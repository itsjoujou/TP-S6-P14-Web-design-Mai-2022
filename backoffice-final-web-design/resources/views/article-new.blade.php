@extends('layouts.layout')

@section('title')
    New article
@endsection

@section('page_assets')
<script src="{{ asset('assets/lib/ckeditor.js') }}"></script>
<!-- <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script> -->
<script>
    window.onload = function() {
        // setting the ck-editor form
        ClassicEditor.create(document.querySelector('#ck-editor'));
        
        // setting listeners on the image input
        document.getElementById("inputForImage").addEventListener("change", function() {
            let file = this.files[0],
            reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function() {
                document.getElementById("hiddenInputForImage").value = reader.result;
                document.getElementById("image").innerHTML = '<img class="card-img mb-3" src="'+ reader.result +'" id="articleImage">';
            }
        });
    };
</script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Article / </span>New</h4>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mb-4">
            <h5 class="card-header">New article</h5>
            <form action="{{ route('save_article') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="inputForTitre" class="form-label">Title</label>
                        <textarea
                                class="form-control"
                                id="inputForTitre"
                                placeholder="Enter the title"
                                name="title"
                                rows="2"
                        ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="inputForSummary" class="form-label">Summary</label>
                        <textarea
                                class="form-control"
                                id="inputForSummary"
                                placeholder="Summarize the content"
                                name="summary"
                                rows="2"
                        ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editor" class="form-label">Body</label>
                        <textarea
                                class="form-control"
                                id="ck-editor"
                                placeholder="What is it about..."
                                name="content"
                                rows="3"
                        ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="inputForCategory" class="form-label">Category</label>
                        <select class="form-control" name="category" id="inputForCategory">
                            @foreach ($categories as $category)
                                <option value="{{ $category->article_category_id }}">{{ $category->category_label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" id="inputForImage">
                        <input type="hidden" id="hiddenInputForImage" name="picture">
                    </div>
                    <div class="card mb-3 border-2 h-100">
                        <div class="card-body" id="image"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection