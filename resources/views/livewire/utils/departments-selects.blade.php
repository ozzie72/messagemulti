
<div>
    <div class="form-group mb-3">
        <label>Sucursales:</label>
        <select wire:model.live="divitionId" name="divition_id" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona sucursal", "allowClear": true }'>
            <option value="">Selecciona sucursal</option>
            @foreach ($divitions as $divition)
               
                <option value="{{ $divition->id }}" {{ old('divition_id', $this->client?->divition_id) == $divition->id ? 'selected' : '' }}>{{ $divition->name }}</option>
            @endforeach
        </select>
        @error('username')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
    </div>

    @if(count($divitions))
    <div class="form-group mb-3">
        <label>Departamentos:</label>
        <select wire:model.live="departmentId" name="department_id" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona departamento", "allowClear": true }'>
            <option value="">Selecciona departamento</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ old('department_id', $this->client?->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select>
    </div>
    @endif

</div>
