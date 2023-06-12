<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <meta name="author" content="Angeles Nieto Amuy">
    <meta name="description" content="Ejercicio API's en HTML5<">
    <title>Formulario de Registro SCIII</title>

    <style>
      body {
        background-color:  #7cbceb;
        margin: 0;
        padding: 0;
      }
      h2, label {
        text-align: center;
        color:  #0b67ad  ;
      }
      table {
        border: 3px solid black;
        padding: 20px 50px;
        margin-top: 20px;
        border-radius: 15px;
        background-color: #e7e9e6;
        border-collapse: separate;
        border-spacing: 10;
        -moz-border-radius: 20px;
		-webkit-border-radius: 5px;
      }
            th, h1 {
        background-color: #edf797;
      }

      
      th, .tabla {
        border: solid 1px #7e7c7c;
        padding: 2px;
        text-align: center;
      }
      #tablaAuto{
        display: none;
      }
    </style>
    <script type="text/javascript">
      function cambioVisible(elemento) {
      document.getElementById(elemento).style.display = "block"; ;
      }
    </script>
  </head>
  <body>
  	
    <form name="" method="POST">
      <table border="0" align="center">
      	<tr>
      		<td>
      			 <h2>Formulario de registro</h2>
      		</td>
      	</tr>	
        <tr>
          <td>
          	<label>
          		Nombre
          	</label>    
          	(Requerido)       
          </td>
        </tr>
        <tr>
          <td>
            <label for="nombre"></label>
            <input type="text" name="nombre" id="nombre" required  />
          </td>
        </tr>
        <tr>
          <td>
          	<label>
          		Primer Apellido
          	</label>
            (Requerido)
          </td>
        </tr>
        <tr>
          <td>
            <label for="apellido1"></label>
            <input type="text" name="apellido1" id="apellido1" required  />
          </td>
        </tr>
         <tr>
          <td>
            <label>
              Segundo Apellido
            </label>
            (Requerido)
          </td>
        </tr>
        <tr>
          <td>
            <label for="apellido2"></label>
            <input type="text" name="apellido2" id="apellido2"  required />
          </td>
        </tr>
        <tr>
        <tr>
          <td>
          	<label>
          		Email
          	</label>
            (Requerido)
          </td>
        </tr>
        <tr>
          <td>
            <label for="email"></label>
            <input type="email" name="email" id="email"  required />
          </td>
        </tr>
        <tr>
           <tr>
          <td>
            <label>
              Login
            </label>
            (Requerido)
          </td>
        </tr>
        <tr>
          <td>
            <label for="login"></label>
            <input type="text" name="login" id="login"  required />
          </td>
        </tr>
        <tr>
           <tr>
          <td>
            <label>
              Contraseña
            </label>
            (Requerido)
          </td>
        </tr>
        <tr>
          <td>
            <label for="password"></label>
            <input type="password" name="password" id="password" minlength="4" maxlength="8" required />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center">
            <input
              type="submit"
              name="enviar"
              id="enviar"
              value="Subscribirse"
            />
          </td>    
        </tr>
              <tr>
          <td  align="center">
            <input type="button" onclick="cambioVisible('tablaAuto');" value="Consulta"></input>
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>

<?php
if($_POST){
  //validamos datos del servidor
$user = "root";
$pass = "";
$host = "localhost";
$datab = "practicasamsung";

//hacemos llamado al imput de formuario
$nombre = $_POST["nombre"] ;
$apellido1 = $_POST["apellido1"] ;
$apellido2 = $_POST["apellido2"] ;
$login = $_POST["login"] ;
$password = $_POST["password"] ;
$email = $_POST["email"] ;

//conetamos al base datos
$connection = mysqli_connect($host, $user, $pass);

$consultaEstan="SELECT * FROM usuario WHERE EMAIL like '$email'";


$instruccion_SQL = "INSERT INTO usuario (`ID`, `NOMBRE`, `APELLIDO1`,`APELLIDO2`, `EMAIL`,`LOGIN`,`PASSWORD`)
                             VALUES (NULL,'$nombre','$apellido1','$apellido2','$email','$login','$password')";

 $consulta = "SELECT * FROM usuario";
if(!$connection) 
        {
            echo "No se ha podido conectar con el servidor".mysql_error();
        }
  
               //indicamos selecionar ala base datos
        $db = mysqli_select_db($connection,$datab);

        if (!$db)
        {
        echo "No se ha podido encontrar la Tabla";
        }
   
         $resultado = mysqli_query($connection,$consultaEstan);    
         if( mysqli_num_rows($resultado)>0){
          echo '<script language="javascript">';
          echo 'alert("Ese usuario ya existe")';
          echo '</script>';
        }
        else{
            $resultado = mysqli_query($connection,$instruccion_SQL);
            $result = mysqli_query($connection,$consulta);
            if(!$result) 
            {
                echo "No se ha podido realizar la consulta";
            }
            echo "<div id='tablaAuto' style='margin-left: 35%;
            margin-right: 35%;'>";
            echo "<table>";
            echo "<tr>";
            echo "<th><h1>Login</th></h1>";
            echo "<th><h1>Nombre</th></h1>";
            echo "<th><h1>Primer_Apellido</th></h1>";
            echo "<th><h1>Segundo_Apellido</th></h1>";
            echo "<th><h1>Email</th></h1>";
            echo "</tr>";


            while ($colum = mysqli_fetch_array($result))
             {
                echo "<tr>";
                echo "<td class='tabla'><h2>" . $colum['LOGIN']. "</td></h2>";
                echo "<td class='tabla'><h2>" . $colum['NOMBRE']. "</td></h2>";
                echo "<td class='tabla'><h2>" . $colum['APELLIDO1'] . "</td></h2>";
                echo "<td class='tabla'><h2>" . $colum['APELLIDO2'] . "</td></h2>";
                echo "<td class='tabla'><h2>" . $colum['EMAIL'] . "</td></h2>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";



        }             
        



mysqli_close( $connection );
}
?>