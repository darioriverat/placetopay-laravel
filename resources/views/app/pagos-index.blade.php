@extends('layout.bootstrap')

@section('title', 'Pago WebCheckout')

@section('content')

<h2><i class="fas fa-shopping-cart"></i> Pago</h2>

<div id="failureMessage"></div>

<form action="/crearTransaccion" id="frmPagos" method="post" data-role="ajax-request" data-title="Transacción" data-id="CREA_TRAN"
    onsubmit="$('#md-request').modal()" data-response="#md-request .modal-body">
    @csrf

    <fieldset>
        <legend>Información del comprador</legend>

        <div class="form-row">
            <div class="form-group col-lg-3 col-sm-6">
                <label for="documentType">Tipo de documento</label>
                <select id="documentType" name="documentType" class="form-control">
                    <option selected>Seleccione ...</option>
                    <option value="CC">Cédula de ciudanía</option>
                    <option value="CE"> Cédula de extranjería</option>
                    <option value="NIT">Número de identificación tributaria</option>
                    <option value="TI">Tarjeta de identidad</option>
                    <option value="SSN">Número de seguridad social</option>
                    <option value="PPN">Pasaporte</option>
                </select>
            </div>
            <div class="form-group col-lg-3 col-sm-6">
                <label for="document">Número de identificación</label>
                <input type="text" class="form-control" id="document" name="document" maxlength="12" />
            </div>
            <div class="form-group col-lg-3 col-sm-6">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="60" />
            </div>
            <div class="form-group col-lg-3 col-sm-6">
                <label for="surname">Apellidos</label>
                <input type="text" class="form-control" id="surname" name="surname" maxlength="60" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="company">Empresa en la que labora</label>
                <input type="text" class="form-control" id="company" name="company" maxlength="60" />
            </div>
            <div class="form-group col-md-4">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="80" />
            </div>
        </div>
        <fieldset>
            <legend>Dirección de residencia</legend>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="country">País</label>
                    <select id="country" name="country" class="form-control">
                        <option value="CO">Colombia</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="state">Departamento / Provincia</label>
                    <select id="state" name="state" class="form-control">
                        <option value="Antioquia">Antioquia</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="city">Ciudad</label>
                    <select id="city" name="city" class="form-control">
                        <option value="Medellín">Medellín</option>
                        <option value="Bello">Bello</option>
                        <option value="Sabaneta">Sabaneta</option>
                        <option value="Salgar">Salgar</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="postalCode">Código postal</label>
                    <input type="text" class="form-control" id="postalCode" name="postalCode" maxlength="10" />
                </div>
                <div class="form-group col-md-3">
                    <label for="street">Dirección</label>
                    <input type="text" class="form-control" id="street" name="street" maxlength="100" />
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" maxlength="30" />
                </div>
            </div>
        </fieldset>
    </fieldset>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="mobile">Número de teléfono móvil</label>
            <input type="text" class="form-control" id="mobile" name="mobile" maxlength="30" />
        </div>
    </div>
    <fieldset>
        <legend>Información de facturación</legend>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="reference">Referencia</label>
                <span class="form-control text-info">2675</span>
                <input type="hidden" class="form-control" id="reference" name="reference" value="2675" />
            </div>
            <div class="form-group col-md-4">
                <label for="description">Concepto</label>
                <span class="form-control text-info">Pago PSE - pruebas técnicas</span>
                <input type="hidden" class="form-control" id="description" name="description" value="Pago PSE - pruebas técnicas" />
            </div>
            <div class="form-group col-md-3">
                <label for="total">Valor a pagar</label>
                <span class="form-control text-danger"><?= number_format(1250000, 2) ?></span>
                <input type="hidden" class="form-control" id="total" name="total" value="1250000" />
            </div>
            <div class="form-group col-md-3">
                <label for="currency">Moneda</label>
                <input type="text" readonly="readonly" class="form-control" id="currency" name="currency" value="COP" />
            </div>
        </div>
        <div class="form-row">
        </div>
    </fieldset>
    <button type="submit" class="btn btn-primary">Confirmar pago</button>
</form>

<div class="modal" tabindex="-1" role="dialog" id="md-request">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Términos de la plataforma</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearInterval(redirectionInterval);">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="
            $('#timer').show();
            $('#timer-desc').show();
            var num = 5;
            redirectionInterval = setInterval(function(){
                if (num == 0)
                    $('#timer').text('...');
                else
                    $('#timer').text(num.toString());
                num--;
                if (num < 0)
                    clearInterval(redirectionInterval);
            }, 1000);
            setTimeout(function(){
                window.location = $('#timer-desc').attr('data-ref');
            }, num * 1000);
        ">Aceptar</button>
      </div>
    </div>
  </div>
</div>

@endsection('content')