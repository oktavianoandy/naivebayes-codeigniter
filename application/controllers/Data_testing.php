<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_testing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_testing_model');
        $this->load->model('naive_bayes_model');
    }

    public function index()
    {
        $data['title'] = "Data Testing";

        $data['breadcrumbs'] = '
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Testing</li>
		';

        $data['data_testing'] = $this->data_testing_model->get_all_data();

        $this->load->view('components/header', $data);
        $this->load->view('components/sidenav');
        $this->load->view('components/topnav');
        $this->load->view('components/breadcrumbs', $data);
        $this->load->view('pages/data_testing/index', $data);
        $this->load->view('components/footer');
    }

    public function add()
    {
        $data['title'] = "Tambah Data Testing";

        $data['breadcrumbs'] = '
			<li class="breadcrumb-item"><a href="' . base_url() . '"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item"><a href="' . base_url() . '">Data Testing</a></li>
			<li class="breadcrumb-item active" aria-current="page"> Tambah Data Testing</li>

		';

        $this->form_validation->set_rules(
            'hari',
            'Hari ke-',
            'required',
            array(
                'required' => '<small class="text-danger"> Belum memasukkan hari ke </small>',
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('components/header', $data);
            $this->load->view('components/sidenav');
            $this->load->view('components/topnav');
            $this->load->view('components/breadcrumbs', $data);
            $this->load->view('pages/data_testing/tambah', $data);
            $this->load->view('components/footer');
        } else {
            $this->addProcess();
        }
    }

    public function addProcess()
    {
        $data = [
            "hari"  => $this->input->post('hari', true),
            "cuaca" => $this->input->post('cuaca', true),
            "suhu" => $this->input->post('suhu', true),
            "tingkat_malas" => $this->input->post('tingkat_malas', true),
            "bangun_siang" => $this->input->post('bangun_siang', true),
            "kuliah" => '??',
        ];

        $this->data_testing_model->add($data);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data testing berhasil dimasukkan.');
            redirect('testing');
        } else {
            $this->session->set_flashdata('failed', 'Data testing gagal dimasukkan.');
            redirect('testing');
        }
    }

    public function naiveBayesSingle($id)
    {
        $kuliah = $this->processNaiveBayes($id);
        if ($kuliah != null) {
            $data = [
                "kuliah" => $kuliah
            ];

            $this->data_testing_model->update($id, $data);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data testing berhasil diproses.');
                redirect('testing');
            } else {
                $this->session->set_flashdata('failed', 'Data testing gagal diproses.');
                redirect('testing');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data testing gagal diproses.');
        }
    }

    public function naiveBayesMultiple()
    {
        $data_testing = $this->data_testing_model->get_all_data_without_label_value();
        if ($data_testing == null) {
            $this->session->set_flashdata('success', 'Semua data telah dites.');
            redirect('testing');
        } else {
            foreach ($data_testing as $dt) {
                $kuliah = $this->processNaiveBayes($dt['id']);
                if ($kuliah != null) {
                    $data = [
                        "kuliah" => $kuliah
                    ];

                    $this->data_testing_model->update($dt['id'], $data);
                } else {
                    $this->session->set_flashdata('failed', 'Data testing gagal diproses.');
                }
            }

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data testing berhasil diproses.');
                redirect('testing');
            } else {
                $this->session->set_flashdata('failed', 'Data testing gagal diproses.');
                redirect('testing');
            }
        }
    }

    public function matriksProbabilitas()
    {
        // atribut cuaca
        // atribut cuaca bolos
        // get jumlah bolos hujan
        $jumlah_hujan_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'cuaca', 'Hujan');
        // get jumlah bolos mendung
        $jumlah_mendung_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'cuaca', 'Mendung');
        // get jumlah bolos cerah
        $jumlah_cerah_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'cuaca', 'Cerah');
        // jumlah cuaca bolos
        $jumlah_cuaca_bolos = $jumlah_hujan_bolos + $jumlah_mendung_bolos + $jumlah_cerah_bolos;
        // nilai probabilitas hujan bolos
        $nilai_probabilitas_hujan_bolos = $jumlah_hujan_bolos / $jumlah_cuaca_bolos;
        //nilai probabilitas mendung bolos
        $nilai_probabilitas_mendung_bolos = $jumlah_mendung_bolos / $jumlah_cuaca_bolos;
        //nilai probabilitas cerah bolos
        $nilai_probabilitas_cerah_bolos = $jumlah_cerah_bolos / $jumlah_cuaca_bolos;

        // atribut cuaca masuk
        // get jumlah masuk hujan
        $jumlah_hujan_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'cuaca', 'Hujan');
        // get jumlah masuk mendung
        $jumlah_mendung_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'cuaca', 'Mendung');
        // get jumlah masuk cerah
        $jumlah_cerah_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'cuaca', 'Cerah');
        // jumlah cuaca masuk
        $jumlah_cuaca_masuk = $jumlah_hujan_masuk + $jumlah_mendung_masuk + $jumlah_cerah_masuk;
        // nilai probabilitas hujan masuk
        $nilai_probabilitas_hujan_masuk = $jumlah_hujan_masuk / $jumlah_cuaca_masuk;
        //nilai probabilitas mendung masuk
        $nilai_probabilitas_mendung_masuk = $jumlah_mendung_masuk / $jumlah_cuaca_masuk;
        //nilai probabilitas cerah masuk
        $nilai_probabilitas_cerah_masuk = $jumlah_cerah_masuk / $jumlah_cuaca_masuk;



        // atribut suhu
        // atribut suhu bolos
        // get jumlah bolos panas
        $jumlah_panas_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'suhu', 'Panas');
        // get jumlah bolos sejuk
        $jumlah_sejuk_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'suhu', 'Sejuk');
        // get jumlah bolos dingin
        $jumlah_dingin_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'suhu', 'Dingin');
        // jumlah suhu bolos
        $jumlah_suhu_bolos = $jumlah_panas_bolos + $jumlah_sejuk_bolos + $jumlah_dingin_bolos;
        // nilai probabilitas panas bolos
        $nilai_probabilitas_panas_bolos = $jumlah_panas_bolos / $jumlah_suhu_bolos;
        //nilai probabilitas sejuk bolos
        $nilai_probabilitas_sejuk_bolos = $jumlah_sejuk_bolos / $jumlah_suhu_bolos;
        //nilai probabilitas dingin bolos
        $nilai_probabilitas_dingin_bolos = $jumlah_dingin_bolos / $jumlah_suhu_bolos;

        // atribut suhu masuk
        // get jumlah masuk panas
        $jumlah_panas_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'suhu', 'Panas');
        // get jumlah masuk sejuk
        $jumlah_sejuk_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'suhu', 'Sejuk');
        // get jumlah masuk dingin
        $jumlah_dingin_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'suhu', 'Dingin');
        // jumlah suhu masuk
        $jumlah_suhu_masuk = $jumlah_panas_masuk + $jumlah_sejuk_masuk + $jumlah_dingin_masuk;
        // nilai probabilitas panas masuk
        $nilai_probabilitas_panas_masuk = $jumlah_panas_masuk / $jumlah_suhu_masuk;
        //nilai probabilitas sejuk masuk
        $nilai_probabilitas_sejuk_masuk = $jumlah_sejuk_masuk / $jumlah_suhu_masuk;
        //nilai probabilitas dingin masuk
        $nilai_probabilitas_dingin_masuk = $jumlah_dingin_masuk / $jumlah_suhu_masuk;



        // atribut tingkat malas
        // atribut tingkat malas bolos
        // get jumlah bolos normal
        $jumlah_normal_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'tingkat_malas', 'Normal');
        // get jumlah bolos tinggi
        $jumlah_tinggi_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'tingkat_malas', 'Tinggi');
        // jumlah tingkat_malas bolos
        $jumlah_tingkat_malas_bolos = $jumlah_normal_bolos + $jumlah_tinggi_bolos;
        // nilai probabilitas normal bolos
        $nilai_probabilitas_normal_bolos = $jumlah_normal_bolos / $jumlah_tingkat_malas_bolos;
        //nilai probabilitas tinggi bolos
        $nilai_probabilitas_tinggi_bolos = $jumlah_tinggi_bolos / $jumlah_tingkat_malas_bolos;

        // atribut tingkat_malas masuk
        // get jumlah masuk normal
        $jumlah_normal_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'tingkat_malas', 'Normal');
        // get jumlah masuk tinggi
        $jumlah_tinggi_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'tingkat_malas', 'Tinggi');
        // jumlah tingkat_malas masuk
        $jumlah_tingkat_malas_masuk = $jumlah_normal_masuk + $jumlah_tinggi_masuk;
        // nilai probabilitas normal masuk
        $nilai_probabilitas_normal_masuk = $jumlah_normal_masuk / $jumlah_tingkat_malas_masuk;
        //nilai probabilitas tinggi masuk
        $nilai_probabilitas_tinggi_masuk = $jumlah_tinggi_masuk / $jumlah_tingkat_malas_masuk;



        // atribut bangun kesiangan
        // atribut bangun kesiangan bolos
        // get jumlah bolos tidak
        $jumlah_tidak_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'bangun_siang', 'Tidak');
        // get jumlah bolos ya
        $jumlah_ya_bolos = $this->naive_bayes_model->get_count_atribut('Bolos', 'bangun_siang', 'Ya');
        // jumlah bangun_siang bolos
        $jumlah_bangun_siang_bolos = $jumlah_ya_bolos + $jumlah_tidak_bolos;
        //nilai probabilitas tidak bolos
        $nilai_probabilitas_tidak_bolos = $jumlah_tidak_bolos / $jumlah_bangun_siang_bolos;
        // nilai probabilitas ya bolos
        $nilai_probabilitas_ya_bolos = $jumlah_ya_bolos / $jumlah_bangun_siang_bolos;

        // atribut bangun kesiangan masuk
        // get jumlah masuk tidak
        $jumlah_tidak_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'bangun_siang', 'Tidak');
        // get jumlah masuk ya
        $jumlah_ya_masuk = $this->naive_bayes_model->get_count_atribut('Masuk', 'bangun_siang', 'Ya');
        // jumlah bangun_siang masuk
        $jumlah_bangun_siang_masuk = $jumlah_ya_masuk + $jumlah_tidak_masuk;
        //nilai probabilitas tidak masuk
        $nilai_probabilitas_tidak_masuk = $jumlah_tidak_masuk / $jumlah_bangun_siang_masuk;
        // nilai probabilitas ya masuk
        $nilai_probabilitas_ya_masuk = $jumlah_ya_masuk / $jumlah_bangun_siang_masuk;

        $matriks_probabilitas = [
            'nilai_prob_cuaca_hujan_bolos'      => $nilai_probabilitas_hujan_bolos,
            'nilai_prob_cuaca_mendung_bolos'    => $nilai_probabilitas_mendung_bolos,
            'nilai_prob_cuaca_cerah_bolos'      => $nilai_probabilitas_cerah_bolos,

            'nilai_prob_cuaca_hujan_masuk'      => $nilai_probabilitas_hujan_masuk,
            'nilai_prob_cuaca_mendung_masuk'    => $nilai_probabilitas_mendung_masuk,
            'nilai_prob_cuaca_cerah_masuk'      => $nilai_probabilitas_cerah_masuk,

            'nilai_prob_suhu_panas_bolos'       => $nilai_probabilitas_panas_bolos,
            'nilai_prob_suhu_sejuk_bolos'       => $nilai_probabilitas_sejuk_bolos,
            'nilai_prob_suhu_dingin_bolos'      => $nilai_probabilitas_dingin_bolos,

            'nilai_prob_suhu_panas_masuk'       => $nilai_probabilitas_panas_masuk,
            'nilai_prob_suhu_sejuk_masuk'       => $nilai_probabilitas_sejuk_masuk,
            'nilai_prob_suhu_dingin_masuk'      => $nilai_probabilitas_dingin_masuk,

            'nilai_prob_malas_normal_bolos'     => $nilai_probabilitas_normal_bolos,
            'nilai_prob_malas_tinggi_bolos'     => $nilai_probabilitas_tinggi_bolos,

            'nilai_prob_malas_normal_masuk'     => $nilai_probabilitas_normal_masuk,
            'nilai_prob_malas_tinggi_masuk'     => $nilai_probabilitas_tinggi_masuk,

            'nilai_prob_kesiangan_tidak_bolos'  => $nilai_probabilitas_tidak_bolos,
            'nilai_prob_kesiangan_ya_bolos'     => $nilai_probabilitas_ya_bolos,

            'nilai_prob_kesiangan_tidak_masuk'  => $nilai_probabilitas_tidak_masuk,
            'nilai_prob_kesiangan_ya_masuk'     => $nilai_probabilitas_ya_masuk,
        ];

        return $matriks_probabilitas;
    }

    public function priorProbabilitas()
    {
        // mencari jumlah label bolos
        $jumlah_label_bolos = $this->naive_bayes_model->get_count_label('Bolos');
        // mencari jumlah label masuk
        $jumlah_label_masuk = $this->naive_bayes_model->get_count_label('Masuk');
        // total jumlah label
        $jumlah_seluruh_label = $jumlah_label_bolos + $jumlah_label_masuk;
        // mencari prior probabilitas label bolos
        $prior_probabilitas_bolos = $jumlah_label_bolos / $jumlah_seluruh_label;
        // mencari prior probabilitas label masuk
        $prior_probabilitas_masuk = $jumlah_label_masuk / $jumlah_seluruh_label;

        $prior_probabilitas = [
            'bolos'  => $prior_probabilitas_bolos,
            'masuk'  => $prior_probabilitas_masuk,
        ];

        return $prior_probabilitas;
    }

    public function processNaiveBayes($id)
    {
        $matriks_probabilitas = $this->matriksProbabilitas();
        $prior_probabilitas = $this->priorProbabilitas();
        $data_training = $this->data_testing_model->get_data_by_id($id);

        $nilai_prediksi_bolos_cuaca = 0;
        $nilai_prediksi_bolos_suhu = 0;
        $nilai_prediksi_bolos_tingkat_kemalasan = 0;
        $nilai_prediksi_bolos_bangun_siang = 0;

        $nilai_prediksi_masuk_cuaca = 0;
        $nilai_prediksi_masuk_suhu = 0;
        $nilai_prediksi_masuk_tingkat_kemalasan = 0;
        $nilai_prediksi_masuk_bangun_siang = 0;

        $hasil_prediksi = "";

        // pencarian nilai prediksi
        // nilai prediksi bolos berdasarkan cuaca
        if ($data_training['cuaca'] == "Hujan") {
            $nilai_prediksi_bolos_cuaca = $matriks_probabilitas['nilai_prob_cuaca_hujan_bolos'];
        } elseif ($data_training['cuaca'] == "Mendung") {
            $nilai_prediksi_bolos_cuaca = $matriks_probabilitas['nilai_prob_cuaca_mendung_bolos'];
        } else {
            $nilai_prediksi_bolos_cuaca = $matriks_probabilitas['nilai_prob_cuaca_cerah_bolos'];
        }

        // nilai prediksi masuk berdasarkan cuaca
        if ($data_training['cuaca'] == "Hujan") {
            $nilai_prediksi_masuk_cuaca = $matriks_probabilitas['nilai_prob_cuaca_hujan_masuk'];
        } elseif ($data_training['cuaca'] == "Mendung") {
            $nilai_prediksi_masuk_cuaca = $matriks_probabilitas['nilai_prob_cuaca_mendung_masuk'];
        } else {
            $nilai_prediksi_masuk_cuaca = $matriks_probabilitas['nilai_prob_cuaca_cerah_masuk'];
        }


        // nilai prediksi bolos berdasarkan suhu
        if ($data_training['suhu'] == "Panas") {
            $nilai_prediksi_bolos_suhu = $matriks_probabilitas['nilai_prob_suhu_panas_bolos'];
        } elseif ($data_training['suhu'] == "Sejuk") {
            $nilai_prediksi_bolos_suhu = $matriks_probabilitas['nilai_prob_suhu_sejuk_bolos'];
        } else {
            $nilai_prediksi_bolos_suhu = $matriks_probabilitas['nilai_prob_suhu_dingin_bolos'];
        }

        // nilai prediksi masuk berdasarkan suhu
        if ($data_training['suhu'] == "Panas") {
            $nilai_prediksi_masuk_suhu = $matriks_probabilitas['nilai_prob_suhu_panas_masuk'];
        } elseif ($data_training['suhu'] == "Sejuk") {
            $nilai_prediksi_masuk_suhu = $matriks_probabilitas['nilai_prob_suhu_sejuk_masuk'];
        } else {
            $nilai_prediksi_masuk_suhu = $matriks_probabilitas['nilai_prob_suhu_dingin_masuk'];
        }

        // nilai prediksi bolos berdasarkan tingkat kemalasan
        if ($data_training['tingkat_malas'] == "Tinggi") {
            $nilai_prediksi_bolos_tingkat_kemalasan = $matriks_probabilitas['nilai_prob_malas_tinggi_bolos'];
        } else {
            $nilai_prediksi_bolos_tingkat_kemalasan = $matriks_probabilitas['nilai_prob_malas_normal_bolos'];
        }

        // nilai prediksi masuk berdasarkan tingkat_kemalasan
        if ($data_training['tingkat_malas'] == "Tinggi") {
            $nilai_prediksi_masuk_tingkat_kemalasan = $matriks_probabilitas['nilai_prob_malas_tinggi_masuk'];
        } else {
            $nilai_prediksi_masuk_tingkat_kemalasan = $matriks_probabilitas['nilai_prob_malas_normal_masuk'];
        }

        // nilai prediksi bolos berdasarkan bangun kesiangan
        if ($data_training['bangun_siang'] == "Ya") {
            $nilai_prediksi_bolos_bangun_siang = $matriks_probabilitas['nilai_prob_kesiangan_ya_bolos'];
        } else {
            $nilai_prediksi_bolos_bangun_siang = $matriks_probabilitas['nilai_prob_kesiangan_tidak_bolos'];
        }

        // nilai prediksi masuk berdasarkan bangun kesiangan
        if ($data_training['bangun_siang'] == "Ya") {
            $nilai_prediksi_masuk_bangun_siang = $matriks_probabilitas['nilai_prob_kesiangan_ya_masuk'];
        } else {
            $nilai_prediksi_masuk_bangun_siang = $matriks_probabilitas['nilai_prob_kesiangan_tidak_masuk'];
        }

        // nilai prediksi bolos akhir
        $nilai_prediksi_bolos_akhir = $prior_probabilitas['bolos'] * $nilai_prediksi_bolos_cuaca
            * $nilai_prediksi_bolos_suhu
            * $nilai_prediksi_bolos_tingkat_kemalasan
            * $nilai_prediksi_bolos_bangun_siang;

        // nilai prediksi masuk akhir
        $nilai_prediksi_masuk_akhir = $prior_probabilitas['masuk'] * $nilai_prediksi_masuk_cuaca
            * $nilai_prediksi_masuk_suhu
            * $nilai_prediksi_masuk_tingkat_kemalasan
            * $nilai_prediksi_masuk_bangun_siang;

        if ($nilai_prediksi_masuk_akhir > $nilai_prediksi_bolos_akhir) {
            $hasil_prediksi = "Masuk";
        } else {
            $hasil_prediksi = "Bolos";
        }

        return $hasil_prediksi;
    }
}
