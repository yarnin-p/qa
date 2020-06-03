<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_permission extends MY_Controller
{
    protected $modules = "user_permission";
    private $model = "user_permission_model";
    private $sorting_column = 'group_id';
    private $sorting_type = 'DESC';

    function __construct()
    {
        parent::__construct();

        // Check Permission Access
        $this->permission->checkLogin();
        $this->permission->loadPermissionScreen($this->function_name);

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
        $this->permission->checkPermissionAccess('view');

        $this->output_data['data_group_id'] = $this->main_model->select_group_id();
        $search = array(
            'group_id' => $this->output_data['data_group_id']['0']['id']
        );

        $order_by = ($this->input->get('orderby')) ? $this->input->get('orderby') : $this->sorting_column;
        $order_type = ($this->input->get('ordertype')) ? $this->input->get('ordertype') : $this->sorting_type;
        $limit = ($this->input->get('limit')) ? $this->input->get('limit') : $this->config->config['limit'][0];
        $page = ($this->input->get('page')) ? $this->input->get('page') : $this->config->config['first_page_no'];
        $this->output_data['order'] = array('type' => $order_type, 'by' => $order_by, 'limit' => $limit, 'page' => $page, 'main' => $this->sorting_column);

//        print_pre($this->input->post());

        // IF Search
        $search = $this->setSearch($search);
        if ($this->input->post('submit_permission_top')) {
            $input = $this->input->post();
            $input_group_id = $this->input->get('group_id');
            unset($input['submit_permission_top']);

            $this->main_model->delete_permission($input['group_id'][0]);

            foreach ($input['screen_id'] as $key => $value) {
                unset($input_update);
                $group_id = $input['group_id'][$key];

                $input_update['view'] = empty($input['view_' . ($key + 1)]) ? '0' : '1';
                $input_update['add'] = empty($input['add_' . ($key + 1)]) ? '0' : '1';
                $input_update['edit'] = empty($input['edit_' . ($key + 1)]) ? '0' : '1';
                $input_update['delete'] = empty($input['delete_' . ($key + 1)]) ? '0' : '1';
                $input_update['print'] = 0;
                $input_update['special1'] = 0;
                $input_update['special2'] = 0;
                $input_update['special3'] = 0;

                $this->main_model->update_data_permission($group_id, $value, $input_update);
            }

//            $this->session->set_flashdata('action', 'save_complete');
            redirect(base_url($this->modules.'?group_id='. $input_group_id . '#save_complete'));
        }

        $this->output_data['search'] = $search;
        //        protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $parent_id = '';
        $result = '';
        $result['total_rows'] = 0;
        $data_tmp = $this->main_model->select_data($search, $order_type, $order_by, $limit, $page, 0, $parent_id);
        foreach ($data_tmp as $key => $value) {
            $result['total_rows']++;
            $result['result'][] = $value;
            $data_1 = $this->main_model->select_data($search, $order_type, $order_by, $limit, $page, 1, $value['screen_id']);
            foreach ($data_1 as $key_1 => $value_1) {
                $result['total_rows']++;
                $result['result'][] = $value_1;
                $data_2 = $this->main_model->select_data($search, $order_type, $order_by, $limit, $page, 2, $value_1['screen_id']);
                foreach ($data_2 as $key_2 => $value_2) {
                    $result['total_rows']++;
                    $result['result'][] = $value_2;
                }
            }
        }
        $this->output_data['result'] = $result;

        $this->output_data['status'] = array(
            array('id' => "1", 'name' => $this->lang->line('label_select_all')),
            array('id' => "0", 'name' => $this->lang->line('label_select_none'))
        );

        $this->output_data['print'] = array(
            array('id' => "1", 'name' => $this->lang->line('label_select_yes')),
            array('id' => "0", 'name' => $this->lang->line('label_select_no'))
        );

        // css style in header
        $this->output_data["css"] = $this->load->view('user_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('user_js', $this->output_data, true);

        // load views
        $this->template->load($this->output_data, $this->template_name, $this->modules, 'index');
    }

}