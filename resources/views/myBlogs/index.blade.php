<x-app-layout>

    <div class="bg-white pt-4 pb-24 sm:pb-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex @if(count($blogs) < 1) justify-center @else justify-end @endif">
                <a href="{{ route('my-blogs.create') }}" type="button"
                   class="rounded-md bg-gray-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700">
                    Create Blog</a>
            </div>
            <div
                class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($blogs as $blog)
                    <article class="flex flex-col items-start justify-between">
                        <a href="{{ route('blogs.show', ['blog' => $blog]) }}">
                            <div class="relative w-full">
                                <img src="{{ asset('storage/'.$blog->image) }}" alt=""
                                     class="aspect-video w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                                <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                            </div>
                        </a>
                        <div class="max-w-xl">
                            <div class="mt-4 flex items-center gap-x-4 text-xs">
                                <time datetime="2020-03-16"
                                      class="text-gray-500">{{ $blog->creation_datetime }}</time>
                            </div>
                            <div class="mt-2 grid grid-cols-4 items-center gap-x-2 text-xs">
                                @foreach($blog->categories as $category)
                                    <a href="{{ route('blogs.category', ['category' => $category->category_id]) }}"
                                       class="rounded-full bg-gray-50 mb-1 px-3 py-1.5 font-medium text-gray-600">{{ $category->category->name }}</a>
                                @endforeach
                            </div>
                            <div class="group relative">
                                <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        {{ $blog->title }}
                                    </a>
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">{{ $blog->description }}</p>
                            </div>
                            <div class="relative mt-8 flex items-center gap-x-4">
                                <div class="text-sm/6">
                                    <p class="font-semibold text-gray-900">
                                        <a href="#">
                                            <span class="absolute inset-0"></span>
                                            {{ $blog->author }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

