<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Config_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    ///Update sort no solution
    public function select_sort_no_by_product_id($product_id){
        $sql = "SELECT sort_no,category_id FROM tb_product WHERE product_id = {$product_id}";
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function select_target_id_by_sort_no($sort_no,$category_id){
        $sql = "SELECT product_id FROM tb_product WHERE sort_no = '{$sort_no}' AND category_id = {$category_id}";
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function update_sort_no_with_source($id, $data)
    {
        $this->db->where('product_id', $id);
        $this->db->update('tb_product', $data);
    }

    public function update_sort_no_with_target($id, $data)
    {
        $this->db->where('product_id', $id);
        $this->db->update('tb_product', $data);
    }

    public function setting_smtp()
    {
        $sql = "SELECT * 
                FROM tb_setting_smtp";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function select_member_by_id($member_id){
        $sql = "SELECT * FROM tb_member WHERE is_delete = 0 AND member_id = '{$member_id}' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }


    public function select_agent_by_id($agent_id){
        $sql = "SELECT * FROM tb_wallet_agent WHERE is_delete = 0 AND agent_id = '{$agent_id}' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
//    public function list_language()
//    {
//        $response = array();
//
//        $sql = "SELECT
//                    `id`,
//                    `name_tha`,
//                    `name_eng`,
//                    `alias`,
//                    `country_name`,
//                    `flag`,
//                    `type`
//                FROM
//                    `tb_language`
//                WHERE
//                    1
//                    AND `is_enable` = '1'
//                    AND `is_delete` = '0'
//                    AND `id` != '1'
//                ORDER BY
//                    `alphabet_tha` ASC ,`name_tha` ASC";
//        $query = $this->db->query($sql);
//        $result = $query->result_array();
//        foreach ($result as $key => $value) {
//            array_push($response, array(
//                'id' => $value['id'],
//                'name_tha' => $value['name_tha'],
//                'name_eng' => $value['name_eng'],
//                'alias' => $value['alias'],
//                'country_name' => $value['country_name'],
//                'flag' => $value['flag'],
//                'type' => $value['type']
//            ));
//        }
//
//        return $response;
//    }
//
//    public function site_language()
//    {
//        $result = array();
//        $sql = "SELECT
//                    `id`,
//                    `name_tha`,
//                    `name_eng`,
//                    `alias`,
//                    `country_name`,
//                    `flag`,
//                    `type`,
//                    `is_validate`
//                FROM
//                    `tb_language`
//                WHERE
//                    1
//                    AND `is_enable` = '1'
//                    AND `is_delete` = '0'
//                    AND `id` = '1' OR `id` = '2'
//                ORDER BY
//                    `id` ASC";
//        $query = $this->db->query($sql);
//        foreach ($query->result_array() as $key => $value) {
//            array_push($result, array(
//                'id' => $value['id'],
//                'name_tha' => $value['name_tha'],
//                'name_eng' => $value['name_eng'],
//                'alias' => $value['alias'],
//                'country_name' => $value['country_name'],
//                'flag' => $value['flag'],
//                'type' => $value['type'],
//                'is_validate' => $value['is_validate']
//            ));
//        }
//
//        $sql_not_th_en = "SELECT
//                    `id`,
//                    `name_tha`,
//                    `name_eng`,
//                    `alias`,
//                    `country_name`,
//                    `flag`,
//                    `type`,
//                    `is_validate`
//                FROM
//                    `tb_language`
//                WHERE
//                    1
//                    AND `is_enable` = '1'
//                    AND `is_delete` = '0'
//                    AND `id` != '1'
//                    AND `id` != '2'
//                ORDER BY
//                   `alphabet_tha` ASC ,`name_tha` ASC";
//        $query_not_th_en = $this->db->query($sql_not_th_en);
//        foreach ($query_not_th_en->result_array() as $key => $value) {
//            array_push($result, array(
//                'id' => $value['id'],
//                'name_tha' => $value['name_tha'],
//                'name_eng' => $value['name_eng'],
//                'alias' => $value['alias'],
//                'country_name' => $value['country_name'],
//                'flag' => $value['flag'],
//                'type' => $value['type'],
//                'is_validate' => $value['is_validate']
//            ));
//        }
//
//        return $result;
//    }

}
