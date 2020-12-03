
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
<h4 align="center" style="padding-bottom:0px; margin-bottom:0px">DATA RESEP OBAT PASIEN</h4>
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
        <!-- <td class="field_judul">Tanggal Masuk</td>
		<td>:</td>
		<td><?php if($data->visit_date) echo date('d-m-Y',strtotime($data->visit_date))?></td> -->
        <td style="font-weight: 900;" class="field_judul">Tanggal Keluar</td>
        <td>:</td>
        <td><?php if($data->visit_end_date) {
                echo date('d-m-Y',strtotime($data->visit_end_date));
            }elseif (empty($data->visit_end_date) and $data->srv_type == 'RJ') {
                echo date('d-m-Y',strtotime($data->visit_date));
            }?></td>
    </tr>

</table>
<br>
<table style="border-collapse:collapse; width:100%; " class="tabel">
    <thead>
    <tr>
        <!-- <th >Tanggal Jam</th> -->
        <th style="color:#000;border:#000000 solid 1px;padding:3px; font-size: 14px;">No. Transaksi</th>
        <th style="color:#000;border:#000000 solid 1px;padding:3px;font-size: 14px;">Obat</th>
        <th style="color:#000;
        border:#000000 solid 1px;
        padding:3px;
        font-size: 14px;">Nama Dokter</th>
        <th style="color:#000;
        border:#000000 solid 1px;
        padding:3px;
        font-size: 14px;" width="15%">Total</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no=1;$jml_total=0;$embalase=0;
    foreach ($obat as $res):
        $jml_total += $res['sale_total']-$res['sr_total'];
//        $embalase = $res['embalase_item_sale'];
        ?>
        <tr>
            <!-- <td><?=$res['tgl_sale']?></td> -->
            <td style="border:#000000 solid 1px;
        padding:3px;
        font-size: 12px;"><?=$res['nomor_resep']?></td>
            <td style="border:#000000 solid 1px;
        padding:3px;
        font-size: 12px;"><?=($res['nama_obat'])?></td>
            <td style="border:#000000 solid 1px;
        padding:3px;
        font-size: 12px;"><?=strtoupper($res['par_name'])?></td>
            <td style="border:#000000 solid 1px;
        padding:3px;
        font-size: 12px;" align="right"><?=$res['sale_total']-$res['sr_total']?></td>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>

</table>
