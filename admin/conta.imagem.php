<?php
include_once 'DAO/DAO.conta.midia.php';
$caminho = basename($_POST["caminhoimg"]);
$midia = new DAOMidia();
$temp = $midia->BuscarCaminho($caminho);
$temp->visto = $temp->visto + 1;


$grava = $midia->IMGVisto($temp->visto, $temp->codigo);



?>
