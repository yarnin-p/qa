<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Setting_smtp extends MY_Controller
{
    protected $modules = "setting_smtp";
    private $model = "setting_smtp_model";
    private $sorting_column = 'smtp_id';
    private $sorting_type = 'DESC';

    function __construct()
    {
        parent::__construct();

        // Check Permission Access
        $this->permission->checkLogin();
        $this->permission->loadPermissionScreen($this->modules);

        $this->output_data["url_ajax"] = base_url() . $this->modules . '/';
        $this->output_data["modules"] = $this->modules;
        $this->lang->load($this->modules, $this->language);
        // load model
        $this->load->model($this->model, "main_model");

        // meta html
        $this->output_data["title"] .= ucfirst(str_replace("_", " ", $this->modules));
    }

    public function index()
    {
        // permission
        $this->permission->checkPermissionAccess('edit');

        // breadcrumbs
        $this->breadcrumbs->push($this->lang->line('label_title_head'), '/' . $this->modules);
        $this->breadcrumbs->push($this->lang->line('label_title_head_edit'), '/');

        // get id
        $id = 1;

        // data from model
        //$this->output_data['data_user_group'] = $this->main_model->get_setting_smtp();
        $this->output_data['result'] = $this->main_model->select_data_by_id($id);

        //IF Submit
        if (!empty($this->input->post())) {
            $input = $this->input->post();
            unset($input['submit']);
            $input['smtp_server'] = $input['smtp_server'];
            $input['ssl_tls'] = $input['ssl_tls'];
            $input['smtp_port'] = $input['smtp_port'];
            $input['is_authenticate'] = $input['is_authenticate'];
            $input['authenticate_username'] = $input['authenticate_username'];
            $input['authenticate_password'] = $input['authenticate_password'];
            $this->main_model->update_data($id, $input);

            redirect(base_url($this->modules . '/setting_smtp#save_complete'));
        }

        // css style in header
        $this->output_data["css"] = $this->load->view('setting_smtp_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('setting_smtp_js', $this->output_data, true);

        // load views
        $this->template->load($this->output_data, $this->template_name, $this->modules, 'edit');
    }

}