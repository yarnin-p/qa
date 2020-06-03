<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Import_product extends MY_Controller
{

    protected $modules = "import_product";
    private $model = "import_product_model";
    private $sorting_column = 'supplier_id';
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


        $this->output_data['result_group_product'] = $this->main_model->getAllProductCate();
        $this->output_data['result_supplier'] = $this->main_model->getAllSupplier();

        if ($_FILES && $this->input->post()) {

            $dateNow = date("Y-m-d H:i:s");

            $input = $this->input->post();
            $data['group_id'] = $input['group_id'];
            $data['supplier_id'] = $input['supplier_id'];
            $inputFileName = $_FILES['excel_file']['tmp_name'];

            $master_margin = $this->main_model->getMasterMargin($data['group_id']);

            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($inputFileName);

            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();

            $headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
            $headingsArray = $headingsArray[1];

            $r = -1;
            $namedDataArray = array();
            for ($row = 2; $row <= $highestRow; ++$row) {
                $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
                if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                    ++$r;
                    foreach ($headingsArray as $columnKey => $columnHeading) {
                        $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                    }
                }
            }

            foreach ($namedDataArray as $resx) {
                //Insert
                $query = " INSERT INTO tb_dealer_product_tmp 
                            (
                                refer_id
                                ,ref_no
                                ,name_tha
                                ,name_eng
                                ,name_chn
                                ,cost_price
                                ,gov_price_rate_1
                                ,gov_price_rate_2
                                ,gov_price_rate_3
                                ,enterprise_price_rate_1
                                ,enterprise_price_rate_2
                                ,enterprise_price_rate_3
                                ,m_dealer_price_rate_1
                                ,m_dealer_price_rate_2
                                ,m_dealer_price_rate_3
                                ,dealer_price_rate_1
                                ,dealer_price_rate_2
                                ,dealer_price_rate_3
                                ,cus_price_rate_1
                                ,cus_price_rate_2
                                ,cus_price_rate_3 
                                ,group_id
                                ,supplier_id
                                ,created_date
                                ,created_by
                            ) VALUES
                            (
                                '" . $resx['refer_id'] . "',
                                '" . $resx['ref_no'] . "',
                                '" . $resx['name_tha'] . "',
                                '" . $resx['name_eng'] . "',
                                '" . $resx['name_chn'] . "',
                                '" . $resx['cost_price'] . "',
                                '" . ((((int)$resx['gov_price_rate_1'] * (int)$master_margin) / 100) + (int)$resx['gov_price_rate_1']) . "',
                                '" . ((((int)$resx['gov_price_rate_2'] * (int)$master_margin) / 100) + (int)$resx['gov_price_rate_2']) . "',
                                '" . ((((int)$resx['gov_price_rate_3'] * (int)$master_margin) / 100) + (int)$resx['gov_price_rate_3']) . "',
                                '" . ((((int)$resx['enterprise_price_rate_1'] * (int)$master_margin) / 100) + (int)$resx['enterprise_price_rate_1']) . "',
                                '" . ((((int)$resx['enterprise_price_rate_2'] * (int)$master_margin) / 100) + (int)$resx['enterprise_price_rate_2']) . "',
                                '" . ((((int)$resx['enterprise_price_rate_3'] * (int)$master_margin) / 100) + (int)$resx['enterprise_price_rate_3']) . "',
                                '" . ((((int)$resx['m_dealer_price_rate_1'] * (int)$master_margin) / 100) + (int)$resx['m_dealer_price_rate_1']) . "',
                                '" . ((((int)$resx['m_dealer_price_rate_2'] * (int)$master_margin) / 100) + (int)$resx['m_dealer_price_rate_2']) . "',
                                '" . ((((int)$resx['m_dealer_price_rate_3'] * (int)$master_margin) / 100) + (int)$resx['m_dealer_price_rate_3']) . "',
                                '" . ((((int)$resx['dealer_price_rate_1'] * (int)$master_margin) / 100) + (int)$resx['dealer_price_rate_1']) . "',
                                '" . ((((int)$resx['dealer_price_rate_2'] * (int)$master_margin) / 100) + (int)$resx['dealer_price_rate_2']) . "',
                                '" . ((((int)$resx['dealer_price_rate_3'] * (int)$master_margin) / 100) + (int)$resx['dealer_price_rate_3']) . "',
                                '" . ((((int)$resx['cus_price_rate_1'] * (int)$master_margin) / 100) + (int)$resx['cus_price_rate_1']) . "',
                                '" . ((((int)$resx['cus_price_rate_2'] * (int)$master_margin) / 100) + (int)$resx['cus_price_rate_2']) . "',
                                '" . ((((int)$resx['cus_price_rate_3'] * (int)$master_margin) / 100) + (int)$resx['cus_price_rate_3']) . "',
                                '" . (int)$data['group_id'] . "',
                                '" . (int)$data['supplier_id'] . "',
                                '" . $dateNow . "',
                                '" . $this->user['id'] . "'
                            )";
//                var_dump($query);exit();
                $res_i = $query = $this->db->query($query);
            }

            if ($res_i) {
                redirect(base_url($this->modules . '#save_complete'));
            } else {
                redirect(base_url($this->modules . '#save_fail'));
            }
        }


        // css style in header
        $this->output_data["css"] = $this->load->view('index_css', $this->output_data, true);

        // javascript, jquery in footer
        $this->output_data["js"] = $this->load->view('index_js', $this->output_data, true);

        // load views
        $this->template->load($this->output_data, $this->template_name, $this->modules, 'index');
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