<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Suppliers extends MY_Controller
{

    protected $modules = "suppliers";
    private $model = "suppliers_model";
    private $sorting_column = 'created_date';
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
//        var_dump($_SERVER['REQUEST_URI']);exit();
        // permission
        $this->permission->checkPermissionAccess('view');

        // breadcrumbs
        $this->breadcrumbs->push($this->lang->line('label_title_head'), '/');

        // search and select data
        $search = array(
            'txt_search' => '',
            'group_id' => ''
        );

        $order_by = ($this->input->get('orderby')) ? $this->input->get('orderby') : $this->sorting_column;
        $order_type = ($this->input->get('ordertype')) ? $this->input->get('ordertype') : $this->sorting_type;
        $limit = ($this->input->get('limit')) ? $this->input->get('limit') : $this->config->config['limit'][0];
        $page = ($this->input->get('page')) ? $this->input->get('page') : $this->config->config['first_page_no'];
        $this->output_data['order'] = array('type' => $order_type, 'by' => $order_by, 'limit' => $limit, 'page' => $page, 'main' => $this->sorting_column);

        // IF Search
        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;
        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }
        $this->output_data['result'] = $this->main_model->select_data($search, $order_type, $order_by, $limit, $page);

        /// check search
        if ($this->input->get('search_type') == '1') {
            $this->output_data['search_type'] = '1';
        }

        if (!empty($this->input->get())) {
            $txt_search = "";
            foreach ($this->input->get() as $key => $value) {
                $txt_search .= $key . '=' . $value . '&';
            }
        }

        if (!empty($txt_search)) {
            $txt_search = "?" . $txt_search;
            $this->output_data['txt_search'] = substr($txt_search, 0, -1);
        }

        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);

        // load views
        $this->template->load($this->output_data, $this->template_name, $this->modules, 'index');
    }

    public function add()
    {
        // permission
        $this->permission->checkPermissionAccess('add');

        // breadcrumbs
        $this->breadcrumbs->push($this->lang->line('label_title_head'), '/' . $this->modules);
        $this->breadcrumbs->push($this->lang->line('label_title_head_add'), '/');



        //IF Submit
        if (!empty($this->input->post())) {
            $input = $this->input->post();
            unset($input['submit']);

//            $image = $this->uploadImage('image', 'image_' . date('Ymd_His'), 'uploads/' . $this->modules, '200', '200');
//            if (!empty($image['imageName'])) {
//                $input['picture'] = $image['imageName'];
//            } else {
//                $input['picture'] = '';
//            }

            $input['supplier_name'] = $input['supplier_name'];
            $input['created_date'] = date('Y-m-d H:i:s');
            $input['created_by'] = $this->user['id'];
            $this->main_model->insert_data($input);

            redirect(base_url($this->modules . '#save_complete'));
        }

        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);

        // load views
        $this->template->load($this->output_data, $this->template_name, $this->modules, 'add');
    }

    public function edit()
    {
        // permission
        $this->permission->checkPermissionAccess('edit');

        // breadcrumbs
        $this->breadcrumbs->push($this->lang->line('label_title_head'), '/' . $this->modules);
        $this->breadcrumbs->push($this->lang->line('label_title_head_edit'), '/');

        // get id
        $id = $this->input->get('id');


        // data from model
        $this->output_data['result'] = $this->main_model->select_data_by_id($id);
    
        //IF Submit
        if (!empty($this->input->post())) {
            $input = $this->input->post();
            unset($input['submit']);
//            $image = $this->uploadImage('image', 'image_' . date('Ymd_His'), 'uploads/' . $this->modules, '200', '200');
//            if (!empty($image['imageName'])) {
//                $input['picture'] = $image['imageName'];
//            }

            $input['supplier_name'] = $input['supplier_name'];
            $this->main_model->update_data($id, $input);

            redirect(base_url($this->modules . '#save_complete'));
        }

        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);

        // load views
        $this->template->load($this->output_data, $this->template_name, $this->modules, 'edit');
    }

    
    public function change_status($id, $status)
    {
        $input["is_enable"] = $status;
        $this->main_model->update_data($id, $input);
    }

    public function delete()
    {
        $id = $this->input->get('id');
        $this->main_model->delete_data($id);
    }

}