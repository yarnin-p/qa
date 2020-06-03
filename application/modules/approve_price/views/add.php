<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('label_title_head_add'); ?></h2>
        <?php echo $this->breadcrumbs->show(); ?>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="post" id="form_data" class="form-horizontal" enctype="multipart/form-data">
                        <div class="no-body" style="padding: 8px 10px;">
                            <div class="form-group">
                                <label for="group_id" class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_form_product_cate'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="group_id" id="group_id">
                                        <?php if (!empty($pro_cate)) { ?>
                                            <option value=""></option>
                                            <?php foreach ($pro_cate as $key => $cate) { ?>
                                                <option value="<?php echo $cate['group_id']; ?>"><?php echo $cate['group_name_tha']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="margin_price" class="col-sm-3 control-label" required>
                                    <?php echo $this->lang->line('label_form_margin'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="number"
                                           min="0"
                                           name="margin_price"
                                           id="margin_price"
                                           placeholder="เช่น 1, 2..."
                                           class="form-control">
                                </div>
                            </div>
                            <!--                            <div class="form-group">-->
                            <!--                                <label class="col-sm-3 control-label">-->
                            <!--                                    --><?php //echo $this->lang->line('label_form_supplier_img'); ?>
                            <!--                                </label>-->
                            <!--                                <div class="col-sm-9">-->
                            <!--                                    <div class="row col-sm-12">-->
                            <!--                                        <img id="show_image" class="img_200x200"-->
                            <!--                                             src="http://placehold.it/200x200"-->
                            <!--                                             alt="Upload Image"/>-->
                            <!--                                        <input type="file"-->
                            <!--                                               name="image"-->
                            <!--                                               id="image"-->
                            <!--                                               onchange="preview_image(event, this);"-->
                            <!--                                               accept="image/*"-->
                            <!--                                               data-rule-required="false"-->
                            <!--                                               data-msg-required="-->
                            <?php //echo $this->lang->line('label_error_image'); ?><!--"-->
                            <!--                                               class="hidden"/>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="row col-sm-12">-->
                            <!--                                        <button type="button" class="btn btn-success btn-select-img"-->
                            <!--                                                onclick="choice_img('image');">-->
                            <!--                                            เลือกไฟล์ <i class="fa fa-picture-o" aria-hidden="true"></i>-->
                            <!--                                        </button>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>

                        <div class="">
                            <ul class="list-unstyled list-inline text-center">
                                <li>
                                    <button class="btn btn-primary"
                                            type="submit">
                                        <?php echo $this->lang->line('label_btn_save'); ?>
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                            class="btn btn-default"
                                            style="margin-left: 0;"
                                            onclick="window.location.href='<?php echo $url_ajax; ?>'">
                                        <?php echo $this->lang->line('label_btn_cancel'); ?>
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>