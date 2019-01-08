<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Testimoni_model' => 'testimoni', 'Lowongan_model' => 'lowongan', 'Event_model' => 'event', 'Home_model' => 'home', 'Profil_model' => 'profil'));
    }

    public function index()
    {
        $this->data['_get_is_tampil'] = $this->testimoni->get_is_tampil();
        $this->data['_view'] = 'main/mainpage';
        $this->template->_render_page('layouts/frontend', $this->data);
    }

    public function loker()
    {
        $this->data['_get_lowongan'] = $this->lowongan->read_per_month();
        if(!isset($this->data['_get_lowongan'])||empty($this->data['_get_lowongan'])){
            $this->data['message'] = 'Tidak ada Info bulan Ini!';
        }
        $this->data['_view'] = 'main/loker';
        $this->template->_render_page('layouts/frontend', $this->data);
    }

    public function loker_detail($slug)
    {
        $row = $this->lowongan->read_slug($slug);
        if ($row) {
            $this->data['id'] = $this->form_validation->set_value('id', $row->id);
            $this->data['nama_perusahaan'] = $this->form_validation->set_value('nama_perusahaan', $row->nama_perusahaan);
            $this->data['job_title'] = $this->form_validation->set_value('job_title', $row->job_title);
            $this->data['job_slug'] = $this->form_validation->set_value('job_slug', $row->job_slug);
            $this->data['deskripsi'] = $this->form_validation->set_value('deskripsi', $row->deskripsi);
            $this->data['tanggal_posting'] = $this->form_validation->set_value('tanggal_posting', $row->tanggal_posting);
            $this->data['title'] = humanize(implode(' | ', array($this->template->set_app_name(), $row->job_title)));
            $this->data['_view'] = 'main/loker_read';
            $this->template->_render_page('layouts/frontend', $this->data);
        }
    }

    public function event_detail($slug)
    {
        $row = $this->event->read_slug($slug);
        if ($row) {
            $this->data['id'] = $this->form_validation->set_value('id', $row->id);
            $this->data['nama_event'] = $this->form_validation->set_value('nama_event', $row->nama_event);
            $this->data['event_title'] = $this->form_validation->set_value('event_title', $row->event_title);
            $this->data['event_slug'] = $this->form_validation->set_value('event_slug', $row->event_slug);
            $this->data['deskripsi'] = $this->form_validation->set_value('deskripsi', $row->deskripsi);
            $this->data['tanggal_posting'] = $this->form_validation->set_value('tanggal_posting', $row->tanggal_posting);
            $this->data['title'] = humanize(implode(' | ', array($this->template->set_app_name(), $row->event_title)));
            $this->data['_view'] = 'main/kegiatan_read';
            $this->template->_render_page('layouts/frontend', $this->data);
        }
    }

    public function lulusan()
    {
        //partial
        $this->data['_partial_css'] = '<link href="'.base_url('assets/frontend').'/css/responsive-table.css" rel="stylesheet">';
        $this->data['_partial_js'] = '<script src="'.base_url('assets/backend').'/js/responsive-table.js"></script>';
        //partial
        $this->data['keyword'] = $this->input->post('keyword');
        if (empty($this->data['keyword']) || !isset($this->data['keyword'])) {
            $this->data['message'] = '<h2>Anda Belum Mengisi Apapun!</h2>';
        } else {
            $keyword = $this->data['keyword'];
            $this->data['_get_keyword'] = $this->profil->getSearchKeyword($keyword);
            if (empty($this->data['_get_keyword']) || !isset($this->data['_get_keyword'])) {
                $this->data['message'] = '<h2>Inputan anda tidak sesuai atau data tidak ditemukan!</h2>';
            }
        }

        $this->data['_view'] = 'main/alumni';

        $this->template->_render_page('layouts/frontend', $this->data);
    }

    public function detail_pencarian($id_user)
    {
        //partial
        $this->data['_partial_css'] = '<link href="'.base_url('assets/frontend').'/css/responsive-table.css" rel="stylesheet">';
        $this->data['_partial_js'] = '<script src="'.base_url('assets/backend').'/js/responsive-table.js"></script>';
        //partial
        $detail = $this->profil->get_alumni_by_user_id($id_user);
        if ($detail) {
            $this->data['first_name'] = set_value('first_name', $detail->first_name);
            $this->data['last_name'] = set_value('last_name', $detail->last_name);
            $this->data['nisn'] = set_value('nisn', $detail->nisn);
            $this->data['jenis_kelamin'] = set_value('jenis_kelamin', $detail->jenis_kelamin);
            $this->data['tahun_lulus'] = set_value('tahun_lulus', $detail->tahun_lulus);
            $this->data['no_ijazah'] = set_value('no_ijazah', $detail->no_ijazah);
            $this->data['no_skhun'] = set_value('no_skhun', $detail->no_skhun);
        }
        $this->data['_view'] = 'main/detail_alumni';

        $this->template->_render_page('layouts/frontend', $this->data);
    }

    public function kegiatan()
    {
        $this->data['_get_event'] = $this->event->read_per_month();
        if(!isset($this->data['_get_event'])||empty($this->data['_get_event'])){
            $this->data['message'] = 'Tidak ada Info bulan Ini!';
        }
        $this->data['_view'] = 'main/kegiatan';
        $this->template->_render_page('layouts/frontend', $this->data);
    }

    public function about()
    {
        $this->data['_view'] = 'main/about';
        $this->template->_render_page('layouts/frontend', $this->data);
    }
}
