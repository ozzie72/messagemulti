
<div>
    <div class="mb-4">
        <label>País:</label>
        <select wire:model.live="countryId" name="country_id" class="form-select">
            <option value="">Selecciona un país</option>
            @foreach ($countries as $country)
               
                <option value="{{ $country->id }}" {{ old('country_id', $client?->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    @if(count($states))
    <div class="mb-4">
        <label>Estado:</label>
        <select wire:model.live="stateId" name="state_id" class="form-select">
            <option value="">Selecciona un estado</option>
            @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ old('state_id', $client?->state_id) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if(count($cities))
    <div class="mb-4">
        <label>Ciudad:</label>
        <select wire:model.live="cityId" name="city_id" class="form-select">
            <option value="">Selecciona una ciudad</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ old('city_id', $client?->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
    @endif
</div>
