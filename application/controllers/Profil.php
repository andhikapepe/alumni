<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Profil_model' => 'profil', 'Status_alumni_model' => 'status'));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->in_group(2)) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        }

        $id = $this->ion_auth->user()->row()->id;
        $user = $this->ion_auth->user($id)->row();

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
        $this->form_validation->set_rules('email', $this->lang->line('edit_user_email_label'), 'trim|required|valid_email');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === false || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === true) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

                    redirect('profil', 'refresh');
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('profil', 'refresh');
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
            'class' => 'form-control',
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
            'class' => 'form-control',
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email', $user->email),
            'class' => 'form-control',
        );

        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control',
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'class' => 'form-control',
        );

        $this->data['is_user'] = $this->ion_auth->user()->row();
        $this->data['_view'] = 'profil/main_profil';
        $this->template->_render_page('layouts/backend', $this->data);
    }

    public function profil_user()
    {
        $id_user = $this->ion_auth->user()->row()->id;
        $num_rows = $this->profil->get_num_rows($id_user)->num_rows();
        //echo $this->profil->get_num_rows($id_user)->row()->id;
        if ($num_rows == 1) {
            $id_profil = $this->profil->get_num_rows($id_user)->row()->id;
            redirect('profil/profil_ubah_data/'.$id_profil.'', 'refresh');
        } else {
            redirect('profil/profil_tambah_data', 'refresh');
        }
    }

    public function status_alumni()
    {
        $id_user = $this->ion_auth->user()->row()->id;
        $num_rows = $this->status->get_num_rows($id_user)->num_rows();
        //echo $this->status->get_num_rows($id_user)->row()->id;
        if ($num_rows == 1) {
            $id_status = $this->status->get_num_rows($id_user)->row()->id;
            redirect('profil/status_alumni_ubah_data/'.$id_status.'', 'refresh');
        } else {
            redirect('profil/status_alumni_tambah_data', 'refresh');
        }
    }

    public function profil_tambah_data()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->in_group(2)) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();
            $id_user = $this->ion_auth->user()->row()->id;
            $this->data['button'] = 'Tambah';
            $this->data['action'] = site_url('profil/profil_tambah_data_aksi');
            $this->data['id'] = array(
                'name' => 'id',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id'),
            );
            $this->data['id_user'] = array(
                'name' => 'id_user',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id_user', $id_user),
            );
            $this->data['jenis_kelamin'] = array(
                'name' => 'jenis_kelamin',
                'type' => 'text',
                'value' => $this->form_validation->set_value('jenis_kelamin'),
                'class' => 'form-control show-tick',
                'required' => 'required',
            );
            $this->data['tempat_lahir'] = array(
                'name' => 'tempat_lahir',
                'type' => 'text',
                'value' => $this->form_validation->set_value('tempat_lahir'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['tanggal_lahir'] = array(
                'name' => 'tanggal_lahir',
                'type' => 'date',
                'value' => $this->form_validation->set_value('tanggal_lahir'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['nisn'] = array(
                'name' => 'nisn',
                'type' => 'text',
                'value' => $this->form_validation->set_value('nisn'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['alamat'] = array(
                'name' => 'alamat',
                'type' => 'text',
                'value' => $this->form_validation->set_value('alamat'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['no_telp'] = array(
                'name' => 'no_telp',
                'type' => 'text',
                'value' => $this->form_validation->set_value('no_telp'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['nama_ayah'] = array(
                'name' => 'nama_ayah',
                'type' => 'text',
                'value' => $this->form_validation->set_value('nama_ayah'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['pekerjaan_ayah'] = array(
                'name' => 'pekerjaan_ayah',
                'type' => 'text',
                'value' => $this->form_validation->set_value('pekerjaan_ayah'),
                'class' => 'form-control',
                'required' => 'required',
                'data-live-search' => 'true',
            );
            $this->data['nama_ibu'] = array(
                'name' => 'nama_ibu',
                'type' => 'text',
                'value' => $this->form_validation->set_value('nama_ibu'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['pekerjaan_ibu'] = array(
                'name' => 'pekerjaan_ibu',
                'type' => 'text',
                'value' => $this->form_validation->set_value('pekerjaan_ibu'),
                'class' => 'form-control',
                'required' => 'required',
                'data-live-search' => 'true',
            );
            $this->data['tahun_masuk'] = array(
                'name' => 'tahun_masuk',
                'type' => 'text',
                'value' => $this->form_validation->set_value('tahun_masuk'),
                'class' => 'form-control show-tick',
                'required' => 'required',
                'data-live-search' => 'true',
            );
            $this->data['tahun_lulus'] = array(
                'name' => 'tahun_lulus',
                'type' => 'text',
                'value' => $this->form_validation->set_value('tahun_lulus'),
                'class' => 'form-control show-tick',
                'required' => 'required',
                'data-live-search' => 'true',
            );
            $this->data['no_ijazah'] = array(
                'name' => 'no_ijazah',
                'type' => 'text',
                'value' => $this->form_validation->set_value('no_ijazah'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['no_skhun'] = array(
                'name' => 'no_skhun',
                'type' => 'text',
                'value' => $this->form_validation->set_value('no_skhun'),
                'class' => 'form-control',
                'required' => 'required',
            );
            $this->data['_ref_tahun'] = $this->profil->get_ref_tahun();
            $this->data['_ref_pekerjaan'] = $this->profil->get_ref_pekerjaan();

            $this->data['_partial_css'] = '<!-- Bootstrap Select Css -->
            <link href="'.base_url('assets/backend').'/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
            $this->data['_partial_js'] = '<!-- Select Plugin Js -->
            <script src="'.base_url('assets/backend').'/plugins/bootstrap-select/js/bootstrap-select.js"></script>';

            $this->data['_view'] = 'profil/profil_form';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function profil_tambah_data_aksi()
    {
        $this->_profil_rules();

        if ($this->form_validation->run() == false) {
            $this->profil_tambah_data();
        } else {
            
            $data = array(
            'id_user' => $this->input->post('id_user', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
            'nisn' => $this->input->post('nisn', true),
            'alamat' => $this->input->post('alamat', true),
            'no_telp' => $this->input->post('no_telp', true),
            'nama_ayah' => $this->input->post('nama_ayah', true),
            'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah', true),
            'nama_ibu' => $this->input->post('nama_ibu', true),
            'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu', true),
            'tahun_masuk' => $this->input->post('tahun_masuk', true),
            'tahun_lulus' => $this->input->post('tahun_lulus', true),
            'no_ijazah' => $this->input->post('no_ijazah', true),
            'no_skhun' => $this->input->post('no_skhun', true),
            );

            $this->profil->insert($data);
            if($this->profil->insert($data)){
                $this->session->set_flashdata('message','Data berhasil ditambahkan');
            }
            
            redirect(site_url('profil/status_alumni_tambah_data'));
        }
    }

    public function profil_ubah_data($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->in_group(2)) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['_ref_tahun'] = $this->profil->get_ref_tahun();
            $this->data['_ref_pekerjaan'] = $this->profil->get_ref_pekerjaan();

            $this->data['is_user'] = $this->ion_auth->user()->row();
            $id_user = $this->ion_auth->user()->row()->id;
            $row = $this->profil->get_by_id($id);

            if ($row) {
                $this->data['button'] = 'Ubah';
                $this->data['action'] = site_url('profil/profil_ubah_data_aksi');
                $this->data['id'] = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $this->form_validation->set_value('id', $row->id),
                );
                $this->data['id_user'] = array(
                    'name' => 'id_user',
                    'type' => 'hidden',
                    'value' => $this->form_validation->set_value('id_user', $id_user),
                );
                $this->data['jenis_kelamin'] = array(
                    'name' => 'jenis_kelamin',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('jenis_kelamin', $row->jenis_kelamin),
                    'class' => 'form-control show-tick',
                    'required' => 'required',
                );
                $this->data['tempat_lahir'] = array(
                    'name' => 'tempat_lahir',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('tempat_lahir',$row->tempat_lahir),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['tanggal_lahir'] = array(
                    'name' => 'tanggal_lahir',
                    'type' => 'date',
                    'value' => $this->form_validation->set_value('tanggal_lahir',$row->tanggal_lahir),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['nisn'] = array(
                    'name' => 'nisn',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('nisn', $row->nisn),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['alamat'] = array(
                    'name' => 'alamat',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('alamat', $row->alamat),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['no_telp'] = array(
                    'name' => 'no_telp',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('no_telp', $row->no_telp),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['nama_ayah'] = array(
                    'name' => 'nama_ayah',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('nama_ayah', $row->nama_ayah),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['pekerjaan_ayah'] = array(
                    'name' => 'pekerjaan_ayah',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('pekerjaan_ayah', $row->pekerjaan_ayah),
                    'class' => 'form-control',
                    'required' => 'required',
                    'data-live-search' => 'true',
                );
                $this->data['nama_ibu'] = array(
                    'name' => 'nama_ibu',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('nama_ibu', $row->nama_ibu),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['pekerjaan_ibu'] = array(
                    'name' => 'pekerjaan_ibu',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('pekerjaan_ibu', $row->pekerjaan_ibu),
                    'class' => 'form-control',
                    'required' => 'required',
                    'data-live-search' => 'true',
                );
                $this->data['tahun_masuk'] = array(
                    'name' => 'tahun_masuk',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('tahun_masuk', $row->tahun_masuk),
                    'class' => 'form-control show-tick',
                    'required' => 'required',
                    'data-live-search' => 'true',
                );
                $this->data['tahun_lulus'] = array(
                    'name' => 'tahun_lulus',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('tahun_lulus', $row->tahun_lulus),
                    'class' => 'form-control show-tick',
                    'required' => 'required',
                    'data-live-search' => 'true',
                );
                $this->data['no_ijazah'] = array(
                    'name' => 'no_ijazah',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('no_ijazah', $row->no_ijazah),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['no_skhun'] = array(
                    'name' => 'no_skhun',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('no_skhun', $row->no_skhun),
                    'class' => 'form-control',
                    'required' => 'required',
                );

                $this->data['_partial_css'] = '<!-- Bootstrap Select Css -->
                <link href="'.base_url('assets/backend').'/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
                $this->data['_partial_js'] = '<!-- Select Plugin Js -->
                <script src="'.base_url('assets/backend').'/plugins/bootstrap-select/js/bootstrap-select.js"></script>';

                $this->data['_view'] = 'profil/profil_form';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data Tidak Ditemukan');
                redirect(site_url('profil/profil_user'));
            }
        }
    }

    public function profil_ubah_data_aksi()
    {
        $this->_profil_rules();

        if ($this->form_validation->run() == false) {
            $this->profil_ubah_data($this->input->post('id', true));
        } else {
            $data = array(
            'id_user' => $this->input->post('id_user', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
            'nisn' => $this->input->post('nisn', true),
            'alamat' => $this->input->post('alamat', true),
            'no_telp' => $this->input->post('no_telp', true),
            'nama_ayah' => $this->input->post('nama_ayah', true),
            'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah', true),
            'nama_ibu' => $this->input->post('nama_ibu', true),
            'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu', true),
            'tahun_masuk' => $this->input->post('tahun_masuk', true),
            'tahun_lulus' => $this->input->post('tahun_lulus', true),
            'no_ijazah' => $this->input->post('no_ijazah', true),
            'no_skhun' => $this->input->post('no_skhun', true),
        );

            $this->profil->update($this->input->post('id', true), $data);
            if($this->profil->update($this->input->post('id', true), $data)){
                $this->session->set_flashdata('message','Data berhasil di ubah');
            }
            
            redirect(site_url('profil/profil_user'));
        }
    }

    public function status_alumni_tambah_data()
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
            $this->data['action'] = site_url('profil/status_alumni_tambah_data_aksi');
            $this->data['id'] = array(
                'name' => 'id',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id'),
            );
            $this->data['id_user'] = array(
                'name' => 'id_user',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id_user', $id_user),
            );
            $this->data['status'] = array(
                'name' => 'status',
                'type' => 'text',
                'value' => $this->form_validation->set_value('status'),
                'class' => 'form-control show-tick',
                'required' => 'required',
            );
            $this->data['deskripsi'] = array(
                'name' => 'deskripsi',
                'type' => 'text',
                'value' => $this->form_validation->set_value('deskripsi'),
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Isikan dengan status anda yang sekarang. Misal jika anda bekerja, sebutkan dan jelaskan dimana lokasi anda bekerja, di posisi apa anda bekerja, dan berapa lama anda telah bekerja. deskripsikan segala sesuatu yang anda anggap penting kepada kami, karena hal ini dapat memudahkan kami dalam melakukan tracing alumni.',
            );

            $this->data['_partial_css'] = '<!-- Bootstrap Select Css -->
            <link href="'.base_url('assets/backend').'/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
            $this->data['_partial_js'] = '<!-- Select Plugin Js -->
            <script src="'.base_url('assets/backend').'/plugins/bootstrap-select/js/bootstrap-select.js"></script>';

            $this->data['_view'] = 'profil/status_alumni_form';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function status_alumni_tambah_data_aksi()
    {
        $this->_rules_status_alumni();

        if ($this->form_validation->run() == false) {
            $this->status_alumni_tambah_data();
        } else {
            $data = array(
            'id_user' => $this->input->post('id_user', true),
            'status' => $this->input->post('status', true),
            'deskripsi' => $this->input->post('deskripsi', true),
            );

            $this->status->insert($data);
            if($this->status->insert($data)){
                $this->session->set_flashdata('message','Data berhasil ditambahkan');
            }
           
            redirect(site_url('profil'));
        }
    }

    public function status_alumni_ubah_data($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->in_group(2)) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();
            $id_user = $this->ion_auth->user()->row()->id;
            $row = $this->status->get_by_id($id);

            if ($row) {
                $this->data['button'] = 'Ubah';
                $this->data['action'] = site_url('profil/status_alumni_ubah_data_aksi');
                $this->data['id'] = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $this->form_validation->set_value('id', $row->id),
                );
                $this->data['id_user'] = array(
                    'name' => 'id_user',
                    'type' => 'hidden',
                    'value' => $this->form_validation->set_value('id_user', $id_user),
                );
                $this->data['status'] = array(
                    'name' => 'status',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('status', $row->status),
                    'class' => 'form-control',
                    'required' => 'required',
                );
                $this->data['deskripsi'] = array(
                    'name' => 'deskripsi',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('deskripsi', $row->deskripsi),
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Isikan dengan status anda yang sekarang. Misal jika anda bekerja, sebutkan dan jelaskan dimana lokasi anda bekerja, di posisi apa anda bekerja, dan berapa lama anda telah bekerja. deskripsikan segala sesuatu yang anda anggap penting kepada kami, karena hal ini dapat memudahkan kami dalam melakukan tracing alumni.',
                );

                $this->data['_partial_css'] = '<!-- Bootstrap Select Css -->
				<link href="'.base_url('assets/backend').'/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
                $this->data['_partial_js'] = '<!-- Select Plugin Js -->
				<script src="'.base_url('assets/backend').'/plugins/bootstrap-select/js/bootstrap-select.js"></script>';

                $this->data['_view'] = 'profil/status_alumni_form';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message','Data Tidak Ditemukan');
                redirect(site_url('profil/status_alumni'));
            }
        }
    }

    public function status_alumni_ubah_data_aksi()
    {
        $this->_rules_status_alumni();

        if ($this->form_validation->run() == false) {
            $this->status_alumni_ubah_data($this->input->post('id', true));
        } else {
            $data = array(
            'id_user' => $this->input->post('id_user', true),
            'status' => $this->input->post('status', true),
            'deskripsi' => $this->input->post('deskripsi', true),
        );

            $this->status->ubah_data($this->input->post('id', true), $data);
            if($this->status->ubah_data($this->input->post('id', true), $data)){
                $this->session->set_flashdata('message','Data berhasil di ubah');
            }
            
            redirect(site_url('profil/status_alumni'));
        }
    }

    /**
     * @return array A CSRF key-value pair
     */
    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    /**
     * @return bool Whether the posted CSRF token matches
     */
    public function _valid_csrf_nonce()
    {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
            return true;
        }

        return false;
    }

    public function _profil_rules()
    {
        $this->form_validation->set_rules('id_user', 'id user', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('nisn', 'nisn', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
        $this->form_validation->set_rules('nama_ayah', 'nama ayah', 'trim|required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'pekerjaan ayah', 'trim|required');
        $this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
        $this->form_validation->set_rules('pekerjaan_ibu', 'pekerjaan ibu', 'trim|required');
        $this->form_validation->set_rules('tahun_masuk', 'tahun masuk', 'trim|required');
        $this->form_validation->set_rules('tahun_lulus', 'tahun lulus', 'trim|required');
        $this->form_validation->set_rules('no_ijazah', 'no ijazah', 'trim|required');
        $this->form_validation->set_rules('no_skhun', 'no skhun', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_status_alumni()
    {
        $this->form_validation->set_rules('id_user', 'id user', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */
