<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email_lib');
        $this->load->database();
    }

    // Login Page
    public function index()
    {
        if ($this->session->userdata('emp_session')) {
            // ✅ CORRECTED: Redirect to dashboard method
            redirect('LoginController/StockProductDashboard');
        } else {
            $this->load->view('Stock/stock_emp_login');
        }
    }

    // Logout
    public function logout()
    {
        $this->session->unset_userdata('emp_session');
        $this->session->sess_destroy();
        redirect('LoginController');
    }

    // Login AJAX handler
    public function employee_login()
    {
        // Validate input
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            echo json_encode([
                'success' => false,
                'message' => strip_tags(validation_errors())
            ]);
            return;
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Use the UsersModel to verify credentials
        $user = _LM_UsersModel()->verifyCredentials($email, $password);

        if ($user) {
            // Remove sensitive data before storing in session
            unset($user['password']);
            $this->session->set_userdata('emp_session', $user);

            echo json_encode([
                'success' => true,
                'message' => 'Login successful'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid email or password'
            ]);
        }
    }

    // Dashboard Page
    public function StockProductDashboard()
    {
        // Check if user is logged in
        if (!$this->session->userdata('emp_session')) {
            redirect('LoginController');
        }

        // Get user data from session
        $data['user'] = $this->session->userdata('emp_session');

        // Load dashboard view
        $this->load->view('Stock/StockProductDashboard', $data);
    }
}
