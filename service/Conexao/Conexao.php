<?php
    define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','gerenciadorprocesso');

	function conectarBancoDeDados()
	{	
            $dsn = "mysql:host=".HOST.";dbname=".DB;

            try
            {
				$conexao = new PDO($dsn,USER,PASS);
				$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conexao;
            }
            catch(PDOException $erro)
            {
				echo "Erro ao conectar ao banco ".$erro->getMessage();
            }
	}
?>
