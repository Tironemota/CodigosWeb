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
			// VALIDAMOS CON MENSAJE DE ERROR
			$o = $_GET["o"];
			header("Location:index.php?o=$o&mensaje=0");
			exit();
		}
	}
	public function nuevoEditor()
	{
		$correo = $_POST["correoform"];
		$pass = $_POST["passform"];
		// ENCRIPTAMOS EL PASSWORD
		$pass = password_hash($pass,PASSWORD_DEFAULT);
		$nombre = $_POST["nombreform"];
		$apaterno = $_POST["maternoform"];
		$amaterno = $_POST["maternoform"];
		$nacio = $_POST["nacioform"];
		echo $correo;
		// CREAMOS CONSULTA PREPARADA
		$sentencia = $this->objetoBase->prepare("INSERT INTO persona (email,pass,nombre,a_paterno,a_materno,nacio) VALUES (?,?,?,?,?,?)");
		// INDICAMOS CUANTOS CAMPOS Y DE QUE TIPOS SON
		// SON 6 CAMPOS TIPO STRING
		// i = entero, d = doble, s = texto, b = blob
		$sentencia->bind_param("ssssss",$correo,$pass,$nombre,$apaterno,$amaterno,$nacio);
		// EJECUTAMOS LA CONSULTA
		if($sentencia->execute()){
			// REDIRECCIONAMOS
			header("location: index.php?o=nuevoEditor&mensaje=2");
		}else{
			// REDIRECCIONAMOS
			header("location: index.php?o=nuevoEditor&mensaje=1");
		}
	}
	public function nuevaNoticia()
	{
		//$titulo = $_POST['titulo'];
		//$contenido = $_POST['contenido'];
		// PROTEJO DE INYECCION CONVIRTIENDO LAS ETIQUETAS HTML A CARACTERES ESPECIALES
		$titulo = htmlentities($_POST['titulo']);
		$contenido = htmlentities($_POST['contenido']);
		$fecha = date("Y-m-d H:i:s");
		$sql = "INSERT INTO noticia (email_autor,fechahora,tituloxx,contenido) VALUES ('mota','$fecha','$titulo','$contenido')";
		if($this->objetoBase->query($sql)){
			// REDIRECCIONAMOS
			header("location: index.php?o=nuevaNoticia&mensaje=1");
		}else{
			//echo "ERROR: ".$this->objetoBase->error;
			header("location: index.php?o=nuevaNoticia&mensaje=2");
		}
	}
	public function sinMetodo()
	{
		echo "Sin metodos";
	}
	public function __destruct()
	{
		$this->objetoBase = null;
	}
}
$operacion = (isset($_GET["o"]) ? $_GET["o"] : "ninguna");
$basedatos = new ClaseBaseDatos();
switch($operacion)
{
	case "nuevoEditor":
		$basedatos->nuevoEditor();
		break;
	case "nuevaNoticia":
		$basedatos->nuevaNoticia();
		break;
	default:
		$this->sinMetodo();
		break;
}
