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
                <tr>
                  <td>
                    <strong>Lunes</strong> {{ date('d-m-Y', strtotime($planilla->inicioPlanilla)) }}

                  </td>
                </tr>
                
                      @foreach($lunes as $lun)

                       <tr class="fila-titulo">
                                <td class="col-titulo-turno">Turno</td>
                                
                                <td class="col-titulo-nombre">Nombre</td>
                                
                                <td class="col-titulo-observacion">Observaciones : </td>
                      </tr>
                                    
                      <!-- Imprimir Hora y Termino del Turno -->
                     
                      <tr>               
                         <td>
                             {{ $lun->inicio }} - {{ $lun->termino }} ({{ $lun->cupos }})
                         </td>
                        <td>

                            @foreach($lun->empaques as $empaque)

                                    @if($empaque['rol'] == 'Coordinador')
                                        <small><b><i> {{ $empaque['nombre'] }} </i></b></small>
                                    @else
                                        <small>{{ $empaque['nombre'] }}</small>
                                    @endif
                                        <br>
                            @endforeach

                        </td>
                        <td></td> 
                      </tr>                 
                       <br>

                                    
                      @endforeach    
              </table>
        <br/>        


              <table class="tabla-pdf2">
                <tr>
                  <td>
                    <strong>Martes</strong> {{ date('d-m-Y', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla))) }}

                  </td>
                </tr>

                      @foreach($martes as $mar)

                       <tr class="fila-titulo">
                                <td class="col-titulo-turno">Turno</td>
                                
                                <td class="col-titulo-nombre">Nombre</td>
                                
                                <td class="col-titulo-observacion">Observaciones : </td>
                      </tr>
                                    
                      <!-- Imprimir Hora y Termino del Turno -->
                     
                      <tr>               
                         <td>
                             {{ $mar->inicio }} - {{ $mar->termino }} ({{ $mar->cupos }})
                         </td>
                        <td>

                            @foreach($mar->empaques as $empaque)

                                @if($empaque['rol'] == 'Coordinador')
                                    <small><b><i> {{ $empaque['nombre'] }} </i></b></small>
                                @else
                                    <small>{{ $empaque['nombre'] }}</small>
                                @endif
                                    <br>
                            @endforeach
                        </td>
                        <td></td> 
                      </tr>                 
                       

                                    
                      @endforeach    
              </table>
        <br/>        



              <table class="tabla-pdf2">
                <tr>
                  <td>
                    <strong>Miércoles</strong> {{ date('d-m-Y', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla))) }}

                  </td>
                </tr>

                      @foreach($miercoles as $mie)

                       <tr class="fila-titulo">
                                <td class="col-titulo-turno">Turno</td>
                                
                                <td class="col-titulo-nombre">Nombre</td>
                                
                                <td class="col-titulo-observacion">Observaciones : </td>
                      </tr>
                                    
                      <!-- Imprimir Hora y Termino del Turno -->
                     
                      <tr>               
                         <td>
                            {{ $mie->inicio }} - {{ $mie->termino }} ({{ $mie->cupos }})
                         </td>
                        <td>

                            @foreach($mie->empaques as $empaque)

                                @if($empaque['rol'] == 'Coordinador')
                                    <small><b><i> {{ $empaque['nombre'] }} </i></b></small>
                                @else
                                    <small>{{ $empaque['nombre'] }}</small>
                                @endif
                                    <br>
                            @endforeach
                        </td>
                        <td></td> 
                      </tr>                 
                       

                                    
                      @endforeach    
              </table>
        <br/>      




              <table class="tabla-pdf2">
                <tr>
                  <td>
                    <strong>Jueves</strong> {{ date('d-m-Y', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla))) }}

                  </td>
                </tr>

                      @foreach($jueves as $jue)

                       <tr class="fila-titulo">
                                <td class="col-titulo-turno">Turno</td>
                                
                                <td class="col-titulo-nombre">Nombre</td>
                                
                                <td class="col-titulo-observacion">Observaciones : </td>
                      </tr>
                                    
                      <!-- Imprimir Hora y Termino del Turno -->
                     
                      <tr>               
                         <td>
                            {{ $jue->inicio }} - {{ $jue->termino }} ({{ $jue->cupos }})
                         </td>
                        <td>

                            @foreach($jue->empaques as $empaque)

                                @if($empaque['rol'] == 'Coordinador')
                                    <small><b><i> {{ $empaque['nombre'] }} </i></b></small>
                                @else
                                    <small>{{ $empaque['nombre'] }}</small>
                                @endif
                                    <br>
                            @endforeach
                        </td>
                        <td></td> 
                      </tr>                 
                       

                                    
                      @endforeach    
              </table>
        <br/>     



              <table class="tabla-pdf2">
                <tr>
                  <td>
                    <strong>Viernes</strong> {{ date('d-m-Y', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla))) }}

                  </td>
                </tr>

                      @foreach($viernes as $vie)

                       <tr class="fila-titulo">
                                <td class="col-titulo-turno">Turno</td>
                                
                                <td class="col-titulo-nombre">Nombre</td>
                                
                                <td class="col-titulo-observacion">Observaciones : </td>
                      </tr>
                                    
                      <!-- Imprimir Hora y Termino del Turno -->
                     
                      <tr>               
                         <td>
                            {{ $vie->inicio }} - {{ $vie->termino }} ({{ $vie->cupos }})
                         </td>
                        <td>

                            @foreach($vie->empaques as $empaque)

                                @if($empaque['rol'] == 'Coordinador')
                                    <small><b><i> {{ $empaque['nombre'] }} </i></b></small>
                                @else
                                    <small>{{ $empaque['nombre'] }}</small>
                                @endif
                                    <br>
                            @endforeach
                        </td>
                        <td></td> 
                      </tr>                 
                       

                                    
                      @endforeach    
              </table>
        <br/>    


              <table class="tabla-pdf2">
                <tr>
                  <td>
                    <strong>Sábado</strong> {{ date('d-m-Y', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla))) }}

                  </td>
                </tr>

                      @foreach($sabado as $sab)

                       <tr class="fila-titulo">
                                <td class="col-titulo-turno">Turno</td>
                                
                                <td class="col-titulo-nombre">Nombre</td>
                                
                                <td class="col-titulo-observacion">Observaciones : </td>
                      </tr>
                                    
                      <!-- Imprimir Hora y Termino del Turno -->
                     
                      <tr>               
                         <td>
                            {{ $sab->inicio }} - {{ $sab->termino }} ({{ $sab->cupos }})
                         </td>
                        <td>

                            @foreach($sab->empaques as $empaque)

                                @if($empaque['rol'] == 'Coordinador')
                                    <small><b><i> {{ $empaque['nombre'] }} </i></b></small>
                                @else
                                    <small>{{ $empaque['nombre'] }}</small>
                                @endif
                                <br>
                            @endforeach
                        </td>
                        <td></td> 
                      </tr>                 
                       

                                    
                      @endforeach    
              </table>
        <br/>    



              <table class="tabla-pdf2">
                <tr>
                  <td>
                    <strong>Domingo</strong> {{ date('d-m-Y', strtotime ('+6 day' , strtotime($planilla->inicioPlanilla))) }}

                  </td>
                </tr>

                      @foreach($domingo as $dom)

                       <tr class="fila-titulo">
                                <td class="col-titulo-turno">Turno</td>
                                
                                <td class="col-titulo-nombre">Nombre</td>
                                
                                <td class="col-titulo-observacion">Observaciones : </td>
                      </tr>
                                    
                      <!-- Imprimir Hora y Termino del Turno -->
                     
                      <tr>               
                         <td>
                            {{ $dom->inicio }} - {{ $dom->termino }} ({{ $dom->cupos }})
                         </td>
                        <td>

                            @foreach($dom->empaques as $empaque)

                                @if($empaque['rol'] == 'Coordinador')
                                    <small><b><i> {{ $empaque['nombre'] }} </i></b></small>
                                @else
                                    <small>{{ $empaque['nombre'] }}</small>
                                @endif
                                <br>

                            @endforeach
                        </td>
                        <td></td> 
                      </tr>                 
                       

                                    
                      @endforeach    
              </table>
        <br/> 
        
  </body>
</html>