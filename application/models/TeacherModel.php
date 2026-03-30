<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TeacherModel extends CI_Model
{
  public function insertAll($table, $data)
  {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  // get all records from single table.
  public function getAll($table, $id, $order)
  {
    // $this->db->order_by($id,$order);
    $qry = $this->db->get($table);
    return $qry->result();
  }
  // get all records which have similar id
  public function getAllWhere($table, $id, $where, $order)
  {
    $this->db->order_by($id, $order);
    $qry = $this->db->where($where);
    $qry = $this->db->get($table);
    return $qry->result();
  }

  // get single record from table.
  public function getSingleRowByWhere($table, $where)
  {
    $this->db->where($where);
    $qry = $this->db->get($table);
    //echo $this->db->last_query();die;
    return $qry->row();
  }

  // update record function
  public function updateRecord($table, $data, $where)
  {
    $this->db->where($where);
    $qry = $this->db->update($table, $data);
    return $qry;
  }

  // delete record function
  public function deleteAll($table, $id)
  {
    $this->db->where($id);
    $q = $this->db->delete($table);
    //echo $this->db->last_query();die;
    return $q;
  }

  public function getEmployeeDetails($empid)
  {
    $this->db->select('*,a.employee_id');
    $this->db->from('add_newemployee as a');
    $this->db->where('a.employee_id', $empid);
    $this->db->join('empdetails as b', 'a.employee_id = b.employee_id', 'left');
    $this->db->join('emp_currentemployementdetails as c', 'a.employee_id = c.employee_id', 'left');
    $this->db->join('emp_academicdetails as d', 'a.employee_id = d.employee_id', 'left');
    $this->db->join('emp_achievementdetails as e', 'a.employee_id = e.employee_id', 'left');
    $this->db->join('emp_bankdetails as f', 'a.employee_id = f.employee_id', 'left');
    $this->db->join('emp_lastemployementdetails as g', 'a.employee_id = g.employee_id', 'left');
    $this->db->join('emp_referencedetails as h', 'a.employee_id = h.employee_id', 'left');
    $this->db->join('add_society as i', 'c.emp_societyid = i.society_id', 'left');
    $this->db->join('add_school as j', 'c.emp_schoolid = j.school_id', 'left');
    $this->db->join('add_department as k', 'c.emp_departmentid = k.department_id', 'left');
    $this->db->join('add_state as l', 'b.perm_emp_state = l.state_id', 'left');
    $query = $this->db->get();
    return $query->result();
  }
  public function getGraduationMarksheets($employee_id)
  {
    $this->db->select('emp_graduation_marksheet');
    $this->db->where('employee_id', $employee_id);
    $query = $this->db->get('add_newemployee'); // Replace 'your_table_name' with your actual table name

    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row->emp_graduation_marksheet;
    }

    return ''; // Return an empty string if no record is found
  }


  public function getpostGraduationMarksheets($employee_id)
  {
    $this->db->select('emp_pg_marksheet');
    $this->db->where('employee_id', $employee_id);
    $query = $this->db->get('add_newemployee'); // Replace 'your_table_name' with your actual table name

    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row->emp_pg_marksheet;
    }

    return ''; // Return an empty string if no record is found
  }

  public function getdocMarksheets($employee_id)
  {
    $this->db->select('emp_doc_marksheet');
    $this->db->where('employee_id', $employee_id);
    $query = $this->db->get('add_newemployee'); // Replace 'your_table_name' with your actual table name

    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row->emp_doc_marksheet;
    }

    return ''; // Return an empty string if no record is found
  }


  public function updateAllRecord($table, $data, $where)
  {
    $columnsToUpdate = array_keys($data);

    // Get the columns in the table
    $tableColumns = $this->db->list_fields($table);

    // Filter only the columns that exist in the table
    $validColumns = array_intersect($columnsToUpdate, $tableColumns);

    // Create an array with only the valid columns and their values
    $validData = array_intersect_key($data, array_flip($validColumns));

    if (!empty($validData)) {
      $this->db->where($where);
      $qry = $this->db->update($table, $validData);
      return $qry;
    }

    return false; // No valid columns to update
  }
}
