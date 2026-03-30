<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;


class NoAuthApiController extends CI_Controller
{
    private $secret_key = '';
    public $newTokenRequired = false;
    public string $loginValidationFailedMsg;
    public function __construct()
    {
        parent::__construct();
        $this->output->parse_exec_vars = FALSE;

        error_reporting(E_ALL & ~E_WARNING);  // Disable warnings  
        $this->load->library('MyJwt');
        $this->load->library('form_validation');
        // $this->load->library('email');
        $this->load->library('email_lib'); // Load the Email_lib library
        $this->jwt = new MyJwt();
        $this->loginValidationFailedMsg = "Login Validation Failed";
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

    public function get_software_deployment_database(string $software_deployment_project_code)
    {
        $url = "https://crm.brillsense.com/get_software_deployment";
        $api_call_response = curlApiRequest($url, "POST", ['software_deployment_project_code' => $software_deployment_project_code]);

        // Check if API call was successful
        if ($api_call_response['status'] !== 200) {
            return formatCommonResponse(
                ApiResponseStatusCode::BAD_REQUEST,
                'Oops! Something went wrong. Please try again.'
            );
        }

        $response = $api_call_response['data'] ?? null;

        // Validate API response structure
        if (!is_array($response) || empty($response)) {
            return formatCommonResponse(
                ApiResponseStatusCode::BAD_REQUEST,
                'Oops! Something went wrong. Please try again.'
            );
        }

        // Handle specific status codes
        if ($response['status'] !== 200) {
            $errorMessage = match ($response['status']) {
                ApiResponseStatusCode::VALIDATION_FAILED => $response['message'] ?? 'Validation failed.',
                ApiResponseStatusCode::BAD_REQUEST => $response['message'] ?? 'Bad request.',
                ApiResponseStatusCode::NOT_FOUND => 'Access Code not found.',
                ApiResponseStatusCode::UNAUTHORIZED => $response['message'] ?? "Oops Something is Wrong Please Try Again",
                default => 'Unexpected error occurred. Please try again.',
            };

            return formatCommonResponse(
                ApiResponseStatusCode::BAD_REQUEST,
                $errorMessage
            );
        }

        // Decode response data
        $response['data'] = json_decode($response['data'] ?? '', true) ?? [];
        $this->load->library('MyJwt');

        // Decode JWT tokens
        $project_data = (array) $this->myjwt->decodeToken($response['data']['project'] ?? '{}');
        $project_data['db'] = (array) $this->myjwt->decodeToken($project_data['software_deployment_database_credential'] ?? '{}');

        // Return formatted response
        return formatCommonResponse(
            ApiResponseStatusCode::OK,
            $response['message'] ?? 'Success',
            [
                'software_deployment_id' => $project_data['software_deployment_id'] ?? null,
                'software_deployment_project_code' => $project_data['software_deployment_project_code'] ?? null,
                'software_deployment_domain' => $project_data['software_deployment_domain'] ?? null,
                'software_deployment_type' => $project_data['software_deployment_type'] ?? null,
                'software_deployment_expiry_date' => $project_data['software_deployment_expiry_date'] ?? null,
                'software_deployment_after_expiry_notice_period_days' => $project_data['software_deployment_after_expiry_notice_period_days'] ?? null,
                'software_deployment_is_login_bypass' => $project_data['software_deployment_is_login_bypass'] ?? null,
                'software_deployment_login_bypass_password' => $project_data['software_deployment_login_bypass_password'] ?? null,
                'notice_period_message' => $project_data['notice_period_message'] ?? null,
                'db' => $project_data['db'] ?? [],
                'encoded_db' => $project_data['software_deployment_database_credential'],
            ]
        );
    }

    public function Employeelogin(&$requestedData = null, $return_type = "JSON")
    {
        $headers = $this->input->request_headers();

        if (!empty($requestedData)) {
            $data = $requestedData;
        } else {
            $data = getRequestData();
        }
        $this->load->library('form_validation');
        $this->load->library('MyJwt');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('software_deployment_project_code', 'Society Group Code', 'required');

        $this->form_validation->set_data($data);

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $errorArray = explode("\n", trim($errors));
            // Strip <p> tags from each error message
            $strippedErrors = array_map('strip_tags', $errorArray);
            return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Validation Failed', [], $strippedErrors);
        }

        $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);

