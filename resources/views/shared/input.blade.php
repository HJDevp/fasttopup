@php
 $label ??= null;
 $type  ??= null;
 $name  ??= '';
 $class ??= null;  
 $value ??= '';
 $placeholder ??= '';
 $span ??= null;
 $span = ucfirst($name)
@endphp



<div @class(['py-2', $class])>
    @if ($type === 'textarea')
        <label class="{{ $label }}">
           <span class="text-gray-700 dark:text-gray-400">{{ $span }}</span>
           <textarea rows="5" class="{{ $class }} form-textarea" @error($name) is-invalid @enderror type="{{ $type }}" name="{{ $name }}" id="{{ $name }}">{{ old($name,$value) }}</textarea>
        </label> 
    @else
        <label class="{{ $label }}">
         <span class="text-gray-700 dark:text-gray-400">{{ $span }}</span>   
         <input class="{{ $class}} form-input" @error($name) is-invalid @enderror placeholder="{{ $placeholder }}"  type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}">  
        </label> 
    @endif
</div>

