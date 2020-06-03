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
                    <?php if ($this->permission->state['edit']) { ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">กานำเข้าข้อมูลสินค้าด้วย Excel File</h4>
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
                                        <form method="post" id="form_data" class="form form-horizontal"
                                              enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="supplier_id" class="">ซัพพลายเออร์</label>
                                                <select class="form-control"
                                                        name="supplier_id"
                                                        id="supplier_id" required>
                                                    <option value=""></option>
                                                    <?php
                                                    if (!empty($result_supplier)) {
                                                        foreach ($result_supplier as $skey => $supplier) {
                                                            ?>
                                                            <option value="<?php echo $supplier['supplier_id']; ?>">
                                                                <?php echo $supplier['supplier_name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id" class="">ประเภทสินค้า</label>
                                                <select class="form-control"
                                                        name="group_id"
                                                        id="group_id" required>
                                                    <option value=""></option>
                                                    <?php
                                                    if (!empty($result_group_product)) {
                                                        foreach ($result_group_product as $ckey => $cate_pro) {
                                                            ?>
                                                            <option value="<?php echo $cate_pro['group_id']; ?>">
                                                                <?php echo $cate_pro['group_name_tha']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="excel_file" class="">อัพโหลดไฟล์ Excel</label>
                                                <input type="file" name="excel_file" id="excel_file" required>
                                            </div>
                                            <button class="btn btn-primary"
                                                    type="submit">
                                                <?php echo $this->lang->line('label_btn_save'); ?>
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                            </button>
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

