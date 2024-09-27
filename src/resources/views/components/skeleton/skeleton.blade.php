@php
    $personalize = $classes();
@endphp

<div aria-hidden="true" @class([
    'animate-pulse rounded-md bg-gray-200 dark:bg-gray-400',  
    $height, 
    $width
])>
</div>
