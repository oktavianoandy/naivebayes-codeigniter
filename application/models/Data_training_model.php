<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_training_model extends CI_Model
{
    public function get_all_data()
    {
        $query = $this->db->get('tbl_data_training');
        return $query->result_array();
    }

    public function add($data)
    {
        $this->db->insert('tbl_data_training', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_data_training', $data);
    }

    public function delete($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_data_training');
    }
}
