@extends('components.layouts.main')

@section('title')
    Detalle de Cliente
@endsection

@section('content')
    <div class="box box-solid bg-gray-light no-shadow">
        <div class="box-header with-border text-black">
            <h3 class="box-title text-navy">Cliente</h3>
            <div class="pull-right">
                <a href="{{ route('clients.index') }}" class="btn bg-blue-tt btn-sm" >
                    <i class="fa fa-list-alt"></i>&nbsp;&nbsp; Lista de Clientes
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h4 class="text-center">Datos del Cliente</h4>
                    <div class="row">
                        <div class="col-md-8">
                        <dl class="dl-horizontal">
                            <dt>Nombre Empresa:</dt>
                            <dd>{{ $client->name }}</dd>
                            <dt>Usuario Servidor:</dt>
                            <dd>{{ $client->server_user }}</dd>
                            <dt>Contraseña Servidor:</dt>
                            <dd>{{ $client->server_pass }}</dd>
                            <dt>Dirección Servidor:</dt>
                            <dd>{{ $client->ip }}</dd>
                            <dt>Puerto Conexión:</dt>
                            <dd>{{ $client->port }}</dd>
                        </dl>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('assets/img/client-'.$client->id.'.jpg') }}" alt="Logo Cliente" class="thumbnail center">
                        </div>
                    </div>
                    <hr>
                    <h4 class="text-center">Usuario Autorizado</h4>
                    <dl class="dl-horizontal">
                        <dt>Nombre:</dt>
                        <dd>{{ $user->last_name }}, {{$user->name}}</dd>
                        <dt>Usuario:</dt>
                        <dd>{{ $user->username }}</dd>
                        <dt>Correo:</dt>
                        <dd>{{ $user->email }}</dd>
                        <dt>Teléfono:</dt>
                        <dd>{{ $user->phone }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="box-footer text-right">
            <a href="{{ route('clients.edit',$client->id) }}" class="btn btn-sm bg-blue-tt">
                <i class="fa fa-edit"></i>&nbsp;&nbsp; Editar Cliente
            </a>
            @if($client->client_status == 'A')
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmationActivationModal">
                    <i class="fa fa-remove"></i>&nbsp;&nbsp; Desactivar Cliente
                </button>
            @elseif($client->client_status == 'I')
                <button type="button" class="btn btn-sm bg-green-mess text-white" data-toggle="modal" data-target="#confirmationActivationModal">
                    <i class="fa fa-check-square-o"></i>&nbsp;&nbsp; Activar Cliente
                </button>
            @endif
        </div>
    </div>

    <!-- Activation Modal -->
    <div class="modal fade" id="confirmationActivationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirmar Operación</h3>
                </div>
                <div class="modal-body">
                    <h4 class="text-center text-blue-tt">¿Está seguro de realizar la operación?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-remove"></i>&nbsp;&nbsp; Cerrar
                    </button>
                    <a href="{{ route('clients.activation', $client->id) }}" class="btn bg-blue-tt btn-sm">
                        <i class="fa fa-check-square"></i>&nbsp;&nbsp; Confirmar
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection