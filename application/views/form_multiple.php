<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/Vupload.css'; ?>">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fontawesome/css/all.min.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Itim|Lobster|Montserrat:500|Noto+Serif|Nunito|Patrick+Hand|Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i|Roboto+Slab|Saira" rel="stylesheet">
    <title>Document</title>
</head>

<body>

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
                <h2>Nhập thông tin môn thi</h2>
                <form action="<?php echo site_url('site/spreadsheet_import') ?>" method="post" enctype="multipart/form-data" id="form-upload-key">
                    <div class="form_container">
                        <div class="input_wrap">
                            <label for="email">Danh sách môn đã có</label>
                            <select name="" id="dsmon">
                                <option value="">Kinh tế - Chính trị (7E13000)</option>
                                <option value="">Tiếng Anh cơ bản 3 (7E13203)</option>
                                <option value="">Triết học Mác - Lenin (7E32910)</option>
                                <option value="">Tiếng Anh cơ bản 1 (7E20304)</option>
                            </select>
                        </div>
                        <div class="input_wrap">
                            <label for="email">Nhập mã môn</label>
                            <input type="text" name="made" class="input" id="made">
                        </div>
                        <div class="input_wrap">
                            <label for="email">Nhập tên môn</label>
                            <input type="text" name="mamon" class="input" id="mamon">
                        </div>
                    </div>
                </form>
            </div>
            <div class="form_2 data_info" style="display: none;">
                <h2>Nhập đáp án</h2>
                <form action="<?php echo site_url('site/spreadsheet_import') ?>" method="post" enctype="multipart/form-data" id="form-upload-key">
                    <div class="form_container">
                        <div class="input_wrap">
                            <label for="input-made">Nhập mã đề</label>
                            <div class="add-files-group">
                                <div class="input-group">
                                    <input type="text" name="" id="" class="input input-made" placeholder="Định dạng file hỗ trợ .xlsx">
                                    <label for="upload_file" id="lbinput-file"><i class="fa-solid fa-file-circle-plus fa-2xl" style="color: #f19b38;margin-left: 10px"></i></label>
                                    <input type="file" name="upload_file_key" id="upload_file" class="form-control" placeholder="Enter file">
                                </div>
                            </div>
                            <div class="btn-add-files">
                                <i class="fa-solid fa-plus fa-xl" style="color: white;"></i>
                                <span style="color:white;">Thêm mã đề</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form_3 data_info" style="display: none;">
                <h2>Nhập bộ câu trả lời</h2>
                <form action="<?php echo site_url("site/upload") ?>" method="post" enctype="multipart/form-data" id="form-upload">
                    <div class="form_container">

                        <div class="input_wrap" style="display: flex;justify-content: center;">
                            <label for="file" id="lb-filedapan"><i class="fa-solid fa-file-circle-plus fa-2xl" style="color: white;margin-right: 10px"></i>Chọn file</label>
                        </div>
                        <div class="input_wrap" style="display: flex;justify-content: center;">
                            <input type="checkbox" name="cbSenđEmail" id="cbSendEmail"><span>Nhận thông báo qua email</span>
                            <input type="file" name="file[]" multiple id="file" placeholder="Định dạng file hỗ trợ: .xlsx" style="display: none;">
                            <!-- <button class="btn btn-primary" id="upload-btn"><i class="fa-solid fa-file-arrow-up" style="color: #ffffff;margin-right: 10px;"></i>Tải lên</button> -->
                        </div>
                        <div class="input_wrap" style="display: flex;justify-content: center;">
                            <h4>Các file đã thêm</h4>
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
            <div class="form_4 data_info" style="display: none;">
                <h2>Đang xử lí.....</h2>
                <div class="input_wrap" style="display: flex;justify-content: center;">
                    <div class="loader"></div>
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
                <button type="button" class="btn_next">Lưu đáp án <span class="icon">
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

</body>
<script src="<?php echo base_url(); ?>assets/js/upload_form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/custom.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

</html>