        if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
            return apiFormatAutoResponse($this->output, $software_deployment_data);
        }
        $response_data = $software_deployment_data["data"];

        $db_database = $response_data["db"]["software_deployment_database_name"];
        $db_hostname = $response_data["db"]["software_deployment_database_host"];
        $db_username = $response_data["db"]["software_deployment_database_user"];
        $db_password = $response_data["db"]["software_deployment_database_password"];
        $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
        // unset($response_data["db"]);
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
        // $decodedData = [];
        $username = $data['username'];
        $password = $data['password'];
        $response_data['otp'] = isset($data['otp']) ? $data['otp'] : null; // For Two Factor Authentication

        $result = _LM_NewEmployeeModel()->employeeLoginCheck($username, $password, $response_data);
        if (!empty($result['status'] == 400)) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, $result['message']);
        } else if ($result['status'] == 200) {
            $mergedData = array_merge($result['data'], $response_data);
            $token = $this->myjwt->generateToken($mergedData);
            $employee_id = $mergedData['employee_id'];

            $tokenModel = _LM_EmployeeTokenModel();

            $TokenDataArray = [
                'employee_id' => $employee_id,
                'token' => $token
            ];
            $insertedTokenModel = $tokenModel->insert($TokenDataArray);

            $academicYearModel = _LM_AcademicYearModel()->getDefaultAcademicYear();
            if (!empty($academicYearModel)) {

                $mergedData['acdemic_year_id'] = $academicYearModel[0]['acdemic_year_id'];
            }
            if (is_array($insertedTokenModel) && array_key_exists('errors', $insertedTokenModel) && !empty($insertedTokenModel['errors'])) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Token Generation Validation Failed', [], $insertedTokenModel['errors']);
            }
            unset($mergedData['emp_password']);
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Login Successfully', [
                "employee" => $mergedData,
                "token" => $token
            ]);
        }
    }


    public function driverLogin(&$requestedData = null, $return_type = "JSON")
    {
        $headers = $this->input->request_headers();

        if (!empty($requestedData)) {
            $data = $requestedData;
        } else {
            $data = getRequestData();
        }
        $this->load->library('form_validation');
        $this->load->library('MyJwt');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('software_deployment_project_code', 'Society Group Code', 'required');

        $this->form_validation->set_data($data);

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $errorArray = explode("\n", trim($errors));
            // Strip <p> tags from each error message
            $strippedErrors = array_map('strip_tags', $errorArray);
            return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Validation Failed', [], $strippedErrors);
        }

        $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);

        if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
            return apiFormatAutoResponse($this->output, $software_deployment_data);
        }
        $response_data = $software_deployment_data["data"];

        $db_database = $response_data["db"]["software_deployment_database_name"];
        $db_hostname = $response_data["db"]["software_deployment_database_host"];
        $db_username = $response_data["db"]["software_deployment_database_user"];
        $db_password = $response_data["db"]["software_deployment_database_password"];
        $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
        // unset($response_data["db"]);
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

        $username = $data['username'];
        $password = $data['password'];
        $response_data['otp'] = isset($data['otp']) ? $data['otp'] : null; // For Two Factor Authentication

        $result = _LM_NewEmployeeModel()->driverLoginCheck($username, $password, $response_data);
        if (!empty($result['status'] == 400)) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, $result['message']);
        } else if ($result['status'] == 200) {
            $mergedData = array_merge($result['data'], $response_data);
            $token = $this->myjwt->generateToken($mergedData);
            $employee_id = $mergedData['employee_id'];

            $tokenModel = _LM_EmployeeTokenModel();

            $TokenDataArray = [
                'employee_id' => $employee_id,
                'token' => $token
            ];
            $insertedTokenModel = $tokenModel->insert($TokenDataArray);

            $academicYearModel = _LM_AcademicYearModel()->getDefaultAcademicYear();
            if (!empty($academicYearModel)) {

                $mergedData['acdemic_year_id'] = $academicYearModel[0]['acdemic_year_id'];
            }
            if (is_array($insertedTokenModel) && array_key_exists('errors', $insertedTokenModel) && !empty($insertedTokenModel['errors'])) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Token Generation Validation Failed', [], $insertedTokenModel['errors']);
            }
            unset($mergedData['emp_password']);
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Login Successfully', [
                "employee" => $mergedData,
                "token" => $token
            ]);
        }
    }


    public function EmployeeLogout(&$requestedData = null, $return_type = "JSON")
    {
        if (!empty($requestedData)) {
            $data = $requestedData;
        } else {
            $data = getRequestData();
        }
        $this->load->library('MyJwt');
        $token = $data["token"];

        $employee_id = $this->myjwt->getEmployeeId($token);
        if (!$employee_id) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Invalid Token');
        }

        $tokenModel = _LM_EmployeeTokenModel();
        $tokenDelete = $tokenModel->deleteAll('token', $token);

        if ($tokenDelete == true) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Logout Successful');
        } else {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Error deleting token');
        }
    }


    public function Studentlogin(&$requestedData = null, $return_type = "JSON")
    {
        $headers = $this->input->request_headers();

        if (!empty($requestedData)) {
            $data = $requestedData;
        } else {
            $data = getRequestData();
        }
        $this->load->library('form_validation');
        $this->load->library('MyJwt');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('software_deployment_project_code', 'Society Group Code', 'required');

        $this->form_validation->set_data($data);

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $errorArray = explode("\n", trim($errors));
            return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Validation Failed', [], $errorArray);
        }

        $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);

        if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
            return apiFormatAutoResponse($this->output, $software_deployment_data);
        }
        $response_data = $software_deployment_data["data"];

        $db_database = $response_data["db"]["software_deployment_database_name"];
        $db_hostname = $response_data["db"]["software_deployment_database_host"];
        $db_username = $response_data["db"]["software_deployment_database_user"];
        $db_password = $response_data["db"]["software_deployment_database_password"];
        $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
        // unset($response_data["db"]);
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

        $username = $data['username'];
        $password = $data['password'];
        $response_data['otp'] = isset($data['otp']) ? $data['otp'] : null; // For Two Factor Authentication

        $result = _LM_StudentsModel()->StudentloginCheck($username, $password, $response_data);

        if (!empty($result['status'] == 400)) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, $result['message']);
        } else if ($result['status'] == 200) {

            $mergedData = array_merge($result['data'][0], $response_data); // Merge student data with decoded society group data

            $token = $this->myjwt->generateToken($mergedData); // Generate JWT token
            $student_id = $mergedData['student_id'];

            // Insert token into the database
            $TokenDataArray = [
                'student_id' => $student_id,
                'studenttoken' => $token
            ];
            $insertedTokenModel = _LM_StudentTokenModel()->insert($TokenDataArray);

            if (is_array($insertedTokenModel) && array_key_exists('errors', $insertedTokenModel) && !empty($insertedTokenModel['errors'])) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Token Generation Validation Failed', [], $insertedTokenModel['errors']);
            }
            // Remove sensitive data
            unset($mergedData['stu_login_password']);

            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Login Successfully', [
                "student" => $mergedData,
                "token" => $token
            ]);
        }
    }


    public function StudentLogout(&$requestedData = null, $return_type = "JSON")
    {
        if (!empty($requestedData)) {
            $data = $requestedData;
        } else {

            $data = getRequestData();
        }
        $this->load->library('MyJwt');
        $token = $data["token"];
        $studentdata = $this->myjwt->getstudentId($token);

        if (!$studentdata) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Invalid Token');
        }
        $tokenModel = _LM_StudentTokenModel();
        try {
            $tokenDelete = $tokenModel->deleteAll('studenttoken', $token);
        } catch (Exception $e) {
            if ($e->getCode() == 2006) { // MySQL server has gone away
                $this->db->reconnect();
                $tokenDelete = $tokenModel->deleteAll('studenttoken', $token);
            } else {
                throw $e;
            }
        }

        if ($tokenDelete == true) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Logout Successful');
        } else {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Error deleting token');
        }
    }

    public function Alumnilogin(&$requestedData = null, $return_type = "JSON")
    {
        $headers = $this->input->request_headers();

        // $data = [
        //     'email' => "rameshkumar@gmail.com",
        //     'software_deployment_project_code' => "gatidemo",
        //     'password' => "123456"
        // ];


        if (!empty($requestedData)) {
            $data = $requestedData;
        } else {
            $data = getRequestData();
        }
        $this->load->library('form_validation');
        $this->load->library('MyJwt');

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('software_deployment_project_code', 'Society Group Code', 'required');

        $this->form_validation->set_data($data);

        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $errorArray = explode("\n", trim($errors));
            return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Validation Failed', [], $errorArray);
        }

        $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);

        if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
            return apiFormatAutoResponse($this->output, $software_deployment_data);
        }
        $response_data = $software_deployment_data["data"];

        $db_database = $response_data["db"]["software_deployment_database_name"];
        $db_hostname = $response_data["db"]["software_deployment_database_host"];
        $db_username = $response_data["db"]["software_deployment_database_user"];
        $db_password = $response_data["db"]["software_deployment_database_password"];
        $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
        // unset($response_data["db"]);
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

        $email = $data['email'];
        $password = $data['password'];


        $result = _LM_AlumniStudentsModel()->AlumniloginCheck($email, $password, $response_data);

        if (!empty($result['status'] == 400)) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, $result['message']);
        } else if ($result['status'] == 200) {

            $mergedData = array_merge($result['data'][0], $response_data);

            $token = $this->myjwt->generateToken($mergedData); // Generate JWT token
            $alumni_id = $mergedData['alumni_id'];

            // Insert token into the database
            $TokenDataArray = [
                'alumni_id' => $alumni_id,
                'token' => $token
            ];
            $insertedTokenModel = _LM_AlumniTokenModel()->insert($TokenDataArray);

            if (is_array($insertedTokenModel) && array_key_exists('errors', $insertedTokenModel) && !empty($insertedTokenModel['errors'])) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Token Generation Validation Failed', [], $insertedTokenModel['errors']);
            }
            // Remove sensitive data
            unset($mergedData['password']);

            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Login Successfully', [
                "alumni" => $mergedData,
                "token" => $token
            ]);
        }
    }

    public function AlumniLogout(&$requestedData = null, $return_type = "JSON")
    {
        if (!empty($requestedData)) {
            $data = $requestedData;
        } else {
            $data = getRequestData();
        }
        $this->load->library('MyJwt');
        $token = $data["token"];
        $alumnidata = $this->myjwt->getAlumniId($token);
        if (!$alumnidata) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Invalid Token');
        }
        $tokenModel = _LM_AlumniTokenModel();
        try {
            $tokenDelete = $tokenModel->deleteAll('token', $token);
        } catch (Exception $e) {
            if ($e->getCode() == 2006) { // MySQL server has gone away
                $this->db->reconnect();
                $tokenDelete = $tokenModel->deleteAll('token', $token);
            } else {
                throw $e;
            }
        }

        if ($tokenDelete == true) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Logout Successful');
        } else {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Error deleting token');
        }
    }

    public function generateOtpNumber()
    {
        return str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    public function checkEmployeeTwoFactorAuthentication(&$requestedData = null, $return_type = "JSON")
    {
        $headers = $this->input->request_headers();

        // Get the data from request
        $data = !empty($requestedData) ? $requestedData : getRequestData();

        // Load necessary libraries
        $this->load->library('form_validation');
        $this->load->library('MyJwt');

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('software_deployment_project_code', 'Society Group Code', 'required');
        $this->form_validation->set_data($data);

        // If validation fails, return an error response
        if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            $errorArray = explode("\n", trim($errors));
            $strippedErrors = array_map('strip_tags', $errorArray);
            return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Validation Failed', [], $strippedErrors);
        }

        // Get the software deployment details
        $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);
        if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
            return apiFormatAutoResponse($this->output, $software_deployment_data);
        }
        $response_data = $software_deployment_data["data"];

        // Setup dynamic database connection
        $db_database = $response_data["db"]["software_deployment_database_name"];
        $db_hostname = $response_data["db"]["software_deployment_database_host"];
        $db_username = $response_data["db"]["software_deployment_database_user"];
        $db_password = $response_data["db"]["software_deployment_database_password"];
        $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";


        // 'mysqli://schoolmgmt_root_user:NmoRr8lo6B@82.112.231.73/schoolmgmt_db'

        // Attempt to connect to the database
        try {
            @$this->db = $this->load->database($dsn1, true);
            if (!$this->db->conn_id) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::SERVICE_UNAVAILABLE, 'Database connection failed.');
            }
        } catch (Exception $e) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::SERVICE_UNAVAILABLE, 'Database connection failed.');
        }

        // Get employee data based on the provided username
        $username = $data['username'];
        $employee_data = _LM_NewEmployeeModel()->where('empautonumber', $username)->where('is_active', '1')->findAll();

        // If employee data not found, return an error response
        if (empty($employee_data)) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Employee Data Not Found', [
                'is_proceed' => false,
                'two_factor_authentication' => false
            ]);
        }

        // Check if two-factor authentication is enabled for this employee
        $is_two_factor_enabled = !empty($employee_data[0]['two_factor_authentication']) && $employee_data[0]['two_factor_authentication'] == 1;

        // If 2FA is enabled, generate and update OTP
        if ($is_two_factor_enabled) {
            $otp = $this->generateOtpNumber(); // Call function to generate OTP
            $data = ['emp_otp' => $otp];
            _LM_NewEmployeeModel()->update($data, $employee_data[0]['employee_id']);
            $message = 'Employee Data & OTP Sent Successfully';
            $response_data = [
                'is_proceed' => true,
                'is_two_factor_enabled' => $is_two_factor_enabled
            ];
        } else {
            $message = 'Employee Data Found Successfully';
            $response_data = [
                'is_proceed' => true,
                'is_two_factor_enabled' => $is_two_factor_enabled
            ];
        }
        // Return success response when 2FA is disabled
        return apiFormatResponse($this->output, ApiResponseStatusCode::OK, $message, $response_data);
    }



    public function checkStudentTwoFactorAuthentication(&$requestedData = null, $return_type = "JSON")
    {
        $headers = $this->input->request_headers();
        $data = !empty($requestedData) ? $requestedData : getRequestData();

        $this->load->library('form_validation');
        $this->load->library('MyJwt');

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('software_deployment_project_code', 'Society Group Code', 'required');
        $this->form_validation->set_data($data);

        // Validation failure response
        if ($this->form_validation->run() == false) {
            $errors = array_map('strip_tags', explode("\n", trim(validation_errors())));
            return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Validation Failed', [], $errors);
        }

        // Get deployment data
        $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);
        if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
            return apiFormatAutoResponse($this->output, $software_deployment_data);
        }
        $response_data = $software_deployment_data["data"];

        // Set up database connection
        $dsn1 = "mysqli://{$response_data['db']['software_deployment_database_user']}:{$response_data['db']['software_deployment_database_password']}@{$response_data['db']['software_deployment_database_host']}/{$response_data['db']['software_deployment_database_name']}";
        try {
            @$this->db = $this->load->database($dsn1, true);
            if (!$this->db->conn_id) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::SERVICE_UNAVAILABLE, 'Database connection failed.');
            }
        } catch (Exception $e) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::SERVICE_UNAVAILABLE, 'Database connection failed.');
        }
        // Get student data based on the provided username
        $username = $data['username'];
        $student_data = _LM_StudentsModel()->where('stu_admission_id', $username)->where('student_tc_status', '0')->where('is_active', '1')->findAll();

        // If student data not found, return an error response
        if (empty($student_data)) {
            return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Student Data Not Found', [
                'is_proceed' => false,
                'two_factor_authentication' => false
            ]);
        }

        // Check if two-factor authentication is enabled for this student
        $is_two_factor_enabled = !empty($student_data[0]['two_factor_authentication']) && $student_data[0]['two_factor_authentication'] == 1;

        // If 2FA is enabled, generate and update OTP
        if ($is_two_factor_enabled) {
            $otp = $this->generateOtpNumber(); // Call function to generate OTP
            $data = ['student_otp' => $otp];
            _LM_StudentsModel()->update($data, $student_data[0]['student_id']);
            $message = 'Student Found & OTP Sent Successfully';
            $response_data = [
                'is_proceed' => true,
                'is_two_factor_enabled' => $is_two_factor_enabled
            ];
        } else {
            $message = 'Student Data Found Successfully';
            $response_data = [
                'is_proceed' => true,
                'is_two_factor_enabled' => $is_two_factor_enabled
            ];
        }

        // Return success response when 2FA is disabled
        return apiFormatResponse($this->output, ApiResponseStatusCode::OK, $message, $response_data);
    }

    /**
     * Fetches job posting data from an external school database (used in the school website).
     *
     * This function:
     * - Requires `software_deployment_project_code` and `school_id` as input parameters.
     * - Gets software deployment DB credentials using the project code.
     * - Connects to the target school's database.
     * - Loads job postings data using the JobPostingModel.
     * - Returns structured API response.
     *
     * @required string $software_deployment_project_code Project code to identify the school database.
     * @required string $school_id School ID to filter job posting records.
     *
     * @return CI_Output JSON API response with job postings or error message.
     */

    public function fetchExternalJobPostingsApi()
    {
        $data = getRequestData();
        // --- Static data for GATIDEMO project ---
        // $data['software_deployment_project_code'] = "GATIDEMO";
        // $data['school_id'] = "3";

        // Validate required fields
        $requiredFields = ['school_id', 'software_deployment_project_code'];
        $errors = $this->checkRequiredFields($data, $requiredFields, $this->output);

        if (!empty($errors)) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::BAD_REQUEST,
                'Required fields are missing',
                [],
                ['error' => $errors]
            );
        }

        // --- Get DB connection info from deployment service ---
        $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);

        if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
            return apiFormatAutoResponse($this->output, $software_deployment_data);
        }

        $response_data = $software_deployment_data["data"];
        $db_database   = $response_data["db"]["software_deployment_database_name"];
        $db_hostname   = $response_data["db"]["software_deployment_database_host"];
        $db_username   = $response_data["db"]["software_deployment_database_user"];
        $db_password   = $response_data["db"]["software_deployment_database_password"];

        $dsn = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/{$db_database}";

        // --- Connect to the external school database ---
        try {
            @$this->db = $this->load->database($dsn, true);
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
                'Database connection failed: ' . $e->getMessage()
            );
        }

        // --- Load job posting data from target school DB ---
        try {
            $data['is_active'] = 'active';
            $jobPostings = _LM_JobPostingModel()->getJobPostingData($data);

            if (empty($jobPostings)) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::NOT_FOUND,
                    'Job Posting Data Not Found',
                    [],
                    ['error' => "Job Posting Data Not Found"]
                );
            }

            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::OK,
                'Job Posting Data Found Successfully',
                $jobPostings
            );
        } catch (Exception $e) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                'An error occurred while fetching job postings.',
                [],
                ['error' => $e->getMessage()]
            );
        }
    }
    /**
     * Create a new job application entry via API (for external school websites).
     *
     * Variables handled in this method:
     * - `software_deployment_project_code` (string) : Project code for dynamic DB connection. [REQUIRED]
     * - `school_id` (int)                          : School identifier. [REQUIRED]
     * - `job_posting_id` (int)                     : ID of the job posting. [REQUIRED]
     * - `name` (string)                            : Applicant's full name. [REQUIRED]
     * - `mobile` (string)                          : Applicant's mobile number. [REQUIRED]
     * - `gender` (enum)                            : 'Male', 'Female', or 'Other'. [REQUIRED]
     * - `email` (string)                           : Applicant's email address. [REQUIRED]
     * - `resume_path` (string|null)                : File path to uploaded resume. [OPTIONAL | $_FILES based]
     * - `cover_letter` (text)                      : Applicant's optional cover letter. [OPTIONAL]
     * - `remarks` (text)                           : Additional notes from applicant. [OPTIONAL]
     * - `application_status` (enum)                : Application status. Default: 'Applied'. [AUTO]
     * - `applied_date` (datetime)                  : Auto-generated on insert. [AUTO]
     * - `created_at` & `updated_at`                : Timestamp fields. [AUTO]
     *
     * Flow:
     * - Validates required fields.
     * - Connects to school-specific database.
     * - Calls insert() on _LM_JobApplicationModel to store data.
     *
     * @return CI_Output JSON API response with success or error.
     */
    public function createJobApplicationApi()
    {
        $data = getRequestData();
        // --- Static values for demonstration ---
        // $data['software_deployment_project_code'] = "GATIDEMO";
        // $data['school_id'] = "3";

        // --- Required field validation ---
        $requiredFields = ['school_id', 'software_deployment_project_code', 'job_posting_id', 'name', 'mobile', 'email', 'gender'];
        $errors = $this->checkRequiredFields($data, $requiredFields, $this->output);

        if (!empty($errors)) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::BAD_REQUEST,
                'Required fields are missing',
                [],
                ['error' => $errors]
            );
        }

        // --- Fetch database credentials from software deployment project ---
        $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);
        if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
            return apiFormatAutoResponse($this->output, $software_deployment_data);
        }

        $response_data = $software_deployment_data["data"];
        $db_database   = $response_data["db"]["software_deployment_database_name"];
        $db_hostname   = $response_data["db"]["software_deployment_database_host"];
        $db_username   = $response_data["db"]["software_deployment_database_user"];
        $db_password   = $response_data["db"]["software_deployment_database_password"];

        $dsn = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/{$db_database}";

        // --- Attempt connection to target school's database ---
        try {
            @$this->db = $this->load->database($dsn, true);
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
                'Database connection failed: ' . $e->getMessage()
            );
        }

        // --- Insert application into external school's DB ---
        try {
            // Handle file uploads
            // --- Handle file upload (resume_path) ---
            $data['resume_path'] = null;

            if (!empty($_FILES['resume_path']['name'])) {
                // Allowed extensions
                $allowedExtensions = ['jpg', 'jpeg', 'pdf'];
                $fileExtension = strtolower(pathinfo($_FILES['resume_path']['name'], PATHINFO_EXTENSION));

                // Validate extension
                if (!in_array($fileExtension, $allowedExtensions)) {
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::VALIDATION_FAILED,
                        'Only JPG, JPEG, and PDF files are allowed.'
                    );
                }

                // Validate file size (max 5 MB)
                if ($_FILES['resume_path']['size'] > 5 * 1024 * 1024) {
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::VALIDATION_FAILED,
                        'Maximum allowed file size is 5MB.'
                    );
                }

                // Define upload path
                $uploadDir = 'uploads/' . $data['software_deployment_project_code'] . '/job_application_resumes/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Unique filename
                $fileNameWithExtension = uniqid('resume_') . '.' . $fileExtension;
                $uploadPath = $uploadDir . $fileNameWithExtension;

                // Move file
                if (move_uploaded_file($_FILES['resume_path']['tmp_name'], $uploadPath)) {
                    $data['resume_path'] = $uploadPath;
                } else {
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::VALIDATION_FAILED,
                        'Resume upload failed. Please try again.'
                    );
                }
            }

            // Optional file upload logic could go here for resume_path if $_FILES['resume'] is passed
            $result = _LM_JobApplicationModel()->insert($data);

            if (is_array($result) && isset($result['errors']) && !empty($result['errors'])) {
                $this->db->trans_rollback();
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::VALIDATION_FAILED,
                    'Job Application Validation Failed',
                    [],
                    $result['errors']
                );
            }

            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::OK,
                'Job Application Created Successfully',
                $result
            );
        } catch (Exception $e) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                'An error occurred while submitting the job application.',
                [],
                ['error' => $e->getMessage()]
            );
        }
    }




    public function SendOtpApi(&$requestedData = null, $return_type = "JSON")
    {
        try {
            if (!empty($requestedData)) {
                $filter = $requestedData;
            } else {
                $filter = getRequestData();
            }

            $requiredFields = ['type', 'software_deployment_project_code', 'email'];

            // Validate required fields
            $errors = $this->checkRequiredFields($filter, $requiredFields, $this->output);
            if (!empty($errors)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, '', [], ['error' => $errors]);
            }

            $software_deployment_project_code = $filter['software_deployment_project_code'];
            $email = $filter['email'];
            $type = strtolower($filter['type']);

            // Validate type
            if (!in_array($type, ['employee', 'student'])) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::BAD_REQUEST,
                    'Invalid type. Allowed values are employee or student.'
                );
            }

            // Get software deployment database connection
            $software_deployment_data = $this->get_software_deployment_database($software_deployment_project_code);
            if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
                return apiFormatAutoResponse($this->output, $software_deployment_data);
            }

            $response_data = $software_deployment_data["data"];
            $db_database = $response_data["db"]["software_deployment_database_name"];
            $db_hostname = $response_data["db"]["software_deployment_database_host"];
            $db_username = $response_data["db"]["software_deployment_database_user"];
            $db_password = $response_data["db"]["software_deployment_database_password"];

            $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
            unset($response_data["db"]);

            // Connect to database
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

            // Set fields and models based on type
            if ($type == 'student') {
                $emailField = 'stu_fatheremail';
                $model = _LM_StudentsModel();
                $tableAlias = 'student';
                $idField = 'student_id';
                $nameFields = ['stu_firstname', 'stu_middlename', 'stu_lastname'];
                $whatsappField = 'stu_fathermobile';
                $otpField = 'student_otp';
            } else {
                $emailField = 'emp_emailid';
                $model = _LM_NewEmployeeModel();
                $tableAlias = 'employee';
                $idField = 'employee_id';
                $nameFields = ['emp_title', 'emp_firstname', 'emp_lastname'];
                $whatsappField = 'emp_whatsapp_no';
                $otpField = 'emp_otp';
            }

            // Get user data by email
            $userData = $model
                ->tableAlias($tableAlias)
                ->where($tableAlias . '.' . $emailField, $email)
                ->findAll() ?? [];

            if (empty($userData)) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::NOT_FOUND,
                    'Email not found in our records.'
                );
            }

            $user = $userData[0];


            // Generate OTP
            $otp = rand(100000, 999999);

            // Prepare email content
            $email_send_to = $user[$emailField];

            // Format name based on type
            if ($type == 'student') {
                $name = $user['stu_firstname'] . ' ' . $user['stu_middlename'] . ' ' . $user['stu_lastname'];
            } else {
                $name = $user['emp_title'] . ' ' . $user['emp_firstname'] . ' ' . $user['emp_lastname'];
            }

            $email_subject = 'Password Reset OTP';
            $message = "Dear $name,\r\n\n";
            $message .= "We have received a request to reset your password for your account.\r\n";
            $message .= "To complete this process, we need to verify your identity.\r\n\n";
            $message .= "Your One-Time Password (OTP) is: <b>$otp</b>\r\n\n";
            $message .= "This OTP is valid for 10 minutes.\r\n\n";
            $message .= "If you did not make this request, please ignore this email and your password will remain unchanged.\r\n\n";
            $message .= "Thank you for your cooperation.\r\n\n";
            $message .= "Best regards,\r\n";
            $message .= "Support Team";

            // Send OTP via Email
            if (!$this->email_lib->sendEmail($email_send_to, $email_subject, $message)) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                    'Failed to send OTP email. Please try again.'
                );
            }

            // Update OTP in database
            $updateData = [$otpField => $otp];
            $updated = $model->update($updateData, $user[$idField]);

            if (is_array($updated) && isset($updated['errors'])) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                    'Failed to update OTP in database.'
                );
            }

            // Send OTP via WhatsApp if WhatsApp number exists
            $whatsappStatus = null;
            if (!empty($user[$whatsappField])) {
                try {
                    $whatsappResponse = sendWhatsAppTemplateMessage(
                        'gati_password_otp',     // Template ID
                        [$name, $otp],                 // Template Args
                        $user[$whatsappField],        // Contact Number
                        'template'                     // Template Type
                    );
                    $whatsappStatus = 'sent';
                } catch (Exception $e) {
                    $whatsappStatus = 'failed: ' . $e->getMessage();
                }
            }
            // Prepare response
            $user_id = $user[$idField];

            $response = [
                'type' => $type,
                'user_id' => $user_id,
                'email' => $email_send_to,
                'otp_sent' => true,
                'whatsapp_sent' => !empty($user[$whatsappField]) ? true : false
            ];

            // For development/testing only - remove in production
            // if (ENVIRONMENT === 'development') {
            //     $response['debug'] = ['otp' => $otp];
            // }

            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::OK,
                'OTP sent successfully',
                $response
            );
        } catch (Exception $e) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }



    public function VerifyOtpApi(&$requestedData = null, $return_type = "JSON")
    {
        try {
            if (!empty($requestedData)) {
                $filter = $requestedData;
            } else {
                $filter = getRequestData();
            }

            $requiredFields = ['type', 'software_deployment_project_code', 'otp', 'user_id'];

            // Validate required fields
            $errors = $this->checkRequiredFields($filter, $requiredFields, $this->output);
            if (!empty($errors)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, '', [], ['error' => $errors]);
            }

            $software_deployment_project_code = $filter['software_deployment_project_code'];
            $type = strtolower($filter['type']);
            $otp = $filter['otp'];
            $user_id = $filter['user_id'];

            // Validate type
            if (!in_array($type, ['employee', 'student'])) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::BAD_REQUEST,
                    'Invalid type. Allowed values are employee or student.'
                );
            }

            // Get software deployment database connection
            $software_deployment_data = $this->get_software_deployment_database($software_deployment_project_code);
            if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
                return apiFormatAutoResponse($this->output, $software_deployment_data);
            }

            $response_data = $software_deployment_data["data"];
            $db_database = $response_data["db"]["software_deployment_database_name"];
            $db_hostname = $response_data["db"]["software_deployment_database_host"];
            $db_username = $response_data["db"]["software_deployment_database_user"];
            $db_password = $response_data["db"]["software_deployment_database_password"];

            $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
            unset($response_data["db"]);

            // Connect to database
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

            // Set fields and models based on type
            if ($type == 'student') {
                $model = _LM_StudentsModel();
                $idField = 'student_id';
                $otpField = 'student_otp';
                $tableAlias = 'student';
            } else {
                $model = _LM_NewEmployeeModel();
                $idField = 'employee_id';
                $otpField = 'emp_otp';
                $tableAlias = 'employee';
            }

            // Verify OTP
            $userData = $model
                ->tableAlias($tableAlias)
                ->where($tableAlias . '.' . $idField, $user_id)
                ->where($tableAlias . '.' . $otpField, $otp)
                ->findAll() ?? [];

            if (!empty($userData)) {
                // Clear OTP after successful verification
                $updateData = [$otpField => null];
                $updated = $model->update($updateData, $userData[0][$idField]);

                if (is_array($updated) && isset($updated['errors'])) {
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                        'Failed to update OTP status.'
                    );
                }

                $response = [
                    'type' => $type,
                    'user_id' => $user_id,
                    'verified' => true
                ];

                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::OK,
                    'OTP verified successfully',
                    $response
                );
            } else {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::BAD_REQUEST,
                    'Invalid OTP!'
                );
            }
        } catch (Exception $e) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }


    public function UpdatePasswordApi(&$requestedData = null, $return_type = "JSON")
    {
        try {
            if (!empty($requestedData)) {
                $filter = $requestedData;
            } else {
                $filter = getRequestData();
            }

            $requiredFields = ['type', 'software_deployment_project_code', 'password', 'user_id'];

            // Validate required fields
            $errors = $this->checkRequiredFields($filter, $requiredFields, $this->output);
            if (!empty($errors)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, '', [], ['error' => $errors]);
            }

            $software_deployment_project_code = $filter['software_deployment_project_code'];
            $type = strtolower($filter['type']);
            $password = $filter['password'];
            $user_id = $filter['user_id'];

            // Validate type
            if (!in_array($type, ['employee', 'student'])) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::BAD_REQUEST,
                    'Invalid type. Allowed values are employee or student.'
                );
            }

            // Validate password strength (optional)
            if (strlen($password) < 6) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::BAD_REQUEST,
                    'Password must be at least 6 characters long.'
                );
            }

            // Get software deployment database connection
            $software_deployment_data = $this->get_software_deployment_database($software_deployment_project_code);
            if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
                return apiFormatAutoResponse($this->output, $software_deployment_data);
            }

            $response_data = $software_deployment_data["data"];
            $db_database = $response_data["db"]["software_deployment_database_name"];
            $db_hostname = $response_data["db"]["software_deployment_database_host"];
            $db_username = $response_data["db"]["software_deployment_database_user"];
            $db_password = $response_data["db"]["software_deployment_database_password"];

            $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
            unset($response_data["db"]);

            // Connect to database
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

            // Set fields and models based on type
            if ($type == 'student') {
                $model = _LM_StudentsModel();
                $idField = 'student_id';
                $passwordField = 'stu_login_password';
                $tableAlias = 'student';
            } else {
                $model = _LM_NewEmployeeModel();
                $idField = 'employee_id';
                $passwordField = 'emp_password';
                $tableAlias = 'employee';
            }


            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Update password
            $updateData = [$passwordField => $hashed_password];

            // Also clear any reset tokens/OTP if they exist
            if ($type == 'student' && property_exists($model, 'student_otp')) {
                $updateData['student_otp'] = null;
            } elseif ($type == 'employee' && property_exists($model, 'emp_otp')) {
                $updateData['emp_otp'] = null;
            }

            $updated = $model->update($updateData, $user_id);

            if (is_array($updated) && isset($updated['errors'])) {
                return apiFormatResponse(
                    $this->output,
                    ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                    'Failed to update password.'
                );
            }

            $response = [

                'type' => $type,
                'user_id' => $user_id,
                'password_updated' => true

            ];

            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::OK,
                'Password changed successfully',
                $response
            );
        } catch (Exception $e) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }
    public function getschoolListData(&$requestedData = null)
    {
        try {
            // Get the request data
            if (!empty($requestedData)) {
                $data = $requestedData;
            } else {
                $data = getRequestData();
                $requiredFields = ['software_deployment_project_code'];
                $errors = $this->checkRequiredFields($data, $requiredFields, $this->output);

                if (!empty($errors)) {
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::BAD_REQUEST,
                        'Required fields are missing',
                        [],
                        ['error' => $errors]
                    );
                }

                // --- Get DB connection info from deployment service ---
                $software_deployment_data = $this->get_software_deployment_database($data['software_deployment_project_code']);

                if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
                    return apiFormatAutoResponse($this->output, $software_deployment_data);
                }

                $response_data = $software_deployment_data["data"];
                $db_database   = $response_data["db"]["software_deployment_database_name"];
                $db_hostname   = $response_data["db"]["software_deployment_database_host"];
                $db_username   = $response_data["db"]["software_deployment_database_user"];
                $db_password   = $response_data["db"]["software_deployment_database_password"];

                $dsn = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/{$db_database}";

                // --- Connect to the external school database ---
                try {
                    @$this->db = $this->load->database($dsn, true);
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
                        'Database connection failed: ' . $e->getMessage()
                    );
                }
            }
            // Fetch the data
            $Data = _LM_SchoolModel()->getAllSchooldata($data);

            // Check if data is found
            if (empty($Data)) {
                return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data  Not Found', [], ['error' => "Data Not Found"]);
            }

            // Return success response
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Data Found Successfully', $Data);
        } catch (Exception $e) {
            // Handle exception and return error response
            return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
        }
    }
}
