<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }



    public function getNotiApprovedProduct(){


        $sql = "SELECT
                    * 
                FROM
                    tb_dealer_product_tmp AS t1
                    LEFT JOIN ( SELECT * FROM tb_dealer_suppliers ) AS t2 ON t1.supplier_id = t2.supplier_id 
                WHERE
                    1 
                    AND t2.is_delete = '0' 
                    AND t1.is_approved = '0' 
                ORDER BY
                    t1.group_id ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }





    public function select_order_list($search){
        $date_start = $search['start_search'];
        $date_end = $search['end_search'];
        $sql = "SELECT * FROM tb_order WHERE is_delete = 0 AND payment_status = 'SC'  AND order_status ='P'  AND DATE(paid_date)  BETWEEN  '{$date_start}' AND '{$date_end}' ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


}
