<x-app-layout>
    <div class="bg-white flex justify-center">
        <form action="{{ route('my-blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1">
                <x-text-input name="title" id="title" value="{{ old('title') }}"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                <input type="file" name="image" value="{{ old('image') }}">
                <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                <textarea name="description" id="description" cols="100" rows="10">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                <x-text-input name="author" id="author" value="{{ old('author') }}"/>
                <x-input-error :messages="$errors->get('author')" class="mt-2"/>
                <x-text-input type="datetime-local" name="creation_datetime" id="creation_datetime" value="{{ old('creation_datetime') }}"/>
                <x-input-error :messages="$errors->get('creation_datetime')" class="mt-2"/>
                <select name="categories[]" id="categories" multiple>
                    <option value="">-</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(in_array($category->id, old('categories') ?? [])) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-primary-button>Store</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
