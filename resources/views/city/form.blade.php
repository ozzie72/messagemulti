<div class="row g-3">


    <div class="col-12">
        <div class="mb-3">
            <label for="state_id" class="form-label">{{ __('State') }}</label>
            <select name="state_id" id="state_id" 
                    class="form-select @error('state_id') is-invalid @enderror"
                    aria-describedby="stateHelp">
                <option value="">{{ __('Select a state') }}</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ old('state_id', $city?->state_id) == $state->id ? 'selected' : '' }}>
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
            @error('state_id')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>


    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $city?->name) }}" 
                   placeholder="{{ __('Enter city name') }}"
                   aria-describedby="nameHelp">
            @error('name')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>





    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-circle me-2"></i>{{ __('Submit') }}
        </button>
        <a href="{{ route('cities.index') }}" class="btn btn-outline-secondary ms-2">
            <i class="bi bi-x-circle me-2"></i>{{ __('Cancel') }}
        </a>
    </div>
</div>

<!--div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $city?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="state_id" class="form-label">{{ __('State Id') }}</label>
            <input type="text" name="state_id" class="form-control @error('state_id') is-invalid @enderror" value="{{ old('state_id', $city?->state_id) }}" id="state_id" placeholder="State Id">
            {!! $errors->first('state_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div-->