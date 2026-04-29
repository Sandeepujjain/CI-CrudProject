<?php

defined('BASEPATH') or exit('No direct script access allowed');


// namespace App\Controllers;

// use App\Controllers\BaseController;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;

class FirebaseController extends CI_Controller
{
    public $response = [];
    protected $integration_data_array = [];
    protected $service_account_credentials;
    protected $acces_tokken;
    protected $firebase_message_send_url;
    protected $headers = [];
    public $is_active = false;
    protected $classRefrence;
    protected $session_required;


    public $notification_title;
    public $notification_body;
    public $notification_image;
    public $notification_web_url;
    public $notification_app_url;



    public function __construct($session_required = true, $classRefrence = null)
    {
        $this->classRefrence = $classRefrence;
        if ($session_required) {
            parent::__construct();
            $this->load->library('session');
            $this->load->library('session_validation');
            $this->load->library('form_validation');
        } else {
            $classRefrence->load->library('form_validation');
        }
        $this->is_active = true;
        $this->firm_logo_url = 'assets/images/logo.svg';
        $this->notification_image = 'assets/images/logo.svg';
        $this->notification_web_url = 'Notification/Notificationlist'; // Default web URL for 
        // $this->notification_app_url = "";notifications
        $this->notification_app_url = 'notification'; // Default app URL for notifications
    }

    public function validateIntegrationFields($classRefrence = null)
    {
        // $validation = Services::validation();
        $classRefrence = ($classRefrence == null) ? $this : $classRefrence;
        // Reset validation before setting new rules
        $classRefrence->form_validation->reset_validation();
        $classRefrence->form_validation->set_data($this->integration_data_array);
        $classRefrence->form_validation->set_rules('firebase_project_number', 'firebase_project_number', 'required');
        $classRefrence->form_validation->set_rules('firebase_web_api_key', 'firebase_web_api_key', 'required');
        $classRefrence->form_validation->set_rules('firebase_app_id', 'firebase_app_id', 'required');
        $classRefrence->form_validation->set_rules('firebase_config', 'firebase_config', 'required');
        $classRefrence->form_validation->set_rules('firebase_sender_id', 'firebase_sender_id', 'required');
        $classRefrence->form_validation->set_rules('firebase_web_push_certificate_key_pair', 'firebase_web_push_certificate_key_pair', 'required');
        $classRefrence->form_validation->set_rules('firebase_web_push_certificate_private_key', 'firebase_web_push_certificate_private_key', 'required');
        $classRefrence->form_validation->set_rules('firebase_service_account_private_key', 'firebase_service_account_private_key', 'required');

        if ($classRefrence->form_validation->run() == FALSE) {
            // If validation fails, return a response with errors
            $this->response = [
                'status' => 422,
                'message' => 'Firebase Messaging Intregation Validation Failed',
                'errors' => $this->form_validation->error_array(),
            ];
        } else {
            $this->response = [
                'status' => 200,
                'message' => 'Firebase Messaging Intregation Validation Success',
            ];
        }
    }

