<x-app-layout>
    <div class="bg-white pt-4 pb-24 sm:pb-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('my-blogs') }}" type="button"
                   class="rounded-md bg-gray-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700">
                    All Blogs</a>
            </div>
            <div class="flex justify-center">
                <form action="{{ route('my-blogs.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2">
                        <div class="col-span-2 mb-2">
                            <label for="title" class="block font-semibold text-gray-900">Title</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title" value="{{ old('title') ?? '' }}"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                        </div>
                        <div class="col-span-2 sm:col-span-1 mb-2">
                            <label class="font-semibold text-gray-900 mb-2 block">Upload image</label>
                            <input type="file" name="image"
                                   class="w-full text-gray-400 font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-gray-500 rounded"/>
                            <p class="text-xs text-gray-400 mt-2">PNG, JPG are Allowed.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                        </div>
                        <div class="col-span-2 mb-2">
                            <label for="description" class="block font-semibold text-gray-900">Description</label>
                            <textarea name="description"
                                      id="description">{{ old('description') ?? ''}}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                        </div>
                        <div class="col-span-2 sm:col-span-1 mb-2">
                            <label for="author" class="block font-semibold text-gray-900">Author</label>
                            <div class="mt-2">
                                <input type="text" name="author" id="author"
                                       value="{{ old('author') ?? '' }}"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                            <x-input-error :messages="$errors->get('author')" class="mt-2"/>
                        </div>
                        <div class="col-span-2 sm:col-span-1 mb-2 ml-2">
                            <label for="creation_datetime" class="block font-semibold text-gray-900">Creation
                                datetime</label>
                            <div class="mt-2">
                                <input type="datetime-local" name="creation_datetime" id="creation_datetime"
                                       value="{{ old('creation_datetime') ?? '' }}"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                            <x-input-error :messages="$errors->get('creation_datetime')" class="mt-2"/>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <div class="mt-2 grid grid-cols-1">
                                <fieldset>
                                    <legend class="text-base font-semibold text-gray-900">Categories</legend>
                                    <div class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200">
                                        @foreach($categories as $category)
                                            <div class="relative flex gap-3 py-4">
                                                <div class="min-w-0 flex-1 text-sm/6">
                                                    <label for="person-1"
                                                           class="select-none font-medium text-gray-900">{{ $category->name }}</label>
                                                </div>
                                                <div class="flex h-6 shrink-0 items-center">
                                                    <div class="group grid size-4 grid-cols-1">
                                                        <input id="person-1" name="categories[]" type="checkbox"
                                                               @if(in_array($category->id, old('categories') ?? [])) checked
                                                               @endif value="{{ $category->id }}"
                                                               class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                                                        <svg
                                                            class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path class="opacity-0 group-has-[:checked]:opacity-100"
                                                                  d="M3 8L6 11L11 3.5" stroke-width="2"
                                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path
                                                                class="opacity-0 group-has-[:indeterminate]:opacity-100"
                                                                d="M3 7H11" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <x-input-error :messages="$errors->get('categories')" class="mt-2"/>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <x-primary-button>Store</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Feb 2, 2025:
                // 'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                {value: 'First.Name', title: 'First Name'},
                {value: 'Email', title: 'Email'},
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
    </script>
</x-app-layout>
