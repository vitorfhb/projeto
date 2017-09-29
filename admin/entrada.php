<?php
    include_once 'DAO/DAO.usuarios.php';
    if (isset($_POST["email"]) && isset($_POST["senha"])){
        $usuario = new DAOUsuario();
        $mail = $usuario->BuscarEmail($_POST["email"]);
        //$reg = $usuario->Buscarlogin($_POST["email"],$_POST["senha"]);
        
                
        if ($mail!=null && (crypt($_POST["senha"], $mail->senha) == $mail->senha)){ 
            session_start();
            $_SESSION["usuario"] = $mail->codigo;
            $_SESSION["usuarioNome"] = $mail->nome;
            return header("Location: index.php");
        }
        return header("Location: seguranca.php?erro=1");
        
    }
    header("Location: seguranca.php");
?>