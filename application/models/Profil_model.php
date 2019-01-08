<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Profil_model extends CI_Model
{
    public $table = 'profil';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_ref_tahun()
    {
        $this->db->order_by($this->id, $this->order);

        return $this->db->get('referensi_tahun')->result();
    }

    //get_num_rows
    public function get_num_rows($id_user)
    {
        return $this->db->get_where($this->table, array('id_user' => $id_user));
    }

    public function get_ref_pekerjaan()
    {
        return $this->db->get('referensi_profesi')->result();
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

    public function getSearchKeyword($keyword)
    {
        if (empty($keyword)) {
            return array();
        }

        $this->db->select('*');
        $this->db->from('profil AS t1');
        $this->db->join('users AS t2', 't2.id = t1.id_user');
        $this->db->like('first_name', $keyword);
        $this->db->or_like('last_name', $keyword);
        $this->db->or_like('jenis_kelamin', $keyword);
        $this->db->or_like('nisn', $keyword);
        $this->db->or_like('tahun_lulus', $keyword);
        $this->db->or_like('no_ijazah', $keyword);
        $this->db->or_like('no_skhun', $keyword);

        return $this->db->get()->result();
    }

    public function get_alumni_by_user_id($id_user = null)
    {
        $this->db->join('users AS t2', 't2.id = t1.id_user');
        $this->db->join('status_alumni AS t3', 't3.id_user = t1.id_user');

        return $this->db->get_where('profil AS t1', array('t1.id_user' => $id_user))->row();
    }
}

/* End of file Profil_model.php */
/* Location: ./application/models/Profil_model.php */
