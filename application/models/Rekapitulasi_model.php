<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rekapitulasi_model extends CI_Model
{
    public $table_profil = 'profil';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // get all
    public function get_all()
    {
        $this->db->order_by('profil.id', $this->order);
        $this->db->join('users', 'profil.id_user = users.id');
        $this->db->join('status_alumni', 'profil.id_user = status_alumni.id_user');

        return $this->db->get($this->table_profil)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);

        return $this->db->get($this->table_profil)->row();
    }

    public function get_alumni_by_user_id($id_user = null)
    {
        $this->db->join('users AS t2', 't2.id = t1.id_user');
        $this->db->join('status_alumni AS t3', 't3.id_user = t1.id_user');

        return $this->db->get_where('profil AS t1', array('t1.id_user' => $id_user))->row();
    }
}

/* End of file Rekapitulasi_model.php */
/* Location: ./application/models/Rekapitulasi_model.php */
