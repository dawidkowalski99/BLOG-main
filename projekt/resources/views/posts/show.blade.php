@extends('master')

<title>Post</title>

@section('contents')
<div class="panel panel-default">
<div class="panel-heading">Post</div>
    <div class="panel-body">

        @if(!$post->trashed())
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Post <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('posts.edit', $post->id) }}">Edytuj</a></li>
				<li><a href="" data-toggle="modal" data-target="#deleteModal" >Usuń</a></li>
            </ul>
        </div>
        @endif

        <!-- Main część -->
        <div class="row">
            <div class=" col col-md-10 col-sm-12">
                <h3>{{ $post->title }}</h3>
                <span class="text-muted">
                    Autor: {{ $post->user->name }}
                </span>
            </div>
            <div class=" col col-md-2 col-sm-12">
                <h3><small>{{ $post->created_at }}</small></h3>
            </div>
        </div>
        <hr>
        @if($post->trashed())
        <div class="alert alert-danger">
            <strong>{{ $post->deleted_at}}</strong>, Post został usunięty przez użytkownika!
        </div>
        <hr>
        @else
            @if($post->publish == 0)
            <div class="alert alert-info alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Uwaga!</strong> Ten post obecnie nie jest opublikowany.
            </div>
            <hr>
            @endif
        @endif

        
        <!-- Zawartość postów -->
        <div class="row">
            <div class=" col col-md-9 col-sm-12">
                <div class="post-contents">
                    {!! $post->contents !!}
                </div>
                
            </div>
            <div class=" col col-md-3 col-sm-12">
               <img class="img-thumbnail" src="/uploads/posts/{{ $post->image }}" alt="Post image">
            </div>
        </div>
        <hr>

        <!-- Usuwanie -->
        <div class="modal fade" id="deleteModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Usuń post</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <strong>Uwaga!</strong> Na pewno chcesz usunąć ten wpis ?
                    </div>
                </div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button> -->
                        {!! Form::model($post, ['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
                        {!! Form::submit('Usuń post', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}                      
					</div>
				</div>
			</div>
		</div>

    </div>
</div>
@endsection