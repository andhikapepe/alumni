<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rekapitulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Rekapitulasi_model' => 'rekapitulasi'));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['is_user'] = $this->ion_auth->user()->row();
            //partial datatable
            $this->data['_partial_css'] = '<!-- JQuery DataTable Css -->
             <link href="'.base_url('assets/backend').'/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">';
            $this->data['_partial_js'] = '<!-- Jquery DataTable Plugin Js -->
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/jquery.dataTables.js"></script>
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
             <script src="'.base_url('assets/backend').'/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
             <!-- Custom Js -->
             <script src="'.base_url('assets/backend').'/js/pages/tables/jquery-datatable.js"></script>
             ';
            //end partial
            $this->data['get_all'] = $this->rekapitulasi->get_all();
            $this->data['title'] = humanize(implode(' | ', array($this->template->set_app_name(), 'Rekapitulasi Data Alumni')));

            $this->data['_view'] = 'rekapitulasi/rekapitulasi_list';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function detail($id_user)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->rekapitulasi->get_alumni_by_user_id($id_user);
            if ($row) {
                $this->data['nisn'] = $this->form_validation->set_value('nisn', $row->nisn);
                $this->data['first_name'] = $this->form_validation->set_value('first_name', $row->first_name);
                $this->data['last_name'] = $this->form_validation->set_value('last_name', $row->last_name);
                $this->data['jenis_kelamin'] = $this->form_validation->set_value('jenis_kelamin', $row->jenis_kelamin);
                $this->data['tempat_lahir'] = $this->form_validation->set_value('tempat_lahir', $row->tempat_lahir);
                $this->data['tanggal_lahir'] = $this->form_validation->set_value('tanggal_lahir', $row->tanggal_lahir);
                $this->data['alamat'] = $this->form_validation->set_value('alamat', $row->alamat);
                $this->data['no_telp'] = $this->form_validation->set_value('no_telp', $row->no_telp);
                $this->data['nama_ayah'] = $this->form_validation->set_value('nama_ayah', $row->nama_ayah);
                $this->data['pekerjaan_ayah'] = $this->form_validation->set_value('pekerjaan_ayah', $row->pekerjaan_ayah);
                $this->data['nama_ibu'] = $this->form_validation->set_value('nama_ibu', $row->nama_ibu);
                $this->data['pekerjaan_ibu'] = $this->form_validation->set_value('pekerjaan_ibu', $row->pekerjaan_ibu);
                $this->data['tahun_masuk'] = $this->form_validation->set_value('tahun_masuk', $row->tahun_masuk);
                $this->data['tahun_lulus'] = $this->form_validation->set_value('tahun_lulus', $row->tahun_lulus);
                $this->data['no_ijazah'] = $this->form_validation->set_value('no_ijazah', $row->no_ijazah);
                $this->data['no_skhun'] = $this->form_validation->set_value('no_skhun', $row->no_skhun);
                $this->data['status'] = $this->form_validation->set_value('status', $row->status);
                $this->data['deskripsi'] = $this->form_validation->set_value('deskripsi', $row->deskripsi);

                $this->data['_view'] = 'rekapitulasi/rekapitulasi_read';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data tidak ditemukan');
                redirect(site_url('rekapitulasi'));
            }
        }
    }
}

/* End of file Rekapitulasi.php */
/* Location: ./application/controllers/Rekapitulasi.php */
