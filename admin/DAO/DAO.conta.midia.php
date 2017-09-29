<?php 
require_once ("conexao.php");
require_once ("class/class.midia.php");
    

class DAOMidia extends Conexao {
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