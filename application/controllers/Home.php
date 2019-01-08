<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * class Home
 * dikembangkan Andhika Putra Pratama.
 */
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('Home_model' => 'home'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();
            $user = $this->ion_auth->user()->row()->id;
            $this->data['count_alumni'] = $this->home->count_alumni();
            $this->data['_view'] = 'home/main';

            $this->data['group'] = $this->ion_auth->get_users_groups($user)->row()->name;
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }
}
