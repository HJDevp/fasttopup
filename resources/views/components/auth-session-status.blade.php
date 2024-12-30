@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 
    "flex items-center justify-center p-4 mb-8 text-lg t font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"]) }}>
        {{ ucfirst($status) }}
    </div>
@endif
