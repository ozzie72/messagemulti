<div class="row padding-1 p-1">
    <!-- Componente de Pestañas -->
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="clientTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="client-tab" data-bs-toggle="tab" data-bs-target="#client-data" type="button" role="tab" aria-controls="client-data" aria-selected="true">
                    Datos del Cliente
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-data" type="button" role="tab" aria-controls="user-data" aria-selected="false">
                    Datos del Usuario
                </button>
            </li>
        </ul>
        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="clientTabsContent">
            <!-- Pestaña Datos del Cliente -->
            <div class="tab-pane fade show active" id="client-data" role="tabpanel" aria-labelledby="client-tab">
                <div class="row">
                    <!-- Columna izquierda -->
                    <div class="col-md-6">
                        <!-- Imagen -->
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">{{ __('Logo de la Empresa') }}</label>
                            <div class="image-upload-container">
                                <div class="image-preview mb-2">
                                    @if(isset($client) && $client->image)
                                        <img id="imagePreview" src="{{ file_exists(asset($client->image)) ? asset($client->image) : asset('assets/img/logo_empresa_default.png') }}" alt="Vista previa del logo" class="img-thumbnail" style="max-width: 240px; max-height: 80px;">
                                    @else
                                        <img id="imagePreview" src="{{ asset('assets/img/logo_empresa_default.png') }}" alt="Vista previa del logo" class="img-thumbnail d-none" style="max-width: 240px; max-height: 80px;">
                                    @endif
                                </div>
                                <input type="file" name="image" id="uploadBtn" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                                @enderror
                                <small class="form-text text-muted">Tamaño recomendado: 240x80 px. Formatos aceptados: JPG, PNG, GIF.</small>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="company" class="form-label">{{ __('Nombre Empresa') }}</label>
                            <input type="text" name="company" id="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company', $client?->company) }}" placeholder="Nombre de Empresa" maxlength="50">
                            @error('company')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="ip" class="form-label">{{ __('Dirección Servidor') }}</label>
                            <input type="text" name="ip" id="ip" class="form-control @error('ip') is-invalid @enderror" value="{{ old('ip', $client?->ip) }}" placeholder="Dirección de Servidor" maxlength="50">
                            @error('ip')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                    </div>
                    
                    <!-- Columna derecha -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="port" class="form-label">{{ __('Puerto Conexión') }}</label>
                            <input type="text" name="port" id="port" class="form-control @error('port') is-invalid @enderror" value="{{ old('port', $client?->port) }}" placeholder="Puerto de Conexión">
                            @error('port')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="server_user" class="form-label">{{ __('Usuario Servidor') }}</label>
                            <input type="text" name="server_user" id="server_user" class="form-control @error('server_user') is-invalid @enderror" value="{{ old('server_user', $client?->server_user) }}" placeholder="Nombre de Usuario" maxlength="50">
                            @error('server_user')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="server_pass" class="form-label">{{ __('Contraseña Servidor') }}</label>
                            <input type="password" name="server_pass" id="server_pass" class="form-control @error('server_pass') is-invalid @enderror" value="{{ old('server_pass', $client?->server_pass) }}" placeholder="Contraseña Servidor" maxlength="100">
                            @error('server_pass')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pestaña Datos del Usuario -->
            <div class="tab-pane fade" id="user-data" role="tabpanel" aria-labelledby="user-tab">
                <div class="row">
                    <!-- Columna izquierda -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $client?->name) }}" placeholder="Nombre de Usuario" maxlength="50">
                            @error('name')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="last_name" class="form-label">{{ __('Apellido') }}</label>
                            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $client?->last_name) }}" placeholder="Apellido de Usuario" maxlength="50">
                            @error('last_name')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">{{ __('Correo') }}</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $client?->email) }}" placeholder="Correo de Usuario" maxlength="50">
                            @error('email')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">{{ __('Teléfono') }}</label>
                            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $client?->phone) }}" placeholder="584146352020" maxlength="12">
                            @error('phone')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                    </div>
                    
                    <!-- Columna derecha -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">{{ __('Usuario') }}</label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $client?->username) }}" placeholder="Usuario Asignado" maxlength="50">
                            @error('username')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password', $client?->password) }}" placeholder="Contraseña Inicial" maxlength="50">
                            @error('password')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        
                        @livewire('utils.departments-selects', ['client' => $client ?? null ])
                    </div>
                </div>
                <div>
                    @livewire('utils.regions-selects', ['client' => $client ?? null ])
                    {{-- <livewire:utils.dependent-selects />  --}}
                </div>
                
                
               
            </div>
        </div>
    </div>
    
    <!-- Botón de envío -->
    <div class="col-md-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
@section('script')
<script>
$(document).ready(function() {
    console.log('Document ready ejecutado'); // Para depuración
    
    // Elementos del DOM
    const divitionSelect = document.getElementById('divition_id');
    const departmentSelect = document.getElementById('department_id');
    const imageInput = document.getElementById('uploadBtn');
    const imagePreview = document.getElementById('imagePreview');


    // Función para cargar departamentos

    // Inicialización de tabs
    function initTabs() {
        var tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabElms.forEach(function(tabEl) {
            tabEl.addEventListener('click', function(event) {
                event.preventDefault();
                var tab = new bootstrap.Tab(tabEl);
                tab.show();
            });
        });
    }

    // Vista previa de imagen
    function initImagePreview() {
        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        imagePreview.src = reader.result;
                        imagePreview.classList.remove('d-none');
                    });
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '';
                    imagePreview.classList.add('d-none');
                }
            });
        }

        $('#uploadBtn').change(function(){
            value = this.value.replace("C:"+"\\"+"fakepath"+"\\",'');
            $('#uploadFile').text(value);
        });
    }

    // Inicialización
    initTabs();
    initLocationSelects();
    initImagePreview();
    
   
});
</script>
@endsection