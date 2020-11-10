<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\Html;


return [
    [
        'header'=>Html::checkbox('selection_all', false, ['class'=>'select-on-check-all', 'value'=>1, 'onclick'=>'$(".kv-row-checkbox").prop("checked", $(this).is(":checked"));']),
        'contentOptions'=>['class'=>'kv-row-select'],
        'content'=>function($model, $key){
            return Html::checkbox('selection[]', false, ['class'=>'kv-row-checkbox', 'value'=>$model->visit_id,]);
        },
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'hiddenFromExport'=>true,
        'mergeHeader'=>true,
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

    [ 'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'visit_date',
        'filterType' => GridView::FILTER_DATE_RANGE,
        'filterWidgetOptions' => ([
            'attribute' => 'only_date',
            'presetDropdown' => true,
            'convertFormat' => false,
            'pluginOptions' => [
                'separator' => ' - ',
                'format' => 'YYYY-MM-DD',
                'locale' => [
                    'format' => 'YYYY-MM-DD'
                ],
            ],
        ]),
        'label'=>'rentan waktu'
    ],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jns_layanan', 'label'=>'pelayanan'],//pelayanan
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_name', 'label'=>'jenis penjaman'],//jenis penjaminan

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_date', 'label'=>'Tanggal Masuk'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_date', 'label'=>'Tanggal keluar'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'KRS',
        'value'=>function($data){
    if (!empty($data->visit_end_date)){
        $s = "Sudah Krs";
    }else{
        $s = "Belum Krs";
    }

    return $s;
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_name', 'label'=>'Pasien'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_birthdate', 'label'=>'Tanggal Lahir'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_norm', 'label'=>'No. RM'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_noktp', 'label'=>'NIK'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_no', 'label'=>'No. SEP'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'unit_layanan',
        'value'=>function($data){
            foreach ($data->unit_layanan as $unit){
                return $unit['f2'];
            }
        },
        'label'=>'Tempat layanan'
    ],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'klb_name', 'label'=>'Status KLB'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa primer',
        'value'=>function($data){
            $s=[];
            foreach ($data->diagnosa_px as $row){
                if (!empty($row)){
                    if ($row['f3'] == '1'){
                        $s[] = $row['f2'];
                    }
                }else{
                    $s[]='null';
                }
            }
            return json_encode($s);
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa Sekunder',
        'value'=>function($data){
            $s=[];
            foreach ($data->diagnosa_px as $row){
                if (!empty($row)){
                    if ($row['f3'] != '1'){
                        $s[] = $row['f2'];
                    }
                }else{
                    $s[]='null';
                }
            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'Hasil Laboratorium',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                if($row['f2'] == "LAB PK" || $row['f2'] == "PATOLOGI ANATOMI"){
                    $s[] =$data->visit_date.", ". $row['f3'].", ".$row['f4'];
//                    $s[] =$data->visit_date.", ". json_encode($data->tagihan_pelayanan);

                }
            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil radiologi', 'format'=>'html',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                if($row['f2'] == "RADIOLOGI"){
                    $s[] = $data->visit_date.", ".$row['f3'].", ".$row['f4'];
//                    $nm[] = $row['f3'];//biaya
                }
            }
            return implode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'terapi',
        'value'=>function($data){
            return json_encode($data->list_obat);
        },
        ],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'DPJP',
        'value'=>function($data){return $data->visit_end_doctor_name;}],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Cara Pulang',
        'value'=>function($data){
    if ($data->visit_end_cause_id == "52"){
        $s = "Meninggal";
    }elseif ($data->visit_end_cause_id == "54"){
        $s = "Atas Permintaan Sendiri";
    }elseif ($data->visit_end_cause_id == "50"){
        $s = "Dirujuk";
    }elseif ($data->visit_end_cause_id == "57"){
        $s = "Melarikan Diri";
    }elseif ($data->visit_end_cause_id == "55"){
        $s = "(-)";
    }elseif ($data->visit_end_cause_id == "48"){
        $s = "Atas Persetujuan Dokter";
    }
    return $s;
}],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Pemulasaraan jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Pemulasaraan') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kantong jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'kantong') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'peti jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'peti') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'plastik jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'plastik') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Desinfektan jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'plastik') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'transport Mobil',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'mobil') !== false && stripos($row['f2'],'transport')){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'Desinfektan Mobil jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'mobil') !== false && stripos($row['f2'],'Desinfektan')){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

];
