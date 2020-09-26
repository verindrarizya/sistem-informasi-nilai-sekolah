<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
foreach($result as $data){?>
<table border='0' width='100%'>
    <tr>
    <td valign='top'>
                NIS : <?php echo $data[0];?><br>
                Nama: <?php echo $data[1];?><br>
    </td>
    </tr>
    </table>
<?php break;}
?>

<table border='1'>
    <tr>
        <th>No.</th>
        <th>Nama Mapel</th>
        <th>AKM</th>
        <th>Absen</th>
        <th>Tugas</th>
        <th>UTS</th>
        <th>UAS</th>
        <th>Nilai Akhir</th>
        <th>Keterangan</th>
    </tr>

    <?php
    $no = 1;
    $total = 0;
    $jum = 0;
    foreach($result as $data){
        $na = ($data[4]+$data[5]+$data[6]+(($data[7]*2)/2))/4;
            $total = number_format($total + $na,1);
            $jum++;
            if($na >= $data[3]){
                $ket = "Terpenuhi";
            }else{
                $ket = "Tidak Terpenuhi";
            }
        echo "<tr>
                <td>$no</td>
                <td>$data[2]</td>
                <td>$data[3]</td>
                <td>$data[4]</td>
                <td>$data[5]</td>
                <td>$data[6]</td>
                <td>$data[7]</td>
                <td>$na</td>
                <td>$ket</td>
              </tr>";
        $no++;
    }
    $rata = $total/$jum;
    ?>
    <tr>
        <td colspan='7' align='right'>Total :</td>
            <td><?php echo $total; ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan='7' align='right'>Rata - Rata :</td>
        <td><?php echo number_format($rata,1);?></td>
        <td></td>
    </tr>
</table>