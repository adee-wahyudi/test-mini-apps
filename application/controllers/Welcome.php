<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('skor_model');
    }

	public function index()
	{
		// $this->load->view('welcome_message');
		$data['title'] = 'Klasemen';
		$data['nama'] = $this->session->userdata('nama');
		$data['klasemen'] = $this->skor_model->getAllKlasemen();

		$this->load->view('_partials/header');
		$this->load->view('_partials/navbar', $data);
		$this->load->view('index', $data);
		$this->load->view('_partials/modal');
		$this->load->view('_partials/footer');
	}
}
