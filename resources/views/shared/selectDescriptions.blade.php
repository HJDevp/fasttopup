@php
 $label ??= null;
 $type  ??= null;
 $name  ??= '';
 $class ??= null;  
 $select_class ??= null;
 $value ??= '';
 $placeholder ??= '';
 $span ??= null;
 $span = ucfirst($name)
@endphp


<div @class(['py-2', $class])>
    <label class="{{ $label }}">
    <span class="text-gray-700 dark:text-gray-400">{{ $span }}</span>  
    <select class="{{ $select_class }}"  name="{{ $name }}" id="{{ $name }}">
        <option value="">Selectionner une description</option>
        @foreach ($Descriptions as $description)
            <option @selected(old('descriptions_id', $freeFireCard->descriptions?->id) == $description->id ) 
             value="{{ $description->id }}">{{ $description->nom }}
            </option>
        @endforeach
    </select>
</div>