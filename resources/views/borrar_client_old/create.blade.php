@extends('components.layouts.main')

@section('title')
    Crear Nuevo Cliente
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid bg-gray-light no-shadow">
                <div class="box-header with-border text-black">
                    <h3 class="box-title">Crear Cliente</h3>
                    <div class="pull-right">
                        <a href="{{ route('clients.index') }}" class="btn bg-blue-tt btn-sm">
                            <i class="fa fa-list-alt"></i>&nbsp;&nbsp; Lista de Clientes
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="box-body">
                            {!! Form::open([
                                'class'=>'form-horizontal',
                                'route' => ['client.store'],
                                'files' => true
                            ]) !!}
                                <div class="margin text-center">
                                    <h4 class="box-title" >Datos del Cliente</h4>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('client', 'Nombre Empresa', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-briefcase"></i>
                                            </span>
                                        {!! Form::text('client', null, ['class' => 'form-control', 'placeholder' =>'Nombre de Empresa', 'maxlength' => '50' ]) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('server_user', 'Usuario Servidor', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-credit-card"></i>
                                            </span>
                                        {!! Form::text('server_user', null, ['class' => 'form-control', 'placeholder' =>'Nombre de Usuario', 'maxlength' => '50']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('server_pass', 'Contraseña Servidor', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                        {!! Form::text('server_pass', null, ['class' => 'form-control', 'placeholder' =>'Contraseña Servidor', 'maxlength' => '100']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('ip', 'Dirección Servidor', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-server"></i>
                                            </span>
                                        {!! Form::text('ip', null, ['class' => 'form-control', 'placeholder' =>'Dirección de Servidor', 'maxlength' => '50']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('port', 'Puerto Conexión', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-sitemap"></i>
                                            </span>
                                        {!! Form::text('port', null, ['class' => 'form-control', 'placeholder' =>'Puerto de Conexión']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('sc_digitel', 'Código SC Digitel ', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                                            <span class="input-group-addon">
                                                                Nº
                                                            </span>
                                        {!! Form::text('sc_digitel', null, ['class' => 'form-control', 'maxlength' => '50', 'placeholder' =>'SC Digitel']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('sc_movilnet', 'Código SC Movilnet ', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                                            <span class="input-group-addon">
                                                                Nº
                                                            </span>
                                        {!! Form::text('sc_movilnet', null, ['class' => 'form-control', 'maxlength' => '50', 'placeholder' =>'SC Movilnet']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('sc_movistar', 'Código SC Movistar ', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                                            <span class="input-group-addon">
                                                                Nº
                                                            </span>
                                        {!! Form::text('sc_movistar', null, ['class' => 'form-control', 'maxlength' => '50', 'placeholder' =>'SC Movistar']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('image', 'Imagen', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                        <div class="fileUpload btn bg-blue-mess btn-sm">
                                                <span>
                                                    <i class="fa fa-file-image-o"></i>&nbsp;&nbsp; Cargar
                                                </span>
                                            <input id="uploadBtn" type="file" class="upload" name="image"/>
                                        </div>
                                        <div id="uploadFile">Escoge una imagen</div>
                                    </div>
                                </div>

                                <div class="margin">
                                    <h4 class="box-title text-center" >Datos del Usuario Acreditado</h4>
                                </div>



                                <div class="form-group col-md-12">
                                    {!! Form::label('name', 'Nombre', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' =>'Nombre de Usuario', 'maxlength' => '50']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('last_name', 'Apellido', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' =>'Apellido de Usuario', 'maxlength' => '50']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('email', 'Correo', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' =>'Correo de Usuario', 'maxlength' => '50']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('phone', 'Teléfono', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-phone"></i>
                                            </span>
                                        {!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' =>'584146352020', 'maxlength' => '12', ]) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('username', 'Usuario', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user-secret"></i>
                                            </span>
                                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' =>'Usuario Asignado', 'maxlength' => '50']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('password', 'Contraseña', ['class' => 'control-label col-md-3']) !!}
                                    <div class="col-md-9 input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        {!! Form::text('password', null, ['class' => 'form-control' , 'placeholder' =>'Contraseña Inicial', 'maxlength' => '50']) !!}
                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                                <div class="text-center">
                                    <button type="button" class="btn bg-blue-tt btn-sm" data-toggle="modal" data-target="#confirmationModal">
                                        <i class="fa fa-plus-circle"></i>&nbsp;&nbsp; Crear
                                    </button>
                                </div>
                                @include('partials.confirmationModal')
                            {!! Form::close() !!}
                        </div>
                    </div>
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