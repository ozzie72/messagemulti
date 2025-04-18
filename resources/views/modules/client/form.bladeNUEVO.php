<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ isset($client) ? 'Editar' : 'Crear' }} Cliente</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($client))
                            @method('PUT')
                        @endif

                        <div class="row mb-3">
                            <!-- Primera columna -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company" class="form-label">Empresa</label>
                                    <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $client->company ?? '') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $client->name ?? '') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $client->last_name ?? '') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="ip" class="form-label">IP</label>
                                    <input type="text" class="form-control" id="ip" name="ip" value="{{ old('ip', $client->ip ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="port" class="form-label">Puerto</label>
                                    <input type="text" class="form-control" id="port" name="port" value="{{ old('port', $client->port ?? '') }}">
                                </div>
                            </div>

                            <!-- Segunda columna -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="server_user" class="form-label">Usuario del Servidor</label>
                                    <input type="text" class="form-control" id="server_user" name="server_user" value="{{ old('server_user', $client->server_user ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="server_pass" class="form-label">Contraseña del Servidor</label>
                                    <input type="password" class="form-control" id="server_pass" name="server_pass" value="{{ old('server_pass', $client->server_pass ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Imagen</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if(isset($client) && $client->image)
                                        <img src="{{ asset('storage/'.$client->image) }}" width="100" class="mt-2">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Estado</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="1" {{ (old('status', $client->status ?? '') == 1 ? 'selected' : '') }}>Activo</option>
                                        <option value="0" {{ (old('status', $client->status ?? '') == 0 ? 'selected' : '') }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Tercera fila - Relaciones -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="divition_id" class="form-label">División</label>
                                    <select class="form-select" id="divition_id" name="divition_id">
                                        <option value="">Seleccione una división</option>
                                        @foreach($divitions as $divition)
                                            <option value="{{ $divition->id }}" {{ old('divition_id', $client->divition_id ?? '') == $divition->id ? 'selected' : '' }}>
                                                {{ $divition->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="department_id" class="form-label">Departamento</label>
                                    <select class="form-select" id="department_id" name="department_id">
                                        <option value="">Seleccione un departamento</option>
                                        @if(isset($client) && $client->department_id)
                                            <option value="{{ $client->department_id }}" selected>{{ $client->department->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Cuarta fila - Ubicación -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="country_id" class="form-label">País</label>
                                    <select class="form-select" id="country_id" name="country_id">
                                        <option value="">Seleccione un país</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id', $client->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="state_id" class="form-label">Estado/Provincia</label>
                                    <select class="form-select" id="state_id" name="state_id" {{ !isset($client->state_id) && !old('state_id') ? 'disabled' : '' }}>
                                        <option value="">Seleccione un estado</option>
                                        @if(isset($client) && $client->state_id)
                                            <option value="{{ $client->state_id }}" selected>{{ $client->state->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="city_id" class="form-label">Ciudad</label>
                                    <select class="form-select" id="city_id" name="city_id" {{ !isset($client->city_id) && !old('city_id') ? 'disabled' : '' }}>
                                        <option value="">Seleccione una ciudad</option>
                                        @if(isset($client) && $client->city_id)
                                            <option value="{{ $client->city_id }}" selected>{{ $client->city->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($client) ? 'Actualizar' : 'Guardar' }}
                            </button>
                            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Cargar departamentos cuando se selecciona una división
        $('#divition_id').change(function() {
            var divitionId = $(this).val();
            if (divitionId) {
                $.get('/api/departments/' + divitionId, function(data) {
                    $('#department_id').empty().append('<option value="">Seleccione un departamento</option>');
                    $.each(data, function(key, value) {
                        $('#department_id').append('<option value="'+key+'">'+value+'</option>');
                    });
                    $('#department_id').prop('disabled', false);
                });
            } else {
                $('#department_id').empty().append('<option value="">Seleccione un departamento</option>').prop('disabled', true);
            }
        });

        // Cargar estados cuando se selecciona un país
        $('#country_id').change(function() {
            var countryId = $(this).val();
            if (countryId) {
                $.get('/api/states/' + countryId, function(data) {
                    $('#state_id').empty().append('<option value="">Seleccione un estado</option>');
                    $.each(data, function(key, value) {
                        $('#state_id').append('<option value="'+key+'">'+value+'</option>');
                    });
                    $('#state_id').prop('disabled', false);
                    $('#city_id').empty().append('<option value="">Seleccione una ciudad</option>').prop('disabled', true);
                });
            } else {
                $('#state_id').empty().append('<option value="">Seleccione un estado</option>').prop('disabled', true);
                $('#city_id').empty().append('<option value="">Seleccione una ciudad</option>').prop('disabled', true);
            }
        });

        // Cargar ciudades cuando se selecciona un estado
        $('#state_id').change(function() {
            var stateId = $(this).val();
            if (stateId) {
                $.get('/api/cities/' + stateId, function(data) {
                    $('#city_id').empty().append('<option value="">Seleccione una ciudad</option>');
                    $.each(data, function(key, value) {
                        $('#city_id').append('<option value="'+key+'">'+value+'</option>');
                    });
                    $('#city_id').prop('disabled', false);
                });
            } else {
                $('#city_id').empty().append('<option value="">Seleccione una ciudad</option>').prop('disabled', true);
            }
        });

        // Si hay valores antiguos (por validación fallida), cargar los selects correspondientes
        @if(old('country_id'))
            $('#country_id').trigger('change');
            setTimeout(function() {
                $('#state_id').val('{{ old('state_id') }}').trigger('change');
            }, 500);
        @endif

        @if(old('state_id'))
            setTimeout(function() {
                $('#city_id').val('{{ old('city_id') }}');
            }, 1000);
        @endif

        @if(old('divition_id'))
            $('#divition_id').trigger('change');
            setTimeout(function() {
                $('#department_id').val('{{ old('department_id') }}');
            }, 500);
        @endif
    });
</script>

