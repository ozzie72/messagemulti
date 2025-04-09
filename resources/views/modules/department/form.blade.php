<div class="row g-3">
    <div class="col-12">



        <div class="mb-3">
            <label for="divition_id" class="form-label">{{ __('Divition') }}</label>
            <select name="divition_id" class="form-select @error('divition_id') is-invalid @enderror" 
                   id="divition_id" aria-describedby="divitionHelp">
                <option value="">{{ __('Select a division') }}</option>
                @foreach($divitions as $divition)
                    <option value="{{ $divition->id }}" {{ old('divition_id', $department?->divition_id) == $divition->id ? 'selected' : '' }}>
                        {{ $divition->name }}
                    </option>
                @endforeach
            </select>
            @error('divition_id')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $department?->name) }}" id="name" 
                   placeholder="{{ __('Enter department name') }}" aria-describedby="nameHelp">
            @error('name')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                      id="description" rows="3" 
                      placeholder="{{ __('Enter department description') }}"
                      aria-describedby="descriptionHelp">{{ old('description', $department?->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>