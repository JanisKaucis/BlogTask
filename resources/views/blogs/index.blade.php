<x-app-layout>
    <form action="{{ route('blogs.search') }}" method="GET" enctype="multipart/form-data">
        <div class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex flex-1 items-center justify-center px-2 lg:ml-6 lg:justify-end">
                        <div class="grid w-full max-w-lg grid-cols-1 lg:max-w-xs">
                            <input type="search" name="search"
                                   class="col-start-1 row-start-1 block w-full rounded-md bg-white py-1.5 pl-10 pr-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                   placeholder="Search Blogs">
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="bg-white pb-24 sm:pb-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Blog page</h2>
                <p class="mt-2 text-lg/8 text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam a
                    pharetra diam. Nunc auctor fringilla ultrices.</p>
            </div>
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
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
