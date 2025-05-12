<div class="row padding-1 p-1">
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
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location-data" type="button" role="tab" aria-controls="location-data" aria-selected="false">
                    Ubicación
                </button>
            </li>
        </ul>

        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="clientTabsContent">
            <div class="tab-pane fade show active" id="client-data" role="tabpanel" aria-labelledby="client-tab">
                <div class="row">
                    <div class="col-md-6">
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

                        <div class="form-group mb-3">
                            <label for="port" class="form-label">{{ __('Puerto Conexión') }}</label>
                            <input type="text" name="port" id="port" class="form-control @error('port') is-invalid @enderror" value="{{ old('port', $client?->port) }}" placeholder="Puerto de Conexión">
                            @error('port')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
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


                    <div class="col-md-6">

                        <div class="form-group mb-3">
                            <label for="image" class="form-label">{{ __('Imagen') }}</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                        <div class="mb-3">
                            <img id="image-preview" src="{{ $client?->image ? asset('storage/' . $client->image) : 'https://via.placeholder.com/150' }}" alt="Vista previa de la imagen" style="max-width: 150px; max-height: 150px;">
                        </div>
                    </div>
                    
                    
                </div>
            </div>






            <div class="tab-pane fade" id="user-data" role="tabpanel" aria-labelledby="user-tab">
                <div class="row">
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
                            <label for="username" class="form-label">{{ __('Usuario') }}</label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $client?->username) }}" placeholder="Usuario Asignado" maxlength="50">
                            @error('username')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">{{ __('Teléfono') }}</label>
                            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $client?->phone) }}" placeholder="584146352020" maxlength="12">
                            @error('phone')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password', $client?->password) }}" placeholder="Contraseña Inicial" maxlength="50">
                            @error('password')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="divition_id">Sucursal</label>
                            <select class="form-control" id="divition_id" name="divition_id" >
                                <option value="">Seleccione una Sucursal</option>
                                @foreach($divitions as $divition)
                                    <option value="{{ $divition->id }}" {{ old('divition_id', $client?->divition_id) == $divition->id ? 'selected' : '' }}>
                                        {{ $divition->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="department_id">Departamento</label>
                            <select class="form-control" id="department_id" name="department_id" disabled>
                                <option value="">Seleccione un Departamento</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="location-data" role="tabpanel" aria-labelledby="location-tab">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="country_id">País</label>
                            <select class="form-control" id="country_id" name="country_id" >
                                <option value="">Seleccione un País</option>
                                <!--
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id', $client?->country_id) == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
-->
                                @foreach($countries as $country)
                                    {{-- Usa el ID por defecto si no hay old() o datos del cliente --}}
                                    <option value="{{ $country->id }}" {{ old('country_id', $client?->country_id ?? $defaultCountryId) == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="state_id">Estado</label>
                            <select class="form-control" id="state_id" name="state_id"  disabled>
                                <option value="">Seleccione un Estado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="city_id">Ciudad</label>
                            <select class="form-control" id="city_id" name="city_id"  disabled>
                                <option value="">Seleccione una Ciudad</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const clientTabs = document.getElementById('clientTabs');
    const tabPanes = document.querySelectorAll('.tab-pane');
    const form = document.querySelector('form'); // Asegúrate de que tu formulario tenga un ID o puedes usar el selector adecuado


    // Función para habilitar/deshabilitar atributos 'required' según la pestaña activa
    function updateRequiredAttributes() {
        tabPanes.forEach(pane => {
            const isActive = pane.classList.contains('show');
            const inputs = pane.querySelectorAll('input[required], select[required], textarea[required]');
            inputs.forEach(input => {
                input.disabled = !isActive;
            });
        });
    }

    // Llamar a la función inicialmente y cada vez que se muestra una nueva pestaña
    updateRequiredAttributes();
    clientTabs.addEventListener('show.bs.tab', updateRequiredAttributes);


    // Cargar departamentos al cambiar la sucursal
    const divitionSelect = document.getElementById('divition_id');
    const departmentSelect = document.getElementById('department_id');

    if (divitionSelect.value) {
        loadDepartments(divitionSelect.value);
    }

    divitionSelect.addEventListener('change', function() {
        loadDepartments(this.value);
    });

    function loadDepartments(divitionId) {
        if (divitionId) {
            departmentSelect.disabled = false;
            fetch(`../../divitions/${divitionId}/departments`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    departmentSelect.innerHTML = '<option value="">Seleccione un Departamento</option>';
                    data.forEach(department => {
                        const option = document.createElement('option');
                        option.value = department.id;
                        option.textContent = department.name;
                        if (department.id == "{{ old('department_id', $client?->department_id) }}") {
                            option.selected = true;
                        }
                        departmentSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching departments:', error);
                    departmentSelect.innerHTML = '<option value="">Error loading departments</option>';
                });
        } else {
            departmentSelect.disabled = true;
            departmentSelect.innerHTML = '<option value="">Seleccione un Departamento</option>';
        }
    }



    // Cargar estados al cambiar el país
    const countrySelect = document.getElementById('country_id');
    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('city_id');



    // Obtener los IDs por defecto y los valores previos (old() o del cliente)
    const defaultCountryId = "{{ $defaultCountryId ?? '' }}";
    const defaultStateId = "{{ $defaultStateId ?? '' }}";
    const defaultCityId = "{{ $defaultCityId ?? '' }}";

    const oldCountryId = "{{ old('country_id', $client?->country_id) }}";
    const oldStateId = "{{ old('state_id', $client?->state_id) }}";
    const oldCityId = "{{ old('city_id', $client?->city_id) }}";

    // Determinar el ID del país seleccionado inicialmente
    const initialCountryId = oldCountryId || defaultCountryId;

    if (countrySelect.value) {
        loadStates(countrySelect.value);
    }

    countrySelect.addEventListener('change', function() {
        loadStates(this.value);
        // Resetear los selectores de estado y ciudad al cambiar de país
        stateSelect.innerHTML = '<option value="">Seleccione un Estado</option>';
        stateSelect.disabled = true;
        citySelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
        citySelect.disabled = true;
    });

    function loadStates(countryId) {
        
        if (countryId) {

            setTimeout(() => {

            stateSelect.disabled = false;
            fetch(`../../countries/${countryId}/states`) // Ajusta la ruta según tu API
                .then(response => {

                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    stateSelect.innerHTML = '<option value="">Seleccione un Estado</option>';
                    data.forEach(state => {
                        const option = document.createElement('option');
                        option.value = state.id;
                        option.textContent = state.name;
                        if (state.id == "{{ old('state_id', $client?->state_id) }}") {
                            option.selected = true;
                        }
                        stateSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching states:', error);
                    stateSelect.innerHTML = '<option value="">Error loading estados</option>';
                });

                }, 250); // Tiempo de espera en milisegundos


        } else {
            stateSelect.disabled = true;
            stateSelect.innerHTML = '<option value="">Seleccione un Estado</option>';
            citySelect.disabled = true;
            citySelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
        }
    }

    // Cargar ciudades al cambiar el estado
    if (stateSelect.value && countrySelect.value) {
        loadCities(stateSelect.value);
    }

    stateSelect.addEventListener('change', function() {
        loadCities(this.value);
    });

    function loadCities(stateId) {
        if (stateId) {
            citySelect.disabled = false;
            fetch(`../../states/${stateId}/cities`) // Ajusta la ruta según tu API
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    citySelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        if (city.id == "{{ old('city_id', $client?->city_id) }}") {
                            option.selected = true;
                        }
                        citySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching cities:', error);
                    citySelect.innerHTML = '<option value="">Error loading ciudades</option>';
                });
        } else {
            citySelect.disabled = true;
            citySelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
        }
    }

        // Deshabilitar campos requeridos en pestañas no activas al cargar la página
        updateRequiredAttributes();

});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files && this.files.length > 0 ? this.files [0] : null;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    }
                reader.readAsDataURL(file);
                } else {
                    imagePreview.src = 'https://via.placeholder.com/150';
                }
        });
        }
    });
</script>

