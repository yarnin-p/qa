<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-6 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block"><?php echo $this->lang->line('label_title_head'); ?></h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <!--                            <li class="breadcrumb-item"><a href="index.html">Home</a>-->
                            <!--                            </li>-->
                            <!--                            <li class="breadcrumb-item"><a href="#">Components</a>-->
                            <!--                            </li>-->
                            <!--                            <li class="breadcrumb-item active">Advance Charts-->
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
                            <h4 class="card-title">ตารางรายชื่อผู้ใช้งานระบบ</h4>
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
                                                    <th class="text-left"
                                                        style="width: 60px;"><?php echo column_head('picture_th', $this, 'N'); ?></th>
                                                    <th><?php echo column_head('username_th', $this, 'Y', 'username', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('name_th', $this, 'Y', 'name', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('user_group_th', $this, 'Y', 'group_name', $order['by'], $order['type']); ?></th>
                                                    <th><?php echo column_head('last_login_th', $this, 'Y', 'last_active', $order['by'], $order['type']); ?></th>
                                                    <th class="text-left" style="width: 140px;">
                                                        <?php echo column_head('last_update_th', $this, 'Y', 'updated_date', $order['by'], $order['type']); ?>
                                                    </th>
                                                    <th class="text-center" style="width: 120px;">
                                                        <?php echo column_head('status_th', $this, 'Y', 'is_enable', $order['by'], $order['type']); ?>
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
                                                        $picture = $assets . 'img/avatar/avatar.png';
                                                        if (!empty($value['picture'])) {
                                                            $picture = base_url() . 'uploads/user/' . $value['picture'];
                                                        }
                                                        $user_update = $this->general->get_user_update($value['updated_by']);
                                                        $updated_date = $language == "tha" ? date_thai($value['updated_date']) : date_eng($value['updated_date']);
                                                        ?>
                                                        <tr>
                                                            <td class="text-left"><img src="<?php echo $picture; ?>"
                                                                                       class="img_32x32 img-circle"
                                                                                       style="width: 60px; height: 60px;"
                                                                                       alt="Image User">
                                                            </td>
                                                            <td><?php echo $value['username']; ?></td>
                                                            <td><?php echo $value['name']; ?></td>
                                                            <td><?php echo $value['group_name']; ?></td>
                                                            <td>
                                                                <?php echo time_elapsed_string($value['last_active'], $language); ?>
                                                                <i class="fa fa-clock-o" aria-hidden="true"
                                                                   data-toggle="tooltip"
                                                                   title="<?php echo $language == "tha" ? datetime_thai($value['last_active']) : datetime_full($value['last_active']); ?>"></i>
                                                            </td>
                                                            <td class="tex t-right">
                                                                <?php echo time_elapsed_string($value['updated_date'], $language); ?>
                                                                <i class="fa fa-clock-o" aria-hidden="true"
                                                                   data-toggle="tooltip"
                                                                   title="<?php echo $this->lang->line('label_update_by') . $user_update['name'] . '<br/>' . $updated_date; ?>"></i>
                                                            </td>
                                                            <td>
                                                                <div class="switch">
                                                                    <div class="onoffswitch">
                                                                        <input
                                                                                type="checkbox" <?php echo $value['is_enable'] == '1' ? 'checked' : ''; ?>
                                                                                class="onoffswitch-checkbox"
                                                                                id="status_<?php echo $value['id']; ?>"
                                                                                value="<?php echo $value['is_enable'] == '1' ? '1' : '0'; ?>"
                                                                                onclick="change_status(this, '<?php echo $value['id']; ?>');"
                                                                        >
                                                                        <label
                                                                                class="onoffswitch-label"
                                                                                for="status_<?php echo $value['id']; ?>">
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
                                                                    <a href="<?php echo $url_ajax . 'edit?id=' . $value['id']; ?>"
                                                                       class="btn btn-sm btn-warning text-white"
                                                                       data-toggle="tooltip"
                                                                       title="<?php echo $this->lang->line('label_edit_tooltip'); ?>">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                    <?php
                                                                }
                                                                if ($this->permission->state['delete'] && $value['id'] != '1') {
                                                                    ?>
                                                                    <a data-href="<?php echo $url_ajax . 'delete?id=' . $value['id']; ?>"
                                                                       class="btn btn-sm btn-danger text-white btn_delete"
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
</div>



