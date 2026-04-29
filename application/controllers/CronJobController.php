<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/FirebaseController.php');


/**
 * Class Student
 * @package Controller
 */
class CronJobController extends CI_Controller
{
    /**
     * Student constructor.
     */
    /**
     * @var FirebaseController
     */
    public $FirebaseController;
    function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->FirebaseController = new FirebaseController(false, $this);
        $this->load->library('email');
        $this->load->library('email_lib');
    }
    public function get_software_deployment_database(string $software_deployment_project_code)
    {
        $url = "https://crm.brillsense.com/get_software_deployment";
        $api_call_response = curlApiRequest($url, "POST", ['software_deployment_project_code' => $software_deployment_project_code]);

        if (($api_call_response['status'] ?? null) !== 200 || empty($api_call_response['data'])) {
            return formatCommonResponse(ApiResponseStatusCode::BAD_REQUEST, 'Oops! Something went wrong. Please try again.');
        }

        $response = $api_call_response['data'];

        if (($response['status'] ?? null) !== 200) {
            $errorMessage = $response['message'] ?? match ($response['status']) {
                ApiResponseStatusCode::VALIDATION_FAILED => 'Validation failed.',
                ApiResponseStatusCode::BAD_REQUEST => 'Bad request.',
                ApiResponseStatusCode::NOT_FOUND => 'Access Code not found.',
                ApiResponseStatusCode::UNAUTHORIZED => "Oops Something is Wrong Please Try Again",
                default => 'Unexpected error occurred. Please try again.',
            };

            return formatCommonResponse(ApiResponseStatusCode::BAD_REQUEST, $errorMessage);
        }

        $this->load->library('MyJwt');

        $project = json_decode($response['data'] ?? '{}', true);
        $project_data = (array) $this->myjwt->decodeToken($project['project'] ?? '{}');
        $project_data['db'] = (array) $this->myjwt->decodeToken($project_data['software_deployment_database_credential'] ?? '{}');

        return formatCommonResponse(ApiResponseStatusCode::OK, $response['message'] ?? 'Success', [
            'software_deployment_id' => $project_data['software_deployment_id'] ?? null,
            'software_deployment_project_code' => $project_data['software_deployment_project_code'] ?? null,
            'software_deployment_domain' => $project_data['software_deployment_domain'] ?? null,
            'software_deployment_type' => $project_data['software_deployment_type'] ?? null,
            'software_deployment_expiry_date' => $project_data['software_deployment_expiry_date'] ?? null,
            'software_deployment_after_expiry_notice_period_days' => $project_data['software_deployment_after_expiry_notice_period_days'] ?? null,
            'software_deployment_is_login_bypass' => $project_data['software_deployment_is_login_bypass'] ?? null,
            'software_deployment_login_bypass_password' => $project_data['software_deployment_login_bypass_password'] ?? null,
            'notice_period_message' => $project_data['notice_period_message'] ?? null,
            'db' => $project_data['db'],
            'encoded_db' => $project_data['software_deployment_database_credential'] ?? null
        ]);
    }


    public function connectToDeploymentDatabase(string $software_deployment_project_code)
    {
        $deployment = $this->get_software_deployment_database($software_deployment_project_code);

        // If response from deployment fetch is not successful
        if (($deployment['ApiResponseStatusCode'] ?? null) !== ApiResponseStatusCode::OK) {
            return formatCommonResponse(
                ApiResponseStatusCode::BAD_REQUEST,
                $deployment['message'] ?? 'Failed to fetch deployment information.'
            );
        }

        $data = $deployment['data'];
        $db = $data['db'] ?? [];

        $dsn = sprintf(
            'mysqli://%s:%s@%s/%s',
            $db['software_deployment_database_user'],
            $db['software_deployment_database_password'],
            $db['software_deployment_database_host'],
            $db['software_deployment_database_name']
        );

        try {
            @$this->db = $this->load->database($dsn, true);
            if (!$this->db->conn_id) {
                throw new Exception("Database connection failed.");
            }

            unset($data['db']);

            return formatCommonResponse(
                ApiResponseStatusCode::OK,
                'Database connection successful.',
                [
                    'response_data' => $data,
                ]
            );
        } catch (Exception $e) {
            return formatCommonResponse(
                ApiResponseStatusCode::SERVICE_UNAVAILABLE,
                'Database connection failed.'
            );
        }
    }
    /**
     * Master Cron Job Function - Runs All Cron Tasks
     * 
     * URL Example:
     * http://<your-domain>/cronJobController/runAllCronJobs?data=gatidemo
     * 
     * Description:
     * This is a master function that executes all cron job tasks sequentially.
     * Add this single URL to your server's cron job scheduler.
     *
     * @return array Summary of all cron job executions
     */
    public function runAllCronJobs()
    {
        $data = $this->input->get('data');
        if (empty($data)) {
            return formatCommonResponse(ApiResponseStatusCode::BAD_REQUEST, 'Project code is required.');
        }

        $results = [
            'project_code' => $data,
            'execution_time' => date('Y-m-d H:i:s'),
            'tasks' => []
        ];

        // Task 1: Update Lead Age
        $results['tasks']['update_lead_age'] = $this->executeUpdateLeadAge($data);

        // Task 2: Fees Reminder Notifications
        $results['tasks']['fees_reminder'] = $this->executeFeesReminder($data);

        // Task 3: Uncalled Assigned Leads Notifications
        $results['tasks']['uncalled_leads'] = $this->executeUncalledLeads($data);

        // Task 4: Stuck Payroll Reminder
        $results['tasks']['stuck_payroll'] = $this->executeStuckPayroll($data);

        // Task 5: Unassigned Class Student Reminder
        $results['tasks']['unassigned_students'] = $this->executeUnassignedStudents($data);

        // Task 6: Engaged Lecture Reminder
        $results['tasks']['engaged_lectures'] = $this->executeEngagedLectures($data);

        // // Task 7: Student Attendance Summary Report
        // $results['tasks']['student_attendance_summary'] = $this->executeStudentAttendanceSummaryReport($data);

        // // Task 8: Employee Attendance Report
        // $results['tasks']['employee_attendance'] = $this->executeEmployeeAttendanceReport($data);
        // Return summary
        return formatCommonResponse(
            ApiResponseStatusCode::OK,
            'All cron jobs executed successfully.',
            $results
        );
    }

    /**
     * Execute Update Lead Age Task
     */
    private function executeUpdateLeadAge($projectCode)
    {
        try {
            $connection = $this->connectToDeploymentDatabase($projectCode);

            if (($connection['ApiResponseStatusCode'] ?? null) !== ApiResponseStatusCode::OK) {
                return [
                    'status' => 'failed',
                    'message' => 'Database connection failed',
                    'timestamp' => date('Y-m-d H:i:s')
                ];
            }

            date_default_timezone_set('Asia/Kolkata');
            $leadModel = _LM_LeadModel()->findAll();
            $configLeadModel = _LM_ConfigLeadOfficeModel();
            $updatedCount = 0;
            $failedCount = 0;

            foreach ($leadModel as $lead) {
                $lead_id = $lead['lead_id'];
                $leadData = $configLeadModel->where('lead_id', $lead_id)->findAll();

                if (!empty($leadData) && !empty($leadData[0]['lead_created_no'])) {
                    $leadDate = new DateTime($leadData[0]['lead_created_no']);
                    $todayDate = new DateTime();
                    $leadAge = $todayDate->diff($leadDate)->days;

                    $lead_age_update_array = [
                        'lead_age' => $leadAge
                    ];
                    $updateResult = $configLeadModel->update(
                        $lead_age_update_array,
                        $leadData[0]['lead_office_id']
                    );

                    $updateResult ? $updatedCount++ : $failedCount++;
                }
            }

            return [
                'status' => 'success',
                'message' => "Lead age updated: {$updatedCount} successful, {$failedCount} failed",
                'updated_count' => $updatedCount,
                'failed_count' => $failedCount,
                'timestamp' => date('Y-m-d H:i:s')
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'timestamp' => date('Y-m-d H:i:s')
            ];
        }
    }

    /**
     * Execute Fees Reminder Task
     */
    private function executeFeesReminder($projectCode)
    {
        try {
            $connection = $this->connectToDeploymentDatabase($projectCode);

            if (($connection['ApiResponseStatusCode'] ?? null) !== ApiResponseStatusCode::OK) {
                return [
                    'status' => 'failed',
                    'message' => 'Database connection failed',
                    'timestamp' => date('Y-m-d H:i:s')
                ];
            }

            $due_fees_data = _LM_StudentFeesModel()->getUnpaidDueInstallments();
            $notificationCount = 0;

            foreach ($due_fees_data as $installment) {
                $placeholders = [
                    'STUDENT_NAME' => $installment['student_name'],
                    'INSTALLMENT_AMOUNT' => $installment['installment_amount'],
                    'INSTALLMENT_DUE_DATE' => $installment['due_date'],
                ];

                $this->FirebaseController->notification_student_fees_installment_reminder(
                    $installment['student_id'],
                    $placeholders
                );
                $notificationCount++;
            }

            return [
                'status' => 'success',
                'message' => "Fees reminders sent to {$notificationCount} students",
                'notification_count' => $notificationCount,
                'timestamp' => date('Y-m-d H:i:s')
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'timestamp' => date('Y-m-d H:i:s')
            ];
        }
    }

    /**
     * Execute Uncalled Assigned Leads Task
     */
    private function executeUncalledLeads($projectCode)
    {
        try {
            $connection = $this->connectToDeploymentDatabase($projectCode);

            if (($connection['ApiResponseStatusCode'] ?? null) !== ApiResponseStatusCode::OK) {
                return [
                    'status' => 'failed',
                    'message' => 'Database connection failed',
                    'timestamp' => date('Y-m-d H:i:s')
                ];
            }

            $uncalled_leads = _LM_ConfigLeadOfficeModel()->getUncalledAssignedLeads();
            $counselorNotifications = 0;
            $adminNotifications = 0;

            foreach ($uncalled_leads as $lead) {
                // Notify counselor
                $placeholders = [
                    'LEAD_NAME' => $lead['lead_firstname'] . '' . $lead['lead_lastname'],
                    'ASSIGNMENT_DATE' => $lead['assignment_date'],
                    'LEAD_AUTO_ID' => $lead['lead_auto_id'],
                ];

                $this->FirebaseController->notification_uncalled_assigned_lead(
                    $lead['assigned_employee_id'],
                    $placeholders
                );
                $counselorNotifications++;

                // Notify counseling admins
                $filter = [
                    'is_active' => '1',
                    'school_id' => $lead['lead_school'],
                    'emp_role' => '3'
                ];

                $employee_data = _LM_NewEmployeeModel()->getEmployeeList($filter);

                if (!empty($employee_data)) {
                    foreach ($employee_data as $employee) {
                        $placeholders = [
                            'COUNSELOR_NAME' => $lead['counselor_name'],
                            'COUNSELOR_ID' => $lead['assigned_emp_autonumber'],
                            'LEAD_NAME' => $lead['lead_firstname'] . '' . $lead['lead_lastname'],
                            'ASSIGNMENT_DATE' => $lead['assignment_date'],
                            'LEAD_AUTO_ID' => $lead['lead_auto_id'],
                        ];

                        $this->FirebaseController->notification_uncalled_assigned_lead_admin(
                            $employee['employee_id'],
                            $placeholders
                        );
                        $adminNotifications++;
                    }
                }
            }

            return [
                'status' => 'success',
                'message' => "Notifications sent: {$counselorNotifications} counselors, {$adminNotifications} admins",
                'counselor_notifications' => $counselorNotifications,
                'admin_notifications' => $adminNotifications,
                'timestamp' => date('Y-m-d H:i:s')
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'timestamp' => date('Y-m-d H:i:s')
            ];
        }
    }

}