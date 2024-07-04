<?php $this->load->view('layouts/header'); ?>
<!-- Start Content -->
<div class="wrapper">
    <div class="header">
        <ul>
            <li class="active form_1_progessbar">
                <div>
                    <p>1</p>
                </div>
            </li>
            <li class="form_2_progessbar">
                <div>
                    <p>2</p>
                </div>
            </li>
            <li class="form_3_progessbar">
                <div>
                    <p>3</p>
                </div>
            </li>
            <li class="form_4_progessbar">
                <div>
                    <p>4</p>
                </div>
            </li>
        </ul>
    </div>
    <div class="form_wrap">
        <div class="form_1 data_info">
            <h3 style="text-align: center;">Nhập đáp án</h3>
            <form action="<?php echo site_url('site/spreadsheet_import') ?>" method="post" enctype="multipart/form-data" id="form-upload-dapan">
                <div class="form_container">
                    <div class="input_wrap">
                        <label for="input-made">Nhập mã đề</label>
                        <div class="add-files-group">
                            <div class="input-group">
                                <input type="text" class="input input-made" placeholder="Định dạng hỗ trợ .xlsx">
                                <input type="file" name="upload_file_key" class="upload_file form-control" placeholder="Enter file">
                                <!-- <span class="btn_removeDA"><i style="margin-left: 10px;" class="fa-solid fa-xmark"></i></span> -->
                            </div>
                        </div>
                        <div class="btn-add-files btn-add_md">
                            <i class="fa-solid fa-plus fa-xl" style="color: white;"></i>
                            <span style="color:white;">Thêm mã đề</span>
                        </div>
                    </div>
                    <!-- <div class="input_wrap" style="display: flex;justify-content: center;flex-wrap: wrap;" id="list-dapan">
                        <h5>Các file đã thêm</h5>
                        <div class="list-file-dapan">
                            <div class="file-items">DapAn.xlsx</div>
                            <div class="btn-del-dapan"><i class="fa-solid fa-trash delete-dapan" style="color: #eb0000;"></i></div>
                        </div>
                    </div> -->
                </div>
            </form>
        </div>
        <div class="form_2 data_info" style="display: none;">
            <h2>Nhập bộ câu trả lời</h2>
            <form action="<?php echo site_url("site/upload") ?>" method="post" enctype="multipart/form-data" id="form-upload">
                <div class="form_container">
                    <div class="input_wrap" style="display: flex;justify-content: center;">
                        <label for="file" id="lb-filedapan"><i class="fa-solid fa-file-circle-plus fa-2xl" style="color: white;margin-right: 10px"></i>Chọn file</label>
                    </div>
                    <div class="input_wrap" style="display: flex;justify-content: center;">
                        <!-- <input type="checkbox" name="cbSenđEmail" id="cbSendEmail"><span>Nhận thông báo qua email</span> -->
                        <input type="file" name="file[]" multiple id="file" placeholder="Định dạng file hỗ trợ: .xlsx" style="display: none;">
                        <!-- <button class="btn btn-primary" id="upload-btn"><i class="fa-solid fa-file-arrow-up" style="color: #ffffff;margin-right: 10px;"></i>Tải lên</button> -->
                    </div>
                    <div class="input_wrap" style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                        <h4>Các file đã thêm</h4>
                        <ul id="listFiles">


                        </ul>
                    </div>
                    <!-- <div class="progress" style="display:none;width: 100%;">
                            <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                20%
                            </div>
                        </div> -->
                    <ul class="list-group">

                    </ul>
                </div>
            </form>
        </div>
        <div class="form_3 data_info" style="display: none;">
            <div class="input_wrap" style="display: flex;justify-content: center;">
                <h4>Bắt đầu thực hiện tính toán?</h4>
            </div>
        </div>
        <div class="form_4 data_info" style="display: none;">
            <h2 id="form4_title">Đang xử lí.....</h2>
            <div class="input_wrap" style="display: flex;justify-content: center;">
                <div class="loader"></div>
                <form action="<?php echo site_url("Caculation/get_excel") ?>" method="post" id="form-TaiXuong">
                    <button type="submit" id="btn_taiXuong" style="display: none;">Tải xuống kết quả</button>
                </form>
            </div>

        </div>
    </div>
    <div class="btns_wrap">
        <div class="common_btns form_1_btns">
            <button type="button" class="btn_next">Tiếp<span class="icon">
                    <ion-icon name="arrow-forward-sharp"></ion-icon>
                </span></button>
        </div>
        <div class="common_btns form_2_btns" style="display: none;">
            <button type="button" class="btn_back"><span class="icon">
                    <ion-icon name="arrow-back-sharp"></ion-icon>
                </span>Quay lại</button>
            <button type="button" class="btn_next" id="btn-save-dapan">Lưu đáp án <span class="icon">
                    <ion-icon name="arrow-forward-sharp"></ion-icon>
                </span></button>
        </div>
        <div class="common_btns form_3_btns" style="display: none;">
            <button type="button" class="btn_back"><span class="icon">
                    <ion-icon name="arrow-back-sharp"></ion-icon>
                </span>Quay lại</button>
            <button type="button" class="btn_next">Thực hiện</button>
        </div>

    </div>
</div>

<div class="modal_wrapper">
    <div class="shadow"></div>
    <div class="success_wrap">
        <span class="modal_icon">
            <ion-icon name="checkmark-sharp"></ion-icon>
        </span>
        <p>You have successfully completed the process.</p>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/upload_form.js"></script>
<?php $this->load->view('layouts/footer') ?>