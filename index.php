<?php
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thinker! - Index</title>
<link rel="stylesheet" href="estilo.css">
</head>

<body bgcolor="#99B3FF">
<table width="993" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="975" height="104">
      <center><h1>Bienvenido al sistema de cuestionarios<br>Por favor, introduce tu nombre</h1></center>
      </td>
    </tr>
    <tr>
      <td height="313">
      
<?php
      include('conexion.php');
	  session_start();
	  
      if (isset($_POST['enviar'])) 
	  {
         if (empty($_POST['nombre'])) 
		 {
            echo "<br><center>Por favor, introduce un nombre. <a href='javascript:history.back();'>Reintentar</a></center>";
         }
		 else 
		 {
            $nombre = $_POST['nombre'];
			$id_cuestionario = $_POST['id_cuestionario'];
			
			$sql = mysql_query("SELECT * FROM preguntas_respondidas WHERE id_usuario = (SELECT id FROM usuarios WHERE nombre = '".$nombre."') AND id_cuestionario = ".$id_cuestionario.";");
			$check = mysql_fetch_array($sql);
			if ($check){
				echo "<br><center>Ese nombre ya ha sido usado. Por favor, escoge otro. <a href='javascript:history.back();'>Reintentar</a></center>";
			}
			else{
			mysql_query("INSERT IGNORE INTO usuarios (nombre) VALUES ('".$nombre."')");

		    $_SESSION['nombre'] = $nombre;
			$_SESSION['id_cuestionario'] = $id_cuestionario;
			
			header("Location: index_cuestionario.php?id_cuestionario=".$id_cuestionario);
			}
         }
      }
	  else
	  {
           ?>
           <center><form action="<?=$_SERVER['PHP_SELF']?>" method="post">
           <label>Nombre:</label><br>
           <input type="text" name="nombre" /><br><br>
           <input type="hidden" name="id_cuestionario" value="<?=$_GET['id_cuestionario']?>" />
           <input type="submit" name="enviar" value="Comenzar cuestionario" />
           </form></center>
           <?php
    }
?>    

      </td>
    </tr>
    <tr>
      <td height="152">&nbsp;</td>
    </tr>
  </tbody>
</table>
</body>
</html>
<?php
ob_end_flush();
?>