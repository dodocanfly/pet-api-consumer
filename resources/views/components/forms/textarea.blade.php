<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
              @if(!empty($rows)) rows="{{ $rows }}" @endif
              @if(!empty($placeholder)) placeholder="{{ $placeholder }}" @endif>{{ old($name, $value ?? null) }}</textarea>
    @error($name) <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
