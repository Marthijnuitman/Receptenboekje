<x-app-layout>
    @if ($recipe->images->isNotEmpty())
        <div class="header-foto" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('storage/' . $recipe->images->first()->url) }}')">
    @else
        <!-- <div class="header-foto">  -->
            <div class="header-foto" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/stock/default.png') }}')">
    @endif

            <h1 class="title1">{{ $recipe->title }}</h1>
            <h2 class="title2">Ontdek de smaken, stap voor stap bereid met liefde.</h2>
    </div>
    <div class="content-block d-flex gap-4">
    <div class="left flex-shrink-0" style="width: 500px;">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($recipe->images as $index => $image)
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner rounded shadow-sm overflow-hidden">
                @foreach ($recipe->images as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->url) }}" class="d-block w-100" alt="{{ $recipe->title }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="right flex-grow-1">
        <h2 class="fw-bold mb-3">{{ $recipe->title }}</h2>
        <div class="mb-3 text-muted small">
            <span><i class="bi bi-journal-text"></i>{{ $recipe->category->name}}</span>
        </div>
        <p class="mb-4">{{ $recipe->description }}</p>
        <ul class="list-unstyled d-flex gap-4 mb-4">
            <li><i class="bi bi-clock"></i> {{ $recipe->prep_time }} min bereiden</li>
            <li><i class="bi bi-basket"></i> {{ $recipe->category->name ?? 'categorie' }}</li>
        </ul>
        <ul class="list-unstyled d-flex gap-4 mb-4">
            @if($recipe->user_id == Auth::id())
                <li><a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary">Bewerken</a></li>
                <li><form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Verwijderen</button>
                </form></li>
            @endif
        </ul>
    </div>
</div>
</x-app-layout>
