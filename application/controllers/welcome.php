<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','form_validate_array_errors'));
		$this->load->library('form_validation');
		$this->load->model('examen_model');
	}
	public function index(){
		$data['empresas'] = $this->examen_model->getEmpresas();
		$data['proyectos'] = $this->examen_model->getProyectos();
		$this->load->view('inicio',$data);
	}

	public function agrega_proyecto(){
		if($this->input->is_ajax_request()){
			$validation_rules = array(
				array('field'=>'nombre','label'=>'Nombre','rules'=>'trim|required'),
				array('field'=>'estado','label'=>'Estado','rules'=>'required'),
				array('field'=>'descripcion','label'=>'Descripcion','rules'=>'trim|required'),
				array('field'=>'fecha','label'=>'Fecha de creacion','rules'=>'required'),
				array('field'=>'lider','label'=>'Lider de proyecto','rules'=>'trim|required'),
				array('field'=>'password','label'=>'Contraseña del proyecto','rules'=>'trim|required|integer'),
				array('field'=>'empresa','label'=>'Empresa','rules'=>'required'),
				#array('field'=>'imagen','label'=>'Imagen','rules'=>'required')
			);
			$this->form_validation->set_rules($validation_rules);
			if($this->form_validation->run() == false){
				$errors_array = validation_errors_to_array($validation_rules);
				echo json_encode(array('resp'=>false,'error'=>1,'errors_array'=>$errors_array));
			}else{
				$img_name = date("YmdHis");
				$file = $_FILES['imagen']['name'];
				$ext = pathinfo($file, PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['imagen']['tmp_name'],'resources/proyecto/'.$img_name.'.'.$ext)){
					$data['nombre'] = $this->input->post('nombre');
					$data['estado'] = $this->input->post('estado');
					$data['descripcion'] = $this->input->post('descripcion');
					$data['fecha'] = $this->input->post('fecha');
					$data['lider'] = $this->input->post('lider');
					$data['password'] = $this->input->post('password');
					$data['empresa'] = $this->input->post('empresa');
					$data['imagen'] = $img_name.'.'.$ext;
					$proyecto = $this->examen_model->addProyecto($data);
					if($proyecto){
						$data['id'] = $proyecto;
						$data['nombre_empresa'] = $this->examen_model->getEmpresa($this->input->post('empresa'));
						echo json_encode(array('resp'=>true,'data'=>$data));
					}else{
						echo json_encode(array('resp'=>false,'error'=>2));
					}
				}
			}
		}
	}
	public function getProyecto(){
		if($this->input->is_ajax_request()){
			echo json_encode($this->examen_model->getProyecto($this->input->post('id')));
		}
	}
}
