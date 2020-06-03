<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_pagination extends CI_Pagination
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function dropdown_limit()
    {
        $config_limit = $this->CI->config->config['limit'];

        $limit = $this->CI->input->get('limit');
        $html = '<div class="input-group"><select class="form-control form-inline" id="limit">';
        foreach ($config_limit as $key => $value) {
            $html .= '<option value="' . $value . '" ' . ($limit == $value ? 'selected' : '') . ' >' . $value . '</option>';
        }
        $html .= '</select></div>';

        return $html;
    }

    function display_pagination()
    {
        $CI_output_data = $this->CI->load->_ci_cached_vars;
        $page_url = base_url($CI_output_data['modules']);
        $per_page = $CI_output_data['order']['limit'];
        $total = $CI_output_data['result']['total_rows'];
        $adjacents = 2;

        $page = empty($CI_output_data['order']['page']) ? 1 : $CI_output_data['order']['page'];
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;
        $setLastpage = ceil($total / $per_page);
        $lpm1 = $setLastpage - 1;

        $variable = $_GET;
        $get = '';

        if (!empty($variable)) {
            foreach ($variable as $k => $v) {
                if ($k !== 'page') {
                    $get .= '&' . $k . "=" . $v;
                }
            }
        }

        $pagination = '';
        if ($setLastpage > 1) {
//            $pagination .= '<div class="btn-group pull-right">';
            if ($prev) {
                $pagination .= '<a href="' . $page_url . "?page=" . $prev . $get . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-chevron-left"></i></a>';
            }

            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {
                    if ($counter == $page) {
                        $pagination .= '<a href="#" class="btn btn-sm btn-primary active">' . $counter . '</a>';
                    } else {
                        $pagination .='<a href="' . $page_url . "?page=" . $counter . $get . '">'.'<button class="btn btn-sm btn-outline-primary">'. $counter . '</button></a>';
                    }
                }
            } elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<a href="#" class="btn btn-sm btn-primary active">' . $counter . '</a>';
                        } else {
                            $pagination .='<a href="' . $page_url . "?page=" . $counter . $get . '">'.'<button class="btn btn-sm btn-outline-primary">'. $counter . '</button></a>';
                        }
                    }

                    $pagination .= '<a href="#" class="btn btn-sm btn-outline-primary">...</a>';
                    $pagination .= '<a href="' . $page_url . "?page=" . $lpm1 . $get . '" class="btn btn-sm btn-outline-primary">'.  $lpm1 . '</a>';
                    $pagination .= '<a href="' . $page_url . "?page=" . $setLastpage . $get . '" class="btn btn-sm btn-outline-primary">'. $setLastpage . '</a>';
                } else if ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= '<a href="' . $page_url . "?page=1" . $get . '" class="btn btn-sm btn-outline-primary">1</a>';
                    $pagination .= '<a href="' . $page_url . "?page=2" . $get . '" class="btn btn-sm btn-outline-primary">2</a>';
                    $pagination .= '<a href="#" class="btn btn-sm btn-outline-primary">...</a>';

                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<a href="#" class="btn btn-sm btn-primary active">' . $counter . '</a>';
                        } else {
                            $pagination .= '<a href="' . $page_url . "?page=" . $counter . $get . '" class="btn btn-sm btn-outline-primary">'. $counter . '</a>';
                        }
                    }
                    $pagination .= '<a href="#" class="btn btn-sm btn-outline-primary">...</a>';
                    $pagination .= '<a href="' . $page_url . "?page=" . $lpm1 . $get . '" class="btn btn-sm btn-outline-primary">'. $lpm1 . '</a>';
                    $pagination .= '<a href="' . $page_url . "?page=" . $setLastpage . $get . '" class="btn btn-sm btn-outline-primary">'. $setLastpage . '</a>';
                } else {
                    $pagination .= '<a href="' . $page_url . "?page=1" . $get . '" class="btn btn-sm btn-outline-primary">1</a>';
                    $pagination .= '<a href="' . $page_url . "?page=2" . $get . '" class="btn btn-sm btn-outline-primary">2</a>';
                    $pagination .= '<a href="#" class="btn btn-sm btn-white">...</a>';
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page) {
                            $pagination .= '<a href="#" class="btn btn-sm btn-primary active">' . $counter . '</a>';
                        } else {
                            $pagination .= '<a href="' . $page_url . "?page=" . $counter . $get . '" class="btn btn-sm btn-outline-primary">'. $counter . '</a>';
                        }
                    }
                }
            }

            if ($next) {
                $pagination .= '<a href="' . $page_url . "?page=" . $next . $get . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-chevron-right"></i></a>';
            }

//            $pagination .= '</div>';
        } else {
//            $pagination .= '<div class="btn-group pull-right">';
            $pagination .= '    <a href="#" class="btn btn-sm btn-primary active">1</a>';
//            $pagination .= '</div>';
        }

        return $pagination;
    }

    public function aftertable()
    {
        $CI_output_data = $this->CI->load->_ci_cached_vars;

        echo '<div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="row">
                <div class="col-md-2 col-12 d-flex justify-content-md-start align-items-md-center align-items-center my-1">
                    <form class="form-inline">
                        <div class="form-group">
                            ' . $this->dropdown_limit() . '
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-12 d-flex justify-content-md-center align-items-md-center justify-content-start my-1">
                    ' . $this->CI->lang->line('label_rows_number_preffix') . number_format($CI_output_data['result']['total_rows'], '0', '.', ',') . $this->CI->lang->line('label_rows_number_suffix') . '
                </div>
                <div class="col-md-2 col-12 d-flex justify-content-md-end align-items-md-center align-items-center justify-content-start my-1">
                    ' . $this->display_pagination() . '
                </div>
                </div>
                </div>
            </div>';
    }

    public function beforetable()
    {
        $CI_output_data = $this->CI->load->_ci_cached_vars;

        echo '<div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="row">
                <div class="col-md-2 col-12 d-flex justify-content-md-start align-items-md-center align-items-center my-1">
                    <form class="form-inline">
                        <div class="form-group">
                            ' . $this->dropdown_limit() . '
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-12 d-flex justify-content-md-center align-items-md-center justify-content-start my-1">
                    ' . $this->CI->lang->line('label_rows_number_preffix') . number_format($CI_output_data['result']['total_rows'], '0', '.', ',') . $this->CI->lang->line('label_rows_number_suffix') . '
                </div>
                <div class="col-md-2 col-12 d-flex justify-content-md-end align-items-md-center align-items-center justify-content-start my-1">
                    ' . $this->display_pagination() . '
                </div>
                </div>
                </div>
            </div>';
    }
}

?>