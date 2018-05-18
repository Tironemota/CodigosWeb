<?php include('ver.php'); ?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Sistema de noticias</title>
<link href="estilos.css" rel="stylesheet">
</head>

<body>
<header>
  <h1 style="text-align:center">Noticiero </h1>
  <h2 style="text-align:center">
    <a href="index.php?o=inicio">Inicio</a> | 
    <a href="index.php?o=nuevoEditor">Nuevo Editor</a> | 
    <a href="index.php?o=nuevaNoticia">Nueva Noticia</a> | 
    <a href="index.php?o=listaNoticia">Editar Noticia</a>
  </h2>
</header>
<main>
  <?php
  $opcion = (isset($_GET["o"])) ? $_GET["o"] : "inicio";
  $objeto = new ver($opcion);
  ?>
</main>
</body>
</html>
