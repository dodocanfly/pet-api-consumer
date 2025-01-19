<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        <option>-- select --</option>
        @foreach($items as $itemValue => $itemLabel)
            <option value="{{ $itemValue }}" @selected($itemValue == old($name, $currentValue ?? null))>{{ $itemLabel }}</option>
        @endforeach
    </select>
    @error($name) <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
