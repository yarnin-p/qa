<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
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
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <?php if ($this->permission->state['add']) { ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ตารางแสดงสิทธิ์ผู้ใช้งานระบบ</h4>
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
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-12">
                                        <form id="detailFormEdit" method="POST" class="form-horizontal"
                                              action="<?php echo base_url($modules . '?' . $_SERVER['QUERY_STRING']); ?>">
                                            <div class="row mb-2">
                                                <div class="col-lg-6 col-md-6 col-12 no-gutters">
                                                    <label class="col-sm-3 control-label">
                                                        <?php echo $this->lang->line('label_group_id'); ?>
                                                    </label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" id="permission_group">
                                                            <?php if (!empty($data_group_id)) {
                                                                foreach ($data_group_id as $k => $v) {
                                                                    $selected = '';
                                                                    if ($v['id'] == $this->input->get('group_id')) {
                                                                        $selected = 'selected';
                                                                    }
                                                                    ?>
                                                                    <option value="<?php echo $v['id'] ?>" <?php echo $selected; ?>>
                                                                        <?php echo $v['name'] ?>
                                                                    </option>
                                                                <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12 d-flex align-items-end justify-content-end">
                                                    <button type="submit"
                                                            name="submit_permission_top"
                                                            value="1"
                                                            class="btn btn-primary">
                                                        <?php echo $this->lang->line('button_save'); ?>
                                                        <i class="fas fa-save"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
                                                            <thead class="bg-primary white">
                                                            <tr>
                                                                <th>
                                                                    <?php echo column_head('page_th', $this, 'N'); ?>
                                                                </th>
                                                                <th class="text-center" style="width: 70px;">
                                                                    <?php //echo column_head('views_th', $this, 'N'); ?>
                                                                </th>
                                                                <th class="text-center" style="width: 70px;">
                                                                    <?php //echo column_head('add_th', $this, 'N'); ?>
                                                                </th>
                                                                <th class="text-center" style="width: 70px;">
                                                                    <?php //echo column_head('edit_th', $this, 'N'); ?>
                                                                </th>
                                                                <th class="text-center" style="width: 70px;">
                                                                    <?php //echo column_head('delete_th', $this, 'N'); ?>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if (!empty($result['result'])) {
                                                                $i = 1;

                                                                foreach ($result['result'] as $key => $value) {
                                                                    if ($value['level_no'] == '0') {
                                                                        $level_no[0] = $value['view'];
                                                                        $level_no[1] = 0;
                                                                        $level_no[2] = 0;
                                                                    } else if ($value['level_no'] == '1') {
                                                                        $level_no[1] = $value['view'];
                                                                        $level_no[2] = 0;
                                                                    } else if ($value['level_no'] == '2') {
                                                                        $level_no[2] = $value['view'];
                                                                    }

                                                                    $white_space = '';
                                                                    $text_name = '<h4 style="margin: 0;">' . $value['text_name'] . '</h4>';
                                                                    if ($value['level_no'] > 0) {
                                                                        $white_space = 'style="padding-left:' . ($value['level_no'] * 30) . 'px;"';
                                                                        $text_name = $value['text_name'];
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td <?php echo $white_space; ?>>
                                                                            <input type="hidden" name="screen_id[]"
                                                                                   value="<?php echo $value['screen_id']; ?>">
                                                                            <input type="hidden" name="group_id[]"
                                                                                   value="<?php echo $value['group_id']; ?>">
                                                                            <?php echo $text_name; ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <div class="checkbox checkbox-success">
                                                                                <input name="view_<?php echo $i; ?>"
                                                                                       type="checkbox"
                                                                                       id="chk_view<?php echo $value['screen_id']; ?>"
                                                                                       value="1"
                                                                                    <?php
                                                                                    $scn_id = substr($value['screen_id'], -2);
                                                                                    echo $scn_id == 00 ? 'onclick="check_view(this);"' : '';
                                                                                    ?>
                                                                                    <?php echo $value['view'] == '1' ? 'checked' : ''; ?>
                                                                                >
                                                                                <label for="chk_view<?php echo $value['screen_id']; ?>">
                                                                                    <?php echo $this->lang->line('views_th'); ?>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <div class="checkbox checkbox-success">
                                                                                <input name="add_<?php echo $i; ?>"
                                                                                       type="checkbox"
                                                                                       id="chk_add<?php echo $value['screen_id']; ?>"
                                                                                       value="1"
                                                                                    <?php
                                                                                    $scn_id = substr($value['screen_id'], -2);
                                                                                    echo ($value['view'] !== '1' && $value['add'] !== '1' && $value['edit'] !== '1' && $value['delete'] !== '1') && $scn_id == 00 ? 'disabled' : '';
                                                                                    ?>
                                                                                    <?php echo $value['add'] == '1' ? 'checked' : ''; ?>
                                                                                >
                                                                                <label for="chk_add<?php echo $value['screen_id']; ?>">
                                                                                    <?php echo $this->lang->line('add_th'); ?>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <div class="checkbox checkbox-success">
                                                                                <input name="edit_<?php echo $i; ?>"
                                                                                       type="checkbox"
                                                                                       id="chk_edit<?php echo $value['screen_id']; ?>"
                                                                                       value="1"
                                                                                    <?php
                                                                                    $scn_id = substr($value['screen_id'], -2);
                                                                                    echo ($value['view'] !== '1' && $value['add'] !== '1' && $value['edit'] !== '1' && $value['delete'] !== '1') && $scn_id == 00 ? 'disabled' : '';
                                                                                    ?>
                                                                                    <?php echo $value['edit'] == '1' ? 'checked' : ''; ?>
                                                                                >
                                                                                <label for="chk_edit<?php echo $value['screen_id']; ?>">
                                                                                    <?php echo $this->lang->line('edit_th'); ?>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <div class="checkbox checkbox-success">
                                                                                <input name="delete_<?php echo $i; ?>"
                                                                                       type="checkbox"
                                                                                       id="chk_delete<?php echo $value['screen_id']; ?>"
                                                                                       value="1"
                                                                                    <?php
                                                                                    $scn_id = substr($value['screen_id'], -2);
                                                                                    echo ($value['view'] !== '1' && $value['add'] !== '1' && $value['edit'] !== '1' && $value['delete'] !== '1') && $scn_id == 00 ? 'disabled' : '';
                                                                                    ?>
                                                                                    <?php echo $value['delete'] == '1' ? 'checked' : ''; ?>
                                                                                >
                                                                                <label for="chk_delete<?php echo $value['screen_id']; ?>">
                                                                                    <?php echo $this->lang->line('delete_th'); ?>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center" colspan="5">
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
                                                </div>
                                            </div>
                                        </form>
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


