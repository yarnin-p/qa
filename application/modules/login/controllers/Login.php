<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends MY_Controller
{

    protected $modules = "login";
    private $model = "login_model";

    function __construct()
    {
        parent::__construct();

        $this->template_name = 'login';
        $this->output_data["url_ajax"] = base_url() . $this->modules . '/';
        $this->output_data["modules"] = $this->modules;
        $this->lang->load($this->modules, $this->language);
        // load model
        $this->load->model($this->model, "main_model");
    }

    public function index()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            redirect(base_url('dashboard'));
        }

        // meta html
        $this->output_data["title"] .= str_replace("_", " ", $this->modules);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' || (!empty($_COOKIE['username']) && !empty($_COOKIE['password']))) {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $remember = $this->input->post('remember');
            } else {
                $username = $_COOKIE['username'];
                $password = $_COOKIE['password'];
                $remember = 1;
            }

            if ($username != '' && $password != '') {
                $username = trim($username);
                $password_md5 = md5($password);
                //  Get user data with username, password
                $result = $this->getLogin($username, $password_md5);
                if ($result) {
                    // Set Remember Login
                    if ($remember == '1') {
                        setcookie('username', $username, time() + 3600 * 24 * 356, "/");
                        setcookie('password', $password, time() + 3600 * 24 * 356, "/");
                    } else {
                        setcookie('username', '', time() + 3600 * 24 * 356, "/");
                        setcookie('password', '', time() - 999999, '/', $_SERVER['SERVER_NAME']);
                        unset($_COOKIE['username']);
                        unset($_COOKIE['password']);
                    }

                    $result['user_id'] = $result['id'];
                    $data_update['last_active'] = date('Y-m-d H:i:s');
                    $data_update['last_user_agent'] = $this->agent->browser() . " " . $this->agent->version();
                    $data_update['last_ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $this->default_model->update_last_login($result['id'], $data_update);

                    $data_log['user_id'] = $result['id'];
                    $data_log['use_os'] = $this->agent->platform();
                    $data_log['user_agent'] = $this->agent->browser() . " " . $this->agent->version();
                    $data_log['ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $data_log['login_date'] = date('Y-m-d H:i:s');
                    $data_log['query_string'] = $_SERVER['QUERY_STRING'];
                    $data_log['session_id'] = $this->session->userdata('session_id');



                    $this->default_model->insert_log_login($data_log);

                    unset($result['password']);
                    unset($result['password_tmp']);
                    unset($result['is_enable']);
                    unset($result['is_delete']);
                    unset($result['is_delete']);
                    $this->session->set_userdata('admin_data', $result);
                    $this->language = $this->session->userdata('language_admin');
                    if (empty($this->language)) {
                        $this->language = $this->config->item('language');
                        $this->session->set_userdata('language', $this->language);
                    }
                    redirect(base_url('dashboard'));
                } else {
                    $this->logout();
                }

            } else {
                $this->load->view('login/index');
            }
        } else {
            $this->session->sess_destroy();
        }

        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);

        // load views
        $this->template->load($this->output_data, $this->template_name, $this->modules, 'index');
    }


    public function portal()
    {
        $token = $_GET['token'];
        $link = $_GET['l'];

        if (trim($token) == '' || $link == '') {
            exit();
        }
        $redirect_link = base64_decode($link);
        $code = base64_decode($token);
        $code_tmp = explode('|', $code);
        $id = $code_tmp[1];
        $key = $this->config->item('portal_key');

        $authen_token = md5($key . $id . $redirect_link);
        if ($authen_token == $code_tmp[0]) {
            $result = $this->getLoginByID($id);
            if ($result) {
                setcookie('username', '', time() + 3600 * 24 * 356, "/");
                setcookie('password', '', time() + 3600 * 24 * 356, "/");

                $result['user_id'] = $result['id'];
                $data_update['last_active'] = date('Y-m-d H:i:s');
                $data_update['last_user_agent'] = $this->agent->browser() . " " . $this->agent->version();
                $data_update['last_ip_address'] = $_SERVER['REMOTE_ADDR'];
                $this->default_model->update_last_login($result['id'], $data_update);

                $data_log['user_id'] = $result['id'];
                $data_log['use_os'] = $this->agent->platform();
                $data_log['user_agent'] = $this->agent->browser() . " " . $this->agent->version();
                $data_log['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $data_log['login_date'] = date('Y-m-d H:i:s');
                $data_log['query_string'] = $_SERVER['QUERY_STRING'];
                $data_log['session_id'] = $this->session->userdata('session_id');
                $this->default_model->insert_log_login($data_log);

                unset($result['password']);
                unset($result['password_tmp']);
                unset($result['is_enable']);
                unset($result['is_delete']);
                unset($result['is_delete']);
                $this->session->set_userdata('admin_data', $result);
                $this->language = $this->session->userdata('language_admin');
                if (empty($this->language)) {
                    $this->language = $this->config->item('language');
                    $this->session->set_userdata('language', $this->language);
                }

                redirect($redirect_link);
            } else {
                echo 'Login fail: user not found';
                exit(404);
            }
        } else {
            echo 'Authen fail: token is incorrect';
            exit(404);
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        setcookie('username', '', time() + 3600 * 24 * 356, "/");
        setcookie('password', '', time() + 3600 * 24 * 356, "/");
        redirect(base_url('login'));
    }

    public function getLogin($username = '', $password = '')
    {
        $sql = "SELECT
                    u.`id`,
                    u.`username`,
                    u.`name`,
                    u.`id_card`,
                    u.`email`,
                    u.`telephone`,
                    u.`telephone`,
                    u.`address`,
                    u.`last_active`,
                    u.`first_login`,
                    u.`last_user_agent`,
                    u.`last_ip_address`,
                    u.`group_id`,
                    g.`group_name_{$this->language}` AS group_name,
                    u.`picture`,
                    u.`token_key`,
                    u.`created_date`,
                    u.`created_by`,
                    u.`updated_by`,
                    u.`updated_date`
                FROM
                    `tb_dealer_security_users` AS u
                    INNER JOIN `tb_dealer_security_users_group` AS g ON u.`group_id`=g.`group_id`
                WHERE
                    1 
                    AND u.`username` = '{$username}'
                    AND u.`password` = '{$password}'
                    AND u.`is_delete` = '0' 
                    AND u.`is_enable` = '1'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function getLoginByID($id)
    {
        $sql = "SELECT
                    u.`id`,
                    u.`username`,
                    u.`name`,
                    u.`id_card`,
                    u.`email`,
                    u.`telephone`,
                    u.`telephone`,
                    u.`address`,
                    u.`last_active`,
                    u.`first_login`,
                    u.`last_user_agent`,
                    u.`last_ip_address`,
                    u.`group_id`,
                    g.`group_name_{$this->language}` AS group_name,
                    u.`picture`,
                    u.`token_key`,
                    u.`created_date`,
                    u.`created_by`,
                    u.`updated_by`,
                    u.`updated_date`
                FROM
                    `tb_dealer_security_users` AS u
                    INNER JOIN `tb_dealer_security_users_group` AS g ON u.`group_id`=g.`group_id`
                WHERE
                    1 
                    AND u.`id` = '{$id}'
                    AND u.`is_delete` = '0' 
                    AND u.`is_enable` = '1'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}