<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Import_product_model extends CI_Model
{

    public $language;
    public $table = 'tb_dealer_product_tmp';

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
                    t1.product_id,
                    t1.refer_id,
                    t1.ref_no,
                    t1.name_tha,
                    t2.supplier_id,
                    t2.supplier_name,
                    t1.cost_price,
                    t1.gov_price_rate_1,
                    t1.gov_price_rate_2,
                    t1.gov_price_rate_2,
                    t1.enterprise_price_rate_1,
                    t1.enterprise_price_rate_2,
                    t1.enterprise_price_rate_3,
                    t1.m_dealer_price_rate_1,
                    t1.m_dealer_price_rate_2,
                    t1.m_dealer_price_rate_3,
                    t1.dealer_price_rate_1,
                    t1.dealer_price_rate_2,
                    t1.dealer_price_rate_3,
                    t1.cus_price_rate_1,
                    t1.cus_price_rate_2,
                    t1.cus_price_rate_3,
                    t1.is_enable,
                    t1.updated_date,
                    t3.group_id,
                    t3.group_name_tha 
                FROM
                    tb_dealer_product_tmp AS t1
                    LEFT JOIN ( SELECT * FROM tb_dealer_suppliers ) AS t2 ON t1.supplier_id = t2.supplier_id
                    LEFT JOIN ( SELECT * FROM tb_product_category ) AS t3 ON t1.group_id = t3.group_id 
                WHERE
                    1 
                    AND t1.is_delete = 0";
        $sql .= " ORDER BY t2.{$order_by} {$order_type} ";// For order row
        $query = $this->db->query($sql);
        $total = count($query->result_array());
        $sql .= " LIMIT " . (($page - 1) * $limit) . ", {$limit} ";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return array('total_rows' => $total, 'result' => $result);
    }

    public function select_data_by_id($id)
    {
        $sql = "SELECT
                    t1.*,
                    t2.group_name_tha,
                    t2.margin_price 
                FROM
                    tb_dealer_product AS t1
                    LEFT JOIN ( SELECT * FROM tb_product_category ) AS t2 ON t1.group_id = t2.group_id 
                WHERE
                    1 
                    AND t1.is_delete = '0' 
                    AND t1.product_id = '{$id}' 
                    LIMIT 1";
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



    // Get All Product Category
    public function getAllProductCate()
    {
        $sql = "SELECT * 
                FROM tb_product_category
                WHERE 1
                AND is_delete = 0 ";
        $query = $this->db->query($sql);

        return $query->result_array();
    }


    public function getAllSupplier() {
        $sql = "SELECT * FROM tb_dealer_suppliers WHERE 1 AND is_delete = '0'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function getMasterMargin($id) {
        $sql = "SELECT margin_price FROM tb_product_category WHERE 1 AND group_id = '{$id}' AND is_delete = '0'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }




}
