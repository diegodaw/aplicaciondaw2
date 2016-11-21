<?php
session_start();

function sacarselect(){
         try{
         $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','diego','a');
         $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
         $stmt=$con->query('select distinct proveedor from productos');
                
         while($filas=$stmt->fetch(PDO::FETCH_ASSOC)){
             echo '<option value="'.$filas['prov'].'">'.$filas['prov'].'</option>';
         }
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
        footer{background-color: greenyellow;margin-top: 400px;height: 30px}
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
                <form action="" method="POST">
                    <tr>
                    <td>Codigo:</td>
                    <td><input type="text" name="codigo"></td>
                    </tr>
                    <tr>
                    <td>Nombre:</td>
                    <td><input type="text" name="nombre"></td>
                    </tr>
                    <tr>
                    <td>Categoria:</td>
                    <td><input type="text" name="categoria"></td>
                    </tr>
                    <tr>
                    <td>Pecio:</td>
                    <td><input type="text" name="precio"></td>
                    </tr>
                    
                   <?php
                    if(isset($_POST['Alta'])){
                        $tipo_prov= isset($_POST['proveedor'])? $_POST['proveedor']:"";
                        if($tipo_prov==""){
                            header("location: Alta_producto.php");
                        }else{
                            ?>
                            <tr><td>Proveedor:</td><td>
                                    <?php
                                if($tipo_prov==1){
                                        echo '<select name="prov">';
                                         sacarselect;
                                        echo"</select>";
                                }else{
                                        echo '<input type="text" name="prov"></td></tr>';
                                        echo '<tr><td>Nombre del Proveedor: </td>';
                                        echo '<td><input type="text" name="nom_prov"></td></tr>';
                                }
                            }
                    }
                    ?>
                            <tr><td><input type="submit" value="Aceptar" name="Aceptar"></td></tr>
                </form>
            </table>
        </section>
        
        <?php
        try{
        $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','diego','a');
        $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $cod= isset($_POST['codigo'])? $_POST['codigo']:"";
            $nom= isset($_POST['nombre'])? $_POST['nombre']:"";
            $cat= isset($_POST['categoria'])? $_POST['categoria']:"";
            $precio= isset($_POST['precio'])? $_POST['precio']:"";
            $prov= isset($_POST['proveedor'])? $_POST['prov']:"";
            $nom_prov= isset($_POST['proveedor'])? $_POST['nom_prov']:"";
        
        if($tipo_prov==2){
            $stmt2=$con->prepare('insert into(cod_producto,nombre_producto,categoria
                     ,precio,proveedor,nom_prov) values(:cod,:nom,:cat,:precio,:prov,:nom_prov');
            $stmt2->execute(array(':cod'=>$cod,':nom'=>$nom,':cat'=>$cat,
                ':precio'=>$precio,':prov'=>$prov,':nom_prov'=>$nom_prov));

             if($stmt2->rowCount()==1){
                 echo "Se ha insertado correctamente con el nuevo proveedor";
             }

        }else{            
            $stmt3=$con->prepare('select distinct nom_prov from prodctos where proveedor=:prov');
            $stmt3->execute(array(':prov'=>$prov));
            $nombreprov=$stmt3->fetch(PDO::FETCH_ASSOC);

            $stmt4=$con->prepare('insert into(cod_producto,nombre_producto,categoria
                     ,precio,proveedor,nom_prov) values(:cod,:nom,:cat,:precio,:prov,:nom_prov');
            $stmt4->execute(array(':cod'=>$cod,':nom'=>$nom,':cat'=>$cat,
                ':precio'=>$precio,':prov'=>$prov,':nom_prov'=>$nombreprov));

             if($stmt2->rowCount()==1){
                 echo "Se ha insertado correctamente con el proveedor existente";
             }

        }
        
        }catch (PDOException $ex){
        $ex->getMessage();
        } 
        ?>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>
       


