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
                    <?php if ($this->permission->state['add']) { ?>
                        <a href="<?php echo base_url($modules . '/add'); ?>"
                           class="btn btn-sm btn-primary"
                           data-toggle="tooltip"
                           title="<?php echo $this->lang->line('label_btn_add'); ?>">
                            <i class="fa fa-plus"></i> <?php echo $this->lang->line('label_btn_add'); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ตารางรายการเมนู</h4>
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
                                    <div class="offset-lg-8 coffset-md-8 col-lg-4 col-md-4 col-sm-12 col-12">
                                        <form class="form_search" method="get"
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
                                            <table class="table table-striped table-bordered">
                                                <thead class="bg-primary white">
                                                <tr>
                                                    <th><?php echo column_head('label_parent_menu', $this, 'N', 'screen_id', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_screen_id', $this, 'N', 'parent_id', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_level_no', $this, 'N', 'level_no', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_name_tha', $this, 'N', 'text_name_tha', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_name_eng', $this, 'N', 'text_name_eng', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_class_name', $this, 'N', 'class_name', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_icon', $this, 'N', 'icon', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('label_sort', $this, 'N', 'sort_no', $order['by'], $order['type']); ?></th>
                                                    <th class="text-center" style="width: 120px;">
                                                        <?php echo column_head('status_th', $this, 'N', 'is_enable', $order['by'], $order['type']); ?>
                                                    </th>
                                                    <th class="text-center" style="width: 150px;">
                                                        <?php echo column_head('operator_th', $this, 'N'); ?>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if (!empty($result['result'])) {
                                                    foreach ($result['result'] as $key => $value) {

                                                        if ($value['level_no'] == 0) {
                                                            $color = "#b5f1e4";
                                                        } else {
                                                            $color = "#e1fff9";
                                                        }
                                                        ?>
                                                        <tr bgcolor=<?php echo $color ?>>
                                                            <td><?php echo $value['parent_id']; ?></td>
                                                            <td><?php echo $value['screen_id']; ?></td>
                                                            <td><?php echo $value['level_no']; ?></td>
                                                            <td><?php echo $value['text_name_tha']; ?></td>
                                                            <td><?php echo $value['text_name_eng']; ?></td>
                                                            <td><?php echo $value['class_name']; ?></td>
                                                            <td><i class="fa <?php echo $value['icon']; ?> "
                                                                   aria-hidden="true"></i> <?php echo $value['icon']; ?>
                                                            </td>
                                                            <td><?php echo $value['sort_no']; ?></td>
                                                            <td>
                                                                <div class="switch">
                                                                    <div class="onoffswitch">
                                                                        <input
                                                                                type="checkbox" <?php echo $value['is_enable'] == '1' ? 'checked' : ''; ?>
                                                                                class="onoffswitch-checkbox"
                                                                                id="status_<?php echo $value['screen_id']; ?>"
                                                                                onclick="change_status(this, '<?php echo $value['screen_id']; ?>');">
                                                                        <label
                                                                                class="onoffswitch-label"
                                                                                for="status_<?php echo $value['screen_id']; ?>">
                                                                            <span class="onoffswitch-inner"></span>
                                                                            <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                if ($this->permission->state['edit']) {
                                                                    ?>
                                                                    <a href="<?php echo $url_ajax . 'edit?id=' . $value['screen_id']; ?>"
                                                                       class="btn btn-sm btn-warning text-white"
                                                                       data-toggle="tooltip"
                                                                       title="<?php echo $this->lang->line('label_edit_tooltip'); ?>">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                    <?php
                                                                }
                                                                if ($this->permission->state['delete']) {
                                                                    ?>
                                                                    <a data-href="<?php echo $url_ajax . 'delete?id=' . $value['screen_id']; ?>"
                                                                       class="btn btn-sm btn-danger btn_delete text-white"
                                                                       data-toggle="tooltip"
                                                                       title="<?php echo $this->lang->line('label_del_tooltip'); ?>">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center" colspan="8">
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


