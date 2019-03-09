<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Auth;
use App\Model\Amount;
use App\Model\Person;
use App\Model\Status;
use App\Model\Address;
use App\Model\PaymentRequest;
use App\Model\RedirectRequest;
use App\Model\RedirectResponse;
use App\Model\RedirectInformation;
use App\Model\Transaction;
use App\Model\SubscriptionResponse;
use App\Model\NameValuePair;
use App\Model\NameValuePairs;
use App\Model\AmountBase;
use App\Model\AmountConversion;
use App\Model\AmountDiscount;
use GuzzleHttp\Exception\GuzzleException;
use App\RedirectionRequest;

class PagosController extends Controller
{
    /**
     * Muestra el formulario de pagos
     *
     * @return array
     */
    public function index()
    {
        return view('app.pagos-index');
    }

    /**
     * Muestra las últimas transacciones realizadas
     *
     * @return array
     */
    public function list()
    {
        $qb = RedirectionRequest::whereNotNull('requestId');

        $requests = $qb->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        return view('app.pagos-list', compact('requests'));
    }

    /**
     * Muestra el formulario de confirmación del pago
     *
     * @return array
     */
    public function confirmacion(int $id)
    {
        $login     = env('P2P_LOGIN');
        $secretKey = env('P2P_SECRET_KEY');
        $seed      = date('c');

        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        $request = new RedirectRequest([
            'auth' => new Auth([
                "login"   => $login,
                "seed"    => $seed,
                "nonce"   => $nonceBase64,
                "tranKey" => $tranKey
            ])
        ]);

        try
        {
            $client = new \GuzzleHttp\Client([
                'curl' => [CURLOPT_SSL_VERIFYPEER => false],'verify' => false, 'base_uri' => env('P2P_ENDPOINT')
            ]);

            $req = RedirectionRequest::find($id);

            $json = json_encode($request);
            $json_array = json_decode($json);
            $response = $client->request('POST', '/redirection/api/session/' . $req->requestId, ['json' => $json_array]);

            $string_response = $response->getBody()->getContents();
            $object_array = json_decode($string_response);
            $object_array->status = new Status($object_array->status);

            $object_array->request->buyer->address = new Address($object_array->request->buyer->address);
            $object_array->request->buyer = new Person($object_array->request->buyer);

            /*
             * Validaciones sobre la consulta del pago mientras está en estado PENDING.
             *
             * Antes de realizarse el intento de pago en pasarela cualquier consulta al webservice
             * del estado de la misma no devolverá los siguientes objetos en formato JSON, por tanto
             * tampoco existen en la variable $object_array.
             *
             * request->payer
             * request->fields
             * request->payment
             * payment
             */

            if (!is_null($payer = $object_array->request->payer ?? null))
            {
                $object_array->request->payer->address = new Address($object_array->request->payer->address);
                $object_array->request->payer = new Person($object_array->request->payer);
            }

            if (!is_null($fileds = $object_array->request->fields ?? null))
            {
                foreach ($object_array->request->fields as $key => $field)
                    $object_array->request->fields[$key] = new NameValuePair($field);

                $object_array->request->fields = new NameValuePairs(["item" => $object_array->request->fields]);
            }

            if (!is_null($payer = $object_array->request->payment ?? null))
            {
                $object_array->request->payment->amount = new Amount($object_array->request->payment->amount);
                $object_array->request->payment = new Transaction($object_array->request->payment);
            }

            if (!is_null($payer = $object_array->payment ?? null))
            {
                foreach ($object_array->payment as $key => $payment)
                {
                    $object_array->payment[$key]->status = new Status($object_array->payment[$key]->status);
                    $object_array->payment[$key]->amount->from = new AmountBase($object_array->payment[$key]->amount->from);
                    $object_array->payment[$key]->amount->to = new AmountBase($object_array->payment[$key]->amount->to);
                    $object_array->payment[$key]->amount = new AmountConversion($object_array->payment[$key]->amount);
                    $object_array->payment[$key]->discount = new AmountDiscount($object_array->payment[$key]->discount);

                    foreach ($object_array->payment[$key]->processorFields as $k => $field)
                        $object_array->payment[$key]->processorFields[$k] = new NameValuePair($field);

                    $object_array->payment[$key]->processorFields =
                        new NameValuePairs(["item" => $object_array->payment[$key]->processorFields]);

                    $object_array->payment[$key] = new Transaction($object_array->payment[$key]);

                    /*
                     * Actualización de estado de la transacción
                     *
                     * Si retorna directamente de la página de la pasarela actualiza el registro de manera instantánea
                     * para poder ser consultado por la vista de transacciones
                     */

                    $req->payment_status        = $object_array->payment[$key]->status->status;
                    $req->payment_reason        = $object_array->payment[$key]->status->reason;
                    $req->payment_message       = $object_array->payment[$key]->status->message;
                    $req->payment_date          = $object_array->payment[$key]->status->date;
                    $req->payment_reference     = $object_array->payment[$key]->reference;
                    $req->payment_authorization = $object_array->payment[$key]->authorization;
                    $req->payment_currency      = $object_array->payment[$key]->amount->from->currency;
                    $req->payment_total         = $object_array->payment[$key]->amount->from->total;

                    $req->save();
                }
            }

            if (is_object($object_array->subscription))
            {
                $object_array->subscription->status = new Status($object_array->subscription->status);

                foreach ($object_array->subscription->instrument as $key => $field)
                    $object_array->subscription->instrument[$key] = new NameValuePair($field);

                $object_array->subscription->instrument = new NameValuePairs(["item" => $object_array->subscription->instrument]);

                $object_array->subscription = new SubscriptionResponse($object_array->subscription);
            }
            else
                $object_array->subscription = null;

            $object_array->request = new RedirectRequest($object_array->request);
            $information = new RedirectInformation($object_array);

            # NO TIENE AUTORIZACIÓN/CUS
            if ($information->status->status == 'PENDING')
                throw new \Exception("Transacción no completada");
        }
        catch (\Exception $e)
        {
            $message = $e->getMessage();
            return view('error', compact('message'));
        }

        return view('app.pagos-confirmacion', compact('information'));
    }

