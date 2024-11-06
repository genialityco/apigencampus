<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Routes</title>
</head>
<body>
	<h1>Endpoints con Documentación</h1>
	<p>{{ count($withDocs) }} urls con documentación de {{ count($allRoutes) }} urls totales</p>
	<table>
	  <thead>
	    <tr>
	      <th>URL</th>
	      <th>Método</th>
	      <th>Documentación</th>
	    </tr>
	  </thead>
	  @foreach ($allRoutes as $route)
	  <tbody>
	    <tr>
	      <td> {{ $route[ 'url' ] }}</td>
	      <td>{{ $route[ 'method' ] }}</td>
	      @if (in_array($route, $withDocs))
		<td></td>
	      @else
		<td></td>
	      @endif
	    </tr>
	  </tbody>
	  @endforeach
	</table>
</body>
</html>
