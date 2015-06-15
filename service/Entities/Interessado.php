<?php

class Interessado{

	private $Id;
	private $Nome;
	private $CPF;
	private $Contato;
	private $Endereco;

	public function setId($id)
	{
		$this->Id = $id;
	}

	public function getId()
	{
		return $this->Id;
	}

	public function setNome($nome)
	{
		$this->Nome = $nome;
	}

	public function getNome()
	{
		return $this->Nome;
	}

	public function setCPF($cpf)
	{
		$this->CPF = $cpf;
	}

	public function getCPF()
	{
		return $this->CPF;
	}

	public function setContato($contato)
	{
		$this->Contato = $contato;
	}

	public function getContato()
	{
		return $this->Contato;
	}

	public function setEndereco($endereco)
	{
		$this->Endereco = $endereco;
	}

	public function getEndereco()
	{
		return $this->Endereco;
	}

}