    public function initializeFirebaseIntegration()
    {
        // $firebase_credentials = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('firebase');



        if (empty($firebase_credentials['third_party_integration_is_active'])) {
            $this->response = formatCommonResponse(ApiResponseStatusCode::BAD_REQUEST, 'Firebase Integration Not Found');
            $this->is_active = false;
            return false;
        }

        $thirdPartyIntegrationData = !empty($firebase_credentials['third_party_integration_is_production']) && $firebase_credentials['third_party_integration_is_production'] == 1
            ? $firebase_credentials['third_party_integration_production_data']
            : $firebase_credentials['third_party_integration_testing_data'];

        if (
            empty($thirdPartyIntegrationData) ||
            !is_array($thirdPartyIntegrationData) ||
            empty($thirdPartyIntegrationData['firebase_project_number'])
        ) {

            $environment = !empty($firebase_credentials['third_party_integration_is_production']) &&
                $firebase_credentials['third_party_integration_is_production'] == 1 ? 'Production' : 'Testing';

            $this->response = formatCommonResponse(
                ApiResponseStatusCode::BAD_REQUEST,
                "Firebase {$environment} Configuration Data is Empty. Please configure Firebase settings."
            );
            $this->is_active = false;
            return false;
        }

        $this->integration_data_array = [
            'firebase_project_number' => $thirdPartyIntegrationData['firebase_project_number'] ?? '',
            'firebase_web_api_key' => $thirdPartyIntegrationData['firebase_web_api_key'] ?? '',
            'firebase_app_id' => $thirdPartyIntegrationData['firebase_app_id'] ?? '',
            'firebase_config' => $thirdPartyIntegrationData['firebase_config'] ?? '',
            'firebase_sender_id' => $thirdPartyIntegrationData['firebase_sender_id'] ?? '',
            'firebase_web_push_certificate_key_pair' => $thirdPartyIntegrationData['firebase_web_push_certificate_key_pair'] ?? '',
            'firebase_web_push_certificate_private_key' => $thirdPartyIntegrationData['firebase_web_push_certificate_private_key'] ?? '',
            'firebase_service_account_private_key' => $thirdPartyIntegrationData['firebase_service_account_private_key'] ?? '',
        ];


        if ($this->session_required) { // Now using class property
            $this->validateIntegrationFields();
        } else {
            $this->validateIntegrationFields($this->classRefrence);
        }

        if ($this->response['status'] != 200) {
            return false;
        }

        $this->service_account_credentials = new ServiceAccountCredentials(
            'https://www.googleapis.com/auth/firebase.messaging',
            json_decode($this->integration_data_array['firebase_service_account_private_key'], true)
        );

        $tokken = $this->service_account_credentials->fetchAuthToken(HttpHandlerFactory::build());
        if (isset($tokken['access_token'])) {
            $this->acces_tokken = $tokken['access_token'];
        } else {
            $this->response = formatCommonResponse(ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'Failed to fetch Firebase access token');
            $this->is_active = false;
            return false;
        }

        $this->firebase_message_send_url = "https://fcm.googleapis.com/v1/projects/" . $this->integration_data_array['firebase_project_number'] . "/messages:send";
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->acces_tokken,
            'Content-Type' => 'application/json'
        ];

