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


class AlumniApiController extends CI_Controller
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
            return true;
        } else {
            $tokenRecord = _LM_AlumniTokenModel()
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

            // Set the alumni_data_session in session
            $this->session->set_userdata('alumni_data_session', $sessionData);

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


    public function getFundRequestList(&$requestedData = null)
    {
        // Verify token validity
        if (!$this->checkTokenAPI()) {
            return;
        }

        try {
            // Get request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Define required fields for validation
            $requiredFields = ['school_id'];

            // Validate required fields
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
            // Fetch the data
            $filter['is_active'] = 1; // Ensure only active fund requests are fetched
            $Data = _LM_AlumniFundRequestModel()->getFundRequestData($filter);

            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => "Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, ' Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }


    public function getFundRequestListData(&$requestedData = null)
    {
        if (!$this->checkTokenAPI()) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::UNAUTHORIZED,
                'Unauthorized access'
            );
        }
        try {
            // Get the request data
            if (!empty($requestedData)) {
                $filter = $requestedData;
            } else {
                $filter = getRequestData();
            }

            // Fetch the data
            $Data = _LM_AlumniFundRequestModel()->getFundRequestData($filter);

            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => "Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, ' Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }







    public function InsertUpdateFundDonationApi(&$requestedData = null)
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

            // Fetch the request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Validate required fields
            $requiredFields = [
                'alumni_fund_request_id',
                'alumni_id',
                'alumni_fund_donations_amount',
                'alumni_fund_donations_payment_method',
                'alumni_fund_donations_payment_reference',
                'alumni_fund_donations_date',
            ];
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



            // Insert new Record
            $insertResult = _LM_AlumniFundDonationsModel()->insert($filter);
            if (is_array($insertResult) && array_key_exists('errors', $insertResult) && !empty($insertResult['errors'])) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::VALIDATION_FAILED,
                    'Data Insertion Failed',
                    [],
                    $insertResult['errors']
                );
            }

            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::CREATED,
                'Data Added Successfully',
                $insertResult
            );
        } catch (Exception $e) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                'An error occurred',
                [],
                ['error' => $e->getMessage()]
            );
        }
    }




    public function getAlumniStudentsDataApi(&$requestedData = null)
    {
        //Verify token validity
        if (!$this->checkTokenAPI()) {
            return;
        }

        try {
            // Get request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Define required fields for validation
            $requiredFields = ['school_id'];

            // Validate required fields
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

            $Data = _LM_AlumniStudentsModel()->getAlumniStudentsData($filter);


            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => "Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, ' Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }



    public function getFundDonationListApi(&$requestedData = null)
    {
        // Verify token validity
        if (!$this->checkTokenAPI()) {
            return;
        }

        try {
            // Get request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Define required fields for validation
            $requiredFields = ['alumni_id'];

            // Validate required fields
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
            // Fetch the data

            $Data = _LM_AlumniFundDonationsModel()->getFundDonationData($filter);


            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => "Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, ' Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }



    public function AlumniUpdateProfileApi(&$requestedData = null)
    {
        if (!$this->checkTokenAPI()) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::UNAUTHORIZED, 'Unauthorized access');
        }


        $filter = !empty($requestedData) ? $requestedData : getRequestData();

        $requiredFields = ['alumni_id'];

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

        if (array_key_exists('alumni_id', $filter) && !empty($filter['alumni_id'])) {
            // $alumniId = $filter['alumni_id'];
            $project_code = $filter['software_deployment_project_code'];

            $destinationDir = 'uploads/' . $project_code . '/alumni_students/';
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0777, true);
            }

            // Handle new image from file input
            if (!empty($_FILES['image']['name'])) {
                // Get old image path from DB
                $existingData = _LM_AlumniStudentsModel()->find($filter['alumni_id']);

                $existingImage = $existingData['image'] ?? null;

                if (!empty($_FILES['image']['name'])) {
                    // Delete old image if exists
                    if (!empty($existingImage) && file_exists($existingImage)) {
                        unlink($existingImage);
                    }

                    // Upload new image
                    $imageName = time() . '_' . basename($_FILES['image']['name']);
                    $targetPath = $destinationDir . $imageName;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                        $filter['image'] = $targetPath;
                    } else {
                        return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Image upload failed.');
                    }
                } elseif (!empty($filter['image'])) {
                    // If image name is sent (maybe from frontend as filename string)
                    $filename = $filter['image'];
                    $sourcePath = 'uploads/' . $project_code . '/studentdadmissiondocuments/student_image/' . $filename;
                    $finalPath = $destinationDir . $filename;

                    if (file_exists($sourcePath)) {
                        // Delete old image if exists
                        if (!empty($existingImage) && file_exists($existingImage)) {
                            unlink($existingImage);
                        }

                        copy($sourcePath, $finalPath);
                        $filter['image'] = $finalPath;
                    } else {
                        // Source file not found, fallback to old image
                        $filter['image'] = $existingImage;
                    }
                } else {
                    // No new image sent at all, keep the old one
                    $filter['image'] = $existingImage;
                }
            }

            // Update alumni data
            $updateResult = _LM_AlumniStudentsModel()->update($filter);
            if (is_array($updateResult) && array_key_exists('errors', $updateResult) && !empty($updateResult['errors'])) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Data Update Failed', [], $updateResult['errors']);
            }

            return apiFormatResponse($this->output, ApiResponseStatusCode::CREATED, 'Data Updated Successfully', $updateResult);
        } else {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Invalid alumni ID');
        }
    }


    public function getAlumniEventListApi(&$requestedData = null)
    {
        // Verify token validity
        if (!$this->checkTokenAPI()) {
            return;
        }

        try {
            // Get request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Define required fields for validation
            $requiredFields = ['school_id'];

            // Validate required fields
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
            // Fetch the data
            $Data = _LM_AlumniEventModel()->getAlumniEventData($filter);
            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => "Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, ' Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }


    public function showNewsDetailApi(&$requestedData = null)
    {
        if (!$this->checkTokenAPI()) {
            return;
        }
        try {
            // Check if request data is provided
            if (!empty($requestedData)) {
                $filter = $requestedData;
            } else {
                $filter = getRequestData();
            }

            //Required fields for validation
            $requiredFields = ['school_id'];

            // Validate the required fields
            $errors = $this->checkRequiredFields($filter, $requiredFields, $this->output);
            if (!empty($errors)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, '', [], ['error' => $errors]);
            }


            // Fetch student fee details
            $News_list = _LM_SchoolNewsModel()->newsDataWithFilter($filter);

            // Check if data is found
            if (empty($News_list)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'News Data Not Found', [], ['error' => "News Data Not Found"]);
            }
            // Return the response with fee data
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'News Data Found Successfully', $News_list);
        } catch (Exception $e) {
            // Return the error response if an exception occurs
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }


    public function getAlumniClassmatesListApi(&$requestedData = null)
    {
        // Verify token validity
        if (!$this->checkTokenAPI()) {
            return;
        }

        try {
            // Get request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Define required fields for validation
            $requiredFields = ['school_id', 'passed_out_class_section_id'];

            // Validate required fields
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


            $Data = _LM_AlumniStudentsModel()->getAlumniStudentsData($filter);


            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => "Data Not Found"]);
            }
            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, ' Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }


    public function getAlumniDashboardApi(&$requestedData = null)
    {
        if (!$this->checkTokenAPI()) {
            return;
        }

        try {
            // Get request data
            $filter = !empty($requestedData) ? $requestedData : getRequestData();

            // Required field validation
            $requiredFields = ['alumni_id', 'passed_out_class_section_id'];
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

            // Get total donation amount by alumni
            $donationResult = _LM_AlumniFundDonationsModel()
                ->tableAlias('alumni_fund_donations')
                ->select('SUM(alumni_fund_donations.alumni_fund_donations_amount) AS total_donation')
                ->join('alumni_students as alumni_students', 'alumni_students.alumni_id = alumni_fund_donations.alumni_id', 'left')
                ->where('alumni_students.alumni_id', $filter['alumni_id'])
                ->findAll();

            $totalDonationAmount = (float) ($donationResult[0]['total_donation'] ?? 0);

            // Get total classmates
            $classmateResult = _LM_AlumniStudentsModel()
                ->tableAlias('alumni_students')
                ->select('COUNT(DISTINCT alumni_students.alumni_id) AS total_students')
                ->where('alumni_students.passed_out_class_section_id', $filter['passed_out_class_section_id'])
                ->findAll();

            $totalStudents = (int) ($classmateResult[0]['total_students'] ?? 0);

            // Final API response
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::OK,
                'Data Found Successfully',
                [
                    'total_students' => $totalStudents,
                    'total_donation' => $totalDonationAmount
                ]
            );
        } catch (Exception $e) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                'An error occurred',
                [],
                ['error' => $e->getMessage()]
            );
        }
    }
}
