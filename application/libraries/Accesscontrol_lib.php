<?php
class Accesscontrol_lib
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
    }

    public function checkAccess($requestedModule)
    {
        $userRole = $this->CI->session->userdata('emp_data_session')['emp_role'];
        $userRolesArray = explode(',', $userRole);
        $modules = $this->CI->session->userdata('emp_data_session')['emp_module'];
        $moduleName = explode(',', $modules);

        // Check if the user is a superAdmin (role "1")
        if (in_array(1, $userRolesArray)) {
            // User is a superAdmin, grant access
            return;
        }

        // Check if the user has access to the requested module
        if (!in_array($requestedModule, $moduleName)) {
            // User does not have access, redirect to access_denied page
            redirect('Access-Denied');
        }
    }
}
