
<script>
var inicio=false;
var ajustehora=0;
var ajusteminuto=0;
var ajustesegundo=0;
function relojear(hora,minuto,segundo){
plazo=new Date();
plazo.setHours(hora);
plazo.setMinutes(minuto);
plazo.setSeconds(segundo);
if(!inicio){
serv_ahora=new Date();
serv_ahora.setHours(<?php echo intval(date('H')) ?>);
serv_ahora.setMinutes(<?php echo intval(date('i')) ?>);
serv_ahora.setSeconds(<?php echo intval(date('s')) ?>);
ahora=new Date();
ajustehora=serv_ahora.getHours()-ahora.getHours();
ajusteminuto=serv_ahora.getMinutes()-ahora.getMinutes();
ajustesegundo=serv_ahora.getSeconds()-ahora.getSeconds();
}
horasinajuste=new Date();
ahora=new Date();
ahora.setHours(horasinajuste.getHours()+ajustehora);
ahora.setMinutes(horasinajuste.getMinutes()+ajusteminuto);
ahora.setSeconds(horasinajuste.getSeconds()+ajustesegundo);
inicio=true;

       
        document.getElementById('status').innerHTML=ahora.getHours()+':'+ahora.getMinutes()+':'+ahora.getSeconds();
   
}
onload=function(){
    setInterval('relojear(21,30,0)',1000);
}
</script>
