<?php 
require_once ("conexao.php");
require_once ("class/class.respostas.php");

    $mensagem = "";
class DAOResposta extends Conexao {
    function ListarTudo() {
        
        $resultado = Conexao::getConexao()->query("SELECT * FROM respostas ORDER BY resposta");
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Resposta');
        $respostas = $resultado->fetchAll();
        
        return $respostas;
    }
    function BuscarCOD() {
        $comando = Conexao::getConexao()->query("SELECT codigocontato as codigo, COUNT(codigocontato) as respostas FROM respostas GROUP BY codigocontato");
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Resposta');
        
        $respostas = $comando->fetchAll();
        return $respostas;
    } 
     function Buscar($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM respostas WhErE codigo = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Resposta');
        
        $comando->execute($valores);
        
        $respostas = $comando->fetchAll();
        if (count($respostas) >0){
            return $respostas[0];
        }
        return null;
    } 
    
    function Envio($resposta) {
        $comando = Conexao::getConexao()->prepare("UPDATE respostas SET enviada = ? WHERE codigo = ? ");
        $valores = array($resposta->enviada, $resposta->codigo);
        
        try{
            $comando->execute($valores);
            return $mensagem;
        } catch(Exception $e){
            var_dump($e);
            return false;
    }}
    function Salvar($resposta) {
        
        if ($resposta->codigo != '') {
            //Alteração - Código está definido
            $comando = Conexao::getConexao()->prepare("UPDATE respostas SET data = ?, resposta = ?, codigocontato = ? WHERE codigo = ? ");
            $valores = array($resposta->data, $resposta->resposta, $resposta->codigocontato, $resposta->codigo);
            $mensagem = "resposta alterado com sucesso!";
        } else {
            //Inclusão
            $comando = Conexao::getConexao()->prepare("INSERT INTO respostas (data,resposta,codigocontato) VALUES (?,?,?)");
            $valores = array($resposta->data, $resposta->resposta, $resposta->codigocontato);
            $mensagem = "resposta incluido com sucesso!";
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
        
        $comando = Conexao::getConexao()->prepare("DELETE FROM respostas WHERE codigo = ? ");
        $valores = array($codigo);
        $mensagem = "resposta excluido com sucesso!";
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