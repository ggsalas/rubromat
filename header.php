<?php
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title><?php echo $titulo; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <!-- Los agrego como tipografías locales por si se utiliza desde un
             servdor sin acceso a internet.
             En el caso de "Raleway" no hay problema porque toma otra sans-serif
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" -->
        <link rel="stylesheet" href="css/iconfont/material-icons.css">
        <link href='https://fonts.googleapis.com/css?family=Raleway:700,500,300' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/validaciones.js">

        </script>
    </head>
    <body class="marco <?php echo isset($bodyEstilos) ? $bodyEstilos : ""; ?>">
        <div class="background"></div>
        <header>
            <div class="marco">
                <div class="logo">
                    <a href="./index.php">RUBRO<b>MAT</b></a>
                </div>
                <nav>
                    <ul>
                        <li><a class="rText" href="./obras.php"><i class="material-icons">home</i>Obras</a></li>
                        <li><a class="rText" href="#"><i class="material-icons">settings</i>Configuración</a>
                            <ul>
                                <li><a href="./rubros.php">Rubros</a></li>
                                <li><a href="./insumos.php">Insumos</a></li>
                            </ul>
                        </li>
                        <li><a class="rText"href="./info.php"><i class="material-icons">info</i>Info</a></li>
                        <!-- <li><a href="./buscar.php">Buscar</a></li> -->
                    </ul>
                </nav>
            </div>
        </header>
