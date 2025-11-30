@props(['category' => 'wishlist'])

<a class="links flex flex-row gap-2" href="{{ route('dashboard', ['category' => $category]) }}">
    <img src="{{ asset('images/icon_go_back.svg')}}" alt=''>
    <div class="inline-flex items-center">Volver atrás</div>
</a>
