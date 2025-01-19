<x-app-layout>
    <div class="bg-white px-6 pt-4 pb-32 lg:px-8">
        <div class="flex justify-end">
            <a href="{{ route('blogs') }}" type="button"
               class="rounded-md bg-gray-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700">
                Back to All Blogs</a>
        </div>
        <div class="mx-auto max-w-5xl text-base/7 text-gray-700">
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
                        class="rounded-full bg-gray-50 mb-4 px-3 py-1.5 font-medium text-gray-600">{{ $category->category->name }}</span>
                @endforeach
            </div>
            <div>
                <div class="my-10">
                    <h2>Comments</h2>
                    <div class="">
                        @foreach($comments as $comment)
                            <div class="flex space-x-4 text-sm text-gray-500">
                                <div class="flex-1 py-1">
                                    <h3 class="font-medium text-gray-900">{{$comment->user->name ?? 'Deleted user'}}</h3>
                                    <div class="mt-4 text-sm/6 text-gray-500 flex space-x-4 justify-between">
                                        <p>{{$comment->comment}}</p>
                                        @if($comment->user && $comment->user->id === auth()->user()->id)
                                            <form
                                                action="{{ route('blogs.comment.destroy', ['comment' => $comment]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @auth()
                    <div class="flex items-start space-x-4">
                        <div class="min-w-0 flex-1">
                            <form action="{{ route('blogs.comment.store', ['blog' => $blog]) }}" method="POST"
                                  class="relative">
                                @csrf
                                <div
                                    class="rounded-lg bg-white outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <label for="comment" class="sr-only">Add your comment</label>
                                    <textarea rows="5" name="comment" id="comment"
                                              class="block w-full resize-none bg-transparent px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                              placeholder="Add your comment..."></textarea>
                                </div>

                                <div class="absolute inset-x-0 bottom-0 flex justify-end py-2 pl-3 pr-2">
                                    <div class="shrink-0">
                                        <button type="submit"
                                                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Post
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
