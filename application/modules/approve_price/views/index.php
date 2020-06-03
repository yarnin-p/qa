<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-6 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block"><?php echo $this->lang->line('label_title_head'); ?></h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <!--                            <li class="breadcrumb-item active">ซัพพลายเออร์-->
                            <!--                            </li>-->
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-6 mb-2 text-right d-flex align-items-center justify-content-end">
                <div class="btn-group float-md-right">
                    <?php if ($this->permission->state['edit']) { ?>
                        <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i> แก้ไข
                        </button>
                        <!--                        <a href="--><?php //echo base_url($modules . '/add'); ?><!--"-->
                        <!--                           class="btn btn-sm btn-primary"-->
                        <!--                           data-toggle="tooltip"-->
                        <!--                           title="--><?php //echo $this->lang->line('label_btn_add'); ?><!--">-->
                        <!--                            <i class="fa fa-plus"></i> --><?php //echo $this->lang->line('label_btn_add'); ?>
                        <!--                        </a>-->
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ตารางรายชื่อซัพพลายเออร์</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <!--                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>-->
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <!--                                    <li><a data-action="close"><i class="ft-x"></i></a></li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left d-flex justify-content-between"
                                         id="wrapper-search">
                                        <button class="btn btn-primary btn-save-approved mb-1">บันทึก</button>
                                        <form class="form_search mb-1" method="get"
                                              action="<?php echo $url_ajax; ?>">
                                            <div class="d-flex justify-content-end">
                                                <input type="hidden" name="title_lang"
                                                       value="<?php echo empty($this->input->get('title_lang')) ? 'eng' : $this->input->get('title_lang'); ?>"/>
                                                <input type="text" class="form-control rounded-0"
                                                       placeholder="<?php echo $this->lang->line('label_search'); ?>"
                                                       name="txt_search" id="txt_search"
                                                       value="<?php echo $this->input->get('txt_search'); ?>"
                                                    <?php echo $search_type == "1" ? "disabled" : ""; ?>>
                                                <button type="submit" class="btn btn-sm btn-success rounded-0"
                                                    <?php echo $search_type == "1" ? "disabled" : ""; ?>>
                                                    <i class="fa fa-search" aria-hidden="true"></i></button>
                                                <button type="button"
                                                        class="btn btn-sm btn-danger rounded-0 get_all_data"
                                                        data-href="<?php echo base_url($modules); ?>"
                                                    <?php echo $search_type == "1" ? "disabled" : ""; ?>>
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-12">
                                        <?php echo $this->pagination->beforetable(); ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-approved">
                                                <thead class="bg-primary white">
                                                <tr>
                                                    <th rowspan="2">
                                                        <?php echo column_head('label_tb_product', $this, 'Y', 't1.name_tha', $order['by'], $order['type']); ?>
                                                    </th>
                                                    <th style="width: 50px;" rowspan="2">
                                                        <?php echo column_head('label_tb_supplier', $this, 'Y', 't3.supplier_name', $order['by'], $order['type']); ?>
                                                    </th>
                                                    <th class="text-center" colspan="3">
                                                        <?php echo column_head('label_tb_gov', $this, 'N', '', $order['by'], $order['type']); ?>
                                                    </th>
                                                    <th class="text-center" colspan="3">
                                                        <?php echo column_head('label_tb_enterprise', $this, 'N', '', $order['by'], $order['type']); ?>
                                                    </th>
                                                    <th class="text-center" colspan="3">
                                                        <?php echo column_head('label_tb_master_dealer', $this, 'N', '', $order['by'], $order['type']); ?>
                                                    </th>
                                                    <th class="text-center" colspan="3">
                                                        <?php echo column_head('label_tb_dealer', $this, 'N', '', $order['by'], $order['type']); ?>
                                                    </th>
                                                    <th class="text-center" colspan="3">
                                                        <?php echo column_head('label_tb_customer', $this, 'N', '', $order['by'], $order['type']); ?>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th><?php echo column_head('label_tb_price_1', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_2', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_3', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_1', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_2', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_3', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_1', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_2', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_3', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_1', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_2', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_3', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_1', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_2', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_tb_price_3', $this, 'N', '', $order['by'], $order['type']); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if (!empty($result['result'])) {
                                                    foreach ($result['result'] as $key => $value) {
                                                        $user_update = $this->general->get_user_update($value['updated_by']);
                                                        $updated_date = $language == "tha" ? date_thai($value['updated_date']) : date_eng($value['updated_date']);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $value['name_tha']; ?></td>
                                                            <td><?php echo $value['supplier_name']; ?></td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['gov_price_rate_1']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['gov_price_rate_1']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['gov_price_rate_2']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['gov_price_rate_2']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['gov_price_rate_3']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['gov_price_rate_3']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['enterprise_price_rate_1']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['enterprise_price_rate_1']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['enterprise_price_rate_2']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['enterprise_price_rate_2']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['enterprise_price_rate_3']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['enterprise_price_rate_3']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['m_dealer_price_rate_1']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['m_dealer_price_rate_1']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['m_dealer_price_rate_2']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['m_dealer_price_rate_2']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['m_dealer_price_rate_3']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['m_dealer_price_rate_3']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['dealer_price_rate_1']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['dealer_price_rate_1']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['dealer_price_rate_2']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['dealer_price_rate_2']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['dealer_price_rate_3']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['dealer_price_rate_3']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['cus_price_rate_1']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['cus_price_rate_1']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['cus_price_rate_2']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['cus_price_rate_2']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       data-price="<?php echo $value['cus_price_rate_3']; ?>"
                                                                       class="tb-input-approved form-control"
                                                                       onblur="formatNumPrice(this);"
                                                                       value="<?php echo $value['cus_price_rate_3']; ?>">
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center" colspan="17">
                                                            <strong>
                                                                <?php echo $this->lang->line('label_data_no_table'); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php echo $this->pagination->aftertable(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

