<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Menu_model extends CI_Model
{

    public $language;
    public $table = 'tb_dealer_security_menu';

    public function __construct()
    {
        parent::__construct();
        $this->language = $this->session->userdata('language_admin');
        // Set user admin
        $this->user = $this->session->userdata('admin_data');
    }

    public function select_data($search, $order_type, $order_by, $limit, $page)
    {
        $txt_search = str_replace(" ", "%", $search['txt_search']);

        $sql = "SELECT
                    t1.`screen_id`,
                    t1.`parent_id`,
                    t1.`level_no`,
                    t1.`text_name_tha`,
                    t1.`text_name_eng`,
                    t1.`class_name`,
                    t1.`sort_no`,
                    t1.icon,
                    t1.is_enable,
                    t1.`created_date`
                FROM
                    `{$this->table}` t1
                WHERE
                    screen_id != 9999 
                    AND ((t1.text_name_tha LIKE '%{$txt_search}%') OR (t1.text_name_eng LIKE '%{$txt_search}%') OR (t1.class_name LIKE '%{$txt_search}%'))
                 ";
                    $sql .= " ORDER BY parent_id ASC,level_no ASC,sort_no ASC ";// For order row

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
                AND `screen_id` = '{$id}'
                LIMIT 1 ";
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function get_menu_level()
    {
        $sql = "SELECT 
                screen_id,
                parent_id,
                level_no,	
                text_name_tha
                FROM `tb_dealer_security_menu` as menu
                WHERE 1 
                AND level_no = 0 
                ORDER BY screen_id ASC";
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
        $this->db->where('screen_id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete_data($id)
    {
        $this->db->where('screen_id', $id);
        $this->db->delete($this->table);

        redirect_back();
    }


}
