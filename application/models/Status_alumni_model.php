<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Status_alumni_model extends CI_Model
{
    public $table = 'status_alumni';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
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

    //read with slug
    public function read_by_userid($id_user = null)
    {
        $this->db->join('users', 'status_alumni.id_user = users.id');

        return $this->db->get_where($this->table, array('id_user' => $id_user))->row();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);

        return $this->db->get($this->table)->row();
    }

    // get all by join
    public function get_join()
    {
        $this->db->order_by('status_alumni.id', $this->order);
        $this->db->join('users', 'status_alumni.id_user = users.id');

        return $this->db->get($this->table)->result();
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

/* End of file Status_alumni_model.php */
/* Location: ./application/models/Status_alumni_model.php */
