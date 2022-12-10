@extends('master')

<title>Moje Konto</title>

@section('contents')
<div class="panel panel-default">
<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            <h1><strong>Miło Cię widzieć <i>{{ Auth::user()->name }}</i></strong></h1>
        </div>
    </div>

    <hr>

    

    <div class="row">

        
        <a href="{{ route('blog.index') }}">
        <div class="col-sm-4">
            <div class="tile"><center>
                <h3 class="title">Blog</h3>
                <p>Pokaż blog</p></center>
            </div>
        </div>
        </a>
        
        <a href="{{ route('posts.index') }}">
        <div class="col-sm-4">
            <div class="tile"><center>
                <h3 class="title">Posty</h3>
                <p>Zarządzaj swoimi postami</p></center>
            </div>
        </div>
        </a>
        
        
    
        
       
        <a href="{{ route('user.index') }}">
        <div class="col-sm-4">
            <div class="tile"><center>
                <h3 class="title">Profil</h3>
                <p>Profil użytkownika</p>
            </div></center>
        </div>
        </a>
		</div>
		<div class="row">
        @if(Auth::user()->hasRole('Admin'))
        
        <a href="{{ route('users.index') }}">
        <div class="col-sm-4">
            <div class="tile"><center>
                <h3 class="title">Użytkownicy</h3>
                <p>Wszyscy użytkownicy</p>
            </div></center>
        </div>
        </a>
		<div class="row">
        @if(Auth::user()->hasRole('Admin'))
        
        <a href="{{ route('blogconfig.index') }}">
        <div class="col-sm-4">
            <div class="tile"><center>
                <h3 class="title">Ustawienia</h3>
                <p>Konfiguracja strony</p>
            </div></center>
        </div>
        </a>
        @endif
    </div>
        @endif
    </div>

    

</div> 
</div>
@endsection