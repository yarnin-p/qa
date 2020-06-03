<div class="row wrapper border-bottom white-bg page-heading page-english_media_category">
    <div class="col-xs-12 col-md-4">
        <h2><?php echo $this->lang->line('label_title_head'); ?></h2>
    </div>
    <div class="col-xs-12 col-md-7">
        <form class="form_search group-btn-english-media" method="get" action="<?php echo $url_ajax; ?>">
            <input type="hidden" name="title_lang"
                   value="<?php echo empty($this->input->get('title_lang')) ? 'eng' : $this->input->get('title_lang'); ?>"/>
            <div class="col-sm-6">
                <label class="col-sm-4 control-label">
                    <?php echo $this->lang->line('user_group'); ?>
                </label>
                <div class="col-sm-8">
                    <select class="form-control select2"
                            id="group_id"
                            name="group_id"
                    >
                        <option value="">
                            <?php echo $this->lang->line('all') ?>
                        </option>

                        <?php
                        if (!empty($data_user_group)) {
                            foreach ($data_user_group as $key => $value) {
                                ?>
                                <option value="<?php echo $value['group_id']; ?>" <?php echo ($this->input->get('group_id')==$value['group_id'])?'selected':''; ?>>
                                    <?php echo $value['group_name_tha'] ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
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
                                <th><?php echo column_head('group_name_tha', $this, 'Y', 'group_name_tha', $order['by'], $order['type']); ?></th>
                                <th><?php echo column_head('name', $this, 'Y', 'name', $order['by'], $order['type']); ?></th>
                                <th><?php echo column_head('use_os', $this, 'Y', 'use_os', $order['by'], $order['type']); ?></th>
                                <th><?php echo column_head('user_agent', $this, 'Y', 'user_agent', $order['by'], $order['type']); ?></th>
                                <th><?php echo column_head('ip_address', $this, 'Y', 'ip_address', $order['by'], $order['type']); ?></th>
                                <th><?php echo column_head('login_date', $this, 'Y', 'login_date', $order['by'], $order['type']); ?></th>
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
                                        <td><?php echo $value['group_name_tha']; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['use_os']; ?></td>
                                        <td><?php echo $value['user_agent']; ?></td>
                                        <td><?php echo $value['ip_address']; ?></td>
                                        <td><?php echo date('d/m/Y H:i:s',strtotime($value['login_date'])); ?></td>
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