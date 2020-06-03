<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function column_head($label, $CI, $is_sort, $field_sorting = '', $sort_by = '', $sort_type = '', $class = '')
{
    $text_lang = $CI->lang->line($label);
    $table_head = $text_lang;

    return $table_head;
}

//function column_sort($label, $CI, $is_sort, $field_sorting = '', $sort_by = '', $sort_type = '', $class = '')
//{
//    $text_lang = $CI->lang->line($label);
//    $table_head = $text_lang;
//
//    return $table_head;
//}

function column_sort($label, $CI, $is_sort, $field_sorting = '', $sort_by = '', $sort_type = '', $class = '')
{
    $text_lang = $CI->lang->line($label);
    $table_head = $text_lang;
    if (strtoupper($is_sort) == 'Y') {
        $input = $CI->input->get();

        $input['ordertype'] = $field_sorting;
        if ($field_sorting != $sort_by) {
            $input['orderby'] = $field_sorting;
            $input['ordertype'] = $sort_type;

            $i = ' <i class="fa fa-fw fa-sort"></i>';
        } else {
//            $input['ordertype'] = ($sort_type == 'ASC') ? 'DESC' : 'ASC';
            $input['ordertype'] = $sort_type;
            $input['orderby'] = $field_sorting;
            $i = ' <i class="fa fa-fw ' . 'fa-sort-asc' . '"></i>';
//            $i = ' <i class="fa fa-fw ' . (($sort_type == 'ASC') ? 'fa-sort-asc' : 'fa-sort-desc') . '"></i>';
        }

        $query_string = http_build_query($input);
        $table_head = '<a href="?' . $query_string . '" class="' . $class . 'btn btn-primary text-white" style="margin-bottom:0px;">' . $text_lang . $i . '</a>';
    }

    return $table_head;
}