<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Setting_smtp_model extends CI_Model
{

    public $language;
    public $table = 'tb_setting_smtp';

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
                    `smtp_id`,
                    `smtp_server`,
                    `ssl_tls`,
                    `smtp_port`,
                    `is_authenticate`,
                    `authenticate_username`,
                    `authenticate_password`,
                    `is_enable`,
                    `updated_date`,
                    `updated_by`
                FROM
                    `{$this->table}`
                WHERE
                    1
                    AND (
                      '' = '{$search['txt_search']}' OR `smtp_server` LIKE '%{$search['txt_search']}%'
                    )
                    AND `is_delete` = 0
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
                    `smtp_id`,
                    `smtp_server`,
                    `ssl_tls`,
                    `smtp_port`,
                    `is_authenticate`,
                    `authenticate_username`,
                    `authenticate_password`,
                    `is_enable`,
                    `updated_date`,
                    `updated_by`
                FROM `{$this->table}` 
                WHERE 1
                AND `smtp_id` = '{$id}'
                LIMIT 1 ";
        $query = $this->db->query($sql);

        return $query->row_array();
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
        $this->db->where('smtp_id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete_data($id)
    {
        $data['is_delete'] = '1';
        $data['updated_date'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->user['id'];
        $this->db->where('smtp_id', $id);
        $this->db->update($this->table, $data);

        redirect_back();
    }
}