    /**
     * Realiza una petición de transacción
     *
     * @return array
     */
    public function crearTransaccion()
    {
        $login     = env('P2P_LOGIN');
        $secretKey = env('P2P_SECRET_KEY');
        $seed      = date('c');

        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        $buyer = new Person([
            'documentType' => $_POST["documentType"],
            'document'     => $_POST["document"],
            'name'         => $_POST["name"],
            'surname'      => $_POST["surname"],
            'company'      => $_POST["company"],
            'email'        => $_POST["email"],
            'mobile'       => $_POST["mobile"],
            'address'      => new Address([
                'street'      => $_POST["street"],
                'city'        => $_POST["city"],
                'state'       => $_POST["state"],
                'postalCode'  => $_POST["postalCode"],
                'country'     => $_POST["country"],
                'phone'       => $_POST["phone"],
            ])
        ]);

        $payment = new PaymentRequest([
            'reference'    => $_POST["reference"],
            'description'  => $_POST["description"],
            'amount'       => new Amount([
                'currency'    => $_POST["currency"],
                'total'       => $_POST["total"],
            ]),
            'allowPartial' => 'false'
        ]);

        $id = DB::table('redirect_request')->max('id');
        $id = is_null($id) ? 1 : $id + 1;

        $request = new RedirectRequest([
            'auth' => new Auth([
                "login"   => $login,
                "seed"    => $seed,
                "nonce"   => $nonceBase64,
                "tranKey" => $tranKey
            ]),
            'locale'     => 'es_CO',
            'buyer'      => $buyer,
            'payment'    => $payment,
            'expiration' => date('c', strtotime('+1 day')),
            'returnUrl'  => url('/confirmacion') . '/' . $id,
            'ipAddress'  => \Request::ip(),
            'userAgent'  => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'CLIENT_USER_AGENT'
        ]);

        try
        {
            $client = new \GuzzleHttp\Client([
                'curl' => [CURLOPT_SSL_VERIFYPEER => false],'verify' => false, 'base_uri' => env('P2P_ENDPOINT')
            ]);

            $json = json_encode($request);
            $json_array = json_decode($json);
            $response = $client->request('POST', '/redirection/api/session', ['json' => $json_array]);

            $string_response = $response->getBody()->getContents();
            $object_array = json_decode($string_response);
            $object_array->status = new Status($object_array->status);

            $response = new RedirectResponse($object_array);

            $processUrl = $response->processUrl;

            $req = new RedirectionRequest;

            $req->id           = $id;
            $req->requestId    = $response->requestId;
            $req->locale       = $request->locale;
            $req->documentType = $request->buyer->documentType;
            $req->document     = $request->buyer->document;
            $req->name         = $request->buyer->name;
            $req->surname      = $request->buyer->surname;
            $req->company      = $request->buyer->company;
            $req->email        = $request->buyer->email;
            $req->street       = $request->buyer->address->street;
            $req->city         = $request->buyer->address->city;
            $req->state        = $request->buyer->address->state;
            $req->postalCode   = $request->buyer->address->postalCode;
            $req->country      = $request->buyer->address->country;
            $req->phone        = $request->buyer->address->phone;
            $req->mobile       = $request->buyer->mobile;
            $req->reference    = $request->payment->reference;
            $req->description  = $request->payment->description;
            $req->currency     = $request->payment->amount->currency;
            $req->total        = $request->payment->amount->total;
            $req->expiration   = $request->expiration;
            $req->ipAddress    = $request->ipAddress;
            $req->userAgent    = $request->userAgent;
            $req->processUrl   = $response->processUrl;
            $req->status       = $response->status->status;
            $req->reason       = $response->status->reason;
            $req->message      = $response->status->message;
            $req->date         = $response->status->date;

            $req->save();
        }
        catch (\Exception $e)
        {
            $message = $e->getMessage();
            return view('error', compact('message'));
        }

        return view('app.pagos-crearTransaccion', compact('processUrl'));
    }
}