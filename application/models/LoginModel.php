<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }


  // get all records from single table.
  public function getAll($table, $id, $order)
  {
    // $this->db->order_by($id,$order);
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
}
