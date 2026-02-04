@props(['bookUser', 'size' => 'auto'])

@php
    $classes = match($size) {
        'small' => 'w-16 ',
        'medium' => 'w-24 ',
        'large' => 'w-40',
        'giant' => 'w-52',
        default => 'w-full h-auto',
    };
@endphp

@if(isset($bookUser->book->cover_path))
    <img class="{{ $classes }} object-contain self-start" src="{{ asset($bookUser->book->cover_path) }}" />
@else
    <img class="size-12 itmes-center" src="{{ asset('images/icon_no_image.svg')}}" />
@endif