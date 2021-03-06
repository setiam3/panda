<?php

//foreach ($model as $data){
    foreach ($data->kelas_pelayanan as $srv_type){
        $jns_rawat = $srv_type['f1'];
    }

    foreach ($data->unit_layanan as $unit_layanan){
        $nm_unit = $unit_layanan['f2'];
    }
//};

//echo $nm_unit; die();
?>

<table class="satu" border="0" width="100%">
    <tr>
        <td>
            <table border="0">
                <tr>
                    <td></td>
                    <td><img src="<?php echo Yii::getAlias('@web').'/logo_rs.png' ?>" width="7%"/></td>
                    <td><b>RSUD IBNU SINA KABUPATEN GRESIK</b><br>
                        <h5 style="font-size:10px;">JL. DR. WAHIDIN SH NO.243 B GRESIK - 0313951239<br>GRESIK</h5></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<h4 align="center" style="padding-bottom:0px; margin-bottom:0px">DATA RUANG PERAWATAN PASIEN</h4>
<p align="center" style="padding-top:0px; margin-top:0px; font-size:10px;"></p>
<table width="100%" style="font-size:12px;">
    <tr>
        <td style="font-weight: 900;" class="field_judul" width="4%">1.</td>
        <td style="font-weight: 900;" class="field_judul" width="20%">Nama Rumah Sakit</td>
        <td width="2%">:</td>
        <td colspan="4">RSUD IBNU SINA KABUPATEN GRESIK</td>
    </tr>
    <tr>
        <td style="font-weight: 900;" class="field_judul">2.</td>
        <td style="font-weight: 900;" class="field_judul">Nomor Rekam Medik</td>
        <td>:</td>
        <td ><?=$data->px_norm?></td>
        <td style="font-weight: 900;" class="field_judul">NIK</td>
        <td>:</td>
        <td ><?=$data->px_noktp?></td>
    </tr>
    <tr>
        <td style="font-weight: 900;" class="field_judul">3.</td>
        <td style="font-weight: 900;" class="field_judul">Nama Pasien</td>
        <td>:</td>
        <td colspan="4"><?=strtoupper($data->px_name)?></td>
    </tr>

    <tr>
        <td style="font-weight: 900;" class="field_judul">4.</td>
        <td style="font-weight: 900;" class="field_judul">Tanggal Keluar</td>
        <td>:</td>
        <td><?php if($data->visit_end_date) {
                echo date('d-m-Y',strtotime($data->visit_end_date));
            }elseif (empty($data->visit_end_date) and $srv_type == 'RJ') {
                echo date('d-m-Y',strtotime($data->visit_date));
            }?></td>
    </tr>

</table>
<br>
<table class="tabel" style="border-collapse:collapse;
            width:100%;">
    <thead>
    <tr>
        <th style="color:#000;
            border:#000000 solid 1px;
            padding:3px;
            font-size: 14px;">Ruang Perawatan</th>
        <th style="color:#000;
            border:#000000 solid 1px;
            padding:3px;
            font-size: 14px;">Jenis/Periode Rawat</th>
        <th style="color:#000;
            border:#000000 solid 1px;
            padding:3px;
            font-size: 14px;">Lama Perawatan</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($roomRi as $res):
        ?>
        <tr>
            <td style="border:#000000 solid 1px;
            padding:3px;
            font-size: 12px;"><?=$res['unit_name']?></td>
            <?php
            if ($res['srv_type'] === 'RI' && !empty($res['billingroom_start_date'])) {
                ?>
                <td style="border:#000000 solid 1px;
            padding:3px;
            font-size: 12px;"><?=$res['room_name'].'['.$res['bed_no'].']'.'<br> Tgl: '.date('d-m-Y',strtotime($res['billingroom_start_date'])).'/'.date('d-m-Y',strtotime($res['billingroom_end_date']))?></td>
                <td style="border:#000000 solid 1px;
            padding:3px;
            font-size: 12px;" align="center"><?=strtoupper($res['billingroom_qty']).' hari'?></td>
                <?php
            }else{
                echo "<td
                style='border:#000000 solid 1px;
            padding:3px;
            font-size: 12px;'
                >". $res['unit_name']."[".date('d-m-Y',strtotime($res['srv_date']))."]</td><td style='border:#000000 solid 1px;
                padding:3px;
                font-size: 12px;' align=\"center\">-</td>";
            }
            ?>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>

