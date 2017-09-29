<?php 
require_once ("conexao.php");
require_once ("class/class.passaros.php");

    $mensagem = "";
class DAOPassaro extends Conexao {
    function ListarTudo() {
        
        $resultado = Conexao::getConexao()->query("SELECT * FROM passaros ORDER BY nome");
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Passaro');
        $passaros = $resultado->fetchAll();
        
        return $passaros;
    }
    function Contar() {
        
        $resultado = Conexao::getConexao()->query("SELECT COUNT(*) FROM passaros");
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Passaro');
        $passaros = $resultado->fetchColumn(0);
        
        return $passaros;
    }
    function ListarLimite($limite, $offset) {
        
        $resultado = Conexao::getConexao()->query("SELECT * FROM passaros LIMIT ".$limite." OFFSET ".$offset);
        //$valores = array($limite, $offset);
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Passaro');
        $resultado->execute($valores);
        $passaros = $resultado->fetchAll();
        
        return $passaros;
    }
     function Buscar($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM passaros WhErE codigo = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Passaro');
        
        $comando->execute($valores);
        
        $passaros = $comando->fetchAll();
        if (count($passaros) >0){
            return $passaros[0];
        }
        return null;
    } 
    
    function Salvar($passaro) {
        $codigo = 0;
        if ($passaro->codigo != '') {
            //Alteração - Código está definido
            $comando = self::getConexao()->prepare("UPDATE passaros SET nome = ?, nomecientifico = ?, descricao = ? WHERE codigo = ? ");
            $valores = array($passaro->nome, $passaro->nomecientifico,
                             $passaro->descricao, $passaro->codigo);
            $codigo = $passaro->codigo;
            $mensagem = "Registro alterado com sucesso!";
        } else {
            //Inclusão
            $comando = Conexao::getConexao()->prepare("INSERT INTO passaros (nome,nomecientifico,descricao) VALUES (?,?,?)");
            $valores = array($passaro->nome, $passaro->nomecientifico,
                             $passaro->descricao);
            $mensagem = "Registro incluido com sucesso!";
        }
        try{
            $comando->execute($valores);
            //return $mensagem;
            if (!($passaro->codigo!='')){
                $codigo = self::getConexao()->lastInsertId();
            }
            return [$mensagem, $codigo];
            
        } catch(Exception $e){
            var_dump($e);
            return false;
        }
    }
    
    function Excluir($codigo){
        
        $comando = self::getConexao()->prepare("DELETE FROM passaros WHERE codigo = ? ");
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
}
?>