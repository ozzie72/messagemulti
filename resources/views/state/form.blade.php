<div class="row g-3">
    <div class="col-12">
        <!-- Campo País -->
        <div class="form-group mb-3">
            <label for="country_id" class="form-label">{{ __('Country') }}</label>
            <select name="country_id" id="country_id" 
                    class="form-select @error('country_id') is-invalid @enderror" required
                    aria-describedby="countryHelp">
                <option value="">{{ __('Select a country') }}</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" 
                        {{ old('country_id', $state->country_id) == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
            @error('country_id')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <!-- Campo Nombre -->
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $state->name) }}" id="name" placeholder="{{ __('Enter name') }}"
                   aria-describedby="nameHelp">
            @error('name')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>

    </div>
    
    <!-- Botón de envío -->
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary px-4">
            {{ __('Submit') }}
        </button>
    </div>
</div>
