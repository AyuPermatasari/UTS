<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klub_Pemain extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataKlub()
		{
			$this->db->select("id, nama, logo");
			$query = $this->db->get('klub');
			return $query->result();
		}

		public function getPemainByKlub($idKlub)
		{
			$this->db->select("pemain.id as id ,klub.nama as namaKlub, pemain.nama as namaPemain, pemain.posisi as posisi, DATE_FORMAT(pemain.tanggal_lahir,'%d-%m-%Y') as tanggal_lahir");
			$this->db->where('fk_klub', $idKlub);	
			$this->db->join('klub', 'klub.id = pemain.fk_klub', 'left');	
			$query = $this->db->get('pemain');
			return $query->result();
		}


		public function insertKlub()
		{
			$object = array('nama' => $this->input->post('nama'), 'logo' => $this->upload->data('file_name') );
			$this->db->insert('klub', $object);
		}

		public function insertPemain()
		{
			$object = array('nama' => $this->input->post('nama'), 'posisi' => $this->input->post('posisi'),'tanggal_lahir' => $this->input->post('tanggal_lahir'),'fk_klub' => $this->input->post('fk_klub'));
			$this->db->insert('pemain', $object);
		}

		public function getKlub($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('klub',1);
			return $query->result();

		}

		public function updateByKlub($id)
		{
			$data = array('nama' => $this->input->post('nama'),'logo' => $this->upload->data('file_name'));
			$this->db->where('id', $id);
			$this->db->update('klub', $data);
		}

		public function updateByPemain($id)
		{
			$data = array('nama' => $this->input->post('nama'), 'posisi' => $this->input->post('posisi'),'tanggal_lahir' => $this->input->post('tanggal_lahir'),'fk_klub' => $this->input->post('fk_klub'));
			$this->db->where('id', $id);
			$this->db->update('pemain', $data);
		}

		public function deleteKlub($id)
		{
			
			$this->db->where('id', $id);
			$this->db->delete('klub');
		}

		public function deletePemain($id)
		{
			
			$this->db->where('id', $id);
			$this->db->delete('pemain');
		}

}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>