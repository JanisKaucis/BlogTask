<x-app-layout>
    <div>
        <x-nav-link-button :href="route('my-blogs')">All Blogs</x-nav-link-button>
        <x-nav-link-button :href="route('my-blogs.show', ['blog' => $blog])">Show Blog</x-nav-link-button>
    </div>
    <div class="bg-white flex justify-center">
        <form action="{{ route('my-blogs.update', ['blog' => $blog]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1">
                <x-text-input name="title" id="title" value="{{ old('title') ?? $blog->title ?? ''}}"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                @if($blog->image ?? null)
                <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog image" width="100">
                @endif
                <input type="file" name="image" value="{{ old('image') ?? $blog->image ?? ''}}">
                <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                <textarea name="description" id="description" cols="100" rows="10">{{ old('description') ?? $blog->description ?? ''}}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                <x-text-input name="author" id="author" value="{{ old('author') ?? $blog->author ?? '' }}"/>
                <x-input-error :messages="$errors->get('author')" class="mt-2"/>
                <x-text-input type="datetime-local" name="creation_datetime" id="creation_datetime" value="{{ old('creation_datetime') ?? $blog->creation_datetime ?? '' }}"/>
                <x-input-error :messages="$errors->get('creation_datetime')" class="mt-2"/>
                <select name="categories[]" id="categories" multiple>
                    <option value="">-</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(in_array($category->id, old('categories') ?? $selectedCategories ?? [])) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-primary-button>Update</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
