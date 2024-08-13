@props(['attr' => '', 'color' => '', 'text', 'link' => '', 'class' => ''])

@if ($link)
    <a {{ $attr }} href="{{ $link }}" class="{{ $class }} px-5 py-2 shadow rounded text-white bg-{{ $color }}-700 hover:bg-{{ $color }}-500 transition-all duration-300 disabled:bg-slate-500 disabled:cursor-not-allowed">{!! $text !!}</a>
@else
    <button {{ $attr }} class="{{ $class }} px-5 py-2 rounded shadow text-white bg-{{ $color }}-700 hover:bg-{{ $color }}-500 transition-all duration-300 disabled:bg-slate-500 disabled:cursor-not-allowed">{!! $text !!}</button>
@endif

