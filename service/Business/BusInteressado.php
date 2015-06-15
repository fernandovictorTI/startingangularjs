<?php

	require_once "../Entities/interessado.php";
	require_once "../DataAccess/daInteressado.php";

	if($_SERVER['REQUEST_METHOD']=='POST'&& empty($_POST))
	{
		$_POST = json_decode(file_get_contents('php://input'),true);

		if($_POST['modo'] != 'excluir')
		{
			$interessado = new Interessado();
			$interessado->setNome($_POST['nome']);
			$interessado->setCPF($_POST['cpf']);
			$interessado->setContato($_POST['contato']);
			$interessado->setEndereco($_POST['endereco']);
		}		

		switch ($_POST['modo']) {					

			case 'salvar':
				$interessado->setId(0);				
				salvar($interessado);
				break;
				
			case 'editar':
				$interessado->setId($_POST['id']);
				salvar($interessado);
				break;

			case 'excluir':
				excluir($_POST['id']);
				break;
		}
	}

	if(!empty($_GET['modo'])){

		switch ($_GET['modo']) {

			case 'listar':
				echo json_encode(array(
					'interessado' => listar()
				));
				break;

			case 'findId':
				echo json_encode(array(
					'interessado' => procurarId($_GET['id'])
				));
				break;
		}
		
	}	
	
	function salvar(Interessado $inter){		
		
		$daAcccess = new DaInteressado();

		if($inter->getId() > 0) {
			$daAcccess->editar($inter);
		}else{
			$daAcccess->salvar($inter);
		}
	}

	function excluir($id){		
		
		$daAcccess = new DaInteressado();

		$daAcccess->excluir($id);
	}

	function listar(){		
		
		$daAcccess = new DaInteressado();

		return $daAcccess->listar();
	}

	function procurarId($id){

		$daAcccess = new DaInteressado();

		return $daAcccess->procurarId($id);
	}
?>