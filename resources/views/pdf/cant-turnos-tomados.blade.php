<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Toma de Turnos</title>
    
     <link rel="stylesheet" type="text/css" href="../public/css/estiloPdf.css">
  </head>
  <body>

  <table class="tabla-pdf">
      <tr>
          <td class="col-datos-planillas">
              <p>
                  <small>
                      <b>Local:</b> {{ $planilla->Local->Cadena->nombre }} - {{ $planilla->Local->nombre }}<br>
                      <b>Día Inicio:</b> {{ date('d-m-Y', strtotime($planilla->inicioPlanilla)) }}<br>
                      <b>Día Término:</b> {{ date('d-m-Y', strtotime($planilla->finPlanilla)) }}<br>
                      <b>Actualizado:</b> {{ date('d-m-Y H:i:s ') }}
                  </small>
              </p>
          </td>
          <td class="col-logo">
              <img src="../public/img/logo-calendario-menu.png" width="70" height="70" alt="logo">
          </td>
      <tr>
  </table>
        <br/>



              <table class="tabla-pdf">
                      <tr class="fila-titulo">
                                <td class="col-titulo-turno">Cant</td>
                                
                                <td class="col-titulo-nombre">Nombre</td>
                                
                                <td class="col-titulo-observacion">Observaciones : </td>
                      </tr>
                
                      @foreach($usuarios as $usuario)

      
                                    
                      <!-- Imprimir Hora y Termino del Turno -->
                     
                      <tr class="border_bottom">               
                        <td>{{ $usuario->cantTurnos }} </td>
                        <td>
                           {{ $usuario->nombre }}
                           {{ $usuario->apellido }}
 
                        </td>
                        <td></td> 

                      </tr>                 
                      

                                    
                      @endforeach    
              </table>

        <br/> 
        
  </body>
</html>