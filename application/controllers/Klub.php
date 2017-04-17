<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klub extends CI_Controller {

	public function index()
	{
		$this->load->model('klub_pemain');
		$data["klub_list"] = $this->klub_pemain->getDataKlub();
		$this->load->view('klub_datatable',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('klub_pemain');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_klub_view');

		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = 1000000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('tambah_klub_view',$error);
			}
			else{
				$this->klub_pemain->insertKlub();
				$this->load->view('tambah_klub_sukses');
			}
			

		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('klub_pemain');	

		if($this->form_validation->run()==FALSE){

			$data['klub']=$this->klub_pemain->getDataKlub($id);
			$this->load->view('edit_klub_view',$data);

		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = 1000000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('edit_klub_view',$error);
			}
			else{
				$this->klub_pemain->updateByKlub();
				$this->load->view('edit_klub_sukses');
			}
			

		}
	}

	public function delete($id)
	{
		
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		
		$this->load->model('klub_pemain');
		$this->klub_pemain->deleteKlub($id);
		
		if($this->form_validation->run()==FALSE){
			redirect('klub');
		}
	}

	
}


/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>