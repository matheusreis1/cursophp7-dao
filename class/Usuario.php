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

			$this->setData($results[0]);

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

			$this->setData($results[0]);

		} else{

			throw new Exception("Login e/ou senha inválidos.");

		}

	}

	public function setData($data){

		$this->setId_usuario($data["id_usuario"]);
		$this->setDeslogin($data["deslogin"]);
		$this->setDessenha($data["dessenha"]);
		$this->setDtcadastro(new DateTime($data["dtcadastro"]));

	}

	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuario_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if (count($results) > 0) {
			$this->setData($results[0]);
		}

	}

	public function __toString($login = "", $password = ""){
		$this->setDeslogin($login);
		$this->setDessenha($password);
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