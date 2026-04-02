<?php

use DeepCopy\Filter\ReplaceFilter;

defined('BASEPATH') or exit('No direct script access allowed');

class PageController extends CI_Controller
{

    // 
    function __construct()
    {
        parent::__construct();
        error_reporting(0);

        // $this->load->model('MasterAdminModel');
        $this->load->library('session_validation');
        // $this->session_validation->checkSession();
        $this->load->library('MyJwt');
        $this->jwt = new MyJwt();
    }

   
    //For Email SMS Notification Template
    public function template()
    {
        // $data['templates'] = _LM_TemplateModel()->findAll();
        // $this->callHeader();
        // $this->load->view('MasterAdmin/templates/email_sms_template', $data);
        // $this->callFooter();
    }
    public function email_sms_template_form()
    {
        $data = getRequestData();

        // Validate if template_id is present
        if (empty($data['template_id'])) {
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::BAD_REQUEST,
                'Template ID is required',
                null
            );
        }

        // Fetch template data
        $template_data = _LM_TemplateModel()->find($data['template_id']);

        // If template data exists, return success response
        if (!empty($template_data)) {
            $html = $this->load->view("MasterAdmin/templates/email_sms_template_form", $template_data, true);
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::OK,
                'Email SMS Template Data Found Successfully',
                ['html' => $html, 'template_data' => $template_data]
            );
        }

        // If no data found, return not found response
        return apiFormatResponse(
            $this->output,
            ApiResponseStatusCode::NOT_FOUND,
            'Email SMS Template Data Not Found',
            ['html' => '<h1 style="text-align:center; color:red;">Template Record Not Found</h1>']
        );
    }

    //For Third Party Integration
    public function third_party_integration()
    {
        // Email
        $data['email_integration']['fields'] = _LM_ThirdPartyIntegrationModel()->getEmailIntegrationFileds();
        $data['email_integration']['data'] = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('email');
        // Sms
        $data['sms_integration']['fields'] = _LM_ThirdPartyIntegrationModel()->getSmsIntegrationFileds();
        $data['sms_integration']['data'] = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('sms');

        // Google Firebase
        $data['firebase_integration']['fields'] = _LM_ThirdPartyIntegrationModel()->getFirebaseIntegrationFileds();
        $data['firebase_integration']['data'] = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('firebase');

        // WhatsApp Integration
        $data['whatsapp_integration']['fields'] = _LM_ThirdPartyIntegrationModel()->getWhatsAppIntegrationsFileds();
        $data['whatsapp_integration']['data'] = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('whatsapp');

        // GPS Integration
        $data['gps_integration']['fields'] = _LM_ThirdPartyIntegrationModel()->getGpsIntegrationFileds();
        $data['gps_integration']['data'] = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('gps');
        // Rozorpay
        // $data['rozorpay_integration']['fields'] = _LM_ThirdPartyIntegrationModel()->getRozorpayIntegrationFileds();
        // $data['rozorpay_integration']['data'] = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('rozorpay');
        // Google OAuth
        // $data['googleoauth_integration']['fields'] = _LM_ThirdPartyIntegrationModel()->getGoogleoauthIntegrationFileds();
        // $data['googleoauth_integration']['data'] = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('googleoauth');
        $this->callHeader();
        $this->load->view('MasterAdmin/ThirdPartyIntegration/third_party_integration', $data);
        $this->callFooter();
    }

    //For Payment Gateway
    public function payment_gateway(&$requestedData = null)
    {
        $prefill_data = [];
        $data = !empty($requestedData) ? $requestedData : getRequestData();
        $school_id = $_SESSION['emp_data_session']['emp_schoolid'];

        $this->load->library('MyJwt');

        $razor_pay_data = _LM_PaymentGatewayModel()
            ->where('payment_gateway_type', 'RAZORPAY')
            ->where('school_id', $school_id)
            ->findAll()[0] ?? [];

        // Decode JWT fields
        if (!empty($razor_pay_data)) {
            foreach (['payment_gateway_razorpay_api_key', 'payment_gateway_razorpay_api_secret_key'] as $field) {
                if (!empty($razor_pay_data[$field])) {
                    $decoded = (array) $this->myjwt->decodeToken($razor_pay_data[$field]);
                    $razor_pay_data[$field] = $decoded['value'] ?? '';
                }
            }
        }

        $prefill_data['razor_pay_data'] = $razor_pay_data;

        $ccavenue_data = _LM_PaymentGatewayModel()
            ->where('payment_gateway_type', 'CCAVENUE')
            ->where('school_id', $school_id)
            ->findAll()[0] ?? [];

        if (!empty($ccavenue_data)) {
            foreach (['payment_gateway_ccavenue_merchant_id', 'payment_gateway_ccavenue_access_code', 'payment_gateway_ccavenue_working_key'] as $field) {
                if (!empty($ccavenue_data[$field])) {
                    $decoded = (array) $this->myjwt->decodeToken($ccavenue_data[$field]);
                    $ccavenue_data[$field] = $decoded['value'] ?? '';
                }
            }
        }

        $prefill_data['ccavenue_data'] = $ccavenue_data;

        // $this->callHeader();
        $this->load->view('ThirdPartyIntegration/payment_gateway', $prefill_data);
        // $this->callFooter();
    }

    public function save_payment_gateway()
    {
        try {
            $this->db->trans_start();
            $data = !empty($requestedData) ? $requestedData : getRequestData();

            $this->load->library('MyJwt');

            /* ================= ENCODE SENSITIVE FIELDS ================= */
            $fields_to_encode = [
                'payment_gateway_razorpay_api_key',
                'payment_gateway_razorpay_api_secret_key',
                'payment_gateway_ccavenue_merchant_id',
                'payment_gateway_ccavenue_access_code',
                'payment_gateway_ccavenue_working_key'
            ];

            foreach ($fields_to_encode as $field) {
                if (!empty($data[$field])) {
                    $data[$field] = $this->myjwt->generateToken(['value' => $data[$field]]);
                }
            }

            $data['is_production'] = isset($data['is_production']) ? (int)$data['is_production'] : 0;
            $data['is_active']     = isset($data['is_active']) ? (int)$data['is_active'] : 0;

            /* ================= ENSURE SINGLE PRODUCTION ================= */
            if ($data['is_production'] === 1) {
                _LM_PaymentGatewayModel()
                    ->disable_other_production_gateway(
                        $data['school_id'],
                        $data['payment_gateway_type']
                    );
            }

            /* ================= ENSURE SINGLE ACTIVE ================= */
            if ($data['is_active'] === 1) {
                _LM_PaymentGatewayModel()
                    ->disable_other_active_gateway(
                        $data['school_id'],
                        $data['payment_gateway_type']
                    );
            }

            /* ================= INSERT / UPDATE ================= */
            if (!empty($data['payment_gateway_id'])) {

                $updateStatus = _LM_PaymentGatewayModel()
                    ->update($data, $data['payment_gateway_id']);

                if (is_array($updateStatus) && !empty($updateStatus['errors'])) {
                    $this->db->trans_rollback();
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::VALIDATION_FAILED,
                        'Update failed',
                        [],
                        $updateStatus['errors']
                    );
                }

                $this->db->trans_commit();
                return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Record Updated Successfully');
            } else {

                $insertStatus = _LM_PaymentGatewayModel()->insert($data);

                if (is_array($insertStatus) && !empty($insertStatus['errors'])) {
                    $this->db->trans_rollback();
                    return apiFormatResponse(
                        $this->output,
                        ApiResponseStatusCode::VALIDATION_FAILED,
                        'Creation failed',
                        [],
                        $insertStatus['errors']
                    );
                }

                $this->db->trans_commit();
                return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Record Added Successfully');
            }
        } catch (\Exception $e) {
            $this->db->trans_rollback();
            return apiFormatResponse(
                $this->output,
                ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
                'Something went wrong',
                [],
                ['exception' => $e->getMessage()]
            );
        }
    }

}