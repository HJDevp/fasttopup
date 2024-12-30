@php
 $label ??= null;
 $type  ??= null;
 $name  ??= '';
 $class ??= null;  
 $select_class ??= null;
 $value ??= '';
 $placeholder ??= '';
 $span ??= null;
 $span = ucfirst($span);

    $months = [
       [
         "id" => 1,
         "name" => "Janvier" 
        ],
       [
         "id" => 2,
         "name" => "Fevrier" 
        ],
       [
         "id" => 3,
         "name" => "Mars" 
        ],
       [
         "id" => 4,
         "name" => "Avril" 
        ],
       [
         "id" => 5,
         "name" => "Mai" 
        ],
       [
         "id" => 6,
         "name" => "Juin" 
        ],
       [
         "id" => 7,
         "name" => "Juillet" 
        ],
       [
         "id" => 8,
         "name" => "Aout" 
        ],
       [
         "id" => 9,
         "name" => "Septembre" 
        ],
       [
         "id" => 10,
         "name" => "Octobre" 
        ],
       [
         "id" => 11,
         "name" => "novembre" 
        ],
       [
         "id" => 12,
         "name" => "decembre" 
        ],
    ];

@endphp



<div @class(['py-2', $class])>
    <label class="{{ $label }}">
    <span class="text-gray-700  dark:text-gray-400">{{ $span }}</span>  
    <select class="{{ $select_class }}"  name="{{ $name }}" id="{{ $name }}">
      <option value="" selected>search by month</option>
      @foreach ($months as $month)
          <option 
           value="{{ $month['id'] }}">{{ $month['name'] }}
          </option>
      @endforeach
    </select>
</div>