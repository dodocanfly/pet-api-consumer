<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
           @if(!empty($placeholder)) placeholder="{{ $placeholder }}" @endif value="{{ old($name, $value ?? null) }}"
           @readonly($readonly ?? false)>
    @error($name) <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
