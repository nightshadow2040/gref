<?php
	session_start();
	ob_start();
	if(isset($_POST['Guardar'])){
		if(empty($_SESSION['usuario'])){
			echo"<script type='text/javascript'>alert('No Existe Ninguna Sesión Iniciada'); window.close(); window.open('administradores.php')</script>";
		}
		else{
			if(empty($_POST['usuario']) || empty($_POST['password'])){
				echo"<script type='text/javascript'>alert('Debes Ingresar todos los Datos...')</script>";
				echo"<script type='text/javascript'>window.close(); window.open('insertar_usuario.php');</script>";
			}
			else{
				include("../includes/config.php");
				include("../includes/funciones.php");
				$cnx = conectar();
				$sql = "SELECT * FROM usuario WHERE clave='". $_POST['password']."'";
				$consulta = mysql_query($sql) or die(mysql_error());
				$lista = mysql_fetch_array($consulta);
					if($_POST['usuario'] == $lista['usuario'] && $_POST['password'] == $lista['clave']){
						echo"<script type='text/javascript'>alert('El Usuario Ya Existe...')</script>";
						echo"<script type='text/javascript'>window.close();window.open('insertar_usuario.php')</script>";
					}
					else{
						$sql = "INSERT INTO usuario SET ";
						$sql .= "usuario = '".$_POST['usuario']."',";
						$sql .= "clave = '".$_POST['password']."'";
						$consulta = mysql_query($sql) or die(mysql_error());
						echo"<script type='text/javascript'>alert('Registro Guardado Correctamente...')</script>";
						echo"<script type='text/javascript'>window.close();window.open('menu.php')</script>";
					}
				mysql_close($cnx);
			}
		}
	}
	else{
		echo"<script type='text/javascript'>alert('No se ha Realizado Ningun Envio de Informacion')</script>";
		echo"<script type='text/javascript'>window.close();window.open('insertar_usuario.php')</script>";
	}
?>
