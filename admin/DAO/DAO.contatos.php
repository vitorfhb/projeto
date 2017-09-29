<?php 
require_once ("conexao.php");
require_once ("class/class.contatos.php");

    $aviso = "";
class DAOContato extends Conexao {
    function ListarTudo() {
        
        $resultado = Conexao::getConexao()->query("SELECT * FROM contato ORDER BY nome");
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Contato');
        $contatos = $resultado->fetchAll();
        
        return $contatos;
    }
     function Buscar($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM contato WhErE codigo = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Contato');
        
        $comando->execute($valores);
        
        $contatos = $comando->fetchAll();
        if (count($contatos) >0){
            return $contatos[0];
        }
        return null;
    } 
    
    function Salvar($contato) {
        
        if ($contato->codigo != '') {
            //Alteração - Código está definido
            $comando = Conexao::getConexao()->prepare("UPDATE contato SET nome = ?, email = ?, data = ?, mensagem = ? WHERE codigo = ? ");
            $valores = array($contato->nome, $contato->email,
                             $contato->data, $contato->mensagem, $contato->codigo);
            $aviso = "Contato alterado com sucesso!";
        } else {
            //Inclusão
            $comando = Conexao::getConexao()->prepare("INSERT INTO contato (nome,email,data,mensagem) VALUES (?,?,?,?)");
            $valores = array($contato->nome, $contato->email,
                             $contato->data, $contato->mensagem);
            $aviso = "Contato incluido com sucesso!";
        }
        try{
            $comando->execute($valores);
            return $aviso;
        } catch(Exception $e){
            var_dump($e);
            return false;
        }
    }
    
    function Excluir($codigo){
        
        $comando = Conexao::getConexao()->prepare("DELETE FROM contato WHERE codigo = ? ");
        $valores = array($codigo);
        $aviso = "Contato excluido com sucesso!";
        try{
            $comando->execute($valores);
            return $aviso;
        } catch(Exception $e){
            var_dump($e);
            return false;
        }
    }
}
?>