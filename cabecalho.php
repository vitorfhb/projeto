<?php 
date_default_timezone_set('America/Sao_Paulo');
//include 'conexao.php';

?>

<!DOCTYPE html>

<html>

<head>
    <title>Olhar da Natureza</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/normalize.css" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/teste.css">
    <link rel="stylesheet" type="text/css" href="css/listnav.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">
    
    <link rel="stylesheet" href="css/estilo.css" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/teste.js"></script>
    <script type="text/javascript" src="js/jquery-listnav.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.min.js"></script>
</head>

<body>
    <header>
    <nav role="navigation" class="cyan darken-2 z-depth-3">
    <div class="nav-wrapper container">
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <a href="index.php" class="brand-logo">Olhar da Natureza</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
                <a href="passaros.php">Pássaros</a>
            </li>
            <li>
                <a class="waves-effect waves-light modal-trigger grey-text text-lighten-3 sobre" href="#modalsobre">Sobre</a>
            </li>
            <li>
                <a class="waves-effect waves-light modal-trigger grey-text text-lighten-3 contato" href="#modal2">Contato</a>
            </li>
        </ul>
        <ul id="mobile-demo" class="side-nav">
            <li>
                <a href="passaros.php">Pássaros</a>
            </li>
            <li>
                <a class="waves-effect waves-light modal-trigger sobre" href="#modalsobre">Sobre</a>
            </li>
            <li>
                <a class="waves-effect waves-light modal-trigger contato" href="#modal2">Contato</a>
            </li>
        </ul>
    </div>
  </nav>
    
    </header>
    <main>
