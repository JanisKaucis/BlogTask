<x-app-layout>
    <div>
        <x-nav-link-button :href="route('my-blogs')">All Blogs</x-nav-link-button>
        <x-nav-link-button :href="route('my-blogs.edit', ['blog' => $blog])">Edit Blog</x-nav-link-button>
    </div>
    <div class="w-1/2">
        {{ $blog->title }}
        <div>
            <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog image" class="object-cover h-48 w-96">
        </div>
        {{ $blog->description }}
        <div>
            @foreach($blog->categories as $category)
                <div>{{ $categories[$category->category_id] }}</div>
            @endforeach
        </div>
    </div>
</x-app-layout>
