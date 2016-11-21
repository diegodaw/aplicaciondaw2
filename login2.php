<?php
session_start();
?>
<html>
    <h2>LOGIN</h2><br>
    <body>
        <form action="" method="POST">
            Usuario: <input type="text" name="usu"><br>
            Contraseña: <input type="password" name="pass"><br>
            <input type="submit" value="Entrar" name="entrar">
        </form>
    </body>
</html>
<?php
if(isset($_REQUEST['entrar'])){
    $usuario=  isset($_REQUEST['usu'])? $_REQUEST['usu']:'';
    $password=  isset($_REQUEST['pass'])? $_REQUEST['pass']:'';
    
    if(empty($usuario)){
      echo  "No ha introducido usuario<br>";
    }else{
        if(empty($password)){
          echo  "No ha introducido contraseña<br>";
          
        }else{
            $con=new PDO('mysql:dbname=examen;host=localhost;charset=utf8','dwes');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $stmt=$con->prepare('select usuario from clientes where usu=:usuario and pass=:password');
            $stmt->execute(array(':usuario'=>$usuario,':password'=>$password));
            
            if($stmt->rowCount()>0){
            
                $_SESSION['usuario']=$usuario;
                header('location: menu2.php');
            }else{
                echo "Usuario/Contraseña no validos";
            }
        }
        
    }
    
    
}
?>