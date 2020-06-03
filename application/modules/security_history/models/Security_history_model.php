<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Security_history_model extends CI_Model
{

    public $language;
    public $table = 'tb_security_log_login';

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
                    a.`id`,
                    c.`group_name_tha`,
                    b.`name`,
                    a.`session_id`,
                    a.`use_os`,
                    a.`user_agent`,
                    a.`ip_address`,
                    a.`login_date`
                FROM
                    `{$this->table}` a
                LEFT JOIN `tb_security_users` b ON 
                    a.`user_id` = b.`id`
                LEFT JOIN `tb_security_users_group` c ON 
                    c.`group_id` = b.`group_id`   
                WHERE
                    1
                    AND (
                      '' = '{$search['txt_search']}' OR b.`name` LIKE '%{$search['txt_search']}%'
                    )
                    AND (
                      '' = '{$search['group_id']}' OR b.`group_id` = '{$search['group_id']}'
                    )
                ORDER BY {$order_by} {$order_type} ";

        
        $query = $this->db->query($sql);
        $total = count($query->result_array());
        $sql .= " LIMIT " . (($page - 1) * $limit) . ", {$limit} ";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return array('total_rows' => $total, 'result' => $result);
    }

    public function select_data_user_group()
    {
        $sql = " SELECT 
                  `group_id`,
                  `group_name_tha`
                FROM `tb_security_users_group` 
                WHERE 1
                AND `is_delete` = '0'";
        $query = $this->db->query($sql);

        return $query->result_array();
    }
}
