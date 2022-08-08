<div>
    <div class="form-group">
        <label for="{{ $id }}">{{ $label }}</label>
        <input id="{{ $id }}"
               name="{{ $id }}"
               type="{{ $type }}"
               value="{{ $value ?? old($id) }}"
               class="form-control @error($id) is-invalid @enderror" />

        @error($id)
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
