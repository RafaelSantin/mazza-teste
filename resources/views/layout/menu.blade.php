<html class="no-js" lang="en">
  	<head>
  		<meta name="csrf-token" content="{{ csrf_token() }}">
    	<link rel="stylesheet" href="{{ URL::asset('assets/geral.css') }}">
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		
		@section('head')
		@show
		
	</head>

	@section('javascript')

    @show

	<body>
		@section('menu')
			<div class="navbar-wrapper">
			    <div class="container-fluid">
			        <nav class="navbar navbar-fixed-top">
			            <div class="container">
			                <div class="navbar-header">
			                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			                    <span class="sr-only">Toggle navigation</span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    </button>
			                    <!-- <a class="navbar-brand" href="#">Logo</a> -->
			                </div>
			                <div id="navbar" class="navbar-collapse collapse">
			                    <ul class="nav navbar-nav">
			                        <li class="active"><a href="/agendamento" class="">Agendamentos</a></li>			
			                        <li><a href="/listarPacientes">Pacientes</a></li>
			                        <li><a href="/listarMedicos">Médicos</a></li>
			                        <li><a href="/listarUsuarios">Usuários</a></li>			                        
			                    </ul>
			                    <ul class="nav navbar-nav pull-right">
			                        <li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Signed in as  <span class="caret"></span></a>
			                            <ul class="dropdown-menu">
			                                <li><a href="#">Change Password</a></li>
			                                <li><a href="#">My Profile</a></li>
			                            </ul>
			                        </li>
			                        <li class=""><a href="#">Logout</a></li>
			                    </ul>
			                </div>
			            </div>
			        </nav>
			    </div>
			</div>
		@show

		<div class="container conteudo">
			@yield('content')
		</div>
	</body>
</html>