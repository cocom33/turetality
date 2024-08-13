@props(['type' => '', 'classb' => '', 'text', 'color' => '', 'id', 'attr' => '', 'class' => ''])

<button {{ $attr }} class="{{ $class }} px-5 py-2 rounded shadow text-white bg-{{ $color }}-700 hover:bg-{{ $color }}-500 transition-all duration-300 disabled:bg-slate-500 disabled:cursor-not-allowed"
data-tw-toggle="modal" data-tw-target="#{{ $id }}">{!! $text !!}</button>

<div id="{{ $id }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $type }}">
        <div class="modal-content">
            <div class="modal-body p-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
