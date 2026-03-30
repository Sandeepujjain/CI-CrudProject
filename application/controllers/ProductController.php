<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductController extends CI_Controller
{
    /** @var CI_DB_query_builder */
    public $db;
    public $input;
    public $output;

    public $ProductsModel;



    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->database();
    // }

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->helper('common_helper'); // 👈 important
    // }

    public function Test()
    {
        // echo "Hello World";
        $this->load->view('ProductViewPage');
    }

    public function InsertUpdateProduct()
    {
        // 1. Fetch data securely using CI3 Input class
        $data = array(
            'product_name'    => $this->input->post('product_name'),
            'category_id'     => $this->input->post('category_id'),
            'subcategory_id' => $this->input->post('subcategory_id')
        );


        // 2. Perform the insert
        $insert = $this->db->insert('products', $data);

        // 3. Handle the response
        if ($insert) {
            $response = array(
                'status' => 'success',
                'message' => 'Product inserted successfully!',
                // 'inserted_id' => $this->db->insert_id(), // Returns the new ID
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Failed to insert product.'
            );
        }

        // 4. Return as JSON for your AJAX call
        echo json_encode($response);
    }


    public function GetProducts()
    {
        $this->db->select('p.*');
        $this->db->from('products p');

        $query = $this->db->get();
        $products = $query->result_array();

        echo json_encode($products);
    }

    public function getProductslist(&$requestedData = null)
    {
        try {
            // Get the request data
            if (!empty($requestedData)) {
                $filter = $requestedData;
            } else {
                $filter = getRequestData();
            }



            // Fetch the data
            $Data = _LM_ProductsModel()->getProductsData($filter);

            


            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => "Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }
}
