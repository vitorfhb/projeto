<?php 
require_once ("admin/conexao.php");
require_once ("admin/class/class.passaros.php");
require_once ("admin/class/class.midia.php");
    
class DAOPassaros extends Conexao {
    function ListarTudo() {
        
        $resultado = Conexao::getConexao()->query("SELECT * FROM passaros ORDER BY nome");
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Passaro');
        $passaros = $resultado->fetchAll();
        
        return $passaros;
    }
    function ListarInicial() {
        
        $resultado = Conexao::getConexao()->query("SELECT * FROM passaros ORDER BY rand() LIMIT 9");
        $resultado->setFetchMode(PDO::FETCH_CLASS, 'Passaro');
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
    function Visto($valor1, $valor2) {
        $comando = Conexao::getConexao()->prepare("UPDATE passaros SET visto = ? WHERE codigo = ? ");
        $valores = array($valor1, $valor2);
        
        try{
            $comando->execute($valores);
            return $mensagem;
        } catch(Exception $e){
            var_dump($e);
            return false;
    }}
     
}
class DAOMidia extends Conexao {
    function ListarMidia($codigo) {
        
        $comando = Conexao::getConexao()->prepare("SELECT * FROM midia WhErE refpassaros = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Midia');
        
        $comando->execute($valores);
        $midia = $comando->fetchAll();
        return $midia;
    }
    function Buscar($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM midia WhErE refpassaros = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Midia');
        
        $comando->execute($valores);
        
        $midia = $comando->fetchAll();
        if (count($midia) >0){
            return $midia[0];
        }
        return null;
    }
    function BuscarCaminho($codigo) {
        $comando = Conexao::getConexao()->prepare("SELECT * FROM midia WhErE caminho = ?");
        $valores = array($codigo);
        $comando->setFetchMode(PDO::FETCH_CLASS, 'Midia');
        
        $comando->execute($valores);
        
        $midia = $comando->fetchAll();
        if (count($midia) >0){
            return $midia[0];
        }
        return null;
    }
    function IMGVisto($valor1, $valor2) {
        $comando = Conexao::getConexao()->prepare("UPDATE midia SET visto = ? WHERE codigo = ? ");
        $valores = array($valor1, $valor2);
        
        try{
            $comando->execute($valores);
            return $mensagem;
        } catch(Exception $e){
            var_dump($e);
            return false;
    }}
}
?>