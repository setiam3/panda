
<style type="text/css">
    .field_judul {
        font-weight: 900;
    }
    .tabel{
        border-collapse:collapse;
        width:100%;}
    .tabel th{
        color:#000;
        border:#000000 solid 1px;
        padding:3px;
        font-size: 14px;
    }
    .tabel td{
        border:#000000 solid 1px;
        padding:3px;
        font-size: 12px;
    }
</style>
<table class="satu" border="0" width="100%">
    <tr>
        <td>
            <table border="0">
                <tr>
                    <td></td>
                   <td><img src="<?php echo site_url('web/logo_rs.png'); ?>" width="7%"/></td>
                    <td><b>RSUD IBNU SINA KABUPATEN GRESIK</b><br>
                        <h5 style="font-size:10px;">JL. DR. WAHIDIN SH NO.243 B GRESIK - 0313951239<br>GRESIK</h5></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<h4 align="center" style="padding-bottom:0px; margin-bottom:0px">HASIL PEMERIKSAAN LABORATORIUM</h4>
<p align="center" style="padding-top:0px; margin-top:0px; font-size:10px;"></p>
<table width="100%" style="font-size:12px;">
    <tr>
        <td class="field_judul" width="4%">1.</td>
        <td class="field_judul" width="20%">Nama Rumah Sakit</td>
        <td width="2%">:</td>
        <td colspan="4">RSUD IBNU SINA KABUPATEN GRESIK</td>
    </tr>
    <tr>
        <td class="field_judul">2.</td>
        <td class="field_judul">Nomor Rekam Medik</td>
        <td>:</td>
        <td ><?=$model[0]['px_norm']?></td>
        <td class="field_judul">NIK</td>
        <td>:</td>
        <td ><?=$model[0]['px_noktp']?></td>
    </tr>
    <tr>
        <td class="field_judul">3.</td>
        <td class="field_judul">Nama Pasien</td>
        <td>:</td>
        <td colspan="4"><?=strtoupper($model[0]['px_name'])?></td>
    </tr>

    <tr>
        <td class="field_judul">4.</td>
        <!-- <td class="field_judul">Tanggal Masuk</td>
		<td>:</td>
		<td><?php if($model[0]['visit_date']) echo date('d-m-Y',strtotime($model[0]['visit_date']))?></td> -->
        <td class="field_judul">Tanggal Keluar</td>
        <td>:</td>
        <td><?php if($model[0]['visit_end_date']) {
                echo date('d-m-Y',strtotime($model[0]['visit_end_date']));
            }elseif (empty($model[0]['visit_end_date']) and $model[0]['srv_type'] == 'RJ') {
                echo date('d-m-Y',strtotime($model[0]['visit_date']));
            }?></td>
    </tr>
    <!-- <tr>
		<td class="field_judul">6.</td>
		<td class="field_judul">Jenis Kelamin</td>
		<td>:</td>
		<td colspan="4"><?=$pasien->px_sex?></td>
	</tr>
	<tr>
		<td class="field_judul">7.</td>
		<td class="field_judul">Cara Pulang</td>
		<td>:</td>
		<td colspan="4">
			<?php
    $cara_pulang = (isset($pasien->wo_name) && isset($pasien->oc_name)? $pasien->wo_name.' # '.$pasien->oc_name:"Atas persetujuan dokter");
    echo strtoupper($cara_pulang);
    ?>
		</td>
	</tr> -->
</table>
<br>
<table width="630px" style="font-size: 12px; border-collapse: collapse;" border="1">
    <?php
    echo $all1;echo $all2;
    ?>
</table>
<!-- <table width="100%" style="font-size:12px;">
	<tr><td width="50%"></td>
		<td width="50%" align="center">Gresik, <?=date('d-m-Y')?></td>
	</tr>
	<tr><td></td>
		<td align="center"><img src="<?php echo site_url('assets/global/img/ttd_verif_nodate.png'); ?>" width="35%"/></td>
	</tr>
</table> -->
