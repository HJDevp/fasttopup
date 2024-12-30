@php
 $label ??= null;
 $type  ??= null;
 $name  ??= '';
 $class ??= null;  
 $select_class ??= null;
 $value ??= '';
 $placeholder ??= '';
 $span ??= null;
 $span = ucfirst($span)
@endphp


<div @class(['py-2', $class])>
    <label class="{{ $label }}">
    <span class="text-gray-700 dark:text-gray-400">{{ $span }}</span>  
    <select class="{{ $select_class }}"  name="{{ $name }}" id="{{ $name }}">
        <option value="">Choisir une avatar</option>
        @foreach ($avatars as $avatar)
            <option @selected(old('avatars_id', $user->avatars?->id) == $avatar->id ) 
             class="bg-gray-50  shadow-sm"    
             value="{{ $avatar->id }}"> {{ $avatar->nom }}
            </option>
        @endforeach
    </select>
</div>