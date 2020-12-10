<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\Html;


return [
//    [
//        'header'=>Html::checkbox('selection_all', false, ['class'=>'select-on-check-all', 'value'=>1, 'onclick'=>'$(".kv-row-checkbox").prop("checked", $(this).is(":checked"));']),
//        'contentOptions'=>['class'=>'kv-row-select'],
//        'content'=>function($model, $key){
//            return Html::checkbox('selection[]', false, ['class'=>'kv-row-checkbox', 'value'=>$model->visit_id,]);
//        },
//        'hAlign'=>'center',
//        'vAlign'=>'middle',
//        'hiddenFromExport'=>true,
//        'mergeHeader'=>true,
//    ],
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
        'value'=>function($data){
            $visit_date = date('d-m-Y H:m:s',strtotime($data->visit_date)); return $visit_date;
        },
        'label'=>'Tanggal Masuk'
    ],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'unit_layanan', 'label'=>'Cara Pulang','value'=>function($data){return json_encode($data->unit_layanan);}],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tgl_pulang', 'label'=>'Tanggal keluar', 'value'=>function($data){
        $visit_end_date = date('d-m-Y H:m:s',strtotime($data->visit_end_date));
        return $visit_end_date;}],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'krs',],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_name', 'label'=>'Pasien'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_birthdate',
        'value'=>function($data){
            $now = new DateTime();
            $date = new DateTime($data->px_birthdate);
            $usia = $now->diff($date)->y;
            $tgl_lahir = date('d-m-Y',strtotime($data->px_birthdate));
            return $tgl_lahir.' ('.$usia.')';
        }, 'label'=>'Tanggal Lahir (usia)'
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_norm', 'label'=>'No. RM'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_noktp', 'label'=>'NIK'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pxsurety_no', 'label'=>'No Kartu BPJS'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_no', 'label'=>'No SEP'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tempat_layanan',
        'value'=>function($data){
            foreach ($data->unit_layanan as $unit){
                return $unit['f2'];
            }
        },
        'label'=>'Tempat layanan'
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'retribusi', 'label'=>'Retribusi',
        'value'=>function($data){
            $s = [];
            foreach ($data->tagihan_pelayanan as $row){
                if ($row['f2'] == 'PENDAFTARAN'){
                    $s []= 'Rp. '.number_format($row['f4'],0, ".", ".");
                }
            }
            return implode($s,',');
        }
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'klb_name', 'label'=>'Status KLB'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa_px','label'=>'Diagnosa Primer','format'=>"html",
        'value'=>function($data){
            $s=[];
            foreach ($data->diagnosa_px as $row){
                if (!empty($row)){
                    if ($row['f3'] == '1'){
                        $s[] =$row['f1'].", ". $row['f2']."<br>";
                    }
                }else{
                    $s[]='null';
                }
            }
            return implode($s,', ');
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa_pxs','label'=>'Diagnosa Sekunder','format' => 'html',
        'value'=>function($data){
            $s=[];
            foreach ($data->diagnosa_px as $row){
                if (!empty($row)){
                    if ($row['f3'] == '2'){
                        $s[] = $row['f1'].", ".$row['f2']."<br>";
                    }
                }else{
                    $s[]='null';
                }
            }
            return implode($s,', ');
        }
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa_px','label'=>'Kondisi Lain','format'=>"html",
        'value'=>function($data){
            $s=[];
            foreach ($data->diagnosa_px as $row){
                if (!empty($row)){
                    if ($row['f3'] == '4'){
                        $s[] =$row['f1'].", ". $row['f2']."<br>";
                    }
                }else{
                    $s[]='null';
                }
            }
            return implode($s,', ');
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tindakan_px2','label'=>'Tindakan ICD 9','format'=>"html",
        'value'=>function($data){
            $s=[];
            foreach ($data->tidakan_px2 as $row){
                if (!empty($row)){
                    if (!empty($row['f1'])){
                        $s[] =$row['f1'].", ". $row['f2']."<br>";
                    }
                }else{
                    $s[]='null';
                }
            }
            return implode($s,', ');
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil_laborat', 'label'=>'hasil laboratorium','format' => 'html',//tanggal older
        'value'=>function($data){
            $s=$tarif=[];
            foreach($data->hasil_penunjang as $row){
                if($row['f2'] == "LAB PK" || $row['f2'] == "PATOLOGI ANATOMI"){
                    $s[] = $row['f3']." Rp. ".number_format($row['f6'],0,".",".").", ".$row['f4']." (".date('d-m-Y',strtotime($row['f5'])).") <br>";
                }

            }
            return implode($s,'-');
        }
    ],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil_radoilogi', 'format'=>'html', 'label'=>'hasil radiologi',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                if ($row['f2'] == "RADIOLOGI") {
                    $s[] = $row['f3'] . ', '.$row['f6'].", ". date_format(date_create($row['f5']),'d-m-Y' ).', '. $row['f4'];

                }
            }
            return implode($s);
        }],
    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'terapi','format'=>'html',
        'value'=>function($data){
            $s = [];
            foreach ($data->list_obat as $row){
                if (empty($row['f1'])){
                    $s = 'null';
                }else{
                    $s[] = "- NO: ".$row['f1'].", ".$row['f3'].", (Rp. ".number_format($row['f4'],0,'.','.').") <br>";
                }
            }
            return implode($s);

        },
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_doctor_name','label'=>'DPJP',],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'cara_pulang', 'label'=>'Cara Pulang'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pemulasaraan_jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f3'],'Pemulasaran Jenazah') !== false){
                    $s[] ="Rp. ".number_format($row['f4'],0, ".", ".");
                }

            }
            return implode($s,'');
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kantong_jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f3'],'Kantong Jenazah') !== false){
                    $s[] ="Rp. ".number_format($row['f4'],0, ".", ".");
                }

            }
            return implode($s,'');
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'peti_jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f3'],'Peti Jenazah') !== false){
                    $s[] ="Rp. ".number_format($row['f4'],0, ".", ".");
                }

            }
            return implode($s,'');
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'plastik_jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f3'],'Plastik Erat') !== false){
                    $s[] ="Rp. ".number_format($row['f4'],0, ".", ".");
                }
            }
            return implode($s,'');
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'desinfektan_jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f3'],'Desenfiktan Jenazah') !== false){
                    $s[] ="Rp. ".number_format($row['f4'],0, ".", ".");
                }
            }
            return implode($s,'');
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'transport_mobil',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f3'],'Transport Mobil Jenazah') !== false){
                    $s[] ="Rp. ".number_format($row['f4'],0, ".", ".");
                }
            }
            return implode($s,'');
        }
    ],

//    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'transport_mobil',
//        'value'=>function($data){
//            $s=[];
//            foreach ($data->tagihan_pelayanan as $row){
//                if (stripos($row['f3'],'Transport Mobil Jenazah') !== false){
//                    $s[] ="Rp. ".number_format($row['f4'],0, ".", ".");
//                }
//            }
//            return implode($s,'');
//        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'desinfektan_mobil',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f3'],'Desenfiktan Mobil Jenazah') !== false ){
                    $s[] ="Rp. ".number_format($row['f4'],0, ".", ".");
                }
            }
            return implode($s,'');
        }
    ],


//
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jns_layanan', 'label'=>'pelayanan'],//pelayanan
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_name', 'label'=>'jenis penjaman'],//jenis penjaminan
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'unit_layanan', 'label'=>'Unit Pelayanan',
//        'value'=>function($data){
//            foreach ($data->unit_layanan as $row){
//                $s[] = $row['f2'];
//            }
//            return json_encode($s);
//        }],//jenis penjaminan
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_date', 'label'=>'Tanggal Masuk'],
























];
