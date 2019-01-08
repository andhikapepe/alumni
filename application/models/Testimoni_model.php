<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Testimoni_model extends CI_Model
{
    public $table = 'testimoni';
    public $id = 'id_testimoni';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // get is_tampil
    public function get_is_tampil()
    {
        $this->db->where('is_tampil', 'Ya');
        $this->db->order_by($this->id, $this->order);
        $this->db->join('users', 'testimoni.id_user = users.id');
        $this->db->join('profil', 'testimoni.id_user = profil.id_user');

        return $this->db->get($this->table)->result();
    }

    // get all
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);

        return $this->db->get($this->table)->result();
    }

    //get_num_rows
    public function get_num_rows($id_user)
    {
        return $this->db->get_where($this->table, array('id_user' => $id_user));
    }

    // get all by join
    public function get_join()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->join('users', 'testimoni.id_user = users.id');

        return $this->db->get($this->table)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->join('users', 'testimoni.id_user = users.id');

        return $this->db->get($this->table)->row();
    }

    // insert data
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
}

/* End of file Testimoni_model.php */
/* Location: ./application/models/Testimoni_model.php */
