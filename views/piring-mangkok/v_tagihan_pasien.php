<table class="satu" border="0" width="100%">
    <tr>
        <td>
            <table border="0">
                <tr>
                    <td></td>
                    <td><img src="<?php echo Yii::getAlias('@web').'/logo_rs.png' ?>" width="7%"/></td>
                    <td><b><?=strtoupper('RSUD IBNU SINA KABUPATEN GRESIK')?></b><br>
                        <h5 style="font-size:10px;">JL. DR. WAHIDIN SH NO.243 B GRESIK - 0313951239<br>GRESIK</h5></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<h4 align="center" style="padding-bottom:0px; margin-bottom:0px">DATA TAGIHAN TINDAKAN PASIEN</h4>
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
        <td style="font-weight: 900;" class="field_judul">Biaya rumah sakit</td>
        <td></td>
        <td colspan="4"></td>
    </tr>
    <?php
    $handel ="";
    $jumlah = 0;
    foreach($bea_tindakan as $rs_bea):
        if($rs_bea['kelompok_tagihan'] != $handel){
            echo "<tr><th></th><th colspan='6' style='text-align:left;'>".strtoupper($rs_bea['kelompok_tagihan'])."</th></tr>";
        }
        $handel = $rs_bea['kelompok_tagihan'];
        echo '<tr>
				<td></td>
				<td colspan="3">- '. ($rs_bea['deskripsi_tagihan'].' x'.$rs_bea['quantity_tagihan']).'</td>
				<td style="text-align:right;" colspan="2"></td>
				<td>: '.number_format($rs_bea['tagihan_pasien'],0,',','.').'</td>
			</tr>';

        $jumlah += $rs_bea['tagihan_pasien'];
    endforeach;
    ?>
    <tr>
    <tr>
        <td></td>
        <td><strong>Total Biaya Rumah Sakit</strong></td>
        <td colspan="4" align="right">:</td>
        <td><strong><?php

                echo number_format($jumlah,0,',','.')?></strong></td>
    </tr>
</table>
