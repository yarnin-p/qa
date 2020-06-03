<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_permission_model extends CI_Model
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

    public function select_data($search, $order_type, $order_by, $limit, $page, $level_no, $parent_id)
    {
        if ($level_no != '2') {
            $parent_id = substr($parent_id, 0, 2);
        }

        $lang = $this->session->userdata('language');
        if ($lang != '') {
            $sql = " SELECT t1.`text_name_{$this->session->userdata('language')}` as `text_name`, t1.`screen_id` , t1.`level_no`, t1.`class_name`
                ,IFNULL(`group_id`,'{$search['group_id']}') as `group_id`, `view`, `add`, `edit`, `delete`, `special1`, `special2`, `special3`, `print`, t1.parent_id";
        } else {
            $sql = " SELECT t1.`text_name_tha` as `text_name`, t1.`screen_id` , t1.`level_no`, t1.`class_name`
                ,IFNULL(`group_id`,'{$search['group_id']}') as `group_id`, `view`, `add`, `edit`, `delete`, `special1`, `special2`, `special3`, `print`, t1.parent_id";
        }
        $sql .= " FROM tb_dealer_security_menu t1
                LEFT JOIN tb_dealer_security_permission t2 ON (t1.`screen_id` = t2.`screen_id` AND t2.group_id ='{$search['group_id']}')
                WHERE 1 
                AND t1.`is_enable` = 1
                AND t1.`level_no` = '{$level_no}'
                AND ('{$level_no}' = 0 OR t1.`parent_id` = '{$parent_id}')
                ORDER BY t1.sort_no ASC";

        $query = $this->db->query($sql);
        $total = count($query->result_array());
        $result = $query->result_array();
        return $result;
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
        $sql = " SELECT group_id as `id`, `group_name_tha` as `name`
                FROM `tb_dealer_security_users_group` 
                WHERE 1
                AND is_delete = 0 AND is_enable = 1 
                ORDER BY group_id ASC ";
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

    public function update_data_permission($group_id, $screen_id, $data)
    {
        $sql = "INSERT INTO `tb_dealer_security_permission`(`group_id`, `screen_id`, `view`, `add`, `edit`, `delete`, `special1`, `special2`, `special3`, `print`) 
                VALUES ('{$group_id}','{$screen_id}','{$data['view']}','{$data['add']}','{$data['edit']}','{$data['delete']}','{$data['special1']}','{$data['special2']}','{$data['special3']}','{$data['print']}')  
                ON DUPLICATE KEY UPDATE 
                    `view`='{$data['view']}'
                    ,`add`='{$data['add']}' 
                    ,`edit`='{$data['edit']}' 
                    ,`delete`='{$data['delete']}' 
                    ,`special1`='{$data['special1']}' 
                    ,`special2`='{$data['special2']}' 
                    ,`special3`='{$data['special3']}' 
                    ,`print`='{$data['print']}' ;";
        $this->db->query($sql);
        $id = $this->db->insert_id();
    }

    public function delete_permission($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->delete('tb_dealer_security_permission');
    }
}
