<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Naive_bayes_model extends CI_Model
{
    // cari jumlah bolos dan masuk di tiap - tiap atribut
    public function get_count_atribut($nilai_label, $atribut, $nilai_atribut)
    {
        $this->db->where('kuliah', $nilai_label);
        $this->db->where($atribut, $nilai_atribut);
        $query = $this->db->get('tbl_data_training');
        return $query->num_rows();
    }

    // cari jumlah label bolos dan masuk
    public function get_count_label($nilai_label)
    {
        $this->db->where('kuliah', $nilai_label);
        $query = $this->db->get('tbl_data_training');
        return $query->num_rows();
    }
}
