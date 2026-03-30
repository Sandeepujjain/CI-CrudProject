<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImageHandler
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library('upload');
    }

    public function handleMultipleUploads($fileInputNames, $uploadDir, $allowedTypes = 'gif|jpg|png|jpeg|pdf', $maxSize = 512)
    {
        $uploadResults = [];

        if (!empty($_SESSION['emp_data_session'])) {
            $software_deployment_project_code = $_SESSION['emp_data_session']['software_deployment_project_code']; // For Employee Session
        } else {
            $software_deployment_project_code = $_SESSION['software_deployment_project_code']; // For Student Session
        }
        $uploadDir = str_replace("uploads/", "uploads/" . $software_deployment_project_code . "/", $uploadDir);
        // if folder directory does not exist, create it
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        foreach ($fileInputNames as $fileInputName) {
            $config['upload_path'] = $uploadDir;
            $config['allowed_types'] = $allowedTypes;
            $config['max_size'] = $maxSize;
            $config['overwrite'] = true;

            $this->CI->upload->initialize($config);

            if (!$this->CI->upload->do_upload($fileInputName)) {
                // Handle error for a specific file
                $uploadResults[$fileInputName] = $this->CI->upload->display_errors();
            } else {
                $data = $this->CI->upload->data();
                $ext_type = pathinfo($data['file_name'], PATHINFO_EXTENSION);
                $newFileName = uniqid() . '.' . $ext_type;
                $uploadResults[$fileInputName] = $uploadDir . $newFileName;

                // Rename the uploaded file to include uniqid
                rename($uploadDir . $data['file_name'], $uploadDir . $newFileName);
            }
        }

        return $uploadResults;
    }
}
