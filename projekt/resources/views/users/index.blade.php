@extends('master')

<title>Użytkownicy</title>

@section('contents')
<div class="panel panel-default">
<div class="panel-heading">Użytkownicy</div>
    <div class="panel-body">

        @include('error_raports')

        <div class="table-responsive">          
            <table class="table">
                <thead>
                    <tr>
                        <th>lp.</th>
                        <th>Nazwa</th>
                        <th>Adres E-mail</th>
                        <th>Rola</th>
                        <th>Ostatnie logowanie</th>
                        <th>Utworzono</th>
                        <th><!-- Akcja --></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)

                        @if($user == Auth::user())
                            <tr class="success">
                        @else
                            <tr>
                        @endif

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                {{ $role->name }}
                            @endforeach   
                        </td>
                        <td>
                            @foreach($user->loginlogs as $log)
                                @if($loop->first)
                                
                                {{ $log->last_login }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-default">Wyświetl</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>


<div class="row">
    <!-- Dodawanie usera -->
    <div class="col col-md-6">
        <a href="{{ route('users.create') }}" class="btn btn-primary"> Dodaj użytkownika</a>
    </div>

    <!-- Logi usera -->
    <div class="col col-md-6 text-right">

    {!! Form::open(['action' => 'UsersController@logsToPdf','method' => 'POST', 'class'=>'form-inline']) !!}
    <div class="form-group">
        {!! Form::label('userselect', 'Historia logowań: ') !!}
        {!! Form::select('userselect', $userselect, $lastkey, ['class' => 'form-control']); !!}
    </div>
    <div class="form-group">
        {!! Form::submit("do PDF", ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    
    </div>
</div> 

    </div>
</div>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
@endsection