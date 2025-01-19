<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}[]" id="{{ $name }}" class="form-select @error( $name ) is-invalid @enderror"
            multiple @if(!empty($size)) size="{{ $size }}" @endif>
        <option disabled>-- select one or more --</option>
        @foreach($items as $itemValue => $itemLabel)
            <option value="{{ $itemValue }}" @selected(in_array($itemValue, old($name, $currentValue ?? [])))>{{ $itemLabel }}</option>
        @endforeach
    </select>
    @error('tags') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
