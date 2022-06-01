<?php 
require("config/configuracion.php");
require("config/conexion.php");
global $db;
$listaGanadores = $db->GetAll(sprintf("SELECT * FROM ganadores WHERE premio != 'NO HAY PREMIO' AND premio !='NO HAY PREMIO TABLET' ORDER BY premio ASC, nombre ASC, direccion ASC"));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/landing.css?<?php echo rand(0,1000)?>">
        <link rel="icon" type="text/css" href="img/logo.png">
        <title>Sorteo Cordilleras</title>
    </head>
    <body>
        <!-- Audio Sorteo-->
        <audio style="display:none" src="img/audio.mp3?<?php echo rand(0,1000)?>" id="audio" controls="controls">Tu navegador no soporta el elemento <code>audio</code></audio>
        <audio style="display:none" src="img/audio2.mp3?<?php echo rand(0,1000)?>" id="audio2" controls="controls">Tu navegador no soporta el elemento <code>audio2</code></audio>
        <!-- pantalla inicial-->
        <?php if(isset($_GET['sorteo']) && $_GET['sorteo'] == 0) { ?>
            <div class="container-fluid" class="body">
                <div>
                    <img src="img/kelly.png" alt="" class="tambores">
                </div>
                <div class="container text-center">
                    <img src="img/logo.png" alt="Logo Cordilleras" class="logo"><br><br><br><br>    
                    <h1 class="ganador" id="ganador">bienvenidos al sorteo</h1>
                    <br><br>
                    <a href="lechona" class="btn btn-outline-primary" >Boleta Banquete</a>
                    <!-- <a href="tablet" class="btn btn-primary" >Boleta Banquete</a> -->
                    <a href="ganadores" class="btn btn-outline-success" >GANADORES</a><br><br>

                </div>
            </div>
        <?php }?>
        <!-- Pantalla del respectivo sorteo -->
        <?php if(isset($_GET['sorteo']) && $_GET['sorteo'] > 0){?>
            <div class="container-fluid">
                <div>
                    <img src="img/kelly.png" alt="" class="tambores">
                </div>
                <div class="container text-center">
                    <img src="img/logo.png" alt="Logo Cordilleras" class="logo"><br><br><br><br>    
                    <h1 class="ganador" id="ganador">nombre del ganador</h1>
                    <h2 class="matricula" id="matricula">matrícula</h2>
                    <h4 class="matricula" id="status">&nbsp;</h4>
                    <br><br>
                    <?php if(isset($_GET['sorteo']) && $_GET['sorteo'] == 1){?>
                        <button class="btn btn-outline-primary botonSorteo" onclick="landing.iniciaSorteo(1)">INICIAR SORTEO BOLETA BANQUETE</button>
                    <?php }?>
                    <?php if(isset($_GET['sorteo']) && $_GET['sorteo'] == 2){?>
                        <button class="btn btn-outline-primary botonSorteo" onclick="landing.iniciaSorteo(2)">INICIAR SORTEO BOLETA BANQUETE</button>
                    <?php }?>
                    <br><br><a class="btn btn-outline-success" onclick="landing.backButton()">Volver a la página anterior</a>
                    <div class="alert alert-info" id="mensaje"></div>
                </div>
                
            </div>
        <?php }?>
        <!-- Pantalla ganadores-->
        <?php if(isset($_GET['ganadores'])){?>
            <div class="container-fluid">
                <div class="container text-center">
                    <img src="img/logo.png" alt="Logo Cordilleras" class="logo"><br><br><br><br>    
                    <h1 class="ganador" id="ganador">Listado de ganadores</h1><br><br>
                    <?php if(count($listaGanadores) > 0){?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="background:#000;color:#fff">MATRÍCULA</th>
                                    <th style="background:#000;color:#fff">NOMBRE</th>
                                    <th style="background:#000;color:#fff">BARRIO</th>
                                    <th style="background:#000;color:#fff">PREMIO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaGanadores as $gan){?>
                                    <tr>
                                        <td><?php echo $gan['matricula']?></td>
                                        <td><?php echo $gan['nombre']?></td>
                                        <td><?php echo $gan['barrio']?></td>
                                        <td><?php echo $gan['premio']?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    <?php }else{?>
                        <div class="alert alert-info">Aún no hay ganadores seleccionados en el sorteo.</div>
                    <?php }?>
                    <br><br><a class="btn btn-outline-success" onclick="landing.backButton()">Volver a la página anterior</a>
                </div>
            </div>
        <?php }?>               

        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/confetti.js"></script>
        <script src="js/landing.js?<?php echo rand(0,1000)?>"></script>
    </body>
</html>