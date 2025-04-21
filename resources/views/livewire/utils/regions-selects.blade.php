
<div>
    <div class="mb-4">
        <label>País:</label>
        <select wire:model.live="countryId" name="countryId" id="countryId" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona un pais", "allowClear": true }' style="width: 50%">
            @foreach ($countries as $country)
               
                <option value="{{ $country->id }}" {{ $client?->country_id == $country->id ? 'Selected' : '' }}>{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
  
    <div class="mb-4">
        <label>Estado:</label>
        <select wire:model.live="stateId" name="stateId" id="stateId" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona un estado", "allowClear": true }' style="width: 50%">
            @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ $client?->state_id == $state->id ? 'Selected' : '' }}>{{ $state->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>Ciudad:</label>
        <select wire:model.live="cityId" name="cityId" id="cityId" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona una ciudad", "allowClear": true }' style="width: 50%">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ $client?->city_id == $city->id ? 'Selected' : '' }}>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
</div>

@push('scripts')

<script>
    $('#countryId').on('change', function (e) {
        @this.set('countryId', e.target.value);
    });
    $('#stateId').on('change', function (e) {
        @this.set('stateId', e.target.value);
    });
    
</script>

@endpush



