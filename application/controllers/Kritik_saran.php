<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kritik_saran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Kritik_saran_model' => 'kritiksaran'));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->in_group(2)) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->data['is_user'] = $this->ion_auth->user()->row();
            $id_user = $this->ion_auth->user()->row()->id;
            $this->data['button'] = 'Tambah';
            $this->data['action'] = site_url('kritik_saran/create_action');
            $this->data['id_kritiksaran'] = array(
                'name' => 'id_kritiksaran',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id_kritiksaran'),
                'class' => 'form-control',
            );
            $this->data['id_user'] = array(
                'name' => 'id_user',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id_user', $id_user),
                'class' => 'form-control',
                
            );
            $this->data['kritik'] = array(
                'name' => 'kritik',
                'type' => 'text',
                'value' => $this->form_validation->set_value('kritik'),
                'class' => 'form-control',
                'required'=>'required',
            );
            $this->data['saran'] = array(
                'name' => 'saran',
                'type' => 'text',
                'value' => $this->form_validation->set_value('saran'),
                'class' => 'form-control',
                'required'=>'required',
            );

            $this->data['_view'] = 'kritik_saran/kritik_saran_form';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function list_admin()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
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

            $this->data['is_user'] = $this->ion_auth->user()->row();
            $this->data['_get_kritiksaran'] = $this->kritiksaran->get_join();
            $this->data['_view'] = 'kritik_saran/kritik_saran_list';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function read($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->kritiksaran->get_by_id($id);
            if ($row) {
                $this->data['id_kritiksaran'] = $this->form_validation->set_value('id_kritiksaran', $row->id_kritiksaran);
                $this->data['first_name'] = $this->form_validation->set_value('first_name', $row->first_name);
                $this->data['last_name'] = $this->form_validation->set_value('last_name', $row->last_name);
                $this->data['kritik'] = $this->form_validation->set_value('kritik', $row->kritik);
                $this->data['saran'] = $this->form_validation->set_value('saran', $row->saran);

                $this->data['_view'] = 'kritik_saran/kritik_saran_read';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data tidak ditemukan');
                redirect(site_url('kritik_saran'));
            }
        }
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = array(
            'id_user' => $this->input->post('id_user', true),
            'kritik' => $this->input->post('kritik', true),
            'saran' => $this->input->post('saran', true),
            );

            $this->kritiksaran->insert($data);
            $this->session->set_flashdata('message','Data berhasil ditambahkan');
            redirect(site_url('kritik_saran'));
        }
    }

    public function delete($id)
    {
        $row = $this->kritiksaran->get_by_id($id);

        if ($row) {
            $this->kritiksaran->delete($id);
            $this->session->set_flashdata('message','Hapus data berhasil');
            redirect(site_url('kritik_saran'));
        } else {
            $this->session->set_flashdata('message','Data tidak ditemukan');
            redirect(site_url('kritik_saran'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_user', 'id user', 'trim|required');
        $this->form_validation->set_rules('kritik', 'kritik', 'trim|required');
        $this->form_validation->set_rules('saran', 'saran', 'trim|required');

        $this->form_validation->set_rules('id_kritiksaran', 'id_kritiksaran', 'trim');
        //$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Kritik_saran.php */
/* Location: ./application/controllers/Kritik_saran.php */
