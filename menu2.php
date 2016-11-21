<?php
session_start();
?>
<html>
    <head><meta charset="utf-8">
        <style type="text/css">
            
            
        </style>
    </head>
    <body>
        <header>
        <h3>Has iniciado sesion como:<?php echo $_SESSION['usuario'];?></h3>
            <ul>
            <li><a href="consulta.php">Consulta</a></li>
            <li>Alta</li>
            <li>Baja</li>
            <li>Modificacion</li>
            <hr>
            <li><a href="login.php">Ir al inicio</a></li>
        </ul>
        </header>
        <section>Aplicacion DAW Tiendas</section>
        <footer>Diego vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>