<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Proyecto Nero</title>

    <link rel="stylesheet" type="text/css" href="../public/css/estiloPdf.css">
</head>
<body>

<table class="tabla-pdf">
    <tr>
        <td class="col-datos-planillas">
            <p>
                <small>
                    <b>Local:</b> {{ $local }}<br>
                    <b>Día Inicio:</b> {{ date('d-m-Y', strtotime($firstDay)) }} <br>
                    <b>Día Término:</b> {{ date('d-m-Y', strtotime($lastDay)) }} <br>
                    <b>Actualizado:</b> {{ date('d-m-Y H:i:s ') }}
                </small>
            </p>
        </td>
        <td class="col-logo">
            <img src="../public/img/iconos/logo-nero-1024x1099.png" width="100" height="100" alt="logo-nero">
        </td>
    <tr>
</table>
<br/>



<table class="tabla-pdf">
    <tr class="fila-titulo">
        <td class="">Nombre</td>
        <td class="">Total</td>
        <td class="">Toma</td>
        <td class="">Repechaje</td>
        <td class="">Asignado</td>
        <td class="">Pre-Toma</td>
        <td class="">Cedido</td>
        <td class="">Cambio</td>
        <td class="">Regalo</td>
    </tr>

@foreach($usuarios as $usuario)



    <!-- Imprimir Hora y Termino del Turno -->

        <tr class="border_bottom">
            <td> {{ $usuario->nombre }} {{ $usuario->apellido }} </td>
            <td> {{ $usuario->cantTurnos }} </td>
            <td> {{ $usuario->toma }} </td>
            <td> {{ $usuario->repechaje }} </td>
            <td> {{ $usuario->asignar }} </td>
            <td> {{ $usuario->pretoma }} </td>
            <td> {{ $usuario->cedido }} </td>
            <td> {{ $usuario->cambio }} </td>
            <td> {{ $usuario->regalo }} </td>
        </tr>



    @endforeach
</table>

<br/>

</body>
</html>