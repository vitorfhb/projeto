<?php
date_default_timezone_set('America/Sao_Paulo');
     include_once 'DAO/DAO.contatos.php';
        $contato = new contato();
        $contato->nome = $_POST["nomecontato"];
        $contato->email = $_POST["emailcontato"];
        $contato->data = date("Y-m-d H:i");
        $contato->mensagem = $_POST["mensagemcontato"];
        
        $dao = new DAOContato();
        $retorno = $dao->Salvar($contato);
        if($retorno) {
           header("Location:".$_SERVER['HTTP_REFERER']."");
        }
?>