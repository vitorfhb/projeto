<!--renomear (retirar "_exemplo")-->
<?php 
    class Conexao {
        public static $conexao;
        
        //private function __construct() {}
        public static function getConexao() {
            if (!isset(self::$conexao)){
                self::$conexao = new PDO("mysql:host=localhost;dbname=DatabaseName", "user", "password");
                self::$conexao->exec("SET CHARACTER SET utf8");
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                error_reporting(E_ALL ^ E_NOTICE);
            }
            return self::$conexao;
        }
    }
?>