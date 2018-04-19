<?php 

class Usuario {

	private $id_usuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getId_usuario(){
		return $this->id_usuario;
	}
	public function setId_usuario($id){
		$this->id_usuario = $id;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($login){
		$this->deslogin = $login;
	}
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($senha){
		$this->dessenha = $senha;
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($data){
		$this->dtcadastro = $data;
	}

	public function loadbyId($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tbUsuario WHERE id_usuario = :ID", array(
			":ID"=>$id
		));

		if (count($results) > 0) {//ou isset($results[0])

			$row = $results[0];

			$this->setId_usuario($row["id_usuario"]);
			$this->setDeslogin($row["deslogin"]);
			$this->setDessenha($row["dessenha"]);
			$this->setDtcadastro(new DateTime($row["dtcadastro"]));

		}

	}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tbUsuario ORDER BY deslogin");

	}

	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tbUsuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));

	}

	public function login($login, $password){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tbUsuario WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if (count($results) > 0) {//ou isset($results[0])

			$row = $results[0];

			$this->setId_usuario($row["id_usuario"]);
			$this->setDeslogin($row["deslogin"]);
			$this->setDessenha($row["dessenha"]);
			$this->setDtcadastro(new DateTime($row["dtcadastro"]));

		} else{

			throw new Exception("Login e/ou senha inválidos.");

		}

	}

	public function __toString(){
		return json_encode(array(
			"id_usuario"=>$this->getId_usuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}



}


?>