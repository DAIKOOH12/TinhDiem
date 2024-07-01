<?php $this->load->view('layouts/header'); ?>
<div class="main-page">
    <div class="title-ds-mon" style="display:flex;width: 80%;justify-content: space-between;">
        <h2>DANH SÁCH MÔN THI</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_mon" data-whatever="@mdo" id="addmon">Thêm môn thi</button>
    </div>
    <table class="table" id="data-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã môn</th>
                <th>Tên môn</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody style="height: 150px;overflow: auto;" id="list-mon">
            <?php for ($i = 0; $i < count($dsmon); $i++) { ?>
                <tr class="ds-mon">
                    <th scope="row"><?php echo $i + 1; ?></th>
                    <td class="idmon"><?php echo $dsmon[$i]['idMon']; ?></td>
                    <td class="namemon"><?php echo $dsmon[$i]['sTenMon']; ?></td>
                    <td>
                        <div class="action">
                            <div class="btn-details"><a href="./quanlyde?id=<?php echo $dsmon[$i]['idMon']; ?>"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></a></div>
                            <div class="btn-fix"><i class="fa-solid fa-wrench" style="color: #ffffff;" data-toggle="modal" data-target="#modal_mon" data-whatever="@mdo"></i></i></div>
                            <div class="btn-delete"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="modal_mon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tieudemodal">Thêm môn thi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="mamon" class="col-form-label">Mã môn thi:</label>
                        <input type="text" class="form-control" id="mamon">
                    </div>
                    <div class="form-group">
                        <label for="tenmon" class="col-form-label">Tên môn thi:</label>
                        <input type="text" class="form-control" id="tenmon">
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