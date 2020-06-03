<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_group_model extends CI_Model
{

    public $language;
    public $table = 'tb_dealer_security_users_group';

    public function __construct()
    {
        parent::__construct();
        $this->language = $this->session->userdata('language_admin');
        // Set user admin
        $this->user = $this->session->userdata('admin_data');
    }

    public function select_data($search, $order_type, $order_by, $limit, $page)
    {
        $sql = "SELECT
                    `group_id`,
                    `group_name_{$this->language}` AS `group_name`,
                    `updated_date`,
                    `updated_by`,
                    `is_enable`
                FROM
                    `{$this->table}`
                WHERE
                    1
                    AND (
                      '' = '{$search['txt_search']}' OR `group_name_{$this->language}` LIKE '%{$search['txt_search']}%'
                    )
                    AND `is_delete` = 0
                    AND `is_enable` = 1
                ORDER BY {$order_by} {$order_type} ";
        $query = $this->db->query($sql);
        $total = count($query->result_array());
        $sql .= " LIMIT " . (($page - 1) * $limit) . ", {$limit} ";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return array('total_rows' => $total, 'result' => $result);
    }

    public function select_data_by_id($id)
    {
        $sql = " SELECT 
                    `group_id`,
                    `group_name_{$this->language}` AS `group_name`,
                    `updated_date`,
                    `updated_by`,
                    `is_enable` 
                FROM `{$this->table}` 
                WHERE 1
                AND `group_id` = '{$id}'
                LIMIT 1 ";
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function select_group_id()
    {
        $sql = " SELECT group_id as `id`, `group_name_{$this->language}` as `name`
                FROM `tb_dealer_security_users_group` 
                WHERE 1
                AND is_delete = 0 AND is_enable = 1 ";
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function get_user_group()
    {
        $sql = "SELECT group_id as `id`, `group_name_{$this->language}` as `group_name`
                FROM `tb_dealer_security_users_group` 
                WHERE 1
                AND is_delete = 0 AND is_enable = 1 ";
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function insert_data($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_data($id, $data)
    {
        $data['updated_date'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->user['id'];
        $this->db->where('group_id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete_data($id)
    {
        $data['is_delete'] = '1';
        $data['updated_date'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->user['id'];
        $this->db->where('group_id', $id);
        $this->db->update($this->table, $data);

        redirect_back();
    }
}
