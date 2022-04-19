<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_testing_model extends CI_Model
{

    public function get_all_data()
    {
        $query = $this->db->get('tbl_data_testing');
        return $query->result_array();
    }

    public function get_all_data_without_label_value()
    {
        $this->db->where('kuliah', '??');
        $query = $this->db->get('tbl_data_testing');
        return $query->result_array();
    }

    public function get_data_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_data_testing');
        return $query->row_array();
    }

    public function add($data)
    {
        $this->db->insert('tbl_data_testing', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_data_testing', $data);
    }

    public function delete($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_data_testing');
    }
}
