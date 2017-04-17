<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemain extends CI_Controller {

	public function index($id)
	{
		$this->load->model('klub_pemain');		
		$data["pemain_list"] = $this->klub_pemain->getPemainByKlub($id);
		$this->load->view('pemain_datatable', $data);
	}

	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('klub_pemain');
		$data['klub']=$this->klub_pemain->updateByPemain($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_pemain_view',$data);

		}else{
			$this->klub_pemain->updateByKlub($id);
			$this->load->view('edit_pemain_sukses');

		}
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('klub_pemain');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_pemain_view');

		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = 1000000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('tambah_pemain_view',$error);
			}
			else{
				$this->klub_pemain->insertKlub();
				$this->load->view('tambah_pemain_sukses');
			}
			

		}
	}

	public function delete($id)
	{
		
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		
		$this->load->model('klub_pemain');
		$this->klub_pemain->deletePemain($id);
		
		if($this->form_validation->run()==FALSE){
			redirect('klub');
		}
	}

}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */

 ?>