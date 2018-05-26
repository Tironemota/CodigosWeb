<?php
include('conex.php');

class ClaseBaseDatos
{
	private $objetoBase = '';
	public function __construct()
	{
		$this->objetoBase = new mysqli(SERVER,USUARIO,PASS,NOMBREBASE);
		if($this->objetoBase->connect_errno)
		{
			echo "Fallo la conexion: ".$objetoMysqli->connect_error;
		}
	}
	public function listaEditor()
	{
		$query = "SELECT email FROM persona";
		$b = '';
		if($result = $this->objetoBase->query($query))
		{
			while($a = $result->fetch_assoc())
			{
				$b[] = $a;
			}
			return $b;
		}
	}
	public function listaNoticia()
	{
		$query = "SELECT * FROM noticia";
		$b = '';
		if($result = $this->objetoBase->query($query))
		{
			while($a = $result->fetch_assoc())
			{
				$b[] = $a;
			}
			return $b;
		}
	}
	public function detalleNoticia()
	{
		$id = $_GET['id'];
		// SOLUCIONA PROBLEMAS DE INYECCION DE SQL.
		// CONVIERTE A VALOR NUMERICO LO QUE PASA POR EL PARAMETRO.
		$id = intval($id);
		$query = "SELECT email_autor,fechahora,titulo,contenido FROM noticia WHERE id = $id";
		$a = '';
		if($result = $this->objetoBase->query($query))
		{
			$a = $result->fetch_assoc(); 
			
		}
		return $a;
	}
}
