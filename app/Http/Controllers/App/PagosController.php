<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Auth;
use App\Model\Amount;
use App\Model\Person;
use App\Model\Status;
use App\Model\Address;
use App\Model\PaymentRequest;
use App\Model\RedirectRequest;
use App\Model\RedirectResponse;
use GuzzleHttp\Exception\GuzzleException;

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
            'returnUrl'  => 'http://www.yoursite.com/needed/return',
            'ipAddress'  => '127.0.0.1',
            'userAgent'  => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'CLIENT_USER_AGENT'
        ]);

        try
        {
            $client = new \GuzzleHttp\Client(['curl' => [CURLOPT_SSL_VERIFYPEER => false],'verify' => false, 'base_uri' => 'https://test.placetopay.com']);

            $json = json_encode($request);
            $json_array = json_decode($json);
            $response = $client->request('POST', '/redirection/api/session', ['json' => $json_array]);

            $string_response = $response->getBody()->getContents();
            $object_array = json_decode($string_response);
            $object_array->status = new Status($object_array->status);

            $response = new RedirectResponse($object_array);

            $processUrl = $response->processUrl;
        }
        catch (\Exception $e)
        {
            echo($e->getMessage());
        }

        return view('app.pagos-crearTransaccion', compact('processUrl'));
    }
}