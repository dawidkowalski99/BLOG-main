@extends('templates.myappblog.master')

@section('title', 'myAppBlog')

@section('contents')

<style>
.jumbotron{
    
}
</style>

<div class="jumbotron text-center">
    <div class="container">
        <h1>Blog piłkarski</h1>
    </div>
</div> <!-- ./jumbotron -->

<div class="container">
<div class="well">
        <h3>Blog o tematyce piłkarskiej</h3>
        <p class="project_about">
Witamy na stronie poświęconej fanom piłki nożnej.
Zapraszamy do rejestracji i czynnego udziału w rozwoju naszej społeczności!
        </p>
    </div>


    <h2>Najnowsze wpisy</h2>
    <hr>
    <div class="row">
    @foreach($posts as $post)
        @if($post->publish == true)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                @if(file_exists(public_path('/uploads/posts/' . $post->image)))
                    <img class="img-responsive" src="/uploads/posts/{{ $post->image }}" alt="...">
                @else
                    <img class="img-responsive" src="/uploads/posts/default.png" alt="...">
                @endif
                <div class="caption">
                    <h3>{{ str_limit($post->title, 26) }}</h3>
                    <a href="{{ route('blog.show', $post->id) }}" type="button" class="btn btn-success btn-outline btn-lg btn-block">Więcej informacji</a>
                </div>
            </div>
        </div>
        @endif
    @endforeach
    </div> <!-- ./row -->
    <div class="text-right">
    {{ $posts->links() }}
    </div>

    <hr>



</div>


<div class="container">
    <h2>Kontakt</h2>
    <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Imię i nazwisko:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Imię i Nazwisko" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Adres e-mail" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Wiadomość:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" name="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input id="submit" name="submit" type="submit" value="Wyślij" class="btn btn-primary">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                          
                        </div>
                    </div>
                </form>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-6 text-center" id="mail">

        </div>
       
    </div>
</div>



@endsection