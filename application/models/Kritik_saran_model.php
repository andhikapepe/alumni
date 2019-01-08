<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kritik_saran_model extends CI_Model
{
    public $table = 'kritik_saran';
    public $id = 'id_kritiksaran';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    //get_num_rows
    public function get_num_rows($id_user)
    {
        return $this->db->get_where($this->table, array('id_user' => $id_user));
    }

    // get all
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);

        return $this->db->get($this->table)->result();
    }

    // get all by join
    public function get_join()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->join('users', 'kritik_saran.id_user = users.id');

        return $this->db->get($this->table)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->join('users', 'kritik_saran.id_user = users.id');

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

    // delete data
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}

/* End of file Kritik_saran_model.php */
/* Location: ./application/models/Kritik_saran_model.php */
