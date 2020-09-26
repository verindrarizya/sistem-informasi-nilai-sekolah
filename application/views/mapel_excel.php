<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1'>
    <tr>
        <th>No.</th>
        <th>Kode Mapel</th>
        <th>Nama Mapel</th>
        <th>Angka Ketuntasan Minimal</th>
    </tr>

    <?php
    $no=1;
    foreach($result as $data){
        echo "<tr>
                <td>$no.</td>
                <td>$data[0]</td>
                <td>$data[1]</td>
                <td>$data[2]</td>
              </tr>";
        $no++;
    }
    ?>
</table>