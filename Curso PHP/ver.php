<?php
include('mensajes.php');
class ver
{
	public function __construct($metodo="inicio")
	{
		switch($metodo)
		{
			case "inicio";
				$this->metodoPantallaInicio();
				break;
			case "nuevoEditor";
				$this->metodoNuevoEditor();
				break;
			case "nuevaNoticia";
				$this->metodoNuevaNoticia();
				break;
			case "listaNoticia";
				$this->metodoListaNoticia();
				break;
			case "detalleNoticia";
				$this->metodoDetalleNoticia();
				break;
			default:
				$this->sinMetodo();
				break;
		}
	}
	private function sinMetodo()
	{
		echo "Sin acciones";
	}
	private function metodoPantallaInicio()
	{
		echo "<h1>Bienvenido al sistema</h1>";
	}
	private function metodoNuevoEditor()
	{
		echo '
			<h1><center>Nuevo Editor</center></h1>
			<form action="guardar.php?o=nuevoEditor" method="post" id="nuevoEditor">
				<input type="text" name="correoform" id="idcorreoform" placeholder="Correo..."><br>
				<input type="text" name="passform" id="idpassform" placeholder="Password..."><br>
				<input type="text" name="nombreform" id="idnombreform" placeholder="Nombre..."><br>
				<input type="text" name="maternoform" id="idmaternoform" placeholder="Apellido paterno..."></br>
				<input type="text" name="maternoform" id="idmaternoform" placeholder="Apellido materno..."></br>
				<input type="text" name="nacioform" id="idnacioform" placeholder="Nacimiento (YYYY-MM-DD)..."><br>
				<input type="submit" value="Guardar datos del nuevo editor">
			</form>';
		if(isset($_GET['mensaje']))$mensaje = new mensaje($_GET['mensaje']);
	}
	private function metodoNuevaNoticia()
	{
		include('consulta.php');
		$consulta = new ClaseBaseDatos();
		$arreglo = $consulta->listaEditor();
		echo '
			<h1><center>Nueva Noticia</center></h1>
			<form action="guardar.php?o=nuevaNoticia" method="post" id="nuevaNoticia">
				<select name="email">';
				foreach($arreglo as $editor)
				{
					echo '<option value="'.$editor['email'].'">'.$editor['email'].'</option>';
				}
				echo '</select><input type="text" name="titulo" id="idtitulo" placeholder="Titulo...">
				<textarea rows="4" cols="50" name="contenido" id="idcontenido" placeholder="Contenido..."></textarea>
				<input type="submit" value="Guardar nueva noticia">
			</form>';
		if(isset($_GET['mensaje']))$mensaje = new mensaje($_GET['mensaje']);
	}
	private function metodolistaNoticia()
	{
		include('consulta.php');
		$consulta = new ClaseBaseDatos();
		$arreglo = $consulta->listaNoticia();
		echo "<h1>Listado de noticias</h1>";
		foreach($arreglo as $noticia)
		{
			echo '<div>';
			echo $noticia['titulo'].'<br>';
			echo '<a href="index.php?o=detalleNoticia&id='.$noticia['id'].'">Detalle</a>';
			echo '<hr></div>';
		}
	}
	private function metodoDetalleNoticia()
	{
		include('consulta.php');
		$consulta = new ClaseBaseDatos();
		$arreglo = $consulta->detalleNoticia();
		echo "<h3>Detalle de noticia</h3>";
		echo "<h1>".$arreglo['titulo']."</h1>";
		echo "<p>".$arreglo['email_autor']."<br>".date('d/m/Y H:m:s',strtotime($arreglo['fechahora']))."</p>";
		// PROTEJO DE INYECCION CONVIRTIENDO ETIQUETAS HTML A CARACTERES ESPECIALES
		$protejoContenido = htmlentities($arreglo['contenido']);
		echo "<div>".$protejoContenido."</div>";
	}
}
