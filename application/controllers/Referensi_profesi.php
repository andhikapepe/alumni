<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Referensi_profesi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Referensi_profesi_model' => 'profesi'));
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
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
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
            $this->data['_get_ref'] = $this->profesi->get_all();
            $this->data['_view'] = 'referensi_profesi/referensi_profesi_list';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function tambah_data()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['is_user'] = $this->ion_auth->user()->row();

            $this->data['button'] = 'Tambah';
            $this->data['action'] = site_url('referensi_profesi/tambah_data_aksi');
            $this->data['id_profesi'] = array(
                'name' => 'id_profesi',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id_profesi'),
            );
            $this->data['nama_profesi'] = array(
                'name' => 'nama_profesi',
                'type' => 'text',
                'value' => $this->form_validation->set_value('nama_profesi'),
                'class' => 'form-control',
            );

            $this->data['_view'] = 'referensi_profesi/referensi_profesi_form';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function tambah_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->tambah_data();
        } else {
            $data = array(
            'nama_profesi' => $this->input->post('nama_profesi', true),
            );

            $this->profesi->insert($data);
            $this->session->set_flashdata('message','Data berhasil ditambahkan');
            redirect(site_url('referensi_profesi'));
        }
    }

    public function ubah_data($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->profesi->get_by_id($id);

            if ($row) {
                $this->data['button'] = 'Ubah';
                $this->data['action'] = site_url('referensi_profesi/ubah_data_aksi');
                $this->data['id_profesi'] = array(
                    'name' => 'id_profesi',
                    'type' => 'hidden',
                    'value' => $this->form_validation->set_value('id_profesi', $row->id_profesi),
                );
                $this->data['nama_profesi'] = array(
                    'name' => 'nama_profesi',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('nama_profesi', $row->nama_profesi),
                    'class' => 'form-control',
                );

                $this->data['_view'] = 'referensi_profesi/referensi_profesi_form';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data Tidak Ditemukan');
                redirect(site_url('referensi_profesi'));
            }
        }
    }

    public function ubah_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->ubah_data($this->input->post('id_profesi', true));
        } else {
            $data = array(
                'nama_profesi' => $this->input->post('nama_profesi', true),
            );

            $this->profesi->update($this->input->post('id_profesi', true), $data);
            $this->session->set_flashdata('message','Data berhasil di ubah');
            redirect(site_url('referensi_profesi'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_profesi', 'nama profesi', 'trim|required');

        $this->form_validation->set_rules('id_profesi', 'id_profesi', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Referensi_profesi.php */
/* Location: ./application/controllers/Referensi_profesi.php */
