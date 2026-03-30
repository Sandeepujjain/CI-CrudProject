<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB $db
 */
class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('login');
    }

    // public function login()
    // {
    //     echo "<pre>";
    //     print_r($_POST);
    //     print_r($this->input->post());
    //     die;

    //     $email = $this->input->post('email');
    //     $password = md5($this->input->post('password'));



    //     $this->load->model('User_model');
    //     $user = $this->User_model->login($email, $password);

    //     if ($user) {
    //         $this->session->set_userdata('user_id', $user->id);
    //         redirect('dashboard');
    //     } else {
    //         echo "Invalid login";
    //     }
    // }

    // public function logout()
    // {
    //     session_destroy();
    //     redirect('auth');
    // }
}
