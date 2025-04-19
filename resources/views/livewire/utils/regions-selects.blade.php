
<div>
    <div class="mb-4">
        <label>País:</label>
        <select wire:model.live="countryId" name="country_id" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona un pais", "allowClear": true }'>
            <option value="">Selecciona un país</option>
            @foreach ($countries as $country)
               
                <option value="{{ $country->id }}" {{ $client?->country_id == $country->id ? 'Selected' : '' }}>{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
  
    @if(count($states))
    <div class="mb-4">
        <label>Estado:</label>
        <select wire:model.live="stateId" name="state_id" id="state_id" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona un estado", "allowClear": true }'>
            @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ $client?->state_id == $state->id ? 'Selected' : '' }}>{{ $state->name }}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if(count($states))
    <div class="mb-4">
        <label>Ciudad:</label>
        <select wire:model.live="cityId" name="city_id" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona una ciudad", "allowClear": true }'>
            <option value="">Selecciona una ciudad</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ $client?->city_id == $city->id ? 'Selected' : '' }}>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
    @endif
</div>
