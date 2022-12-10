<!-- Nawigacja -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('welcome.index') }}">Strona Główna Konta</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						
						<strong>{{ Auth::user()->name }}</strong> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('blog.index') }}"> Pokaż Blog</a></li>
                        <li><a href="{{ route('user.index') }}"> Profil</a></li>
						<li class="divider"></li>
						<li>
                            <a href="{{ route('logout') }}"
                            	onclick="event.preventDefault();
                            	document.getElementById('logout-form').submit();">
								
                                Wyloguj
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>