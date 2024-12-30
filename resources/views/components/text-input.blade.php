@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-zinc-900 focus:zinc-900 rounded-md shadow-sm']) !!}>
