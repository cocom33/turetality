@props(['text'])

{{ strlen($text) >= 18 ? substr($text, 0, 18).'...' : $text }}
