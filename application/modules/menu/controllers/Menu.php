<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Menu extends MY_Controller
{

    protected $modules = "menu";
    private $model = "menu_model";
    private $sorting_column = 'id';
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
        $this->permission->checkPermissionAccess('view');

        // breadcrumbs
        $this->breadcrumbs->push($this->lang->line('label_title_head'), '/');

        // search and select data
        $search = array(
            'txt_search' => ''
        );

        $search = $this->setSearch($search);
        $this->output_data['search'] = $search;

        // protect sql injection
        foreach ($search as $key => $value) {
            $search[$key] = addslashes($value);
        }

        $order_by = ($this->input->get('orderby')) ? $this->input->get('orderby') : $this->sorting_column;
        $order_type = ($this->input->get('ordertype')) ? $this->input->get('ordertype') : $this->sorting_type;
        $limit = ($this->input->get('limit')) ? $this->input->get('limit') : $this->config->config['limit'][0];
        $page = ($this->input->get('page')) ? $this->input->get('page') : $this->config->config['first_page_no'];
        $this->output_data['order'] = array('type' => $order_type, 'by' => $order_by, 'limit' => $limit, 'page' => $page, 'main' => $this->sorting_column);


        $this->output_data['result'] = $this->main_model->select_data($search, $order_type, $order_by, $limit, $page);

        /// check search
        if ($this->input->get('search_type') == '1') {
            $this->output_data['search_type'] = '1';
        }
        else{
            $this->output_data['search_type'] = '0';
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
        $this->output_data["css"] = $this->load->view('menu_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('menu_js', $this->output_data, true);

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

         //data from model
        $this->output_data['get_menu_level'] = $this->main_model->get_menu_level();

        //IF Submit
        if (!empty($this->input->post())) {
            $input = $this->input->post();
            unset($input['submit']);

            $input['screen_id'] = $input['screen_id'];
            $input['text_name_tha'] = $input['text_name_tha'];
            $input['text_name_eng'] = $input['text_name_eng'];
            $input['class_name'] = $input['class_name'];
            $input['icon'] = $input['icon'];
            $input['sort_no'] = $input['sort_no'];
            $input['created_date'] = date('Y-m-d H:i:s');

            if($input['parent_id'] == '-1'){
                $input['parent_id'] = substr($input['screen_id'],0,2 );
                $input['level_no'] = '0';
            }else{
                $input['parent_id'] = $input['parent_id'];
                $input['level_no'] = '1';
            }
            
            $this->main_model->insert_data($input);

            redirect(base_url($this->modules . '#save_complete'));
        }
        
        // css style in header
        $this->output_data["css"] = $this->load->view('menu_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('menu_js', $this->output_data, true);

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

        $this->output_data['get_menu_level'] = $this->main_model->get_menu_level();
    
        //IF Submit
        if (!empty($this->input->post())) {
            $input = $this->input->post();
            unset($input['submit']);

            $input['screen_id'] = $input['screen_id'];
            $input['text_name_tha'] = $input['text_name_tha'];
            $input['text_name_eng'] = $input['text_name_eng'];
            $input['class_name'] = $input['class_name'];
            $input['icon'] = $input['icon'];
            $input['sort_no'] = $input['sort_no'];
            if($input['parent_id'] == '-1'){
                $input['parent_id'] = substr($input['screen_id'],0,2 );
                $input['level_no'] = '0';
            }else{
                $input['parent_id'] = $input['parent_id'];
                $input['level_no'] = '1';
            }
            $input['parent_id'] = $input['parent_id'];

            $this->main_model->update_data($id, $input);

            redirect(base_url($this->modules . '#save_complete'));
        }

        // css style in header
        $this->output_data["css"] = $this->load->view('menu_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('menu_js', $this->output_data, true);

        // load views
        $this->template->load($this->output_data, $this->template_name, $this->modules, 'edit');
    }
    
    public function change_status($id, $status)
    {
        $input["is_enable"] = $status;
        $this->main_model->update_data($id, $input);
    }

    public function check_screen_no(){

        if (isset($_POST)) {
            $input = $_POST; 
            $screen_id = $input['screen_id']; 
            $result = $this->main_model->select_data_by_id($screen_id); 

            if(!$result) {
                $output['status'] = "OK";
            }else{
                $output['status'] = "Fail"; 
            }
        }
        echo json_encode($output);

    }
    
    public function delete()
    {
        $id = $this->input->get('id');
        $this->main_model->delete_data($id);
    }

}