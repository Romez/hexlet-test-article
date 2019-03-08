@extends('layouts.app')

@section('content')
    <div class="container">
        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif

        <div class="row">
            <a href="{{route('article.create')}}" class="btn btn-success">Create Article</a>
            <a href="{{route('articles')}}" class="btn btn-default">All Articles</a>
        </div>
    </div>
@endsection
