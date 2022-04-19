<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_training extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('data_training_model');
	}

	public function index()
	{
		$data['title'] = "Data Training";

		$data['breadcrumbs'] = '
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Training</li>
		';

		$data['data_training'] = $this->data_training_model->get_all_data();

		$this->load->view('components/header', $data);
		$this->load->view('components/sidenav');
		$this->load->view('components/topnav');
		$this->load->view('components/breadcrumbs', $data);
		$this->load->view('pages/data_training/index', $data);
		$this->load->view('components/footer');
	}

	public function add()
	{
		$data['title'] = "Tambah Data Training";

		$data['breadcrumbs'] = '
			<li class="breadcrumb-item"><a href="' . base_url() . '"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item"><a href="' . base_url() . '">Data Training</a></li>
			<li class="breadcrumb-item active" aria-current="page"> Tambah Data Training</li>

		';

		$this->form_validation->set_rules(
			'hari',
			'Hari ke-',
			'required|is_unique[tbl_data_training.hari]',
			array(
				'required' => '<small class="text-danger"> Belum memasukkan hari ke </small>',
				'is_unique' => '<small class="text-danger"> Hari tersebut telah dimasukkan </small>'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('components/header', $data);
			$this->load->view('components/sidenav');
			$this->load->view('components/topnav');
			$this->load->view('components/breadcrumbs', $data);
			$this->load->view('pages/data_training/tambah', $data);
			$this->load->view('components/footer');
		} else {
			$this->addProcess();
		}
	}

	public function addProcess()
	{
		$data = [
			"hari" => $this->input->post('hari', true),
			"cuaca" => $this->input->post('cuaca', true),
			"suhu" => $this->input->post('suhu', true),
			"tingkat_malas" => $this->input->post('tingkat_malas', true),
			"bangun_siang" => $this->input->post('bangun_siang', true),
			"kuliah" => $this->input->post('cuaca', true),
		];

		$this->data_training_model->add($data);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data training berhasil dimasukkan');
			redirect('');
		} else {
			$this->session->set_flashdata('failed', 'Data training gagal dimasukkan');
			redirect('');
		}
	}
}
