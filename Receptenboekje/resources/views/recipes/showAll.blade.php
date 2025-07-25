<x-app-layout>
    <div class="header-foto" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/stock/image1.png') }}')"> 

            <h1 class="title1">Receptenboekje</h1>
            <h2 class="title2">Zie hier alle heerlijke recepten</h2>
    </div>

    <div class="container">
        <div class="image-column">
            @foreach ($recipes as $recipe)
            <a href="/recipes/{{ $recipe->id }}">
                <div class="recipe-card">
                    <div class="recipe-image">
                        @if ($recipe->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $recipe->images->first()->url) }}" alt="{{ $recipe->name }}">
                        @else
                            <img src="{{ asset('images/stock/default.png') }}" alt="Default Image">
                        @endif
                    </div>
                    <div class="recipe-text">
                        <h1 class="title1">{{ $recipe->title }}</h1>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
