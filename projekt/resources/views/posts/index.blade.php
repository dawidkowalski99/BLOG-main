
@extends('master')
<script>
$( ".moj" ).prop( "disabled", true );
</script>
<title>Posty</title>
<style>tr > td {vertical-align: middle !important;}</style>
@section('contents')
<div class="panel panel-default">
<div class="panel-heading">Posty</div>
    <div class="panel-body">
        @include('error_raports')
        <div class="table-responsive">          
            <table class="table">
                <thead>
                    <tr>
                        <th>lp.</th>
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th>Utworzono</th>
                        <th><!-- Akcja --></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    @if($post->trashed())
                        <tr class="trashed">
                    @else
                        <tr>
                    @endif
                        <td>{{ $loop->iteration }}</td>
                        
                        <td>{{ $post->title }}</td>
                        
                        <td>
                            @if(Auth::user()->hasRole('Admin'))
                            {{ $post->user->name }}
                            @else
                            {{ $post->user->name }}
                            @endif
                        </td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                             <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default">Wyświetl</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td><!-- brak id --></td><td>Brak danych</td><td>Brak danych</td><td>Brak danych</td><td>Brak danych</td><td>Brak danych</td><td><!-- Brak akcji --></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <hr>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Dodaj post</a>
    </div>
	<div class="panel-footer">
		{{ $posts->links() }}
	</div>
</div>
@endsection