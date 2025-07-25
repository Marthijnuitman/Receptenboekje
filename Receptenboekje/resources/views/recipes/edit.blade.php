<x-app-layout>
     @if ($recipe->images->isNotEmpty())
        <div class="header-foto" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('storage/' . $recipe->images->first()->url) }}')">
    @else
        
        <div class="header-foto" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/stock/default.png') }}')">
    @endif
        <h1 class="title1">Recept bewerken</h1>
        <h2 class="title2">Pas hier je recept aan {{ $recipe->title }}</h2>
    </div>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="id" class="form-control" value="{{ old('id', $recipe->id) }}" required>
            <div>
                <label for="title" class="form-label">Titel</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $recipe->title) }}" required>
            </div>

            <div>
                <label for="description" class="form-label">Beschrijving</label>
                <textarea name="description" class="form-control" required>{{ old('description', $recipe->description) }}</textarea>
            </div>

            <div>
                <label for="instructions" class="form-label">Instructies</label>
                <textarea name="instructions" class="form-control" required>{{ old('instructions', $recipe->instructions) }}</textarea>
            </div>
            <div class="row">
                <div style="width: 20%"> 
                    <label for="prep_time" class="form-label">Voorbereidingstijd (minuten)</label>
                    <input type="number" name="prep_time" class="form-control" value="{{ old('prep_time', $recipe->prep_time) }}" required>
                </div>

                <div style="width: 20%">
                    <label for="cook_time" class="form-label">Kooktijd (minuten)</label>
                    <input type="number" name="cook_time" class="form-control" value="{{ old('cook_time', $recipe->cook_time) }}" required>
                </div>

                <div style="width: 20%"> 
                    <label for="servings" class="form-label">Porties</label>
                    <input type="number" name="servings" class="form-control" value="{{ old('servings', $recipe->servings) }}" required>
                </div>

            <div>
                <label for="category_id" class="form-label">Categorie</label>
                <select name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="images" class="form-label">Nieuwe afbeeldingen toevoegen</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Wijzigingen opslaan</button>
        </form>
        
        <div class="imageForm">
            <label class="form-label">Bestaande afbeeldingen</label>
            <div class="clearfix">
                @foreach ($recipe->images as $image)
                    <div class="image-column">
                        <div class="card">
                            <img src="{{ asset('storage/' . $image->url) }}" alt="Foto">
                            <div class="card-body">
                                <form action="{{ route('recipes.photos.destroy', [$recipe->id, $image->id]) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze foto wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Verwijderen</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
