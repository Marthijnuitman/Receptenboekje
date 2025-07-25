<x-app-layout>
    <div class="header-foto" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/stock/default.png') }}')">
            <h1 class="title1">Nieuw Recept aanmaken</h1>
            <h2 class="title2">Voeg hier je nieuwe recept toe</h2>
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

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title" class="form-label">Titel</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div>
                <label for="description" class="form-label">Beschrijving</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div>
                <label for="instructions" class="form-label">Instructies</label>
                <textarea name="instructions" class="form-control" required></textarea>
            </div>

            <div>
                <label for="prep_time" class="form-label">Voorbereidingstijd (minuten)</label>
                <input type="number" name="prep_time" class="form-control" required>
            </div>

            <div>
                <label for="cook_time" class="form-label">Kooktijd (minuten)</label>
                <input type="number" name="cook_time" class="form-control" required>
            </div>

            <div>
                <label for="servings" class="form-label">Porties</label>
                <input type="number" name="servings" class="form-control" required>
            </div>

            <div>
                <label for="category_id" class="form-label">Categorie</label>
                <select name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="images" class="form-label">Afbeeldingen</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
</x-app-layout>
