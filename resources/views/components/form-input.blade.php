@props(['label', 'name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'attr' => '', 'required' => true])

<div class="col">
    <label for="{{ $name }}" class="form-label">{{ $label }} @if ($required) <span class="text-red-500">*</span> @endif</label>
    <input id="{{ $name }}" type="{{ $type }}"
        class="form-control @if($type == 'file') py-2 border @endif " value="{{ $value ?? old($name) }}"
        name="{{ $name }}" placeholder="{{ $placeholder }}"
        {{ $attr }}
        @if ($type == 'file')
            accept="image/png, image/jpg, image/jpeg, image/gif"
        @endif
        @if ($required)
            required
        @endif
    >
</div>
