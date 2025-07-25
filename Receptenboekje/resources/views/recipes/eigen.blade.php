<x-app-layout>

    <div class="header-foto" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/stock/default.png') }}')">
            <h1 class="title1">recepten</h1>
            <h2 class="title2">Klik hier onder om een nieuw recept toe te voegen
            </h2>
            <div class="btn-holder">
                <a class="btn" style="width: 265px; border-radius: 33px; font-size: 19px;" href="{{ route('recipes.create') }}">Nieuw recept</a>
            </div>
    </div>
    <div class="container">
        <h1 class="title">Eigen Recepten</h1>

        @if($recipes->isEmpty())
            <div class="alert" role="alert">
                <p class="font-semibold">Je hebt nog geen eigen recepten.</p>
            </div>
        @else
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
        @endif
    </div>
</x-app-layout>
