<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/FirebaseController.php');


use \Firebase\JWT\JWT;
// use Component;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @property MyJwt $jwt
 * @property MyJwt $myjwt
 * @property CI_Session $session
 * @property CI_Output $output
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property FirebaseController $FirebaseController
 * @property Gps_lib $Gps_lib
 */


class ApiController extends CI_Controller
{
    /**
     * @var FirebaseController
     */
    public $FirebaseController;

    /**
     * @var MyJwt
     */
    public $jwt;

    /**
     * @var MyJwt
     */
    public $myjwt;

    /**
     * @var Gps_lib
     */
    public $Gps_lib;


    private $secret_key = '';
    public $newTokenRequired = false;

    public string $loginValidationFailedMsg;
    public function __construct()
    {
        parent::__construct();
        $this->output->parse_exec_vars = FALSE;
        $this->load->library('MyJwt');
        $this->jwt = new MyJwt();
        $this->loginValidationFailedMsg = "Login Validation Failed";
        $this->FirebaseController = new FirebaseController(false, $this);
        $this->load->library('Gps_lib');

        $this->Gps_lib = new Gps_lib();
    }

    private function checkTokenAPI($token = null)
    {
        if (!empty($token)) {
            $headers = $token;
        } else {
            $headers = $_SERVER["HTTP_AUTHORIZATION"] ?: '';
            if (!isset($headers) || empty($headers)) {
                apiFormatResponse($this->oi->output, ApiResponseStatusCode::BAD_REQUEST, 'Please Login Again', [], ['error' => 'Token not found']);
                return false;
            }
        }
        $authorizationHeader = $headers;
        $token = str_replace('Bearer ', '', $authorizationHeader);

        $decodedToken = $this->myjwt->decodeToken($token);

        if (!$decodedToken) {
            apiFormatResponse($this->output, ApiResponseStatusCode::UNAUTHORIZED, 'Please Login Again', [], ['error' => 'Invalid Token']);
            return false;
        }
        $db_database = $decodedToken->db->software_deployment_database_name;
        $db_hostname = $decodedToken->db->software_deployment_database_host;
        $db_username = $decodedToken->db->software_deployment_database_user;
        $db_password = $decodedToken->db->software_deployment_database_password;
        if (!empty($db_database)) {
            $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";

            // Reload the database connection
            try {
                @$this->db = $this->load->database($dsn1, true);
                if (!$this->db->conn_id) {
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::SERVICE_UNAVAILABLE,
                        'Database connection failed.'
                    );
                }
            } catch (Exception $e) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::SERVICE_UNAVAILABLE,
                    'Database connection failed.'
                );
            }
        } else {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::BAD_REQUEST,
                'Invalid society group database name.'
            );
        }

        if (isset($this->newTokenRequired) && $this->newTokenRequired) {
            //
            return true;
        } else {
            $tokenRecord = _LM_EmployeeTokenModel()
                ->where('token', $token)
                ->findAll();
            if (empty($tokenRecord)) {
                apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Please Login Again', [], ['error' => 'Token Data Not Found']);
                return false;
            }
            $decodedTokenArray = (array) $decodedToken;
            $tokenDataArray = (array) $tokenRecord[0];
            // set session
            $sessionData = array_merge($decodedTokenArray, $tokenDataArray);

            // Set the emp_data_session in session
            $this->session->set_userdata('emp_data_session', $sessionData);

            // If token is valid, proceed with the request
            return true;
        }
    }

    public function checkAuthorization()
    {
        $token = $this->input->get_request_header('Authorization');
        if ($token && ($this->jwt->validateToken($token))) {
            return true; // Token is valid
        } else {
            if (!$token) {
                apiFormatResponse($this->output, ApiResponseStatusCode::UNAUTHORIZED, 'Token is missing'[], ['error' => 'Token is missing']);
            } else {
                apiFormatResponse($this->output, ApiResponseStatusCode::UNAUTHORIZED, 'Token is invalid or expired', [], ['error' => 'Token is invalid or expired']);
            }
            return false;
        }
    }



    public function protected_endpoint()
    {
        if (!$this->checkAuthorization()) {
            return;
        }
        $data = ['message' => 'Authenticated'];

        apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Data retrieved successfully', $data);
    }


    /**
     * Validates required fields and returns an array of error messages for missing fields.
     *
     * @param array $data The data to validate.
     * @param array $requiredFields An array of required field names.
     * @return array An array of error messages for missing fields.
     */
    function checkRequiredFields($data, $requiredFields, $output)
    {
        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $errors[] = "$field is required";
            }
        }
        return $errors;
    }


    public function index()
    {
        $result = _LM_EmployeeAttendanceModel()->select("*,concat(in_time,' - ', out_time)as time,DAY(attendance_date) as day")->findAll();
        $attandance = json_encode($result);
        $this->load->view('test', ['attandance' => $attandance]);
    }

    public function getSelectHtml()
    {
        $responseData = $_POST;

        if (array_key_exists('functionName', $responseData) && (strpos($responseData['functionName'], 'select') === 0)) {
            if (array_key_exists('filter', $responseData)) {
                $htmlString = $responseData['functionName']($responseData['data'], $responseData['filter']);
            } else {
                $htmlString = $responseData['functionName']($responseData['data']);
            }
            echo json_encode($htmlString);
        } else {
            echo json_encode(['error' => 'functionName Required']);
        }
    }

    public function InsertUpdateJobPosting(&$requestedData = null)
    {
        try {
            // Check the API token
            if (!$this->checkTokenAPI()) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::UNAUTHORIZED,
                    'Unauthorized access'
                );
            }

            $this->db->trans_begin(); // Start transaction

            // Fetch the request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Validate required fields
            $requiredFields = ['school_id', 'date', 'job_title', 'role_id', 'job_type', 'contact_no', 'created_by'];
            $errors = $this->checkRequiredFields($filter, $requiredFields, $this->output);

            if (!empty($errors)) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::BAD_REQUEST,
                    'Required fields are missing',
                    [],
                    ['error' => $errors]
                );
            }

            // Handle file uploads
            $filename = null;
            if (!empty($_FILES['job_posting_image']['name'])) {
                // Define the upload directory and ensure it exists
                $uploadDir = 'uploads/' . $_SESSION['emp_data_session']['software_deployment_project_code'] . '/job_posting/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); // Create the directory with proper permissions
                }

                // Handle updating an existing file
                if (!empty($filter['job_posting_id'])) {
                    $jobPostingData = _LM_JobPostingModel()->find($filter['job_posting_id']);
                    if (!empty($jobPostingData) && !empty($jobPostingData['job_posting_image'])) {
                        $oldFilePath = $jobPostingData['job_posting_image'];
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath); // Delete the existing image
                        }
                    }
                }

                // Extract the file extension and construct the full file path
                $fileExtension = pathinfo($_FILES['job_posting_image']['name'], PATHINFO_EXTENSION);
                $fileNameWithoutExtension = $filter['file_name'] ?? uniqid('jobposting_');
                $fileNameWithExtension = $fileNameWithoutExtension . '.' . $fileExtension;
                $uploadPath = $uploadDir . $fileNameWithExtension;

                // Move the uploaded file
                if (move_uploaded_file($_FILES['job_posting_image']['tmp_name'], $uploadPath)) {
                    $filename = $fileNameWithExtension;
                    $filter['job_posting_image'] = $uploadPath;
                } else {
                    $this->db->trans_rollback();
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::VALIDATION_FAILED,
                        'Image upload failed'
                    );
                }
            }

            // Determine if this is an update or insert operation
            if (!empty($filter['job_posting_id'])) {
                $updateResult = _LM_JobPostingModel()->update($filter);

                if (!empty($updateResult['errors'])) {
                    $this->db->trans_rollback();
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::VALIDATION_FAILED,
                        'Job Posting Updation Failed',
                        $updateResult['errors']
                    );
                }

                $this->db->trans_commit();
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::OK,
                    'Job Posting Updated successfully',
                    $updateResult
                );
            }

            // Insert a new job posting
            $insertResult = _LM_JobPostingModel()->insert($filter);

            if (!empty($insertResult['errors'])) {
                $this->db->trans_rollback();
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::VALIDATION_FAILED,
                    'Job Posting Insertion Failed',
                    [],
                    $insertResult['errors']
                );
            }

            $this->db->trans_commit();
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::CREATED,
                'Job Posting Added Successfully',
                []
            );
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                'An error occurred',
                [],
                ['error' => $e->getMessage()]
            );
        }
    }


    public function jobPostingList(&$requestedData = null)
    {
        try {
            if (!$this->checkTokenAPI()) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::UNAUTHORIZED,
                    'Unauthorized access'
                );
            }
            // Fetch the request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Validate required fields
            $requiredFields = ['school_id'];
            $errors = $this->checkRequiredFields($filter, $requiredFields, $this->output);

            if (!empty($errors)) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::BAD_REQUEST,
                    'Required fields are missing',
                    [],
                    ['error' => $errors]
                );
            }
            // Fetch the data
            $Data = _LM_JobPostingModel()->getJobPostingData($filter);

            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Job Posting Data Not Found', [], ['error' => " Job Posting  Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Job Posting   Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }


    public function JobApplicationListApi(&$requestedData = null)
    {
        if (!$this->checkTokenAPI()) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::UNAUTHORIZED,
                'Unauthorized access'
            );
        }
        try {
            //Get the request data
            if (!empty($requestedData)) {
                $filter = $requestedData;
            } else {
                $filter = getRequestData();
            }

            $requiredFields = ['school_id'];
            // Validate required fields
            $errors = $this->checkRequiredFields($filter, $requiredFields, $this->output);
            if (!empty($errors)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, '', [], ['error' => $errors]);
            }
            // Fetch the data
            $Data = _LM_JobApplicationModel()->getJobApplicationData($filter);

            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => " Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, ' Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }


     public function DeleteJobPosting(&$requestedData = null)
    {
        // Check API token validity
        if (!$this->checkTokenAPI()) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::UNAUTHORIZED,
                'Invalid or missing API token.',
                [],
                ['error' => 'Unauthorized request.']
            );
        }

        try {
            // Retrieve request data and validate required fields
            $filter = !empty($requestedData) ? $requestedData : getRequestData();
            $requiredFields = ['job_posting_id'];
            $errors = $this->checkRequiredFields($filter, $requiredFields, $this->output);

            if (!empty($errors)) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::BAD_REQUEST,
                    'Missing required fields.',
                    [],
                    ['error' => $errors]
                );
            }

            if (!empty($filter['job_posting_id'])) {
                // Fetch the job posting data
                $jobPosting = _LM_JobPostingModel()->find($filter['job_posting_id']);

                if (!$jobPosting) {
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::NOT_FOUND,
                        'Job posting not found.',
                        [],
                        ['error' => 'Invalid job_posting_id.']
                    );
                }

                // Attempt to delete the job posting
                $deleteResult = _LM_JobPostingModel()->delete($filter['job_posting_id']);

                if (is_array($deleteResult) && isset($deleteResult['errors']) && !empty($deleteResult['errors'])) {
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::VALIDATION_FAILED,
                        'Job Posting Validation failed.',
                        [],
                        $deleteResult['errors']
                    );
                }

                // Delete associated image file if it exists
                if (!empty($jobPosting['job_posting_image']) && file_exists($jobPosting['job_posting_image'])) {
                    unlink($jobPosting['job_posting_image']);
                }

                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::OK,
                    'Job posting Data Deleted Successfully.',
                    []
                );
            }
        } catch (Exception $e) {
            // Handle unexpected errors
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                'An unexpected error occurred while processing the request.',
                [],
                ['error' => $e->getMessage()]
            );
        }
    }


}