<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permission
{

    protected $CI;
    public $state;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

//    public function get_menu_category()
//    {
//        $sql = "SELECT * FROM `tb_security_screen_category` WHERE 1 ORDER BY order_no ASC ";
//        $query = $this->CI->db->query($sql);
//
//        $output = $query->result_array();
//
//        return $output;
//    }

    public function get_menu($parent = '', $level_no = 0)
    {
        $user_group_id = $this->CI->session->userdata('admin_data')['group_id'];
        $sql = "SELECT
                    s.`screen_id`,
                    s.`level_no`,
                    s.`text_name_tha`,
                    s.`text_name_eng`,
                    s.`class_name`,
                    s.`icon`,
                    s.`is_enable`,
                    s.`is_break_line`,
                    s.`created_date`,
                    s.`partition`,
                    s.`partition_color`,
                    sp.*
                FROM
                    `tb_dealer_security_menu` s
                LEFT JOIN `tb_dealer_security_permission` sp ON
                    (s.`screen_id` = sp.`screen_id`)
                WHERE
                    s.`is_enable` = 1 AND sp.`group_id` = '{$user_group_id}' AND s.`level_no` = '{$level_no}' AND(
                        '{$parent}' = '' OR s.`parent_id` = '{$parent}'
                    )
                ORDER BY s.`partition` ASC , s.`sort_no` ASC";
        $query = $this->CI->db->query($sql);

        return $query->result_array();
    }

    public function get_user_current_data($id)
    {
        $sql = "SELECT su.*
				FROM `tb_dealer_security_users` su
				WHERE su.`id` = '{$id}' 
				";
        $query = $this->CI->db->query($sql);

        $output = $query->row_array();

        return $output;
    }

//    public function get_screen_detail($module_name)
//    {
//        $sql = "SELECT s.*
//				FROM `tb_security_screen` s
//				WHERE s.`is_active` = 1
//				AND s.`module_name` = '{$module_name}'
//				";
//        $query = $this->CI->db->query($sql);
//
//        $output = $query->result_array();
//
//        return $output;
//    }

    public function get_group_detail()
    {
        $user_group_id = $this->CI->session->userdata('admin_data')['group_id'];

        $sql = "SELECT g.*
				FROM `tb_dealer_security_users_group` g
				WHERE g.`is_enable` = 1 
				AND g.`is_delete` = 0
				AND g.`group_id` = '{$user_group_id}'
				";
        $query = $this->CI->db->query($sql);

        return $query->row_array();
    }

    public function by_screen($module_name)
    {
        $user_group_id = $this->CI->session->userdata('admin_data')['group_id'];

        $sql = "SELECT s.`screen_id`, s.`parent_id`, s.`level_no`, s.`text_name_tha`, s.`text_name_eng`, s.`class_name`, s.`is_enable`, s.`created_date`, sp.*
				FROM `tb_dealer_security_menu` s
				LEFT JOIN `tb_dealer_security_permission` sp ON (s.`screen_id` = sp.`screen_id`)
				WHERE s.`is_enable` = 1 
		 		AND sp.`group_id` = '{$user_group_id}'
				AND s.`class_name` = '{$module_name}'
				";
        $query = $this->CI->db->query($sql);

        $result = $query->row_array();

        return $result;
    }

    public function by_id($screen_id)
    {
        $user_group_id = $this->CI->session->userdata('admin_data')['group_id'];

        $sql = "SELECT s.`screen_id`, s.`parent_id`, s.`level_no`, s.`text_name_tha`, s.`text_name_eng`, s.`class_name`, s.`is_enable`, s.`created_date`, sp.*
				FROM `tb_dealer_security_menu` s
				LEFT JOIN `tb_dealer_security_permission` sp ON (s.`screen_id` = sp.`screen_id`)
				WHERE s.`is_enable` = 1
		 		AND sp.`group_id` = '{$user_group_id}'
				AND s.`screen_id` LIKE '{$screen_id}%'
				";
        $query = $this->CI->db->query($sql);

        $result = $query->row_array();

        return $result;
    }


    public function displayMenu()
    {
        $user_group_camp_id = $this->CI->session->userdata('admin_data')['group_camp_id'];
        $lang = $this->CI->session->userdata('language_admin');
        // get Main Menu List
        if ($lang != '') {
            $menu = $this->get_menu('', 0);
            if ($menu) {
                $curent_menu = $this->CI->uri->segments['1'];
                foreach ($menu as $key => $value) {
                    if ($value['view'] != 1) {
                        continue;
                    }
                    $submenu = $this->get_menu(substr($value['screen_id'], 0, 2), 1);
                    if (!empty($submenu)) {
//                            <span class="fa arrow"></span>
                        echo '<li class="nav-item has-sub">
                                <a href="">
                                    <i class="fas ' . $value['icon'] . '"></i>
                                    <span class="menu-title">' . $value['text_name_' . $this->CI->session->userdata('language_admin')] . '</span>
                                </a>';
                        echo '<ul class="menu-content">';
                        foreach ($submenu as $subkey => $subvalue) {
                            if ($subvalue['view'] != 1) {
                                continue;
                            }

                            if ($subvalue['is_break_line'] == '1') {
                                echo '<li class="divider"></li>';
                            }

                            $submenu_level_2 = $this->get_menu($subvalue['screen_id'], 2);
                            if ($submenu_level_2) {
                                echo '<li>
                                        <a href="#" id="damian">' . $subvalue['text_name_' . $this->CI->session->userdata('language_admin')] . '<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">';
                                foreach ($submenu_level_2 as $subkey_level_2 => $subvalue_level_2) {
                                    if ($subvalue_level_2['view'] != 1) {
                                        continue;
                                    }

                                    if ($subvalue_level_2['is_break_line'] == '1') {
                                        echo '<li class="divider"></li>';
                                    }
                                    echo '<li><a href="' . base_url() . $subvalue_level_2['class_name'] . '">' . $subvalue_level_2['text_name_' . $this->CI->session->userdata('language_admin')] . '</a></li>';
                                }
                                echo '</ul> 
                                    </li>';
                            } else {
                                echo '<li class="" id="menu_' . $subvalue['class_name'] . '"><a href="' . base_url() . $subvalue['class_name'] . '">' . $subvalue['text_name_' . $this->CI->session->userdata('language_admin')] . '</a></li>';
                            }
                        }
                        echo '</ul>';
                    } else {
                        //id="menu_' . $value['class_name'] . '"
                        echo '<li class="nav-item" id="menu-no-sub__'.$value['class_name'].'">
                            <a href="' . base_url() . $value['class_name'] . '">
                                <i class="fas ' . $value['icon'] . '"></i>
                                <span class="menu-title">' . $value['text_name_' . $this->CI->session->userdata('language_admin')] . '</span>
                                ' . (empty($submenu) ? '' : '<span class="fa arrow"></span>') . '
                            </a>';
                    }
                    echo '</li>';
                }
            }
        } else {
            $menu = $this->get_menu('', 0);
            if ($menu) {
                foreach ($menu as $key => $value) {
                    if ($value['view'] != 1) {
                        continue;
                    }
                    echo '<li class="nav-item has-sub">
                            <a href="#">
                                <i class="fas fa-th-large"></i>
                                <span class="menu-title">' . $value['text_name_' . $this->CI->session->userdata('language_admin')] . '</span>
                                <spanclass="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level menu-content">';

                    $submenu = $this->get_menu(substr($value['screen_id'], 0, 2), 1);
                    if ($submenu) {
                        foreach ($submenu as $subkey => $subvalue) {
                            if ($subvalue['view'] != 1)
                                continue;

                            if ($subvalue['is_break_line'] == '1')
                                echo '<li class="divider"></li>';

                            $submenu_level_2 = $this->get_menu($subvalue['screen_id'], 2);
                            if ($submenu_level_2) {
                                echo '<li class="dropdown-submenu">
                                        <a tabindex="-1" href="#">' . $subvalue['text_name_' . $this->CI->session->userdata('language_admin')] . '</a>
                                        <ul class="dropdown-menu">';
                                foreach ($submenu_level_2 as $subkey_level_2 => $subvalue_level_2) {
                                    if ($subvalue_level_2['view'] != 1)
                                        continue;

                                    if ($subvalue_level_2['is_break_line'] == '1')
                                        echo '<li class="divider"></li>';

                                    echo '<li><a href="' . base_url() . $subvalue_level_2['class_name'] . '">' . $subvalue_level_2['text_name_' . $this->CI->session->userdata('language_admin')] . '</a></li>';
                                }
                                echo '</ul>
                                      </li>';
                            } else {
                                echo '<li><a href="' . base_url() . $subvalue['class_name'] . '">' . $subvalue['text_name_' . $this->CI->session->userdata('language_admin')] . '</a></li>';
                            }
                        }
                    }
                    echo '</ul>
                        </li>';
                }
            }
        }
    }


    public function loadPermissionScreen($module_name)
    {
        // Check Login IF NULL Redirect to Login Page

        $permission = $this->by_screen($module_name);

        $this->state = $permission;
    }

    public function checkLogin()
    {
        $user = $this->CI->session->userdata('admin_data');

        //IF Login state fail redirect to logout
        if (empty($user) || !$this->get_group_detail())
            redirect(base_url('login/logout'));
    }

    public function checkPermissionAccess($action)
    {
        // check permission access if has state and state is 0
        if (isset($this->state[$action]) && !$this->state[$action]) {
            // if action is view redirect to another page
            if ($action == 'view') {
                $group_data = $this->get_group_detail();

                $menu = $this->get_menu('', 0);
                if ($menu) {
                    foreach ($menu as $key => $value) {
                        if ($value['view'] != 1)
                            continue;
                        $submenu = $this->get_menu(substr($value['screen_id'], 0, 2), 1);
                        if ($submenu) {
                            foreach ($submenu as $subkey => $subvalue) {
                                if ($subvalue['view'] != 1)
                                    continue;
                                $submenu_level_2 = $this->get_menu($subvalue['screen_id'], 2);
                                if ($submenu_level_2) {
                                    foreach ($submenu_level_2 as $subkey_level_2 => $subvalue_level_2) {
                                        if ($subvalue_level_2['view'] != 1)
                                            continue;
                                        redirect(base_url($subvalue_level_2['class_name']));
                                    }
                                }
                                redirect(base_url($subvalue['class_name']));
                            }
                        }
                        redirect(base_url($value['class_name']));
                    }
                } else {
                    redirect(base_url());
                }
                exit();

            } else {
                redirect(base_url($this->CI->module_config['url_path']));
            }
        } else {

//            Check parent if parent view is 0 redirect_back
            if ($this->state['level_no'] > 0) {
                $parent_id = $this->state['parent_id'];
                for ($i = $this->state['level_no']; $i > 0; $i--) {
                    $parent_data = $this->by_id($parent_id);
                    if ($parent_data['view'] == 0) {
                        $menu = $this->get_menu('', 0);
                        if ($menu) {
                            foreach ($menu as $key => $value) {
                                if ($value['view'] != 1)
                                    continue;
                                $submenu = $this->get_menu(substr($value['screen_id'], 0, 2), 1);
                                if ($submenu) {
                                    foreach ($submenu as $subkey => $subvalue) {
                                        if ($subvalue['view'] != 1)
                                            continue;
                                        $submenu_level_2 = $this->get_menu($subvalue['screen_id'], 2);
                                        if ($submenu_level_2) {
                                            foreach ($submenu_level_2 as $subkey_level_2 => $subvalue_level_2) {
                                                if ($subvalue_level_2['view'] != 1)
                                                    continue;
                                                redirect(base_url($subvalue_level_2['class_name']));
                                            }
                                        }
                                        redirect(base_url($subvalue['class_name']));
                                    }
                                }
                                redirect(base_url($value['class_name']));
                            }
                        } else {
                            redirect(base_url());
                        }
                    } else {
                        if ($parent_data['level_no'] > 0) {
                            $parent_id = $parent_data['parent_id'];
                        }
                    }
                }
            }
        }
        // check member block
        $member_data = $this->get_user_current_data($this->CI->session->userdata('admin_data')['id']);

        if ($member_data['is_enable'] == '0' || $member_data['is_delete'] == '1') {
            redirect(base_url('login/logout'));
        }
    }

}
