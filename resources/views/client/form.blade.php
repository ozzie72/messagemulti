

<div class="row padding-1 p-1">



    
    
    <div class="col-md-6">

        <div class="margin text-center">
            <h5>Datos del Cliente</h5>
        </div>

        <div class="form-group mb-2 mb20">
            <label for="client" class="form-label">{{ __('Nombre Empresa') }}</label>
            <input type="text" name="client" id="client" class="form-control @error('client') is-invalid @enderror" value="{{ old('client', $client?->client) }}" placeholder="Nombre de Empresa" maxlength="50">
            @error('client')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ip" class="form-label">{{ __('Dirección Servidor') }}</label>
            <input type="text" name="ip" id="ip" class="form-control @error('ip') is-invalid @enderror" value="{{ old('ip', $client?->ip) }}" placeholder="Dirección de Servidor" maxlength="50">
            @error('ip')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="port" class="form-label">{{ __('Puerto Conexión') }}</label>
            <input type="text" name="port" id="port" class="form-control @error('port') is-invalid @enderror" value="{{ old('port', $client?->port) }}" placeholder="Puerto de Conexión">
            @error('port')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="server_user" class="form-label">{{ __('Usuario Servidor') }}</label>
            <input type="text" name="server_user" id="server_user" class="form-control @error('server_user') is-invalid @enderror" value="{{ old('server_user', $client?->server_user) }}" placeholder="Nombre de Usuario" maxlength="50">
            @error('server_user')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="server_pass" class="form-label">{{ __('Contraseña Servidor') }}</label>
            <input type="password" name="server_pass" id="server_pass" class="form-control @error('server_pass') is-invalid @enderror" value="{{ old('server_pass', $client?->server_pass) }}" placeholder="Contraseña Servidor" maxlength="100">
            @error('server_pass')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>

    </div>

    <div class="col-md-6">

        <div class="margin">
            <h5 class="text-center" >Datos del Usuario Acreditado</h5>
        </div>        

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $client?->name) }}" placeholder="Nombre de Usuario" maxlength="50">
            @error('name')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="last_name" class="form-label">{{ __('Apellido') }}</label>
            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $client?->last_name) }}" placeholder="Apellido de Usuario" maxlength="50">
            @error('last_name')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label">{{ __('Correo') }}</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $client?->email) }}" placeholder="Correo de Usuario" maxlength="50">
            @error('email')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="phone" class="form-label">{{ __('Teléfono') }}</label>
            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $client?->phone) }}" placeholder="584146352020" maxlength="12">
            @error('phone')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="username" class="form-label">{{ __('Usuario') }}</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $client?->username) }}" placeholder="Usuario Asignado" maxlength="50">
            @error('username')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>
        <div class="form-group mb-2 mb20">
            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
            <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password', $client?->password) }}" placeholder="Contraseña Inicial" maxlength="50">
            @error('password')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
        </div>

        <div class="form-group">
            <label for="divition_id">Sucursal</label>
            <select class="form-control" id="divition_id" name="divition_id" required>
                <option value="">Select a Divition</option>
                @foreach($divitions as $divition)
                    <option value="{{ $divition->id }}">{{ $divition->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="department_id">Departmento</label>
            <select class="form-control" id="department_id" name="department_id" required disabled>
                <option value="">Select a Department</option>
            </select>
        </div>





    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>

<script>

document.getElementById('divition_id').addEventListener('change', function() {
    const divitionId = this.value;
    const departmentSelect = document.getElementById('department_id');
    
    if (divitionId) {
        departmentSelect.disabled = false;
        
        fetch(`../divitions/${divitionId}/departments`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                departmentSelect.innerHTML = '<option value="">Select a Department</option>';
                data.forEach(department => {
                    const option = document.createElement('option');
                    option.value = department.id;
                    option.textContent = department.name;
                    departmentSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching departments:', error);
                departmentSelect.innerHTML = '<option value="">Error loading departments</option>';
            });
    } else {
        departmentSelect.disabled = true;
        departmentSelect.innerHTML = '<option value="">Select a Department</option>';
    }
});






    
</script>