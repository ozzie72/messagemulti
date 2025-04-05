@extends('components.layouts.main')

@section('title')
    Editar Cliente
@endsection

@section('content')
    <div class="box box-solid bg-gray-light no-shadow">
        <div class="box-header with-border text-black">
            <h3 class="box-title">Editar Cliente</h3>
            <div class="pull-right">
                <a href="{{ route('clients.show', $client->id) }}" class="btn bg-blue-tt btn-sm">
                    <i class="fa fa-briefcase"></i>&nbsp;&nbsp; Volver al Cliente
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box-body">
                    {!! Form::open([
                        'class'=>'form-horizontal',
                        'route' => ['clients.update', $client->id],
                        'method' => 'PUT',
                        'files' => true
                    ]) !!}
                    <div class="box-header text-center">
                        <h3 class="box-title" style="margin: 3vh 0">Datos del Cliente</h3>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('client', 'Nombre Empresa', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-briefcase"></i>
                                                </span>
                            {!! Form::text('client', $client->name, ['class' => 'form-control', 'maxlength' => '50']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('server_user', 'Usuario Servidor', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-credit-card"></i>
                                            </span>
                            {!! Form::text('server_user', $client->server_user, ['class' => 'form-control', 'placeholder' =>'Nombre de Usuario', 'maxlength' => '50']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('server_pass', 'Contraseña Servidor', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                            {!! Form::text('server_pass', $client->server_pass, ['class' => 'form-control', 'placeholder' =>'Contraseña Servidor', 'maxlength' => '100']) !!}
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        {!! Form::label('port', 'Puerto Conexión', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-sitemap"></i>
                                                </span>
                            {!! Form::text('port', $client->port, ['class' => 'form-control', 'maxlength' => '50']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('ip', 'Dirección Servidor', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-server"></i>
                                                </span>
                            {!! Form::text('ip', $client->ip, ['class' => 'form-control', 'maxlength' => '15']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('sc_digitel', 'Código SC Digitel ', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    Nº
                                                </span>
                            {!! Form::text('sc_digitel', $client->sc_digitel, ['class' => 'form-control', 'maxlength' => '50', 'value'=>"$client->sc_digitel"]) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('sc_movilnet', 'Código SC Movilnet ', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    Nº
                                                </span>
                            {!! Form::text('sc_movilnet', $client->sc_movilnet, ['class' => 'form-control', 'maxlength' => '50', 'value'=>"client->sc_movilnet"]) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('sc_movistar', 'Código SC Movistar ', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    Nº
                                                </span>
                            {!! Form::text('sc_movistar', $client->sc_movistar, ['class' => 'form-control', 'maxlength' => '50', 'value'=>"$client->sc_movistar"]) !!}
                        </div>
                    </div>

                    <!--<div class="col-md-4 col-md-offset-4">
                        <img src="{{ asset('assets/img/client-'.$client->id.'.jpg') }}" alt="Logo Cliente" class="thumbnail center">
                    </div>-->

                    <div class="form-group col-md-12" style="margin-top: 20px;">
                        <div class="input-group input-group-sm" style="display: flex; align-items: center;">
                            {!! Form::label('image', 'Imagen', ['class' => 'control-label col-md-3 imagen']) !!}
                            <div class="fileUpload btn bg-blue-mess btn-sm pull-left" style="margin-left: 0.5em;">
                                 <span>
                                    <i class="fa fa-file-image-o"></i>&nbsp;&nbsp; Cargar
                                 </span>
                                <input id="uploadBtn" type="file" class="upload" name="image"/>
                            </div>
                            <div id="uploadFile" class="pull-right">
                                    Escoge una imagen
                            </div>
                            <div class="contenedor-logo" style="flex: 1; text-align: right;">
                                <img src="{{ asset('assets/img/client-'.$client->id.'.jpg') }}" alt="Logo Cliente" class="thumbnail center" style="display: inline-block; float: right;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="box-header text-center">
                        <h3 class="box-title" style="margin: 3vh 0">Datos del Usuario Acreditado</h3>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('name', 'Nombre', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                            {!! Form::text('name', $user->name, ['class' => 'form-control', 'maxlength' => '50']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('last_name', 'Apellido', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                            {!! Form::text('last_name', $user->last_name, ['class' => 'form-control', 'maxlength' => '50']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('email', 'Correo', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                            {!! Form::email('email', $user->email, ['class' => 'form-control', 'maxlength' => '50']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('phone', 'Teléfono', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-phone"></i>
                                            </span>
                            {!! Form::tel('phone', $user->phone, ['class' => 'form-control', 'maxlength' => '12', ]) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('username', 'Usuario', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-9 input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user-secret"></i>
                                                </span>
                            {!! Form::text('username', $user->username, ['class' => 'form-control', 'maxlength' => '50']) !!}
                        </div>
                    </div>
                    <div class="text-center margin-bottom">
                        <button type="button" class="btn bg-blue-tt btn-sm" data-toggle="modal" data-target="#confirmationModal">
                            <i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp; Actualizar
                        </button>
                    </div>
                    @include('partials.confirmationModal')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function(){
            $('#uploadBtn').change(function(){
                value = this.value.replace("C:"+"\\"+"fakepath"+"\\",'');
                $('#uploadFile').text(value);
            });
        });
    </script>

@endsection