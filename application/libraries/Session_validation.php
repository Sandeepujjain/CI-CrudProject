<?php
class Session_validation
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
    }

    public function checkSession()
    {
        if (!$this->CI->session->userdata('emp_data_session')) {
            redirect('EmployeeLogin');
        }
    }

    public function studentCheckSession()
    {
        if (!$this->CI->session->userdata('student_session')) {
            redirect('StudentLogin');
        }
    }
}
