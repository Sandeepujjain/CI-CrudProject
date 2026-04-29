<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
// use tecnickcom\tcpdf\TCPDF; // Correct namespace for TCPDF



require_once(APPPATH . 'controllers/FirebaseController.php');

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


class StudentApiController extends CI_Controller
{
    private $secret_key = '';

    public string $loginValidationFailedMsg;
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


    public function __construct()
    {
        parent::__construct();
        $this->output->parse_exec_vars = FALSE;
        $this->load->library('MyJwt');

        $this->jwt = new MyJwt();
        $this->loginValidationFailedMsg = "Login Validation Failed";
        // Check Token Before Initializing Firebase
        // if ($this->checkTokenAPI()) {
        $this->FirebaseController = new FirebaseController(false, $this);
        // }
        $this->load->library('Gps_lib');

        $this->Gps_lib = new Gps_lib();
    }

    private function checkTokenAPI($token = null)
    {
        $headers = $this->input->request_headers();
        if (!empty($token)) {
            $authorizationHeader = $token;
        } else {
            if (!isset($headers['Authorization']) || empty($headers['Authorization'])) {
                apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Please Login Again', [], ['error' => 'Token not found']);
                return false;
            }
            $authorizationHeader = $headers['Authorization'];
        }
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

        $tokenRecord = _LM_StudentTokenModel()
            ->where('studenttoken', $token)
            ->findAll();
        if (empty($tokenRecord)) {
            apiFormatResponse($this->output, ApiResponseStatusCode::BAD_REQUEST, 'Please Login Again', [], ['error' => 'Token Data Not Found']);
            return false;
        }
        $decodedToken = (array) $decodedToken;
        $session_data = (array) $tokenRecord[0];
        // set session
        $sessionData = array_merge($decodedToken, $session_data);
        $this->session->set_userdata('student_session', $sessionData);
        // If token is valid, proceed with the request
        return true;
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

    public function studentAttendanceDataByLectureId(&$requestedData = null, $return_type = "JSON")
    {
        if (!empty($requestedData)) {
            $data = $requestedData;
        } else {
            $data = getRequestData();
        }

        $TTSDM = _LM_TimeTableSetDayModel();
        $TTSDM->tableAlias('ttsdm');
        $TTSDM->select('ttsdm.*,att.*', true);
        $TTSDM->where("table_set_day_id", $data["table_set_day_id"]);

        $TTSDM->join(_LM_AssignTimeTableModel()->tableName . " as att", "att." . _LM_AssignTimeTableModel()->primaryKey . "=ttsdm.assign_time_table_id");

        $lectureData = $TTSDM->findAll();


        $studentData = []; // Initialize empty array

        if (!empty($lectureData)) {
            $studentModel = _LM_StudentsModel();
            $studentModel->select("concat(student.stu_firstname,' ',student.stu_middlename,' ',student.stu_lastname) as student_name,student.student_id,student.stu_admission_id ,student.stu_apaar_id,student.stu_enrollment_id ");
            $studentModel->tableAlias('student');

            $studentModel->where('stu_academic_year', $lectureData[0]['academic_year_id']);
            $studentModel->where('stu_schoolid', $lectureData[0]['school_id']);
            $studentModel->where('clist_assignid', $lectureData[0]['class_section_id']);
            $studentData = $studentModel->findAll();
        } else {
            $studentModel = _LM_StudentsModel();
            $studentModel->select("concat(student.stu_firstname,' ',student.stu_middlename,' ',student.stu_lastname) as student_name,student.student_id,student.stu_admission_id ,student.stu_apaar_id,student.stu_enrollment_id ");
            $studentModel->tableAlias('student');

            $studentModel->where('stu_academic_year', $data['academic_year_id']);
            $studentModel->where('stu_schoolid', $data['school_id']);
            $studentModel->where('clist_assignid', $data['class_section_id']);
            $studentData = $studentModel->findAll();
        }

        // Check if lecture data is found but student data is not found
        if (empty($studentData)) {

            if ($return_type === "JSON") {
                apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, '', [], ['error' => 'Students not found in this class']);
                return; // Return to avoid further processing
            } else {
                $message = "Students not found in this class";
                return ['error' => $message];
            }
        }
        $responseData = [
            'lectureData' => $lectureData,
            'studentData' => $studentData
        ];

        if ($return_type === "JSON") {
            apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Data Get Successfully', [$responseData]);
        } else {
            return $responseData;
        }
    }

}