<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Routes</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="blue-grey darken-4">

      <div class="container ">

      <div class="center row">
	<h1 class="white-text">Endpoints con Documentación</h1>
	  <p class="white-text">{{ count($withDocs) }} urls con documentación de {{ count($allRoutes) }} urls totales</p>
	  <a class="btn-floating cyan" href="{{ route('routes.excel') }}"><i class="material-icons">file_download</i></a>
	  <p class="grey-text">Descargar Excel</p>
      </div>

	<table class="highlight z-depth-2 card-panel blue-grey darken-2">

	  <thead class="blue-grey darken-3">
	    <tr>
	      <th class="white-text">URL</th>
	      <th class="white-text">Método</th>
	      <th class="white-text">Documentación</th>
	    </tr>
	  </thead>

	  @foreach ($allRoutes as $route)
	  <tbody>
	    <tr>
	      <td class="white-text"> {{ $route[ 'url' ] }}</td>
	      <td class="white-text">{{ $route[ 'method' ] }}</td>
	      @if (in_array($route, $withDocs))
		<td class="green-text"><i class="material-icons">check</i></td>
	      @else
		<td class="red-text"><i class="material-icons">close</i></td>
	      @endif
	    </tr>
	  </tbody>
	  @endforeach

	</table>

      </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
