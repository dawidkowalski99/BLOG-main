@extends('templates.myappblog.master')

@section('title', $post->title)

@section('contents')

<style>
.jumbotron{
    background-image: url('/myappblog/img/{{ $config->image }}');
}
</style>

<div class="jumbotron text-center">
    <div class="container">
        <h1>{{ $post->title }}</h1>
    </div>
</div> <!-- ./jumbotron -->

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $post->title }}</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                     {{ $post->user->name }} 
                </div>
                
            </div>
            <hr>
            <span class="post-contents">
            {!! $post->contents !!}
            </span>
            <hr>
            
        </div>
    </div>

    @include('templates.myappblog.comments')

</div>
@endsection