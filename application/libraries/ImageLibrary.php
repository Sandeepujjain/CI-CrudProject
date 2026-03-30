<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImageLibrary
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('upload');
        $this->CI->load->library('image_lib'); // Load the image_lib
    }

    public function do_upload($updir, $img)
    {
        $new_name = uniqid();
        $filepath = $_SERVER["DOCUMENT_ROOT"] . $updir;
        $config['file_name'] = $new_name;
        $config['upload_path'] = $filepath;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 10000;

        $this->CI->upload->initialize($config);

        if (!$this->CI->upload->do_upload($img)) {
            $error = $this->CI->upload->display_errors();
            return false;
        } else {
            $data = $this->CI->upload->data();
            return $data['file_name'];
        }
    }


    public function do_upload_thumb($filename, $source_path, $target_path, $height, $width)
    {
        $source_path = $_SERVER['DOCUMENT_ROOT'] . $source_path . $filename;
        $target_path = $_SERVER['DOCUMENT_ROOT'] . $target_path;
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'thumb_marker' => '',
            'width' => $width,
            'height' => $height
        );

        $this->CI->image_lib->initialize($config_manip); // Initialize the image_lib with the config

        if (!$this->CI->image_lib->resize()) {
            $error = $this->CI->image_lib->display_errors();
            return false;
        } else {
            return true;
        }
    }
}
