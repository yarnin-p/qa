<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function getBankName($sub_bank){
        $sql = "SELECT * FROM tb_bank WHERE sub_bank = '{$sub_bank}' LIMIT 1";
        $query = $this->CI->db->query($sql);
        $data = $query->row_array();

        return '('.$data['sub_bank'].') '.$data['bank_tha'];
    }

    public function get_user_update($id)
    {
        $sql = " SELECT
                    `id`,
                    `username`,
                    `name`
                FROM
                    `tb_security_users`
                WHERE
                    1 AND `is_enable` = '1' AND `is_delete` = '0' AND `id` = '{$id}'
                LIMIT 1 ";
        $query = $this->CI->db->query($sql);
        $data = $query->row_array();

        return $data;
    }

    public function get_user_create($id)
    {
        $sql = " SELECT
                    `id`,
                    `username`,
                    `name`
                FROM
                    `tb_security_users`
                WHERE
                    1 AND `is_enable` = '1' AND `is_delete` = '0' AND `id` = '{$id}'
                LIMIT 1 ";
        $query = $this->CI->db->query($sql);
        $data = $query->row_array();

        return $data;
    }

}
