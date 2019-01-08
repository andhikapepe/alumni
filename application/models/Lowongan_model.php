<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lowongan_model extends CI_Model
{
    public $table = 'lowongan';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // read per month
    public function read_per_month()
    {
        $query = $this->db->query('SELECT * FROM `lowongan` WHERE MONTH(tanggal_posting) = MONTH(CURRENT_DATE()) AND YEAR(tanggal_posting) = YEAR(CURRENT_DATE()) ORDER by `id` DESC');

        return $query->result();
    }

    // get all
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);

        return $this->db->get($this->table)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);

        return $this->db->get($this->table)->row();
    }

    //read with slug
    public function read_slug($slug = null)
    {
        return $this->db->get_where($this->table, array('job_slug' => $slug))->row();
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

/* End of file Lowongan_model.php */
/* Location: ./application/models/Lowongan_model.php */
