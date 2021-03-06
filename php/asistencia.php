<?php
	//iniciamos la sesión
	session_start();
	if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//ES" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http="Content-Type" content="text/html; charset=iso-8859-1">
		<title>
			...::: Asistencia :::...
		</title>
		<link rel="stylesheet" type="text/css" href="../css/estilo.css">
		<link rel="stylesheet" type="text/css" href="../css/menu2.css">
		<script type="text/javascript" src="../js/titulo.js"></script>
		<script type="text/javascript">
			function habilitar(){
				window.document.frmAgregar.Guardar.disabled = false;
				window.document.frmAgregar.Modificar.disabled = true;
				window.document.frmAgregar.Eliminar.disabled = true;
			}
			function cancelar(){
				window.document.frmAgregar.Guardar.disabled = true;
				window.document.frmAgregar.Modificar.disabled = false;
				window.document.frmAgregar.Eliminar.disabled = false;
			}
			function fecha(){
				var f = window.document.frmAgregar.fechaA.value;
				return f;
			}			
		</script>
	</head>
	<body>
		<?php
			include("../includes/config.php");
			include("../includes/funciones.php");
			$cnx = conectar();
			$sql = "SELECT CodGref,CedId,Apellidos,Nombres FROM personal ORDER BY CedId";
			$consulta = mysql_query($sql);
		?>
		<div>
			<table border="1" cellpadding="2px" cellspacing="2px" align="center">
				<tr>
					<td>
						<div>
							<img src="../Imagenes/BannerGREF.gif" width="950px" height="100px">
						</div>
					</td>
				</tr>
			</table>
		</div>
		<br>
		<header>
			<nav>
				<center>
					<div id="marco" >
						<span class="preload2">
						</span>
						<!--MENU-->
						<ul class="menu2">
							<img src="../Imagenes/menu_izq.gif" align="left" />
							<img src="../Imagenes/menu_der.gif" align="right"/>		
							<li class="top">
								<a class="top_link">
									<span class="down">
										Registar
									</span>
								</a>		
								<ul class="sub">			
									<li>
										<a href="insertar_usuario.php">
											Nuevos Usuarios
										</a>
									</li>
									<li>
										<a href="insertar_equipo.php">
											Equipos
										</a>
									</li>					
								</ul>		
							</li>
							<li class="top">
								<a class="top_link">
									<span class="down">
										Procesar
									</span>
								</a>
								<ul class="sub">
									<li>
										<a href="asistencia.php">
											Asistencia
										</a>
									</li>			
								</ul>		
							</li>
							<li class="top">
								<a class="top_link">
									<span class="down">
										Reportes
									</span>
								</a>
								<ul class="sub">
									<li>
										<a href="reporte_miembros">
											Miembros
										</a>
									</li>
									<li>
										<a href="reporte_equipos.php">
											Equipos
										</a>
									</li>
									<li>
										<a href="reporte_asistencia.php">
											Asistencia
										</a>
									</li>			
								</ul>
					
							</li>							
						</ul>
						<!-- FIN MENU-->
					</div>
				</center>
				<div align="right" class="estilo1">
					<h6>
						<?echo"Usuario: " . $_SESSION['usuario']; ?>
						<br>
						<a href="salir.php">
							Cerrar Sesi&oacute;n
						</a>
					</h6>			
				</div>
			</nav>
			<p align="center" class="estilo1">
				<strong>
					 Infomaci&oacute;n de Asistencia
				</strong>
			</p>
		</header>
		<center>
			<div class="boxu">
				<form name="frmAgregar" method="POST">
					<table border="0" align="center" cellpadding="2px" cellspacing="2px" align="center">
						<tr>
							<td>
								<div>
									<strong>
										AsistenciaId:
									</strong>
								</div>
							</td>
							<td>
								<div>
									<strong>
										C&oacute;digoGref:
									</strong>
									
								</div>
							</td>
							<td>
								<div>
									<strong>
										C&eacute;dula:
									</strong>
								</div>
							</td>
							<td>
								<div>
									<strong>
										Apellidos:
									</strong>
								</div>
							</td>
							<td>
								<div>
									<strong>
										Nombres:
									</strong>
								</div>
							</td>
							<td>
								<div>
									<strong>
										Fecha:
									</strong>
								</div>
							</td>
							<td>
								<div>
									<strong>
										Estado:
									</strong>
								</div>
							</td>
						</tr>
						<?php
							while(list($codigo,$ci,$apellidos,$nombres) = mysql_fetch_array($consulta)){
								echo"<tr>";
								echo"<td><div><input type='text' name='asistenciaid' maxlength='30'></div></td>";
									echo"<td><div><input type='text' name='codigo' value='$codigo' disabled></div><div><input type='hidden' name='codigo' value='$codigo'></div></td>";
								echo"<td><div><input type='text'name='ci' value='$ci' disabled></div>";
									echo"<td><div><input type='text' name='apellidos' value='$apellidos' disabled></div></td>";
									echo"<td><div><input type='text' name='nombres' value='$nombres' disabled></div></td>";
									echo"<td><div><input type='text' name='fechaA' maxlength='10' size='12' placeholder='2001-05-14'></div></td>";
									echo"<td><div><select id='estado' name='estado'>
											<option selected='selected'>
												Seleccione
											</option>
											<option>
												Activo
											</option>
											<option>
												Inactivo
											</option>
										</select></div></td>";
								echo"</tr>";
								
							}
							mysql_free_result($consulta);
							mysql_close();
						?>
					</table>&nbsp;
						<table border="0" cellpadding="2px" cellspacing="2px" align="center">
						<tr>
							<td>
								<div>
									<input type="button" name="Nuevo" value="Nuevo" class="nuevo" onclick="habilitar();">
							</div>
							</td>
							<td>
								<div>
									<input type="submit" name="Guardar" value="Guardar" class="guardar" onclick="window.document.frmAgregar.action = 'guardarNA.php'" disabled>
							</div>
							</td>
							<td>
								<div>
									<input type="submit" name="Consultar" value="Consultar" class="consultar" onclick="window.document.frmAgregar.action = 'consultar_asistencia.php'">
									
								</div>
							</td>
							<td>
								<div>
									<input type="submit" name="Modificar" value="Modificar" class="modificar" onclick="window.document.frmAgregar.action = 'modificar_asistencia.php'">
								</div>
							</td>
							<td>
								<div>
									<input type="submit" name="Eliminar" value="Eliminar" class="eliminar" onclick="window.document.frmAgregar.action = 'eliminar_A.php'">
								</div>
							</td>
							<td>
								<div>
										<input type="button" name="Cancelar" value="Cancelar" class="cancelar" onclick="cancelar()">
								</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</center>
	</body>
</html>
<?
	}
	else{
		echo"<script type='text/javascript'>alert('No Existe Ninguna Sesion Iniciada');</script>";
		echo"<script type='text/javascript'>window.close();</script>";
		echo"<script type='text/javascript'>window.open('administradores.php');</script>";		
	}
?>
