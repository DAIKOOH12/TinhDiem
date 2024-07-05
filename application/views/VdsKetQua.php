<?php
$this->load->view("layouts/header");
?>

<link rel="stylesheet" href="<?php echo base_url("assets/css/VdsKetQua.css") ?>">


<div class="main-page">
    <h2>DANH SÁCH KẾT QUẢ CHẤM THI</h2>
    <table border="0" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Minimum date:</td>
                <td><input type="date" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Maximum date:</td>
                <td><input type="date" id="max" name="max"></td>
            </tr>
        </tbody>
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
    </table>
</div>
<script>
    let minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    DataTable.ext.search.push(function(settings, data, dataIndex) {
        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[4]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    });

    // // Create date inputs
    // minDate = new DateTime('#min', {
    //     format: 'MMMM Do YYYY'
    // });
    // maxDate = new DateTime('#max', {
    //     format: 'MMMM Do YYYY'
    // });

    // DataTables initialisation
    let table = new DataTable('#example');

    // Refilter the table
    document.querySelectorAll('#min, #max').forEach((el) => {
        el.addEventListener('change', () => table.draw());
    });
</script>
<?php
$this->load->view("layouts/footer");
?>