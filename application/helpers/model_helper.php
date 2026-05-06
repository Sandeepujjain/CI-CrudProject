<?php

 if (!function_exists('_LM_SchoolModel')) {
    /**
     * Load and return an instance of the SchoolModel class.
     * @return SchoolModel
     *   The instance of SchoolModel.
     */
    function _LM_SchoolModel()
    {
        $CI = &get_instance();
        $CI->load->model('SchoolModel');
        return $CI->SchoolModel;
    }
}
if (!function_exists('_LM_AcademicYearModel')) {
    /**
     * Load and return an instance of the AcademicYearModel class.
     * @return AcademicYearModel
     *   The instance of AcademicYearModel.
     */
    function _LM_AcademicYearModel()
    {
        $CI = &get_instance();
        $CI->load->model('AcademicYearModel');
        return $CI->AcademicYearModel;
    }
}


if (!function_exists('_LM_StudentSaleItemModel')) {
    /**
     * Load and return an instance of the StudentSaleItemModel class.
     * @return StudentSaleItemModel
     *   The instance of StudentSaleItemModel.
     */
    function _LM_StudentSaleItemModel()
    {
        $CI = &get_instance();
        $CI->load->model('StudentSaleItemModel');
        return $CI->StudentSaleItemModel;
    }
}
if (!function_exists('_LM_PaymentGatewayModel')) {
    /**
     * Load and return an instance of the PaymentGatewayModel class.
     * @return PaymentGatewayModel
     *   The instance of PaymentGatewayModel.
     */
    function _LM_PaymentGatewayModel()
    {
        $CI = &get_instance();
        $CI->load->model('PaymentGatewayModel');
        return $CI->PaymentGatewayModel;
    }
}
if (!function_exists('_LM_StudentRegistrationFeesModel')) {
    /**
     * Load and return an instance of the StudentRegistrationFeesModel class.
     * @return StudentRegistrationFeesModel
     *   The instance of StudentRegistrationFeesModel.
     */
    function _LM_StudentRegistrationFeesModel()
    {
        $CI = &get_instance();
        $CI->load->model('StudentRegistrationFeesModel');
        return $CI->StudentRegistrationFeesModel;
    }
}

if (!function_exists('_LM_StudentRegistrationPaymentsModel')) {
    /**
     * Load and return an instance of the StudentRegistrationPaymentsModel class.
     * @return StudentRegistrationPaymentsModel
     *   The instance of StudentRegistrationPaymentsModel.
     */
    function _LM_StudentRegistrationPaymentsModel()
    {
        $CI = &get_instance();
        $CI->load->model('StudentRegistrationPaymentsModel');
        return $CI->StudentRegistrationPaymentsModel;
    }
}

if (!function_exists('_LM_StudentSeatingSeasonModel')) {
    /**
     * Load and return an instance of the StudentSeatingSeasonModel class.
     * @return StudentSeatingSeasonModel
     *   The instance of StudentSeatingSeasonModel.
     */
    function _LM_StudentSeatingSeasonModel()
    {
        $CI = &get_instance();
        $CI->load->model('StudentSeatingSeasonModel');
        return $CI->StudentSeatingSeasonModel;
    }
}
if (!function_exists('_LM_StudentSeatingAllocationsModel')) {
    /**
     * Load and return an instance of the StudentSeatingAllocationsModel class.
     * @return StudentSeatingAllocationsModel
     *   The instance of StudentSeatingAllocationsModel.
     */
    function _LM_StudentSeatingAllocationsModel()
    {
        $CI = &get_instance();
        $CI->load->model('StudentSeatingAllocationsModel');
        return $CI->StudentSeatingAllocationsModel;
    }
}
if (!function_exists('_LM_InvigilatorAllocationsModel')) {
    /**
     * Load and return an instance of the InvigilatorAllocationsModel class.
     * @return InvigilatorAllocationsModel
     *   The instance of InvigilatorAllocationsModel.
     */
    function _LM_InvigilatorAllocationsModel()
    {
        $CI = &get_instance();
        $CI->load->model('InvigilatorAllocationsModel');
        return $CI->InvigilatorAllocationsModel;
    }
}

if (!function_exists('_LM_HostelModel')) {
    /**
     * Load and return an instance of the HostelModel class.
     * @return HostelModel
     *   The instance of HostelModel.
     */
    function _LM_HostelModel()
    {
        $CI = &get_instance();
        $CI->load->model('HostelModel');
        return $CI->HostelModel;
    }
}
if (!function_exists('_LM_HostelFloorModel')) {
    /**
     * Load and return an instance of the HostelFloorModel class.
     * @return HostelFloorModel
     *   The instance of HostelFloorModel.
     */
    function _LM_HostelFloorModel()
    {
        $CI = &get_instance();
        $CI->load->model('HostelFloorModel');
        return $CI->HostelFloorModel;
    }
}
if (!function_exists('_LM_HostelRoomsModel')) {
    /**
     * Load and return an instance of the HostelRoomsModel class.
     * @return HostelRoomsModel
     *   The instance of HostelRoomsModel.
     */
    function _LM_HostelRoomsModel()
    {
        $CI = &get_instance();
        $CI->load->model('HostelRoomsModel');
        return $CI->HostelRoomsModel;
    }
}
if (!function_exists('_LM_HostelRulesModel')) {
    /**
     * Load and return an instance of the HostelRulesModel class.
     * @return HostelRulesModel
     *   The instance of HostelRulesModel.
     */
    function _LM_HostelRulesModel()
    {
        $CI = &get_instance();
        $CI->load->model('HostelRulesModel');
        return $CI->HostelRulesModel;
    }
}
if (!function_exists('_LM_HostelRoomTypeModel')) {
    /**
     * Load and return an instance of the HostelRoomTypeModel class.
     * @return HostelRoomTypeModel
     *   The instance of HostelRoomTypeModel.
     */
    function _LM_HostelRoomTypeModel()
    {
        $CI = &get_instance();
        $CI->load->model('HostelRoomTypeModel');
        return $CI->HostelRoomTypeModel;
    }
}

if (!function_exists('_LM_HostelAllotmentModel')) {
    /**
     * Load and return an instance of the HostelAllotmentModel class.
     * @return HostelAllotmentModel
     *   The instance of HostelAllotmentModel.
     */
    function _LM_HostelAllotmentModel()
    {
        $CI = &get_instance();
        $CI->load->model('HostelAllotmentModel');
        return $CI->HostelAllotmentModel;
    }
}

if (!function_exists('_LM_HostelMessModel')) {
    /**
     * Load and return an instance of the HostelMessModel class.
     * @return HostelMessModel
     *   The instance of HostelMessModel.
     */
    function _LM_HostelMessModel()
    {
        $CI = &get_instance();
        $CI->load->model('HostelMessModel');
        return $CI->HostelMessModel;
    }
}




if (!function_exists('_LM_ProductsModel')) {
    /**
     * Load and return an instance of the ProductsModel class.
     * @return ProductsModel
     *   The instance of ProductsModel.
     */
    function _LM_ProductsModel()
    {
        $CI = &get_instance();
        $CI->load->model('ProductsModel');
        return $CI->ProductsModel;
    }
}

if (!function_exists('_LM_UsersModel')) {
    /**
     * Load and return an instance of the UsersModel class.
     * @return UsersModel
     *   The instance of UsersModel.
     */
    function _LM_UsersModel()
    {
        $CI = &get_instance();
        $CI->load->model('UsersModel');
        return $CI->UsersModel;
    }
}
