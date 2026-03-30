<?php

if (!function_exists('selectAcademicYearPreSelect')) {
    /**
     * Generates a select component for AcadYearemic.
     *
     * @param array $data {
     * The data for generating the select component.
     *
     * @type string "select_name" The name attribute for the select element.
     * @type string "select_id" The id attribute for the select element.
     * @type string "select_classes" The class name of select element. (Default Class 'selectComponent')
     * @type string "select_attribute" The all attribute of select element.
     * @type boolean "select_multiple" for multiple select
     * @type string "option_selected" The value to mark as selected.
     * @type string "option_label" The label for the default option.
     * }
     * @return string The generated select component.
     */
    function selectAcademicYearPreSelect(array $data = [], array $filter = null)
    {
        $CI = &get_instance();

        $options = _LM_AcademicYearModel()
            ->select('acdemic_year_id, acdemic_year_name, academic_status')
            ->select('CONCAT(DAY(acdemic_from), "-", MONTH(acdemic_from), "-", YEAR(acdemic_from), ",", DAY(acdemic_to), "-", MONTH(acdemic_to), "-", YEAR(acdemic_to)) AS date')
            ->select('concat(acdemic_from,",",acdemic_to) as acdamic_date')
            ->findAll();

        $data['options'] = $options;
        $data['option_text_field_name'] = 'acdemic_year_name';
        $data['option_value'] = 'acdemic_year_id';
        $data['option_title'] = 'date';
        $data['option_parent_id'] = 'acdamic_date';
        $selectedOptions = '';

        // Filter options based on academic_status and extract acdemic_year_id
        foreach ($options as $row) {
            if ($row['academic_status'] == 1) {
                $selectedOptions = $row['acdemic_year_id'];
                break;
            }
        }
        $data['option_selected'] = (isset($data['option_selected']) && !empty($data['option_selected'])) ? $data['option_selected'] : $selectedOptions;

        return $CI->load->view('components/select', $data, true);
    }
}

if (!function_exists('selectClassOnlySimple')) {

    function selectClassOnlySimple(array $data = [], array $filter = null)
    {
        $CI = &get_instance();

        // Direct query with join and school filter
        $class_list = $CI->db
            ->select('c.classlist_id, c.classlist_name')
            ->distinct()
            ->from('classlist_assignsections s')
            ->join('class_list c', 'c.classlist_id = s.assignboard_classid', 'left')
            ->where('s.assignboard_schoolid', $CI->session->userdata('emp_data_session')['emp_schoolid'])
            ->order_by('c.classlist_name', 'ASC')
            ->get()
            ->result_array();

        // Check if 'extraOption' is set and true
        if (!empty($filter['extraOption']) && $filter['extraOption'] == true) {
            $options = [['classlist_name' => 'All Class', 'classlist_id' => 'allclass']];
            $options = array_merge($options, $class_list);
        } else {
            $options = $class_list;
        }

        $data['options'] = $options;
        $data['option_text_field_name'] = 'classlist_name';
        $data['option_value'] = 'classlist_id';
        $data['option_title'] = 'classlist_name';
        $data['option_selected'] = $data['option_selected'] ?? (!empty($filter['extraOption']) ? 'allclass' : '');

        return $CI->load->view('components/select', $data, true);
    }
}