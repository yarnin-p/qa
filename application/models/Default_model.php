<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_model extends CI_Model {

	// Master
    public function update_last_login($id, $data){
        $data['updated_date'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $id;
        $this->db->where('id', $id); 
        $this->db->update('tb_security_users', $data);
    }

    public function insert_log_login($data){
        $this->db->insert('tb_security_log_login', $data);
    }
	
    public function select_common_value($common_type, $lang) {
        $sql = " SELECT common_value_id as id, name_{$lang} as name
                FROM tb_common_value 
                WHERE common_type_id =  '{$common_type}' AND is_enable = 1 AND is_delete = 0
                ORDER BY common_value_id ASC ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function select_common_value_logistic_vendor($common_type, $lang){
        $sql = " SELECT common_value_id as id, name_{$lang} as name
                FROM tb_common_value 
                WHERE common_type_id =  '{$common_type}' AND is_enable = 1 AND is_delete = 0
                ORDER BY sort_no ASC ";

        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function select_common_country($lang) {
        $sql = " SELECT province_id as id, province_name_{$lang} as name
                FROM tb_common_province
                ORDER BY province_name_{$lang} ASC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function select_common_province($country_id, $lang) {
        $sql = " SELECT province_id as id, province_name_{$lang} as name
                FROM tb_common_province
                WHERE country_id = '{$country_id}' AND is_delete = 0
                ORDER BY province_name_{$lang} ASC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function select_common_amphur($province_id, $lang) {
		if ($lang == 'tha') {
			$lang = '';
		} else {
			$lang = '_'.$lang;
		}
        $sql = " SELECT amphur_id as id, amphur_name{$lang} as name
                FROM tb_common_amphur
                WHERE province_id = '{$province_id}'
                ORDER BY amphur_name{$lang} ASC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }


	// Product

    public function select_product_category_list($parent_id = '0') {
        $sql = " SELECT category_id as id, name_{$lang} as name
                FROM tb_product_category
                WHERE parent_id = '{$parent_id}' AND is_enable = 1 AND is_delete = 0
                ORDER BY name_{$lang} ASC ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function select_banner_pos($parent_id = '0') {
        $sql = " SELECT banner_pos_id as id, position_name as name, image_width, image_height, is_relate_category
                FROM tb_banner_position
                WHERE is_enable = 1 AND is_delete = 0
                ORDER BY banner_pos_id ASC ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function select_product_root_category_by_seller_id($seller_id, $lang) {
        $sql = " SELECT DISTINCT t2.category_id as id, t2.name_{$lang} as name                
                FROM tb_seller_product t1
                INNER JOIN (SELECT * FROM `tb_product_category`) t2
                ON (t1.category_id = t2.category_id)
                WHERE t1.seller_id = '{$seller_id}'";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    //Document
    public function select_document_category($lang) {
        $sql = " SELECT doc_cat_id as id, name_{$lang} as name
                FROM tb_document_category
                WHERE is_enable = 1 AND is_delete = 0
                ORDER BY name_{$lang} ASC ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getVat($lang){
        $sql = "SELECT `vat_rate` FROM `tb_setting_vat` ORDER BY `effective_date` DESC LIMIT 0,1";
        $query = $this->db->query($sql);
        return  $query->row_array();
    }

// Debug Log
    public function insert_debug_data($data){
        $this->db->initialize();
        $this->db->insert('tb_debug', $data);
        return $this->db->insert_id();
    }
    public function update_debug_data($debug_id, $data){
        $this->db->initialize();
        $this->db->where('debug_id', $debug_id); 
        $this->db->update('tb_debug', $data);
    }

    public function debug_tracking_start($caller_id, $module_type,$module_name,$function_name){
        $url_name = $_SERVER['REQUEST_URI'];
        $query_string = $_SERVER['QUERY_STRING'];
        $insert_data = array(
                'caller_id' =>$caller_id ,
                'url_name' =>$url_name ,
                'query_string' =>$query_string ,
                'module_type' =>$module_type ,
                'module_name' =>$module_name ,
                'function_name' =>$function_name ,
                'start_date' =>date('Y-m-d H:i:s') ,
                'log_ip_address' =>$this->input->ip_address() ,
                'log_browser' =>$this->agent->browser().' '.$this->agent->version()  ,
                'log_os' =>$this->agent->platform() ,
                'session_user_id' =>!empty($this->user['seller_id'])?$this->user['seller_id']:0 
            );

        $debug_id = $this->insert_debug_data($insert_data);

        return $debug_id;
    }

    public function debug_tracking_end($debug_id, $process_ms_start){
        $url_name = $_SERVER['REQUEST_URI'];
        $query_string = $_SERVER['QUERY_STRING'];
        $update_data = array(
                'end_date' =>date('Y-m-d H:i:s') ,
                'process_ms' => (round(microtime(true) * 1000) - $process_ms_start) ,
            );
        $debug_id = $this->update_debug_data($debug_id, $update_data);
    }

 }