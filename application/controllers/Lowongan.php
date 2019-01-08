<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lowongan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Lowongan_model' => 'lowongan'));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->in_group(2))) {
            redirect('auth', 'refresh');
        }
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['_get_lowongan'] = $this->lowongan->read_per_month();
        if(!isset($this->data['_get_lowongan'])||empty($this->data['_get_lowongan'])){
            $this->session->set_flashdata('message','Tidak ada Info Lowongan bulan Ini!');
        }
        $this->data['is_user'] = $this->ion_auth->user()->row();

        $this->data['_view'] = 'lowongan/lowongan_list';
        $this->template->_render_page('layouts/backend', $this->data);
    }

    public function list_admin()
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            redirect('auth', 'refresh');
        }
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['is_user'] = $this->ion_auth->user()->row();
        $this->data['_get_lowongan'] = $this->lowongan->get_all();
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

        $this->data['_view'] = 'lowongan/lowongan_admin_list';
        $this->template->_render_page('layouts/backend', $this->data);
    }

    public function read($slug)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->lowongan->read_slug($slug);
            if ($row) {
                $this->data['id'] = $this->form_validation->set_value('id', $row->id);
                $this->data['nama_perusahaan'] = $this->form_validation->set_value('nama_perusahaan', $row->nama_perusahaan);
                $this->data['job_title'] = $this->form_validation->set_value('job_title', $row->job_title);
                $this->data['job_slug'] = $this->form_validation->set_value('job_slug', $row->job_slug);
                $this->data['deskripsi'] = $this->form_validation->set_value('deskripsi', $row->deskripsi);
                $this->data['tanggal_posting'] = $this->form_validation->set_value('tanggal_posting', $row->tanggal_posting);

                $this->data['_view'] = 'lowongan/lowongan_read';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data tidak ditemukan');
                if ($this->ion_auth->is_admin()) {
                    redirect(site_url('lowongan/list_admin'));
                } else {
                    redirect(site_url('lowongan'));
                }
            }
        }
    }

    public function create()
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $this->data['button'] = 'Tambah';
            $this->data['action'] = site_url('lowongan/tambah_aksi');
            $this->data['id'] = array(
                'name' => 'id',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['nama_perusahaan'] = array(
                'name' => 'nama_perusahaan',
                'type' => 'text',
                'value' => $this->form_validation->set_value('nama_perusahaan'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['job_title'] = array(
                'name' => 'job_title',
                'type' => 'text',
                'value' => $this->form_validation->set_value('job_title'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['deskripsi'] = array(
                'name' => 'deskripsi',
                'type' => 'text',
                'value' => $this->form_validation->set_value('deskripsi'),
                'class' => 'form-control',
                'required' => 'required',
            );

            $this->data['_view'] = 'lowongan/lowongan_form';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
            'nama_perusahaan' => $this->input->post('nama_perusahaan', true),
            'job_title' => $this->input->post('job_title', true),
            'job_slug' => slug($this->input->post('job_title', true)),
            'deskripsi' => $this->input->post('deskripsi', true),
            );

            $this->lowongan->insert($data);
            $this->session->set_flashdata('message','Data berhasil ditambahkan');
            redirect(site_url('lowongan/list_admin'));
        }
    }

    public function update($id)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->lowongan->get_by_id($id);

            if ($row) {
                $this->data['button'] = 'Ubah';
                $this->data['action'] = site_url('lowongan/ubah_aksi');
                $this->data['id'] = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $this->form_validation->set_value('id', $row->id),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['nama_perusahaan'] = array(
                    'name' => 'nama_perusahaan',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('nama_perusahaan', $row->nama_perusahaan),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['job_title'] = array(
                    'name' => 'job_title',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('job_title', $row->job_title),
                    'class' => 'form-control',
                    'required' => 'required',
                );

                $this->data['deskripsi'] = array(
                    'name' => 'deskripsi',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('deskripsi', $row->deskripsi),
                    'class' => 'form-control',
                    'required' => 'required',
                );

                $this->data['_view'] = 'lowongan/lowongan_form';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data Tidak Ditemukan');
                redirect(site_url('lowongan'));
            }
        }
    }

    public function ubah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
            'nama_perusahaan' => $this->input->post('nama_perusahaan', true),
            'job_title' => $this->input->post('job_title', true),
            'job_slug' => slug($this->input->post('job_title', true)),
            'deskripsi' => $this->input->post('deskripsi', true),
        );

            $this->lowongan->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message','Data berhasil di ubah');
            redirect(site_url('lowongan/list_admin'));
        }
    }

    public function delete($id)
    {
        $row = $this->lowongan->get_by_id($id);

        if ($row) {
            $this->lowongan->delete($id);
            $this->session->set_flashdata('message','Hapus data berhasil');
            redirect(site_url('lowongan'));
        } else {
            $this->session->set_flashdata('message','Data tidak ditemukan');
            redirect(site_url('lowongan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required');
        $this->form_validation->set_rules('job_title', 'job title', 'trim|required');
        $this->form_validation->set_rules('job_slug', 'job slug', 'trim');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        //$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Lowongan.php */
/* Location: ./application/controllers/Lowongan.php */
