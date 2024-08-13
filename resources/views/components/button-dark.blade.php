@props(['attr' => '', 'color', 'text', 'link' => ''])

@if ($link)
<a {{ $attr }} href="{{ $link }}" class="px-5 py-2 rounded text-black bg-{{ $color }}-800 hover:bg-{{ $color }}-700 transition-all duration-300">{{ $text }}</a>
@else
<button {{ $attr }} class="px-5 py-2 rounded text-black bg-{{ $color }}-800 hover:bg-{{ $color }}-700 transition-all duration-300">{{ $text }}</button>
@endif
