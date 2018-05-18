<?php
class mensaje
{
	public function __construct($mensaje='')
	{
		switch($mensaje)
		{
			case "1";
				echo "<script>alert('Sus datos se ha subido con satifación')</script>";
				break;
			case "2";
				echo "<script>alert('ERROR - No se pudo subir los registros')</script>";
				break;
		}
	}
	
}
