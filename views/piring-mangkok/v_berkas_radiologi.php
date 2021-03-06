<table class="satu" border="0" width="100%">
    <tr>
        <td>
            <table border="0">
                <tr>
                    <td></td>
                    <td><b>RSUD IBNU SINA KABUPATEN GRESIK</b><br>
                        <h5 style="font-size:10px;">JL. DR. WAHIDIN SH NO.243 B GRESIK - 0313951239<br>GRESIK</h5></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<h4 align="center" style="padding-bottom:0px; margin-bottom:0px">HASIL PEMERIKSAAN RADIOLOGI</h4>
<p align="center" style="padding-top:0px; margin-top:0px; font-size:10px;"></p>
<table width="100%" style="font-size:12px;">
    <tr>
        <td style = "font-weight: 900;" class="field_judul" width="4%">1.</td>
        <td style = "font-weight: 900;" class="field_judul" width="20%">Nama Rumah Sakit</td>
        <td width="2%">:</td>
        <td colspan="4">RSUD IBNU SINA KABUPATEN GRESIK</td>
    </tr>
    <tr>
        <td style = "font-weight: 900;" class="field_judul">2.</td>
        <td style = "font-weight: 900;" class="field_judul">Nomor Rekam Medik</td>
        <td>:</td>
        <td ><?=$data->px_norm?></td>
        <td style = "font-weight: 900;" class="field_judul">NIK</td>
        <td>:</td>
        <td ><?=$data->px_noktp?></td>
    </tr>
    <tr>
        <td style = "font-weight: 900;" class="field_judul">3.</td>
        <td style = "font-weight: 900;" class="field_judul">Nama Pasien</td>
        <td>:</td>
        <td colspan="4"><?=strtoupper($data->px_name)?></td>
    </tr>

    <tr>
        <td style = "font-weight: 900;" class="field_judul">4.</td>
        <!-- <td class="field_judul">Tanggal Masuk</td>
		<td>:</td>
		<td><?php if($data->visit_date) echo date('d-m-Y',strtotime($data->visit_date))?></td> -->
        <td style = "font-weight: 900;" class="field_judul">Tanggal Keluar</td>
        <td>:</td>
        <td><?php if($data->visit_end_date) {
                echo date('d-m-Y',strtotime($data->visit_end_date));
            }elseif (empty($data->visit_end_date) and $data->srv_type == 'RJ') {
                echo date('d-m-Y',strtotime($data->visit_date));
            }?></td>
    </tr>

</table>
<br>
<table width="630px" style="font-size: 12px; border-collapse: collapse;" border="1">
    <?php
    echo "<tr>
            <td width='5%' style='border-top: 0px; border-left: 0px;border-bottom: 0px;'></td><td>Tanggal</td><td align='center'>Pemeriksaan</td><td>Hasil</td></tr>";
    $nom = 1;
    foreach ($radiologi as $key => $value) {
        echo "<tr>
            <td width='5%' style='border-top: 0px; border-left: 0px;border-bottom: 0px;'></td>
            <td valign='top'>".$nom++.'. '.date('d-m-Y H:i:s', strtotime($value['created_at']))."</td>
            <td valign='top'>".$value['namecheck']."</td><td valign='top'>".$value['result']."</td></tr>";

    }
    ?>
</table>

