<?php 
require_once ("conexao.php");
require_once ("class/class.usuarios.php");

    $mensagem = "";
class DAOUsuario extends Conexao {
    function ListarTudo() {
        
        $resultado = Conexao::getConexao()->query("SELECT * FROM usuarios ORDER BY nome");
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $usuarios = $resultado->fetchAll();
        
        return $usuarios;
    }
     function Buscar($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM usuarios WhErE codigo = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        
        $comando->execute($valores);
        
        $usuarios = $comando->fetchAll();
        if (count($usuarios) >0){
            return $usuarios[0];
        }
        return null;
     }
    function BuscarEmail($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM usuarios WhErE email = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        
        $comando->execute($valores);
        
        $usuarios = $comando->fetchAll();
        if (count($usuarios) >0){
            return $usuarios[0];
        }
        return null;
    }
    function Buscarlogin($email,$senha) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $valores = array($email,$senha);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        
        $comando->execute($valores);
        
        $usuarios = $comando->fetchAll();
        if (count($usuarios) >0){
            return $usuarios[0];
        }
        return null;
    } 
    
    function Salvar($usuario) {
        
        if ($usuario->codigo != '') {
            //Alteração - Código está definido
            $comando = Conexao::getConexao()->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE codigo = ? ");
            $valores = array($usuario->nome, $usuario->email,
                             $usuario->senha, $usuario->codigo);
            $mensagem = "Usuário alterado com sucesso!";
        } else {
            //Inclusão
            $comando = Conexao::getConexao()->prepare("INSERT INTO usuarios (nome,email,senha) VALUES (?,?,?)");
            $valores = array($usuario->nome, $usuario->email,
                             $usuario->senha);
            $mensagem = "Usuário incluido com sucesso!";
        }
        try{
            $comando->execute($valores);
            return $mensagem;
        } catch(Exception $e){
            var_dump($e);
            return false;
        }
    }
    
    function Excluir($codigo){
        
        $comando = Conexao::getConexao()->prepare("DELETE FROM usuarios WHERE codigo = ? ");
        $valores = array($codigo);
        $mensagem = "Usuário excluido com sucesso!";
        try{
            $comando->execute($valores);
            return $mensagem;
        } catch(Exception $e){
            var_dump($e);
            return false;
        }
    }
}
?>