<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * class referensi tahun
 * dikembangkan Andhika Putra Pratama.
 */
class Referensi_tahun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('Referensi_tahun_model' => 'referensi_tahun'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
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
            // set the flash data error message if there is one
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
            $this->data['_get_ref'] = $this->referensi_tahun->get_all();
            $this->data['_view'] = 'referensi_tahun/referensi_tahun_list';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function create()
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
            $this->data['action'] = site_url('referensi_tahun/create_action');
            $this->data['id'] = array(
                'name' => 'id',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id'),
                'class' => 'form-control',
            );
            $this->data['ref_tahun'] = array(
                'name' => 'ref_tahun',
                'type' => 'text',
                'value' => $this->form_validation->set_value('ref_tahun'),
                'class' => 'form-control',
                'required' => 'required',
                'autofocus' => 'autofocus',
            );

            $this->data['_view'] = 'referensi_tahun/referensi_tahun_form';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
        'ref_tahun' => $this->input->post('ref_tahun', true),
        );

            $this->referensi_tahun->insert($data);

            $this->session->set_flashdata('message', 'Data berhasil ditambahkan');
            redirect(site_url('referensi_tahun'));
        }
    }

    public function update($id)
    {
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->referensi_tahun->get_by_id($id);

            if ($row) {
                $this->data['button'] = 'Ubah';
                $this->data['action'] = site_url('referensi_tahun/update_action');
                $this->data['id'] = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $this->form_validation->set_value('id', $row->id),
                    'class' => 'form-control',
                );
                $this->data['ref_tahun'] = array(
                    'name' => 'ref_tahun',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('ref_tahun', $row->ref_tahun),
                    'class' => 'form-control',
                    'required' => 'required',
                    'autofocus' => 'autofocus',
                );

                $this->data['_view'] = 'referensi_tahun/referensi_tahun_form';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
                redirect(site_url('referensi_tahun'));
            }
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
            'ref_tahun' => $this->input->post('ref_tahun', true),
        );

            $this->referensi_tahun->update($this->input->post('id', true), $data);

            $this->session->set_flashdata('message','Data berhasil di ubah');
            redirect(site_url('referensi_tahun'));
        }
    }

    public function delete($id)
    {
        $row = $this->referensi_tahun->get_by_id($id);

        if ($row) {
            $this->referensi_tahun->delete($id);

            $this->session->set_flashdata('message', 'Hapus data berhasil');
            redirect(site_url('referensi_tahun'));
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('referensi_tahun'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('ref_tahun', 'ref tahun', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        //$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Referensi_tahun.php */
/* Location: ./application/controllers/Referensi_tahun.php */
