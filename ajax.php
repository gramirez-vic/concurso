<?php
require("config/configuracion.php");
require("config/conexion.php");
global $db;
extract($_POST);
$tiempoDeEspera     = 12;
$cantidadLechonas   = 25;
$cantidadTablets    = 5;
//antes que nada realizo un query a la tabla de los ganadores para que me traiga las matrículas que ya se sortearon, esto es para que no me vuelva a generar al mismo ganador
$verificoGanadores = $db->GetAll(sprintf("SELECT * FROM ganadores"));
//recorro estos ganadores
$listaGanadores = "";
if(count($verificoGanadores) > 0)
{
    foreach($verificoGanadores as $gan)
    {
        $listaGanadores .= $gan['matricula'].",";
    }
    $listaGanadores = substr($listaGanadores,0,strlen($listaGanadores) - 1);
    $listaGanadoresQuery = " AND matricula NOT IN (".$listaGanadores.")";
}
else
{
    $listaGanadoresQuery = "";
}
//realizo el query que selecciona al ganador definitivo
if($sorteo == 1)//COJIN LECHONA
{
    //antes de buscar un ganador verifico que no se hayan entregado ya los dos premios
    $queryVerifica = $db->GetAll(sprintf("SELECT * FROM ganadores WHERE premio='BOLETA INGRESO AL BANQUETE' or premio = 'NO HAY PREMIO'"));
    if(count($queryVerifica) < $cantidadLechonas)//si aún no se han entregado los 2 premios de la COLCHON LECHONA
    {        
        //duermo el código para dar suspenso a la cosa
        sleep($tiempoDeEspera);
        //consulto el ganador
        $queryGanador = $db->GetAll(sprintf("SELECT REPLACE(nombre,' . .','') as nombre, REPLACE(matricula,' . .','') as matricula, REPLACE(direccion,' . .','') as direccion, REPLACE(barrio,' . .','') as barrio  FROM suscriptores  WHERE nombre != '#N/D' AND direccion!='#N/D' %s ORDER BY RAND() LIMIT 1",$listaGanadoresQuery));
        if(count($queryGanador) > 0)
        {            
            //verifico cuantos ganadores hay hasta la inserción
            if(count($queryVerifica) < 4)
            {                
                //inserto el ganador sin premio
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,barrio,premio) values('%s','%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'],$queryGanador[0]['direccion'],$queryGanador[0]['barrio'],'NO HAY PREMIO'));
                $salida      = array("mensaje"=>"Gracias por su Pago Oportuno, Sigue intentando",
                                    "continuar"=>1,
                                    "esGanador"=>0,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) + 1 == 5)//si es el quinto gana
            {                
                //inserto el ganador en una tabla para que no lo vuelvan a escoger
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,barrio,premio) values('%s','%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'],$queryGanador[0]['direccion'],$queryGanador[0]['barrio'],' BOLETA INGRESO AL BANQUETE'));
                $salida      = array("mensaje"=>"Ganador del INGRESO AL BANQUETE",
                                    "continuar"=>1,
                                    "esGanador"=>1,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) >= 5 && count($queryVerifica) < 9)
            {
                //inserto el ganador sin premio
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,barrio,premio) values('%s','%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'],$queryGanador[0]['direccion'],$queryGanador[0]['barrio'],'NO HAY PREMIO'));
                $salida      = array("mensaje"=>"Gracias por su Pago Oportuno, Sigue intentando",
                                    "continuar"=>1,
                                    "esGanador"=>0,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) + 1 == 10)//si es el 10 gana
            {                
                //inserto el ganador en una tabla para que no lo vuelvan a escoger
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,premio) values('%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'], $queryGanador[0]['direccion'],$queryGanador[0]['barrio'],'INGRESO AL BANQUETE'));
                $salida      = array("mensaje"=>"Ganador del INGRESO AL BANQUETE",
                                    "continuar"=>1,
                                    "esGanador"=>1,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) >= 10 && count($queryVerifica) < 15)
            {
                //inserto el ganador sin premio
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,premio) values('%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'], $queryGanador[0]['direccion'],$queryGanador[0]['barrio'],'NO HAY PREMIO'));
                $salida      = array("mensaje"=>"Gracias por su Pago Oportuno, Sigue intentando",
                                    "continuar"=>1,
                                    "esGanador"=>0,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) + 1 == 15)//si es el 15 gana
            {                
                //inserto el ganador en una tabla para que no lo vuelvan a escoger
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,barrio,premio values('%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'], $queryGanador[0]['barrio'],$queryGanador[0]['barrio'],'INGRESO AL BANQUETE'));
                $salida      = array("mensaje"=>"Ganador del INGRESO AL BANQUETE",
                                    "continuar"=>1,
                                    "esGanador"=>1,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) >= 15 && count($queryVerifica) < 20)
            {
                //inserto el ganador sin premio
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,premio) values('%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'], $queryGanador[0]['direccion'],$queryGanador[0]['barrio'],'NO HAY PREMIO'));
                $salida      = array("mensaje"=>"Gracias por su Pago Oportuno, Sigue intentando",
                                    "continuar"=>1,
                                    "esGanador"=>0,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) + 1 == 20)//si es el 20 gana
            {                
                //inserto el ganador en una tabla para que no lo vuelvan a escoger
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,premio) values('%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'], $queryGanador[0]['direccion'],$queryGanador[0]['barrio'],'INGRESO AL BANQUETE'));
                $salida      = array("mensaje"=>"Ganador del INGRESO AL BANQUETE",
                                    "continuar"=>1,
                                    "esGanador"=>1,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) >= 20 && count($queryVerifica) < 25)
            {
                //inserto el ganador sin premio
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,premio) values('%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'], $queryGanador[0]['direccion'],$queryGanador[0]['barrio'],'NO HAY PREMIO'));
                $salida      = array("mensaje"=>"Gracias por su Pago Oportuno, Sigue intentando",
                                    "continuar"=>1,
                                    "esGanador"=>0,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) + 1 == 25)//si es el 25 gana
            {                
                //inserto el ganador en una tabla para que no lo vuelvan a escoger
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,direccion,premio) values('%s','%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'], $queryGanador[0]['direccion'],$queryGanador[0]['barrio'],'INGRESO AL BANQUETE'));
                $salida      = array("mensaje"=>"Ganador del INGRESO AL BANQUETE",
                                    "continuar"=>1,
                                    "esGanador"=>1,
                                    "datos"=>$queryGanador[0]);
            } 
        }
    }
    else
    {
        $salida      = array("mensaje"=>"Ya se han entregado 2 premios del INGRESO AL BANQUETE",
                             "continuar"=>0,
                             "datos"=>array());
    }
}
else if($sorteo == 2)//tablet
{
    //antes de buscar un ganador verifico que no se hayan entregado ya los dos premios
    $queryVerifica = $db->GetAll(sprintf("SELECT * FROM ganadores WHERE premio='TABLET' or premio='NO HAY PREMIO TABLET'"));
    if(count($queryVerifica ) < $cantidadTablets)//si aún no se han entregado los 2 premios de la TABLET
    {
        //duermo el código para dar suspenso a la cosa
        sleep($tiempoDeEspera);
        //consulto el ganador
        $queryGanador = $db->GetAll(sprintf("SELECT REPLACE(nombre,' . .','') as nombre, REPLACE(matricula,' . .','') as matricula  FROM suscriptores  WHERE nombre != '#N/D' AND direccion!='#N/D' %s ORDER BY RAND() LIMIT 1",$listaGanadoresQuery));
        if(count($queryGanador) > 0)
        {
            if(count($queryVerifica) < 4)
            {
                //inserto el ganador en una tabla para que no lo vuelvan a escoger
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,premio) values('%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'],'NO HAY PREMIO TABLET'));
                $salida      = array("mensaje"=>"Gracias por su Pago Oportuno, Sigue intentando",
                                    "continuar"=>1,
                                    "esGanador"=>0,
                                    "datos"=>$queryGanador[0]);
            }
            else if(count($queryVerifica) + 1 == 5)//si es el quinto gana
            {
                //inserto el ganador en una tabla para que no lo vuelvan a escoger
                $queryInsert = $db->Execute(sprintf("INSERT INTO ganadores (matricula,nombre,premio) values('%s','%s','%s')",$queryGanador[0]['matricula'],$queryGanador[0]['nombre'],'TABLET'));
                $salida      = array("mensaje"=>"Ganador de la TABLET",
                                    "continuar"=>1,
                                    "esGanador"=>1,
                                    "datos"=>$queryGanador[0]);
            }
        }
    }
    else
    {
        $salida      = array("mensaje"=>"Ya se ha entregado 1 premio de TABLET",
                             "continuar"=>0,
                             "datos"=>array());
    }
}
else
{
    $salida = array("mensaje"=>"Zona restringida",
                    "continuar"=>0);
}
echo json_encode($salida);
//  $queryPersonas = $db->GetAll(sprintf("SELECT REPLACE(nombre,' . .','') as nombre, REPLACE(matricula,' . .','') as matricula FROM suscriptores WHERE nombre != '#N/D' AND direccion!='#N/D' limit 100"));
//  echo json_encode($queryPersonas);
?>