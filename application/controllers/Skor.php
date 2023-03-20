<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skor extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('klub_model');
		$this->load->model('skor_model');
    }
	
	public function index()
	{
		$data['title'] = 'Score';
		$data['nama'] = $this->session->userdata('nama');
		$data['klub'] = $this->klub_model->getAll();
		$data['skor'] = $this->skor_model->getAll();

		$this->load->view('_partials/header');
		$this->load->view('_partials/navbar', $data);
		$this->load->view('skor', $data);
		$this->load->view('_partials/modal');
		$this->load->view('_partials/footer');
	}

	public function simpan()
	{
		$this->form_validation->set_rules('klub1', 'Klub 1', 'required');
        $this->form_validation->set_rules('score1', 'Score 1', 'trim|required');
		$this->form_validation->set_rules('klub2', 'Klub 2', 'required');
        $this->form_validation->set_rules('score2', 'Score 2', 'trim|required');

		if($this->form_validation->run() == true){
			$klub1 = $this->input->post('klub1', true);
			$score1 = $this->input->post('score1', true);
			$klub2 = $this->input->post('klub2', true);
			$score2 = $this->input->post('score2', true);

			if($klub1 != $klub2){
				$klub = $this->skor_model->getKlub($klub1, $klub2);
				if($klub == false){
					if($score1 > $score2){
						$klasemen1 = $this->skor_model->getKlasemen1($klub1);
						$klasemen2 = $this->skor_model->getKlasemen2($klub2);
						$data = [
							'id_klub1' => $klub1,
							'score1' => $score1,
							'id_klub2' => $klub2,
							'score2' => $score2
						];
						$this->skor_model->addScore($data);
						if($klasemen1){
							$id1 = $klasemen1['id'];
							$data1 = [
								'main' => $klasemen1['main'] + 1,
								'menang' => $klasemen1['menang'] + 1,
								'seri' => $klasemen1['seri'] + 0,
								'kalah' => $klasemen1['kalah'] + 0,
								'goal_menang' => $klasemen1['goal_menang'] + $score1,
								'goal_kalah' => $klasemen1['goal_kalah'] + $score2,
								'point' => $klasemen1['point'] + 3
							];
							$this->skor_model->updateKlasemen1($id1, $data1);
							if($klasemen2){
								$id2 = $klasemen2['id'];
								$data2 = [
									'main' => $klasemen2['main'] + 1,
									'menang' => $klasemen2['menang'] + 0,
									'seri' => $klasemen2['seri'] + 0,
									'kalah' => $klasemen2['kalah'] + 1,
									'goal_menang' => $klasemen2['goal_menang'] + $score1,
									'goal_kalah' => $klasemen2['goal_kalah'] + $score2,
									'point' => $klasemen2['point'] + 0
								];
								$this->skor_model->updateKlasemen2($id2, $data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}else{
								$data2 = [
									'id_klub' => $klub2,
									'main' => 1,
									'menang' => 0,
									'seri' => 0,
									'kalah' => 1,
									'goal_menang' => $score2,
									'goal_kalah' => $score1,
									'point' => 0
								];
								$this->skor_model->addKlasemen2($data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}
						}else{
							$data1 = [
								'id_klub' => $klub1,
								'main' => 1,
								'menang' => 1,
								'seri' => 0,
								'kalah' => 0,
								'goal_menang' => $score1,
								'goal_kalah' => $score2,
								'point' => 3
							];
							$this->skor_model->addKlasemen1($data1);
							if($klasemen2){
								$id2 = $klasemen2['id'];
								$data2 = [
									'main' => $klasemen2['main'] + 1,
									'menang' => $klasemen2['menang'] + 0,
									'seri' => $klasemen2['seri'] + 0,
									'kalah' => $klasemen2['kalah'] + 1,
									'goal_menang' => $klasemen2['goal_menang'] + $score2,
									'goal_kalah' => $klasemen2['goal_kalah'] + $score1,
									'point' => $klasemen2['point'] + 0
								];
								$this->skor_model->updateKlasemen2($id2, $data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}else{
								$data2 = [
									'id_klub' => $klub2,
									'main' => 1,
									'menang' => 0,
									'seri' => 0,
									'kalah' => 1,
									'goal_menang' => $score2,
									'goal_kalah' => $score1,
									'point' => 0
								];
								$this->skor_model->addKlasemen2($data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}
							$data2 = [
								'id_klub' => $klub2,
								'main' => 1,
								'menang' => 0,
								'seri' => 0,
								'kalah' => 1,
								'goal_menang' => $score2,
								'goal_kalah' => $score1,
								'point' => 0
							];
							$this->skor_model->addKlasemen2($data2);
							$this->session->set_flashdata('message', 
								'<div class="alert alert-success" role="alert">
									<i class="bi bi-check-circle-fill"></i>
									New score added!
								</div>');
							redirect('skor');
						}
						// 
					}elseif($score1 < $score2){
						$klasemen1 = $this->skor_model->getKlasemen1($klub1);
						$klasemen2 = $this->skor_model->getKlasemen2($klub2);
						$data = [
							'id_klub1' => $klub1,
							'score1' => $score1,
							'id_klub2' => $klub2,
							'score2' => $score2
						];
						$this->skor_model->addScore($data);
						if($klasemen1){
							$id1 = $klasemen1['id'];
							$data1 = [
								'main' => $klasemen1['main'] + 1,
								'menang' => $klasemen1['menang'] + 0,
								'seri' => $klasemen1['seri'] + 0,
								'kalah' => $klasemen1['kalah'] + 1,
								'goal_menang' => $klasemen1['goal_menang'] + $score1,
								'goal_kalah' => $klasemen1['goal_kalah'] + $score2,
								'point' => $klasemen1['point'] + 0
							];
							$this->skor_model->updateKlasemen1($id1, $data1);
							if($klasemen2){
								$id2 = $klasemen2['id'];
								$data2 = [
									'main' => $klasemen2['main'] + 1,
									'menang' => $klasemen2['menang'] + 1,
									'seri' => $klasemen2['seri'] + 0,
									'kalah' => $klasemen2['kalah'] + 0,
									'goal_menang' => $klasemen2['goal_menang'] + $score2,
									'goal_kalah' => $klasemen2['goal_kalah'] + $score1,
									'point' => $klasemen2['point'] + 3
								];
								$this->skor_model->updateKlasemen2($id2, $data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}else{
								$data2 = [
									'id_klub' => $klub2,
									'main' => 1,
									'menang' => 1,
									'seri' => 0,
									'kalah' => 0,
									'goal_menang' => $score2,
									'goal_kalah' => $score1,
									'point' => 3
								];
								$this->skor_model->addKlasemen2($data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}
						}else{
							$data1 = [
								'id_klub' => $klub1,
								'main' => 1,
								'menang' => 0,
								'seri' => 0,
								'kalah' => 1,
								'goal_menang' => $score1,
								'goal_kalah' => $score2,
								'point' => 0
							];
							$this->skor_model->addKlasemen1($data1);
							if($klasemen2){
								$id2 = $klasemen2['id'];
								$data2 = [
									'main' => $klasemen2['main'] + 1,
									'menang' => $klasemen2['menang'] + 1,
									'seri' => $klasemen2['seri'] + 0,
									'kalah' => $klasemen2['kalah'] + 0,
									'goal_menang' => $klasemen2['goal_menang'] + $score2,
									'goal_kalah' => $klasemen2['goal_kalah'] + $score1,
									'point' => $klasemen2['point'] + 3
								];
								$this->skor_model->updateKlasemen2($id2, $data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}else{
								$data2 = [
									'id_klub' => $klub2,
									'main' => 1,
									'menang' => 1,
									'seri' => 0,
									'kalah' => 0,
									'goal_menang' => $score2,
									'goal_kalah' => $score1,
									'point' => 3
								];
								$this->skor_model->addKlasemen2($data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}
							$data2 = [
								'id_klub' => $klub2,
								'main' => 1,
								'menang' => 1,
								'seri' => 0,
								'kalah' => 0,
								'goal_menang' => $score2,
								'goal_kalah' => $score1,
								'point' => 3
							];
							$this->skor_model->addKlasemen2($data2);
							$this->session->set_flashdata('message', 
								'<div class="alert alert-success" role="alert">
									<i class="bi bi-check-circle-fill"></i>
									New score added!
								</div>');
							redirect('skor');
						}
						// 
					}elseif($score1 == $score2){
						$klasemen1 = $this->skor_model->getKlasemen1($klub1);
						$klasemen2 = $this->skor_model->getKlasemen2($klub2);
						$data = [
							'id_klub1' => $klub1,
							'score1' => $score1,
							'id_klub2' => $klub2,
							'score2' => $score2
						];
						$this->skor_model->addScore($data);
						if($klasemen1){
							$id1 = $klasemen1['id'];
							$data1 = [
								'main' => $klasemen1['main'] + 1,
								'menang' => $klasemen1['menang'] + 0,
								'seri' => $klasemen1['seri'] + 1,
								'kalah' => $klasemen1['kalah'] + 0,
								'goal_menang' => $klasemen1['goal_menang'] + $score1,
								'goal_kalah' => $klasemen1['goal_kalah'] + $score2,
								'point' => $klasemen1['point'] + 1
							];
							$this->skor_model->updateKlasemen1($id1, $data1);
							if($klasemen2){
								$id2 = $klasemen2['id'];
								$data2 = [
									'main' => $klasemen2['main'] + 1,
									'menang' => $klasemen2['menang'] + 0,
									'seri' => $klasemen2['seri'] + 1,
									'kalah' => $klasemen2['kalah'] + 0,
									'goal_menang' => $klasemen2['goal_menang'] + $score2,
									'goal_kalah' => $klasemen2['goal_kalah'] + $score1,
									'point' => $klasemen2['point'] + 1
								];
								$this->skor_model->updateKlasemen2($id2, $data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}else{
								$data2 = [
									'id_klub' => $klub2,
									'main' => 1,
									'menang' => 0,
									'seri' => 1,
									'kalah' => 0,
									'goal_menang' => $score2,
									'goal_kalah' => $score1,
									'point' => 1
								];
								$this->skor_model->addKlasemen2($data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}
						}else{
							$data1 = [
								'id_klub' => $klub1,
								'main' => 1,
								'menang' => 0,
								'seri' => 1,
								'kalah' => 0,
								'goal_menang' => $score1,
								'goal_kalah' => $score2,
								'point' => 1
							];
							$this->skor_model->addKlasemen1($data1);
							if($klasemen2){
								$id2 = $klasemen2['id'];
								$data2 = [
									'main' => $klasemen2['main'] + 1,
									'menang' => $klasemen2['menang'] + 0,
									'seri' => $klasemen2['seri'] + 1,
									'kalah' => $klasemen2['kalah'] + 0,
									'goal_menang' => $klasemen2['goal_menang'] + $score2,
									'goal_kalah' => $klasemen2['goal_kalah'] + $score1,
									'point' => $klasemen2['point'] + 1
								];
								$this->skor_model->updateKlasemen2($id2, $data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}else{
								$data2 = [
									'id_klub' => $klub2,
									'main' => 1,
									'menang' => 0,
									'seri' => 1,
									'kalah' => 0,
									'goal_menang' => $score2,
									'goal_kalah' => $score1,
									'point' => 1
								];
								$this->skor_model->addKlasemen2($data2);
								$this->session->set_flashdata('message', 
									'<div class="alert alert-success" role="alert">
										<i class="bi bi-check-circle-fill"></i>
										New score added!
									</div>');
								redirect('skor');
							}
							$data2 = [
								'id_klub' => $klub2,
								'main' => 1,
								'menang' => 0,
								'seri' => 1,
								'kalah' => 0,
								'goal_menang' => $score2,
								'goal_kalah' => $score1,
								'point' => 1
							];
							$this->skor_model->addKlasemen2($data2);
							$this->session->set_flashdata('message', 
								'<div class="alert alert-success" role="alert">
									<i class="bi bi-check-circle-fill"></i>
									New score added!
								</div>');
							redirect('skor');
						}
						// 
					}
				}else{
					$this->session->set_flashdata('message', 
                    '<div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Data pertandingan tidak boleh sama!
                    </div>');
					redirect('skor');
				}
			}else{
				$this->session->set_flashdata('message', 
                    '<div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Klub 1 dan klub 2 tidak boleh sama!
                    </div>');
				redirect('skor');
			}
            redirect('skor');
        }
	}

	// public function delete($id)
    // {
    //     $this->skor_model->delete($id);
    //     $this->session->set_flashdata("message", 
    //                     "<script>
    //                         swal({
    //                             title: 'Deleted!',
    //                             text: 'Your file has been deleted.',
    //                             type: 'success',
    //                             buttons : {
    //                                 confirm: {
    //                                     className : 'btn btn-success'
    //                                 }
    //                             }
    //                         });
    //                     </script>");
    //     redirect('skor');
    // }
}
