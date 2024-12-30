@php
 $label ??= null;
 $type  ??= null;
 $name  ??= '';
 $class ??= null;  
 $value ??= '';
 $id    ??= null;
 $placeholder ??= '';
 $span ??= null;
 $span = ucfirst($span)
@endphp

<div @class(['py-2'])>
    <label class="{{ $label }}">
        <input class="{{ $class}} form-radio" @error($name) is-invalid @enderror  type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}">  
        <span class="ml-2 text-gray-700 dark:text-gray-400">{{ $span }}</span>   
    </label>  
</div>
