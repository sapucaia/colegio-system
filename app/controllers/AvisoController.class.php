<?php
	
	$acao = $_GET['acao'];
	
	$controller = new AvisoController();
	
	switch($acao){
		case 'cadastrar':{
			$form = $_POST;
			if($id = $controller->salvar($form)){
				header("Location: ../views/aviso/mostrar.php?id=".$id);
			}else{
				header("Location: ../views/aviso/novo.php");
			}	
			break;
		}
		default:{
			$controller->index();
		}
	
	}
	
class AvisoController{
	private $aviso;
	private $avisoRecord; 
	
	public function __construct(){
		$this->aviso = new Aviso();
		$this->avisoRecord = new AvisoRecord();
	}
	
	public function salvar($form){
		
		$this->aviso->setData($form['data']);
		$this->aviso->setAviso($form['aviso']);
		if($this->avisoRecord->cadastrar($aviso)){
			return $this->avisoRecord->ultimoId("aviso_idaviso_seq");
		}
		return null;
	}
	
	public function index(){
		$_SESSION['todosAvisos'] = $this->avisoRecord->listar();
		header("Location: ../views/aviso/");
	}
}

?>