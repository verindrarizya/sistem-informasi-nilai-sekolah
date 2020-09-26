<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1'>
    <tr>
        <th>Nomor Induk Siswa</th>
        <th>Nama Lengkap</th>
        <th>Alamat</th>
    </tr>

    <?php
    foreach($result as $data){
        echo "<tr>
                <td>$data[0]</td>
                <td>$data[1]</td>
                <td>$data[2]</td>
              </tr>";
    }
    ?>
</table>