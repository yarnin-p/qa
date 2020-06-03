<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model
{

    public $language;
    public $table = 'tb_dealer_security_users';

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
                    t1.`id`,
                    t1.`picture`,
                    t1.`username`,
                    t1.`name`,
                    su.`group_name_{$this->language}` AS `group_name`,
                    t1.`last_active`,
                    t1.`updated_date`,
                    t1.`updated_by`,
                    t1.`is_enable`
                FROM
                    `{$this->table}` t1
                LEFT JOIN `tb_dealer_security_users_group` su ON
                    su.group_id = t1.group_id
                WHERE
                    1 
                    AND (
                       t1.`name` LIKE '%{$search['txt_search']}%' 
                        OR t1.`username` LIKE '%{$search['txt_search']}%' OR su.`group_name_{$this->language}` LIKE '%{$search['txt_search']}%' 
                    )";
        if ($search['group_id'] != "all") {
            $sql .= "AND ('' = '{$search['group_id']}' OR t1.group_id = '{$search['group_id']}' )";
        }
        $sql .= "AND su.`is_delete` = 0
            AND su.`is_enable` = 1 
            AND t1.`is_delete` = 0
            AND t1.id != 1 ";
        if ($order_by == 'group_name') {
            $sql .= " ORDER BY {$order_by} {$order_type} ";// For order row
        } else {
            $sql .= " ORDER BY t1.{$order_by} {$order_type} ";// For order row
        }
        $query = $this->db->query($sql);
        $total = count($query->result_array());
        $sql .= " LIMIT " . (($page - 1) * $limit) . ", {$limit} ";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return array('total_rows' => $total, 'result' => $result);
    }

    public function select_data_by_id($id)
    {
        $sql = " SELECT * 
                FROM `{$this->table}` 
                WHERE 1
                AND `id` = '{$id}'
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

    public function get_user_group($id)
    {
        $sql = "SELECT group_id as `id`, `group_name_{$this->language}` as `group_name`
                FROM `tb_dealer_security_users_group` 
                WHERE 1
                AND group_id <> '{$id}'
                AND is_delete = 0 AND is_enable = 1  AND group_id <> 9 AND group_id <> 7 AND group_id <> 1";
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
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete_data($id)
    {
        $data['is_delete'] = '1';
        $data['updated_date'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->user['id'];
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);

        redirect_back();
    }
}
