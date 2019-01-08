<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Event_model' => 'event'));
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
            $this->data['_get_event'] = $this->event->read_per_month();
            if(!isset($this->data['_get_event'])||empty($this->data['_get_event'])){
                $this->session->set_flashdata('message','Tidak ada Info Kegiatan bulan Ini!');
            }
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $this->data['_view'] = 'event/event_list';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function list_admin()
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            redirect('auth', 'refresh');
        }
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['is_user'] = $this->ion_auth->user()->row();
        $this->data['_get_event'] = $this->event->get_all();

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
        $this->data['_view'] = 'event/event_admin_list';
        $this->template->_render_page('layouts/backend', $this->data);
    }

    public function read($slug)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->event->read_slug($slug);
            if ($row) {
                $this->data['id'] = $this->form_validation->set_value('id', $row->id);
                $this->data['nama_event'] = $this->form_validation->set_value('nama_event', $row->nama_event);
                $this->data['event_title'] = $this->form_validation->set_value('event_title', $row->event_title);
                $this->data['event_slug'] = $this->form_validation->set_value('event_slug', $row->event_slug);
                $this->data['deskripsi'] = $this->form_validation->set_value('deskripsi', $row->deskripsi);
                $this->data['tanggal_posting'] = $this->form_validation->set_value('tanggal_posting', $row->tanggal_posting);

                $this->data['title'] = humanize(implode(' | ', array($this->template->set_app_name(), $row->event_title)));
                $this->data['_view'] = 'event/event_read';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data tidak ditemukan');
                redirect(site_url('event'));
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
            $this->data['action'] = site_url('event/tambah_aksi');
            $this->data['id'] = array(
                'name' => 'id',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id'),
                'class' => 'form-control',
            );
            $this->data['nama_event'] = array(
                'name' => 'nama_event',
                'type' => 'text',
                'value' => $this->form_validation->set_value('nama_event'),
                'class' => 'form-control',
            );
            $this->data['event_title'] = array(
                'name' => 'event_title',
                'type' => 'text',
                'value' => $this->form_validation->set_value('event_title'),
                'class' => 'form-control',
            );
            $this->data['deskripsi'] = array(
                'name' => 'deskripsi',
                'type' => 'text',
                'value' => $this->form_validation->set_value('deskripsi'),
                'class' => 'form-control',
            );

            $this->data['_view'] = 'event/event_form';
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
                'nama_event' => $this->input->post('nama_event', true),
                'event_title' => $this->input->post('event_title', true),
                'event_slug' => slug($this->input->post('event_title', true)),
                'deskripsi' => $this->input->post('deskripsi', true),
            );

            $this->event->insert($data);
            $this->session->set_flashdata('message','Data berhasil ditambahkan');
            redirect(site_url('event'));
        }
    }

    public function update($id)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->event->get_by_id($id);

            if ($row) {
                $this->data['button'] = 'Ubah';
                $this->data['action'] = site_url('event/ubah_aksi');
                $this->data['id'] = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $this->form_validation->set_value('id', $row->id),
                    'class' => 'form-control',
                );
                $this->data['nama_event'] = array(
                    'name' => 'nama_event',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('nama_event', $row->nama_event),
                    'class' => 'form-control',
                );
                $this->data['event_title'] = array(
                    'name' => 'event_title',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('event_title', $row->event_title),
                    'class' => 'form-control',
                );
                $this->data['deskripsi'] = array(
                    'name' => 'deskripsi',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('deskripsi', $row->deskripsi),
                    'class' => 'form-control',
                );

                $this->data['_view'] = 'event/event_form';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data Tidak Ditemukan');
                redirect(site_url('event'));
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
            'nama_event' => $this->input->post('nama_event', true),
            'event_title' => $this->input->post('event_title', true),
            'event_slug' => slug($this->input->post('event_title', true)),
            'deskripsi' => $this->input->post('deskripsi', true),
        );

            $this->event->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message','Data berhasil di ubah');
            redirect(site_url('event'));
        }
    }

    public function delete($id)
    {
        $row = $this->event->get_by_id($id);

        if ($row) {
            $this->event->delete($id);
            $this->session->set_flashdata('message','Hapus data berhasil');
            redirect(site_url('event'));
        } else {
            $this->session->set_flashdata('message','Data tidak ditemukan');
            redirect(site_url('event'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_event', 'nama event', 'trim|required');
        $this->form_validation->set_rules('event_title', 'event title', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Event.php */
/* Location: ./application/controllers/Event.php */
