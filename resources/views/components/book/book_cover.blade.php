@props(['bookUser'])
@if($bookUser->book->cover_path)
    <div class="w-5 h-5 m-1 border-2 rounded-sm bg-amber-200">F</div>
    {{-- <img class="w-full h-auto object-cover" src="{{ asset($bookUser->book->cover_path) }}" /> --}}
@else
    <img class="size-12 itmes-center" src="{{ asset('images/icon_no_image.svg')}}" />
@endif