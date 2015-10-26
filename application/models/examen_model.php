<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examen_model extends CI_Model {
	public function getEmpresas(){
		return $this->db->get('empresa')->result();
	}
	public function getProyectos(){
		return $this->db->select('pro.*')->select('emp.nombre as nombre_empresa')->from('proyecto as pro')->join('empresa as emp','pro.empresa = emp.id')->get()->result();
	}
	public function addProyecto($data){
		$this->db->insert('proyecto', $data);
		return $this->db->insert_id();
	}
	public function getEmpresa($id){
		return $this->db->where('id',$id)->get('empresa')->row()->nombre;
	}
	public function getProyecto($id){
		return $this->db->select('pro.*')->select('emp.nombre as nombre_empresa')->from('proyecto as pro')->where('pro.id',$id)->join('empresa as emp','pro.empresa = emp.id')->get()->row();
	}
}