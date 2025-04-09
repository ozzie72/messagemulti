<div class="row g-3">
    <div class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" 
                   name="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $country?->name) }}" 
                   id="name" 
                   placeholder="{{ __('Enter country name') }}"
                   aria-describedby="nameHelp"
                   required>
            @error('name')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror

        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Code {{ __('Country') }}  (ISO 3166-1)</label>
            <input type="text" 
                   name="code" 
                   class="form-control @error('code') is-invalid @enderror" 
                   value="{{ old('code', $country?->code) }}" 
                   id="code" 
                   placeholder="{{ __('e.g. US, CA, MX') }}"
                   aria-describedby="codeHelp"
                   required
                   maxlength="2"
                   pattern="[A-Za-z]{2}"
                   title="{{ __('2-letter country code') }}">
            @error('code')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror

        </div>
    </div>

    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary px-4 py-2">
            <i class="bi bi-check-circle me-2"></i>{{ __('Submit') }}
        </button>
    </div>
</div>
