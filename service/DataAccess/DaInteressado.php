<?php

	require_once "../Conexao/Conexao.php";

	class DaInteressado{

		private $conexao;

		public function __construct(){

			$this->conexao = conectarBancoDeDados();

		}

		public function salvar(Interessado $interessado){

			try 
			{
				
				$sQL = $this->conexao->prepare("insert into tab_interessado (nome, cpf, contato, endereco) values (:nome, :cpf, :contato, :endereco)");

				$sQL->bindValue(':nome',$interessado->getNome(),PDO::PARAM_STR);
				$sQL->bindValue(':cpf',$interessado->getCPF(),PDO::PARAM_STR);
				$sQL->bindValue(':contato',$interessado->getContato(),PDO::PARAM_STR);
				$sQL->bindValue(':endereco',$interessado->getEndereco(),PDO::PARAM_STR);

				$sQL->execute();
			} 
			catch (PDOException $erro) 
			{
				echo $erro->getMessage();
			}
		}

		public function editar(Interessado $interessado){

			try 
			{
				
				$sQL = $this->conexao->prepare("update tab_interessado set nome = :nome, cpf = :cpf, contato = :contato, endereco = :endereco where id = :idInt");

				$sQL->bindValue(':idInt',   $interessado->getId(),      PDO::PARAM_INT);
				$sQL->bindValue(':nome',    $interessado->getNome(),    PDO::PARAM_STR);
				$sQL->bindValue(':cpf',     $interessado->getCPF(),     PDO::PARAM_STR);
				$sQL->bindValue(':contato', $interessado->getContato(), PDO::PARAM_STR);
				$sQL->bindValue(':endereco',$interessado->getEndereco(),PDO::PARAM_STR);

				$sQL->execute();
			} 
			catch (PDOException $erro) 
			{
				echo $erro->getMessage();
			}
		}

		public function excluir($idInteressado){

			try 
			{
				
				$sQL = $this->conexao->prepare("delete from tab_interessado where id = :idInteressado");

				$sQL->bindValue(':idInteressado', $idInteressado,PDO::PARAM_INT);

				$sQL->execute();
			} 
			catch (PDOException $erro) 
			{
				echo "Erro: ".$erro->getMessage();	
			}
		}

		public function listar(){

			try
                {
                	$sQL = $this->conexao->prepare("select ti.id, ti.nome, ti.cpf, ti.contato, ti.endereco from tab_interessado ti");

                    $sQL->execute();
                    
                    if($sQL->rowCount() > 0)
                    {
                        return $sQL->fetchAll(PDO::FETCH_ASSOC);
                    }
                }
                catch (PDOException $erro) 
                {
					echo "Erro: ".$erro->getMessage();	
				}
		}

		public function procurarId($id){

			try 
			{
				$sQL = $this->conexao->prepare("select ti.id, ti.nome, ti.cpf, ti.contato, ti.endereco from tab_interessado ti where ti.id = :idInteressado");
				$sQL->bindValue(':idInteressado', $id,PDO::PARAM_INT);

                $sQL->execute();
                
                if($sQL->rowCount() > 0)
                {
                    return $sQL->fetchAll(PDO::FETCH_ASSOC);
                }
			} 
			catch (PDOException $erro) 
            {
				echo "Erro: ".$erro->getMessage();	
			}
		}

	}