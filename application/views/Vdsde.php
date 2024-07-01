<?php $this->load->view('layouts/header'); ?>
<div class="main-page">
    <div class="title-ds-mon" style="display:flex;width: 80%;justify-content: space-between;">
        <h2>BỘ ĐÁP ÁN</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_mon" data-whatever="@mdo" id="addmon">Thêm môn thi</button>
    </div>
    <table class="table" id="data-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã đề</th>
                <th>Tên môn</th>
                <th>Thời gian tạo</th>
                <th>Số lượng câu</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody style="height: 150px;overflow: auto;" id="list-mon">
            <?php if (!empty($dsde)) { ?>
                <?php for ($i = 0; $i < count($dsde); $i++) { ?>
                    <tr class="ds-mon">
                        <th scope="row"><?php echo $i + 1; ?></th>
                        <td class="idde"><?php echo $dsde[$i]['sMaDe']; ?></td>
                        <td><?php echo $dsde[$i]['sTenMon']; ?></td>
                        <td><?php echo $dsde[$i]['dThoiGianTao']; ?></td>
                        <td><?php echo $dsde[$i]['iSoLuongCau']; ?></td>
                        <td>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr class="ds-mon">
                    <td style="text-align: center;" colspan="6">
                        <h2>Không tìm thấy dữ liệu</h2>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->load->view('layouts/footer') ?>