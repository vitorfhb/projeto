<?php 
require_once ("conexao.php");
require_once ("class/class.midia.php");

    $mensagem = "";
class DAOMidia extends Conexao {
    function ListarTudo() {
        
        $resultado = Conexao::getConexao()->query("SELECT * FROM midia ORDER BY refpassaros");
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Midia');
        $midia = $resultado->fetchAll();
        
        return $midia;
    }
     function Buscar($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM midia WhErE codigo = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Midia');
        
        $comando->execute($valores);
        
        $midia = $comando->fetchAll();
        if (count($midia) >0){
            return $midia[0];
        }
        return null;
    }
    function BuscarRef($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM midia WhErE refpassaros = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Midia');
        
        $comando->execute($valores);
        
        $midia = $comando->fetchAll();
        if (count($midia) >0){
            return $midia;
        }
        return null;
    } 
    
    function Salvar($midia) {
        
        if ($midia->codigo != '') {
            //Alteração - Código está definido
            $comando = Conexao::getConexao()->prepare("UPDATE midia SET caminho = ?, refpassaros = ?, legenda = ? WHERE codigo = ? ");
            $valores = array($midia->caminho, $midia->refpassaros,
                             $midia->legenda, $midia->codigo);
            $mensagem = "Registro alterado com sucesso!";
        } else {
            //Inclusão
            $comando = Conexao::getConexao()->prepare("INSERT INTO midia (caminho,refpassaros,legenda) VALUES (?,?,?)");
            $valores = array($midia->caminho, $midia->refpassaros,
                             $midia->legenda);
            $mensagem = "Registro incluido com sucesso!";
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
        
        $comando = Conexao::getConexao()->prepare("DELETE FROM midia WHERE codigo = ? ");
        $valores = array($codigo);
        $mensagem = "Registro excluido com sucesso!";
        try{
            $comando->execute($valores);
            return $mensagem;
        } catch(Exception $e){
            var_dump($e);
            return false;
        }
    }
    
    function ExcluirMult($codigo){
                
        $comando = Conexao::getConexao()->prepare("DELETE FROM midia WHERE codigo = ? ");
        
        try{
            foreach ($codigo as $id){
            $valores = array($id);
            $comando->execute($valores);
            }
            $mensagem = "Registro(s) excluido(s) com sucesso!";
            return $mensagem;
        } catch(Exception $e){
            var_dump($e);
            return false;
        }
    }
}
?>