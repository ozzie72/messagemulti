
<div>
    <div class="mb-4">
        <label>País:</label>
        <select wire:model.live="country_id" name="country_id" id="country_id" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona un pais", "allowClear": true }' style="width: 50%">
            @foreach ($countries as $country)
               
                <option value="{{ $country->id }}" {{ $client?->country_id == $country->id ? 'Selected' : '' }}>{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
  
    <div class="mb-4">
        <label>Estado:</label>
        <select wire:model.live="state_id" name="state_id" id="state_id" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona un estado", "allowClear": true }' style="width: 50%">
            @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ $client?->state_id == $state->id ? 'Selected' : '' }}>{{ $state->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>Ciudad:</label>
        <select wire:model.live="city_id" name="city_id" id="city_id" class="form-select" data-plugin-selectTwo data-plugin-options='{ "placeholder": "Selecciona una ciudad", "allowClear": true }' style="width: 50%">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ $client?->city_id == $city->id ? 'Selected' : '' }}>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
</div>

@push('scripts')

<script>
    $('#country_id').on('change', function (e) {
        @this.set('country_id', e.target.value);
    });
    $('#state_id').on('change', function (e) {
        @this.set('state_id', e.target.value);
    });
    
</script>

@endpush



