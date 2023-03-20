<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        if($this->form_validation->run() == false){
            redirect('');
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->user_model->getUser($username);

            if($user){
                if(password_verify($password, $user['password'])){
                    $data = [
                        'username' => $user['username'],
                        'nama' => $user['nama']
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata("message",
                        "<script>
                            swal('Login Successfully!', 'Selamat anda berhasil login!', {
                                icon : 'success',
                                buttons: {
                                    confirm: {
                                        className : 'btn btn-success'
                                    }
                                },
                            });
                        </script>");
                    redirect('');
                }else{
                    $this->session->set_flashdata("message", 
                        "<script>
                            swal('Wrong password!', 'Password yang anda masukkan salah!', {
                                icon : 'error',
                                buttons: {
                                    confirm: {
                                        className : 'btn btn-danger'
                                    }
                                },
                            });
                        </script>");
                    redirect('');
                }
            }else{
                $this->session->set_flashdata("message", 
                    "<script>
                        swal('Username is not registered!', 'Username yang anda masukkan tidak terdaftar!', {
                            icon : 'error',
                            buttons: {
                                confirm: {
                                    className : 'btn btn-danger'
                                }
                            },
                        });
                    </script>");
                redirect('');
            }
        }
	}

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');
        $this->session->set_flashdata("message",
            "<script>
                swal('Logout Successfully!', 'You have been logout!', {
                    icon : 'success',
                    buttons: {
                        confirm: {
                            className : 'btn btn-success'
                        }
                    },
                });
            </script>");
        redirect('');
    }
}
