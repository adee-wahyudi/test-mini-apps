<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klub extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('klub_model');
    }

	public function index()
	{
		$data['title'] = 'Data Klub';
		$data['nama'] = $this->session->userdata('nama');
		$data['klub'] = $this->klub_model->getAll();
		
		$this->load->view('_partials/header');
		$this->load->view('_partials/navbar', $data);
		$this->load->view('klub', $data);
		$this->load->view('_partials/modal');
		$this->load->view('_partials/footer');
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_klub', 'Nama Klub', 'trim|required');
        $this->form_validation->set_rules('kota', 'Kota', 'trim|required');

		if($this->form_validation->run() == false){
            redirect('klub');
        }else{
            $nama_klub = $this->input->post('nama_klub', true);
            $kota = $this->input->post('kota', true);
            $klub = $this->klub_model->getKlub($nama_klub);
            if($klub == false){
                $this->klub_model->addKlub($nama_klub, $kota);
                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        New klub added!
                    </div>');
                    redirect('klub');
            }else{
                $this->session->set_flashdata('message', 
                    '<div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Nama klub sudah ada!
                    </div>');
                redirect('klub');
            }
        }
	}

	public function delete($id)
    {
        $this->klub_model->delete($id);
        $this->session->set_flashdata("message", 
                        "<script>
                            swal({
                                title: 'Deleted!',
                                text: 'Your file has been deleted.',
                                type: 'success',
                                buttons : {
                                    confirm: {
                                        className : 'btn btn-success'
                                    }
                                }
                            });
                        </script>");
        redirect('klub');
    }
}
