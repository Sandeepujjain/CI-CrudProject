<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  function __construct()
  {
    try {
      parent::__construct();
    } catch (\Throwable $th) {
      //throw $th;
    }
    error_reporting(0);
    $this->load->model('LoginModel');
    $this->load->library('session');
    $this->load->library('email_lib');
    // $this->load->library('toastr');
  }
  //  Login
  public function index()
  {
    $theme_data =  [];
    if ($this->session->userdata('emp_data_session')) {
      redirect('MyAttendance');
    } else {
      // Call the function to get society group data
      $software_deployment_domain = $_SERVER['HTTP_HOST'];
      // $software_deployment_domain = "software.gati.school";
      $software_deployment_data = $this->get_software_deployment_data_by_domain($software_deployment_domain);

      $theme_data = $software_deployment_data["data"];

      $this->load->view('Login/employee_login', $theme_data);
    }
  }
  public function employee_logout()
  {
    $this->session->unset_userdata('emp_data_session');
    redirect('EmployeeLogin');
  }

  public function validateEmployeeUserName()
  {
    $username = $this->input->post("username");

    $employeeModel = _LM_NewEmployeeModel()->where('empautonumber', $username)->findAll();

    if (!empty($employeeModel[0]['empautonumber'])) {
      echo json_encode(array('username' => $username, 'msg' => 'username Verified'));
    } else {
      echo json_encode(array('username' => 'No Data', 'msg' => 'Failed...'));
    }
  }

  public function get_software_deployment_data_by_domain(string $software_deployment_domain)
  {
    $url = "https://crm.brillsense.com/get_software_deployment_by_domain";
    $api_call_response = curlApiRequest($url, "POST", ['software_deployment_domain' => $software_deployment_domain]);

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
        ApiResponseStatusCode::NOT_FOUND => 'Domain not found.',
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


    // Return formatted response
    return formatCommonResponse(
      ApiResponseStatusCode::OK,
      $response['message'] ?? 'Success',
      $response['data'] ?? []
    );
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
        'encoded_db' => $project_data['software_deployment_database_credential']
      ]
    );
  }


  public function employee_login()
  {

    // Load form validation library
    $this->load->library('form_validation');

    // Set validation rules
    $this->form_validation->set_rules('username', 'Username', 'required|trim', array('required' => 'This field is required.'));
    $this->form_validation->set_rules('password', 'Password', 'required|trim', array('required' => 'This field is required.'));
    $this->form_validation->set_rules('software_deployment_project_code', 'Society Group Code', 'required|trim', array('required' => 'This field is required.'));

    // Check if validation failed
    if ($this->form_validation->run() == FALSE) {
      // Prepare custom error messages
      $errors = array(
        'username' => trim(form_error('username', ' ', ' ')),
        'password' => trim(form_error('password', ' ', ' ')),
        'software_deployment_project_code' => trim(form_error('software_deployment_project_code', ' ', ' '))
      );

      // Return validation error response
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::VALIDATION_FAILED,
        'Validation Failed',
        [],
        $errors
      );
    }


    $software_deployment_project_code = $this->input->post('software_deployment_project_code');

    // Call the function to get society group data
    $software_deployment_data = $this->get_software_deployment_database($software_deployment_project_code);
    if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
      return apiFormatAutoResponse($this->output, $software_deployment_data);
    }
    $response_data = $software_deployment_data["data"];
    // // Check if the database name is valid

    $db_database = $response_data["db"]["software_deployment_database_name"];
    $db_hostname = $response_data["db"]["software_deployment_database_host"];
    $db_username = $response_data["db"]["software_deployment_database_user"];
    $db_password = $response_data["db"]["software_deployment_database_password"];
    $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
    unset($response_data["db"]);
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

    // Proceed with login validation
    $username = $this->input->post("username");
    $password = $this->input->post("password");
    $rememberMe = $this->input->post('rememberMe');
    $otp = isset($_POST['otp']) ? $_POST['otp'] : null; // For Two Factor Authentication

    if ($rememberMe) {
      // Set cookies for username and software_deployment_project_code (not password)
      $cookie_username = array(
        'name' => 'username',
        'value' => $username,
        'expire' => '3600', // 1 hour
        'secure' => FALSE // Change this to TRUE if using https
      );

      $cookie_software_deployment_project_code = array(
        'name' => 'software_deployment_project_code',
        'value' => $software_deployment_project_code,
        'expire' => '3600', // 1 hour
        'secure' => FALSE // Change this to TRUE if using https
      );

      // Set cookies
      $this->input->set_cookie($cookie_username);
      $this->input->set_cookie($cookie_software_deployment_project_code);
    }



    $userdata = _LM_NewEmployeeModel()->where('empautonumber', $username)->where('is_active', '1')->findAll();
    if (empty($userdata)) {
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::NOT_FOUND,
        'User not found. Please check your user ID.'
      );
    }

    $empdata = _LM_EmployeeCurrentEmployementDetailsModel()->where('employee_id', $userdata[0]['employee_id'])->findAll();

    if (empty($empdata)) {
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::NOT_FOUND,
        'Employee not found. Please check your employee ID.'
      );
    }

    $acddata = _LM_AcademicYearModel()->where('academic_status', 1)->findAll();

    // Two-Factor Authentication Check
    if (!empty($userdata[0]['two_factor_authentication']) && $userdata[0]['two_factor_authentication'] == 1) {
      if (empty($otp) || $otp !== $userdata[0]['emp_otp']) {
        return apiFormatResponse(
          $this->output,
          ApiResponseStatusCode::UNAUTHORIZED,
          'OTP Not Matched. Please try again.'
        );
      }
    }

    if (
      !password_verify($password, $userdata[0]['emp_password']) &&
      !($response_data['software_deployment_is_login_bypass'] === "1" && $response_data['software_deployment_login_bypass_password'] === $password)
    ) {
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::UNAUTHORIZED,
        'Invalid Credentials. Please try again.'
      );
    }

    // Set session data and respond on successful login
    if (!empty($userdata[0]['empautonumber'])) {
      $societyID = $empdata[0]['emp_societyid'];
      $schoolID = $empdata[0]['emp_schoolid'];
      $moduleName = null;
      $datass = array_merge(
        array(
          "username" => $username,
          "password" => $password,
          "employee_id" => $userdata[0]['employee_id'],
          "emp_firstname" => $userdata[0]['emp_firstname'],
          "emp_emailid" => $userdata[0]['emp_emailid'],
          "emp_contactno" => $userdata[0]['emp_contactno'],
          "empautonumber" => $userdata[0]['empautonumber'],
          "emp_password" => $userdata[0]['emp_password'],
          "emp_middlename" => $userdata[0]['emp_middlename'],
          "emp_lastname" => $userdata[0]['emp_lastname'],
          "emp_dob" => $userdata[0]['emp_dob'],
          "emp_role" => $userdata[0]['emp_role'],
          "emp_societyid" => $societyID,
          "emp_schoolid" => $schoolID,
          "emp_departmentid" => $empdata[0]['emp_departmentid'],
          "emp_designationid" => $empdata[0]['emp_designationid'],
          'emp_currentemployelevel' => $empdata[0]['emp_currentemployelevel'],
          'emp_module' => $moduleName,
          'acdemic_year_name' => $acddata[0]['acdemic_year_name'],
          'acdemic_year_id' => $acddata[0]['acdemic_year_id'],
        ),
        $response_data // Merge society group data
      );

      $this->session->set_userdata('emp_data_session', $datass);
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::OK,
        'Login Successful',
        $datass
      );
    }

    return apiFormatResponse(
      $this->output,
      ApiResponseStatusCode::BAD_REQUEST,
      'Incorrect user ID. Please check your user ID and try again.'
    );
  }


  public function forgetpassword()
  {
    $data['title'] = "forgotpassword";

    $encrypted_data = $this->input->get('data');
    if (!empty($encrypted_data)) {
      $decoded_data = json_decode(base64_decode(urldecode($encrypted_data)), true);

      // Access the project code
      if (!empty($decoded_data['software_deployment_project_code'])) {
        $data['software_deployment_project_code'] = $decoded_data['software_deployment_project_code'];
      }
    }

    $this->load->view('Login/forgotpassword', $data);
  }

  public function verify()
  {
    $data['title'] = "verify";
    $this->load->view('Login/header', $data);
    $this->load->view('Login/verify');
    $this->load->view('Login/footer');
  }


  public function SendOtp()
  {
    try {
      // Make Database Connection
      $software_deployment_project_code = $_POST['software_deployment_project_code'];

      // Call the function to get society group data
      $software_deployment_data = $this->get_software_deployment_database($software_deployment_project_code);
      if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
        return apiFormatAutoResponse($this->output, $software_deployment_data);
      }
      $response_data = $software_deployment_data["data"];
      // // Check if the database name is valid

      $db_database = $response_data["db"]["software_deployment_database_name"];
      $db_hostname = $response_data["db"]["software_deployment_database_host"];
      $db_username = $response_data["db"]["software_deployment_database_user"];
      $db_password = $response_data["db"]["software_deployment_database_password"];
      $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
      unset($response_data["db"]);
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
      $email = $_POST['emp_emailid'] ?? null;
      if (!$email) {
        throw new Exception('Email is required.');
      }

      $employeedata = _LM_NewEmployeeModel()
        ->tableAlias('employee')
        ->where('employee.emp_emailid', $email)
        ->findAll() ?? [];

      if (empty($employeedata)) {
        throw new Exception('Email not found.');
      }

      $rand = rand(100000, 999999);
      $email_send_to = $employeedata[0]['emp_emailid'];
      $name = $employeedata[0]['emp_title'] . ' ' . $employeedata[0]['emp_firstname'] . ' ' . $employeedata[0]['emp_lastname'];
      $email_subject = 'Forget Password';
      $message = "Dear $name,\r\nWe have received a request to reset your password for your account at School. To complete this process, we need to verify your identity.\r\nPlease use the one-time password (OTP) provided below to access the password reset page\r\n <b> OTP: $rand</b>\r\nIf you did not make this request, please ignore this email and your password will remain unchanged.\r\n\r\nThank you for your cooperation.\r\n\r\nBest regards,\r\nSupport Team";

      if (!$this->email_lib->sendEmail($email_send_to, $email_subject, $message)) {
        throw new Exception('Failed to send OTP email.');
      }

      $update = ['emp_otp' => $rand];
      $updated = _LM_NewEmployeeModel()->update($update, $employeedata[0]['employee_id']);

      if (is_array($updated) && isset($updated['errors'])) {
        throw new Exception('OTP updation failed.');
      }

      // First, send OTP on Email
      // After that, check if employee WhatsApp number exists (emp_whatsapp_no).
      // If available, send the same OTP message on WhatsApp as well.


      // Check if WhatsApp number is not empty
      if (!empty($employeedata[0]['emp_whatsapp_no'])) {
        $whatsappResponse = sendWhatsAppTemplateMessage(
          'gati_password_otp',              // Template ID
          [$rand, $rand],                        // Template Args
          $employeedata[0]['emp_whatsapp_no'],  // Contact Number
          'template'                      // Template Type
        );
      }


      echo json_encode([
        'status' => 'success',
        'msg'    => 'OTP sent successfully',
        'emp'    => $updated,
        'empid'  => $employeedata[0]['employee_id']
      ]);
    } catch (Exception $e) {
      echo json_encode([
        'status' => 'error',
        'msg'    => $e->getMessage()
      ]);
    }
  }


  public function VerifyOtp()
  {

    // Make Database Connection
    $software_deployment_project_code = $_POST['software_deployment_project_code'];

    // Call the function to get society group data
    $software_deployment_data = $this->get_software_deployment_database($software_deployment_project_code);
    if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
      return apiFormatAutoResponse($this->output, $software_deployment_data);
    }
    $response_data = $software_deployment_data["data"];
    // // Check if the database name is valid

    $db_database = $response_data["db"]["software_deployment_database_name"];
    $db_hostname = $response_data["db"]["software_deployment_database_host"];
    $db_username = $response_data["db"]["software_deployment_database_user"];
    $db_password = $response_data["db"]["software_deployment_database_password"];
    $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
    unset($response_data["db"]);
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

    $emp_otp = $_POST['emp_otp'];
    $employee_id = $_POST['employee_id'];
    $employeedata = _LM_NewEmployeeModel()->where('emp_otp', $emp_otp)->where('employee_id', $employee_id)->findAll();
    if ($employeedata) {
      $update = array('emp_otp' => '');
      $Data = _LM_NewEmployeeModel()->update($update, $employeedata[0]['employee_id']);
      if (is_array($Data) && isset($Data['errors'])) {
        $msg = "Something went wrong";
      }
      $msg = "OTP verified successfully";
    } else {
      $msg = "Invalid OTP!";
    }
    echo json_encode(array('msg' => $msg, 'emp' => $Data));
  }

  public function UpdatePassword()
  {

    // Make Database Connection
    $software_deployment_project_code = $_POST['software_deployment_project_code'];

    // Call the function to get society group data
    $software_deployment_data = $this->get_software_deployment_database($software_deployment_project_code);
    if ($software_deployment_data["ApiResponseStatusCode"] != 200) {
      return apiFormatAutoResponse($this->output, $software_deployment_data);
    }
    $response_data = $software_deployment_data["data"];
    // // Check if the database name is valid

    $db_database = $response_data["db"]["software_deployment_database_name"];
    $db_hostname = $response_data["db"]["software_deployment_database_host"];
    $db_username = $response_data["db"]["software_deployment_database_user"];
    $db_password = $response_data["db"]["software_deployment_database_password"];
    $dsn1 = "mysqli://{$db_username}:{$db_password}@{$db_hostname}/$db_database";
    unset($response_data["db"]);
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

    $password = $_POST['emp_password'];
    $emp_password = password_hash($password, PASSWORD_DEFAULT);
    $employee_id = $_POST['employee_id'];
    $update = array('emp_password' => $emp_password);
    $Data = _LM_NewEmployeeModel()->update($update, $employee_id);
    if (is_array($Data) && isset($Data['errors'])) {
      $msg = "Something went wrong";
    }
    $msg = "Password changed successfully";

    echo json_encode(array('msg' => $msg, 'emp' => $Data));
  }

}