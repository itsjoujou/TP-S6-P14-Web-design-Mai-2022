@extends('layouts.layout')

@section('title')
    Liste articles
@endsection

@section('content')
<div class="row row-cols-1 row-cols-md-3 g-5 mb-5">
    @foreach ($articles as $article)
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="">
                <div class="card">
                    <h5 class="card-header">{{ $article->title }}</h5>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>
                                {{ $article->summary }}
                            </p>
                            {{-- <footer class="blockquote-footer">
                                Category - 
                                <cite title="category">{{ $article->article_category->category_label }}</cite>
                            </footer> --}}
                        </blockquote>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
