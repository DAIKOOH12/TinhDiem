<?php $this->load->view('layouts/header'); ?>
<div class="main-page">
    <h2>DANH SÁCH MÔN THI</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Thêm môn thi</button>
    <table class="table" id="data-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã môn</th>
                <th>Tên môn</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody style="height: 150px;overflow: auto;">
            <?php for ($i = 0; $i < count($dsmon); $i++) { ?>
                <tr>
                    <th scope="row"><?php echo $i + 1; ?></th>
                    <td><?php echo $dsmon[$i]['idMon']; ?></td>
                    <td><?php echo $dsmon[$i]['sTenMon']; ?></td>
                    <td>
                        <div class="action">
                            <div class="btn-details"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></div>
                            <div class="btn-fix"><i class="fa-solid fa-wrench" style="color: #ffffff;"></i></i></div>
                            <div class="btn-delete"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm môn thi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mã môn thi:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên môn thi:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="button-action">Thực hiện</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layouts/footer') ?>