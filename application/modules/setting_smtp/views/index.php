<div class="row wrapper border-bottom white-bg page-heading page-english_media_category">
    <div class="col-xs-12 col-md-4">
        <h2><?php echo $this->lang->line('label_title_head'); ?></h2>
    </div>
    <div class="col-xs-12 col-md-3">
        <?php if ($this->permission->state['add']) { ?>
            <div class="group-btn-english-media pull-right">
                <a href="<?php echo base_url($modules . '/add'); ?>"
                   class="btn btn-sm btn-export btn-success"
                   data-toggle="tooltip"
                   title="<?php echo $this->lang->line('label_btn_add'); ?>"
                >
                    <i class="fa fa-plus"></i> <?php echo $this->lang->line('label_btn_add'); ?>
                </a>
            </div>

            <div class="clearfix"></div>
        <?php } ?>
    </div>
    <div class="col-xs-12 col-md-5">
        <form class="form_search group-btn-english-media" method="get" action="<?php echo $url_ajax; ?>">
            <input type="hidden" name="title_lang"
                   value="<?php echo empty($this->input->get('title_lang')) ? 'eng' : $this->input->get('title_lang'); ?>"/>
            <div class="input-group">
                <input type="text"
                       placeholder="<?php echo $this->lang->line('label_search'); ?>"
                       class="input-sm form-control"
                       name="txt_search" id="txt_search"
                       value="<?php echo $this->input->get('txt_search'); ?>"
                    <?php echo $search_type == "1" ? "disabled" : ""; ?>
                />
                <span class="input-group-btn">
                    <button type="submit"
                            class="btn btn-sm btn-search"
                        <?php echo $search_type == "1" ? "disabled" : ""; ?>>
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </span>
                <span class="input-group-btn">
                    <button type="button"
                            class="btn btn-sm get_all_data"
                            data-href="<?php echo base_url($modules); ?>"
                        <?php echo $search_type == "1" ? "disabled" : ""; ?>>
                            <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped hd-grey">
                            <thead>
                            <tr>
                                <th><?php echo column_head('smtp_server', $this, 'Y', 'smtp_server', $order['by'], $order['type']); ?></th>
                                <th><?php echo column_head('ssl_tls', $this, 'Y', 'ssl_tls', $order['by'], $order['type']); ?></th>
                                <th><?php echo column_head('smtp_port', $this, 'Y', 'smtp_port', $order['by'], $order['type']); ?></th>
                                <th class="text-left" style="width: 130px;">
                                    <?php echo column_head('last_update_th', $this, 'Y', 'updated_date', $order['by'], $order['type']); ?>
                                </th>
                                <th class="text-center" style="width: 80px;">
                                    <?php echo column_head('status_th', $this, 'Y', 'is_enable', $order['by'], $order['type']); ?>
                                </th>
                                <th class="text-center" style="width: 70px;">
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
                                        $picture = 'uploads/user/' . $value['picture'];
                                    }
                                    $user_update = $this->general->get_user_update($value['updated_by']);
                                    $updated_date = $language == "tha" ? date_thai($value['updated_date']) : date_eng($value['updated_date']);
                                    ?>
                                    <tr>
                                        <td><?php echo $value['smtp_server']; ?></td>
                                        <td><?php echo $value['ssl_tls']; ?></td>
                                        <td><?php echo $value['smtp_port']; ?></td>
                                        <td class="tex t-right">
                                            <?php echo time_elapsed_string($value['updated_date'], $language); ?>
                                            <i class="fa fa-clock-o" aria-hidden="true"
                                               data-toggle="tooltip"
                                               title="<?php echo $this->lang->line('label_update_by') . $user_update['name'] .'<br/>'.  $updated_date; ?>"></i>

                                        </td>
                                        <td>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input
                                                        type="checkbox" <?php echo $value['is_enable'] == '1' ? 'checked' : ''; ?>
                                                        class="onoffswitch-checkbox"
                                                        id="status_<?php echo $value['smtp_id']; ?>"
                                                        value="<?php echo $value['is_enable'] == '1' ? '1' : '0'; ?>"
                                                        onclick="change_status(this, '<?php echo $value['smtp_id']; ?>');"
                                                    >
                                                    <label
                                                        class="onoffswitch-label"
                                                        for="status_<?php echo $value['smtp_id']; ?>">
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
                                                <a href="<?php echo $url_ajax . 'edit?smtp_id=' . $value['smtp_id']; ?>"
                                                   class="btn btn-xs btn-primary btn-bitbucket"
                                                   data-toggle="tooltip"
                                                   title="<?php echo $this->lang->line('label_edit_tooltip'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <?php
                                            }
                                            if ($this->permission->state['delete']) {
                                                ?>
                                                <a data-href="<?php echo $url_ajax . 'delete?smtp_id=' . $value['smtp_id']; ?>"
                                                   class="btn btn-xs btn-del btn-bitbucket btn_delete"
                                                   data-toggle="tooltip"
                                                   title="<?php echo $this->lang->line('label_del_tooltip'); ?>">
                                                    <i class="fa fa-trash"></i>
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
                        <?php echo $this->pagination->aftertable(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>