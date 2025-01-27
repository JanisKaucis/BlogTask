<x-app-layout>
    <div class="bg-white pt-4 pb-24 sm:pb-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex justify-end">
                <a href="{{ route('my-blogs.edit', ['blog' => $blog]) }}" type="button"
                   class="rounded-md bg-gray-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700">
                    Edit Blog</a>
                <a href="{{ route('my-blogs') }}" type="button"
                   class="ml-2 rounded-md bg-gray-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700">
                    Back to My Blogs</a>
            </div>
            <div>
                <h1 class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $blog->title }}</h1>
                <figure class="mt-16">
                    <img class="aspect-video rounded-xl bg-gray-50 object-cover"
                         src="{{ asset('storage/'.$blog->image) }}"
                         alt="">
                </figure>
                <div class="my-6">{!! $blog->description !!}</div>
                <div class="mb-2">
                    <time datetime="2020-03-16"
                          class="text-gray-500">{{ $blog->creation_datetime }}</time>
                </div>
                @foreach($blog->categories as $category)
                    <span
                        class="rounded-full bg-gray-50 mb-4 px-3 py-1.5 font-medium text-gray-600">{{ $category->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
