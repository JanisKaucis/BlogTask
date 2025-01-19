<x-app-layout>
    <div class="bg-white flex justify-center">
        <form action="{{ route('my-blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1">
                <x-text-input name="title" id="title" value="{{ old('title') }}"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                <input type="file" name="image" value="{{ old('image') }}">
                <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                <textarea name="description" id="description"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                <x-text-input name="author" id="author" value="{{ old('author') }}"/>
                <x-input-error :messages="$errors->get('author')" class="mt-2"/>
                <x-text-input type="datetime-local" name="creation_datetime" id="creation_datetime" value="{{ old('creation_datetime') }}"/>
                <x-input-error :messages="$errors->get('creation_datetime')" class="mt-2"/>
                <select name="categories[]" id="categories" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(in_array($category->id, old('categories') ?? [])) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-primary-button>Store</x-primary-button>
            </div>
        </form>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Feb 2, 2025:
                // 'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
    </script>
</x-app-layout>
