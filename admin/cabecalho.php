<?php 
date_default_timezone_set('America/Sao_Paulo');
//include 'conexao.php';
session_start();
    if (!isset($_SESSION["usuario"])){ 
        header("Location: seguranca.php");}
     //conexao com mysql 
    $nomeUsuario = $_SESSION["usuarioNome"];
?>

<!DOCTYPE html>

<html>

<head>
    <title>Admin <?php echo (isset($TITULO) ? "- ".$TITULO : "");?></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/normalize.css" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/teste.css">
    <!--<link rel="stylesheet" type="text/css" href="css/dataTables.material.min.css">
    <link rel="stylesheet" type="text/css" href="css/dtcustom.css">-->

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>-->
    <script type="text/javascript" src="js/teste.js"></script>
        <!--    <script type="text/javascript" src="js/dataTables.material.min.js"></script>-->
</head>

<body>
    <header>
    <nav role="navigation" class="nav-extended light-blue darken-3 z-depth-3">
    <div class="nav-wrapper container">
        <div class="row">
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <div class="">
            <a href="index.php" class="brand-logo">Administração</a>
        </div>
        <div class="right">
        <div class="chip">
        <?=$nomeUsuario;?>
        <a href="saida.php" class="red" style="display: inline">Sair</a>
        </div>
        </div>
        </div>
        <div class="row">
        <ul id="nav-mobile" class="hide-on-med-and-down">
            <li <?php if (isset($menu_ativo) && $menu_ativo == "usuario") { ?> class="active" <?php } ?> ><a href="usuariolista.php">Usuários</a></li>
            <li <?php if (isset($menu_ativo) && $menu_ativo == "passaro") { ?> class="active" <?php } ?> ><a href="passarolista.php">Pássaros</a></li>
            <li <?php if (isset($menu_ativo) && $menu_ativo == "midia") { ?> class="active" <?php } ?> ><a href="midialista.php">Midia</a></li>
            <li <?php if (isset($menu_ativo) && $menu_ativo == "contato") { ?> class="active" <?php } ?> ><a href="contatolista.php">Contatos</a></li>
            <li <?php if (isset($menu_ativo) && $menu_ativo == "resposta") { ?> class="active" <?php } ?> ><a href="respostalista.php">Respostas</a></li>
            <li class="right<?php if (isset($menu_ativo) && $menu_ativo == "estatistica") { echo (" active"); } ?>" ><a href="estatisticapassaro.php">Estatísticas</a></li>
        </ul>
        </div>
        <ul class="side-nav" id="mobile-demo">
        <li <?php if (isset($menu_ativo) && $menu_ativo == "usuario") { ?> class="active" <?php } ?> ><a href="usuariolista.php">Usuários</a></li>
        <li <?php if (isset($menu_ativo) && $menu_ativo == "passaro") { ?> class="active" <?php } ?> ><a href="passarolista.php">Pássaros</a></li>
        <li <?php if (isset($menu_ativo) && $menu_ativo == "midia") { ?> class="active" <?php } ?> ><a href="midialista.php">Midia</a></li>
        <li <?php if (isset($menu_ativo) && $menu_ativo == "contato") { ?> class="active" <?php } ?> ><a href="contatolista.php">Contatos</a></li>
        <li <?php if (isset($menu_ativo) && $menu_ativo == "resposta") { ?> class="active" <?php } ?> ><a href="respostalista.php">Respostas</a></li>
        <li <?php if (isset($menu_ativo) && $menu_ativo == "estatistica") { ?> class="active" <?php } ?> ><a href="estatisticapassaro.php">Estatísticas</a></li>
        </ul>
    
    </div>
  </nav>
    
    </header>
    <main class="container">
