<?php
session_start();

function sesion(){
    try{
    $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','diego','a');
    $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
    return $con;
    }catch (PDOException $ex){
        $ex->getMessage();
    }
}   
function Mostrarproveedores(){
         try{
            $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','diego','a');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $stmt2=$sesion->query('select * from productos');

         echo "<table border>";
         while($filas2=$stmt2->fetch(PDO::FETCH_ASSOC)){
             echo "<tr><td>".$filas2['proveedor']."</td><td>".$filas2['nom_prov']."</td></tr>";
         }
         echo "</table>";
         }catch (PDOException $ex){
        $ex->getMessage();
    }
}
    
?>
<html>
    <head><meta charset="utf-8">
        <style type="text/css">
            body{width:800px;height:768px; border:2pt dashed orange}
            h3,footer{text-align:center}
            header{background-color:gainsboro;}
        header ul{width:600px;height:50px;background-color: greenyellow;
            margin-left: 80px;margin-top: 20px}
        header ul li{float:left; width:100px;height:20px;margin-left:20px;
                     list-style-type: none}   
        section{clear: both}
        section table{margin-top:20px}
        footer{background-color: greenyellow;margin-top: 500px;height: 30px}
        a,footer{text-decoration:none;color:gray;}
        </style>
    </head>
    <body>
        <header>
        <h3>Has iniciado sesion como:<?php echo "\n"; echo $_SESSION['usuario'];?></h3>
        <ul>
            <li><a href="consulta.php">Consulta</a></li>
            <li><a href="Alta_producto.php">Alta</a></li>
            <li><a href="Baja_producto.php">Baja</a></li>
            <li><a href="Modificacion.php">Modificacion</a></li>
            <li><a href="cerrar.php">Cerrar Sesion</a></li>
        </ul>
        </header>
        <section>
        <table align="center">
                
            <form method="POST" action="formulario_alta.php">
            <tr>
                <td><input type="radio" name="proveedor" value="1">Proveedor creado</td>                        
                <td><input type="radio" name="proveedor" value="2">Proveedor nuevo</td>
                
            </tr>
            <tr>
                <td align="right">
                    <input type="submit" name="Alta">
                </td>
                <td>
                    <input type="submit" value="Cancelar">
                </td>
            </tr>
            </form>
        </table>
        <article><?php Mostrarproveedores();?></article>
        </section>
        <footer>Diego Vera 2? Desarrollo aplicaciones WEB</footer>
    </body>
</html>