        $this->is_active = true;
        return true;
    }
    public function sendNotification(string $token, string $title, string $body, string $redirect_url, string $image_url = ""): bool
    {

        if (!$this->is_active || empty($this->integration_data_array)) {
            if (!$this->initializeFirebaseIntegration()) {
                return false;
            }
        }

        $image_url = (empty($image_url)) ? $this->notification_image : $image_url;
        // $redirect_url = (empty($redirect_url)) ? $this->notification_web_url : $redirect_url;

        if (!$this->is_active) {
            $this->response = apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Firebase Integration is Disabled');
            return false;
        }

        $message = [];
        $message['message']['token'] = $token;
        $message['message']['webpush']['fcm_options']['link'] = $redirect_url;
        $message['message']['notification']['title'] = $title;
        $message['message']['notification']['body'] = $body;
        $message['message']['notification']['image'] = $image_url ?? "";
        $message['message']['data']['title'] = $title ?? "";
        $message['message']['data']['body'] = $body ?? "";
        $message['message']['data']['url'] = $redirect_url ?? "";
        $message['message']['data']['image'] = $image_url ?? "";

        $response = curlApiRequest($this->firebase_message_send_url, 'POST', $message, $this->headers);
        if (isset($response['status']) && $response['status'] === ApiResponseStatusCode::OK) {
            $this->response = ['status' => ApiResponseStatusCode::OK, 'Message' => 'Notification sent successfully'];
            return true;
        } else {
            $errorMessage = 'Failed to send notification';
            $errors = isset($response['errors']) ? $response['errors'] : [];

            if (isset($response['message'])) {
                $errorMessage = $response['message'];
            }

            $this->response = apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, $errorMessage, [], $errors);
            return true;
        }
    }

    // Add Employee User Token Api
    public function addEmployeeUserTokenFirebase()
    {

        $data = getRequestData();
        // Set validation rules
        // $this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
        $this->form_validation->set_rules('token', 'Token', 'required');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');
        $this->form_validation->set_data($data);


        // Run validation
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, return a response with errors
            return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'User Token Validation Failed', [], $this->form_validation->error_array());
        }
        $udtm = _LM_UserDeviceTokenModel();
        $data['device_type'] = 'web';
        $fmt_data = [
            'user_type' => $data['user_type'],
            'employee_id' => $data['employee_id'],
            'token' => $data['token']
        ];
        $check_token = $udtm->where('token', $data['token'])->where('user_type', $data['user_type'])->where('device_type', $data['device_type'])->findAll();

        if (empty($check_token[0])) {
            $udtm->insert($fmt_data);
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Token Added Successfully');
        } else {
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Token Already Exist');
        }
    }

    // Add Student User Token Api
    public function addStudentUserTokenFirebase()
    {

        $data = getRequestData();
        // Set validation rules
        // $this->form_validation->set_rules('student_id', 'Student Id', 'required');
        $this->form_validation->set_rules('token', 'Token', 'required');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');
        $this->form_validation->set_data($data);


        // Run validation
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, return a response with errors
            return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'User Token Validation Failed', [], $this->form_validation->error_array());
        }
        $udtm = _LM_UserDeviceTokenModel();
        $data['device_type'] = 'web';
        $fmt_data = [
            'user_type' => $data['user_type'],
            'student_id' => $data['student_id'],
            'token' => $data['token']
        ];
        $check_token = $udtm->where('token', $data['token'])->where('user_type', $data['user_type'])->where('device_type', $data['device_type'])->findAll();
        if (empty($check_token[0])) {
            $udtm->insert($fmt_data);
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Token Added Successfully');
        } else {
            return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Token Already Exist');
        }
    }

    public function reset()
    {
        $this->notification_title = "";
        $this->notification_body = "";
        $this->notification_image = "";
        $this->notification_web_url = "";
        $this->notification_app_url = "";
    }
    // Send Notification To Student Function
    public function sendNotificationToStudent($student_id): bool
    {
        $fmtm = _LM_UserDeviceTokenModel();
        $fmt_data = $fmtm->where('user_type', 'student')->where('student_id', $student_id)->findAll() ?? [];
        if (empty($fmt_data)) {
            if ($this->classRefrence) {
                $this->response = formatCommonResponse(ApiResponseStatusCode::BAD_REQUEST, 'Token Not Found To Send Message');
                return false;
            } else {
                $this->response = apiFormatResponse($this->classRefrence->output ?? $this->output, ApiResponseStatusCode::BAD_REQUEST, 'Token Not Found To Send Message');
                return false;
            }
        }
        $notificationData = [
            'user_type' => 'student',
            'student_id' => $student_id,
            'title' => $this->notification_title,
            'image' => $this->notification_image,
            'body' => $this->notification_body,
            'web_url' => $this->notification_web_url ?? '',
            'app_url' => $this->notification_app_url ?? '',
            'student_created_by' => $_SESSION['student_data_session']['student_id'] ?? null,
            'employee_created_by' => $_SESSION['emp_data_session']['employee_id'] ?? null,

        ];
        $insert_notification_data = _LM_FirebaseMessagingNotificationModel()->insert($notificationData);

        $result = null;
        foreach ($fmt_data as $key => $value) {
            if ($value['device_type'] == 'web') {
                $result = $this->sendNotification($value['token'], $this->notification_title, $this->notification_body, $this->notification_web_url, $this->notification_image);
            } else {
                $result = $this->sendNotification($value['token'], $this->notification_title, $this->notification_body, $this->notification_app_url, $this->notification_image);
            }
        }
        $this->reset();
        return true;
    }
    // Sned Notification to Employee Function
    public function sendNotificationToEmployee($employee_id): bool
    {
        // $fmtm = _LM_UserDeviceTokenModel();
        $fmt_data = $fmtm->where('user_type', 'employee')->where('employee_id', $employee_id)->findAll() ?? [];
        if (empty($fmt_data)) {
            if ($this->classRefrence) {
                $this->response = formatCommonResponse(ApiResponseStatusCode::BAD_REQUEST, 'Token Not Found To Send Message');
                return false;
            } else {
                $this->response = apiFormatResponse($this->classRefrence->output ?? $this->output, ApiResponseStatusCode::BAD_REQUEST, 'Token Not Found To Send Message');
                return false;
            }
        }
        $notificationData = [
            'user_type' => 'employee',
            'employee_id' => $employee_id,
            'title' => $this->notification_title,
            'image' => $this->notification_image,
            'body' => $this->notification_body,
            'web_url' => $this->notification_web_url,
            'app_url' => $this->notification_app_url,
            'student_created_by' => $_SESSION['student_data_session']['student_id'] ?? null,
            'employee_created_by' => $_SESSION['emp_data_session']['employee_id'] ?? null,
        ];
        $insert_notification_data = _LM_FirebaseMessagingNotificationModel()->insert($notificationData);
        $result = null;
        foreach ($fmt_data as $key => $value) {
            if ($value['device_type'] == 'web') {
                $result = $this->sendNotification($value['token'], $this->notification_title, $this->notification_body, $this->notification_web_url, $this->notification_image);
            } else {
                $result = $this->sendNotification($value['token'], $this->notification_title, $this->notification_body, $this->notification_app_url, $this->notification_image);
            }
        }
        $this->reset();
        return true;
    }
    // Condition Base Functions
    public function updateTemplateData($template_type, $placeHolders)
    {
        $templates = _LM_TemplateModel()->where('template_type', $template_type)->where('notification_send', '1')->findAll();
        if (!empty($templates)) {
            $this->notification_title = $this->updatePlaceHolder($templates[0]['notification_title'], $placeHolders);
            $this->notification_body = $this->updatePlaceHolder($templates[0]['notification_body'], $placeHolders);
        }
    }
    public function updatePlaceHolder(string $string, array $placeHolders)
    {
        foreach ($placeHolders as $key => $value) {
            $string = str_replace("{{" . $key . "}}", $value, $string);
        }
        return $string;
    }
    /**
     * Summary of lead_assign_to_counselor
     * @param int $employee_id
     * @param array $placeHolders {{LEAD_ID}}, {{LEAD_NAME}}, {{LEAD_EMAIL}}, {{LEAD_MOBILE}}, {{COUNSELOR_NAME}}, {{ASSIGN_DATE}}
     * @return void
     */
    public function notification_lead_assign_to_counselor(int $employee_id, array $placeHolders = [])
    {
        $this->updateTemplateData("lead_assignment_notification", $placeHolders);
        $this->notification_image = "assets/images/logo.svg";
        // $this->notification_web_url = "";
        // $this->notification_app_url = "";
        return $this->sendNotificationToEmployee($employee_id);
    }

    /**
     * Summary of lead_admitted_by_counselor
     * @param int $employee_id
     * @param array $placeHolders {{LEAD_ID}}, {{LEAD_NAME}}, {{COUNSELOR_NAME}}, {{CLASS_NAME}}
     * @return void
     */
    public function notification_lead_admitted_by_counselor(int $employee_id, array $placeHolders = [])
    {
        $this->updateTemplateData("lead_admitted_by_counselor", $placeHolders);
        $this->notification_image = "assets/images/logo.svg";
        // $this->notification_web_url = "";
        // $this->notification_app_url = "";
        return $this->sendNotificationToEmployee($employee_id);
    }


    /**
     * Summary of notification_lead_forwarded_to_student_section
     * @param int $employee_id
     * @param array $placeHolders {{LEAD_ID}}, {{LEAD_NAME}}, {{COUNSELING_ADMIN_NAME}}, {{CLASS_NAME}}
     * @return void
     */
    public function notification_lead_forwarded_to_student_section(int $employee_id, array $placeHolders = [])
    {
        $this->updateTemplateData("lead_forwarded_to_student_section", $placeHolders);
        $this->notification_image = "assets/images/logo.svg";
        // $this->notification_web_url = "";
        // $this->notification_app_url = "";
        return $this->sendNotificationToEmployee($employee_id);
    }

    /**
     * Summary of notification_employee_leave_application
     * @param int $employee_id
     * @param array $placeHolders {{EMPLOYEE_NAME}}, {{EMPLOYEE_ID}}, {{FROM_DATE}}, {{TO_DATE}},{{LEAVE_DAYS}},{{LEAVE_REASON}}
     * @return void
     */
    public function notification_employee_leave_application(int $employee_id, array $placeHolders = [])
    {
        $this->updateTemplateData("employee_leave_application", $placeHolders);
        $this->notification_image = "assets/images/logo.svg";
        $this->notification_web_url = 'LeaveApproval';
        $this->notification_app_url = 'employes-leave-list';
        return $this->sendNotificationToEmployee($employee_id);
    }

    /**
     * Summary of notification_employee_leave_approved
     * @param int $employee_id
     * @param array $placeHolders {{EMPLOYEE_NAME}}, {{EMPLOYEE_ID}}, {{FROM_DATE}}, {{TO_DATE}},{{LEAVE_DAYS}},{{LEAVE_REASON}}
     * @return void
     */
    public function notification_employee_leave_approved(int $employee_id, array $placeHolders = [])
    {
        $this->updateTemplateData("employee_leave_approved", $placeHolders);
        $this->notification_image = "assets/images/logo.svg";
        $this->notification_web_url = 'Teacher/ApplyLeave';
        $this->notification_app_url = 'leave';
        return $this->sendNotificationToEmployee($employee_id);
    }

}