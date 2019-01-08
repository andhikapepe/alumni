<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * dikembangkan oleh andhika putra pratama.
 */
class Home_model extends CI_Model
{
    public $table_lowongan = 'lowongan';
    public $table_event = 'event';
    public $table_group = 'users_groups';
    public $table_profil = 'profil';
    public $table_status = 'status_alumni';
    public $table_user = 'users';

    public $id = 'id';
    public $group_id = '2';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

   

    public function count_alumni()
    {
        $this->db->where('group_id', $this->group_id);

        return $this->db->count_all_results($this->table_group);
    }
}
