<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<p>Hola, El Local <strong>{{ $local }} </strong> de la Cadena <strong>{{ $cadena }} </strong> ha modificado la planilla.<br>
Te recomendamos revisar para que no exista lentitud en el sitio web.</p>
<br>
<p><u><i>Información Extra</i></u></p>
<p>
    <stron>ID Planilla:</stron> {{ $id }} <br>
    <stron>Fecha de Uso:</stron> {{ $inicioPlanilla }} al {{ $finPlanilla }}<br>
    <stron>Fecha de Toma:</stron> {{ $inicioToma }} a las {{ $finToma }} <br>
    <stron>Fecha de Pre-toma:</stron> {{ $inicioPreToma }} a las {{ $finPreToma }} <br>
    <stron>Fecha de Repechaje:</stron> {{ $inicioRepechaje }} a las {{ $finRepechaje }} <br>
</p>

</body>
</html>