@props(['category' => 'wishlist'])

<a href="{{ route('dashboard', ['category' => $category]) }}">
    <img src="{{ asset('storage/icon_go_back.svg')}}" alt=''>
    <div>volver atrás</div>
</a>
