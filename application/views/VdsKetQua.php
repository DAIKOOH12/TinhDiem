<?php
$this->load->view("layouts/header");
?>
<div class="main-page">
    <h2 style="width: 100%;text-align: center;">DANH SÁCH KẾT QUẢ CHẤM THI</h2>
    <div class="datepicker">
        <input type="text" id="mindate" placeholder="Từ ngày">
        <input type="text" id="maxdate" placeholder="Đến ngày">
    </div>
    <table class="table" id="data-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên môn</th>
                <th>Thời gian</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody style="height: 150px;overflow: auto;">
            <?php for ($i = 0; $i < count($dskq); $i++) { ?>
                <tr>
                    <th scope="row"><?php echo $i + 1; ?></th>
                    <td><?php echo $dskq[$i]['sTenMon']; ?></td>
                    <td><?php echo $dskq[$i]['dThoiGian']; ?></td>
                    <td>
                        <div class="action">
                            <div class="btn-download"><a href="<?php echo base_url() . $dskq[$i]["sDuongDan"] . ".xlsx"; ?>" download="<?php echo $dskq[$i]["sTenFile"] . ".xlsx"; ?>"><i class="fa-solid fa-download" style="color: #ffffff;"></i></a></div>
                            <div class="btn-delete"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $("#mindate").datepicker({
        dateFormat: 'dd/mm/yy',
    });
    $("#maxdate").datepicker({
        dateFormat: 'dd/mm/yy',
    });
</script>
<?php
$this->load->view("layouts/footer");
?>