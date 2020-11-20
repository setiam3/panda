<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\Html;
return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

    [ 'class'=>'\kartik\grid\DataColumn','label'=>'Tanggal Masuk',
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
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_date', 'label'=>'Tanggal Pulang'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'krs', 'label'=>'KRS'],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'krs', 'label'=>'KRS',
//        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
//        'filter' => ['sudah krs'=>'Sudah KRS','belum krs'=>'Belum KRS'],
//        'filterWidgetOptions' => [
//            'pluginOptions' => ['allowClear' => true],]
//    ],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_name', 'label'=>'jenis pinjaman'],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jns_layanan', 'label'=>'pelayanan'],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'unit_layanan', 'label'=>'unit',
//        'value'=>function($data){
//            foreach ($data->unit_layanan as $row){
//                $s[] = $row['f2'];
//            }
//            return json_encode($s);
//        }
//    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_name', 'label'=>'Nama Pasien'],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id', 'label'=>'visit'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_birthdate',
        'value'=>function($data){
    $now = new DateTime();
    $date = new DateTime($data->px_birthdate);
            $usia = $now->diff($date)->y;
            return $data->px_birthdate.'('.$usia.')';
        }, 'label'=>'Tanggal Lahir'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_norm', 'label'=>'No Rekam Medis'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_noktp', 'label'=>'No Identitas (NIK)'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pxsurety_no', 'label'=>'No Kartu BPJS'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_no', 'label'=>'no SEP'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_tgl', 'label'=>'Tanggal SEP'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tagihan_pelayanan', 'label'=>'Retribusi',
        'value'=>function($data){
            $s = [];
            foreach ($data->tagihan_pelayanan as $row){
                if ($row['f2'] == 'PENDAFTARAN'){
                    $s []= 'Rp. '.$row['f4'];
                }
            }
            return json_encode($s);
        }
    ],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id', 'label'=>'visit'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kelas_pelayanan',
        'value'=>function($data){
            foreach ($data->kelas_pelayanan as $row){
                $s[] = $row['f3'];
            }
            return json_encode($s);
        },
        'label'=>'Hak Kelas',
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'ruang_rawat_px',
        'value'=>function($data){
            foreach ($data->ruang_rawat_px as $row){
                if ($row['f3'] != 'LAB PK'){
                    $s[] = $row['f3']." ( ". $row['f1'].' - '.$row['f2'].") ". $row['f4'];

                }elseif ($row['f3'] == 'RADIOLOGI'){
                    $s[] = $row['f3']." ( ". $row['f1'].' - '.$row['f2'].") ". $row['f4'];
                }
            }
            return json_encode($s);
        },
        'label'=>'Tempat Layanan',
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_doctor_name', 'label'=>'DPJP'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'cara_pulang', 'label'=>'Cara Pulang'],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_cause_id', 'label'=>'Cara Pulang',
//        'value'=>function($data){
//            if ($data->visit_end_cause_id == "52"){
//                $s = "Meninggal";
//            }elseif ($data->visit_end_cause_id == "54"){
//                $s = "Atas Permintaan Sendiri";
//            }elseif ($data->visit_end_cause_id == "50"){
//                $s = "Dirujuk";
//            }elseif ($data->visit_end_cause_id == "57"){
//                $s = "Melarikan Diri";
//            }elseif ($data->visit_end_cause_id == "55"){
//                $s = "(-)";
//            }elseif ($data->visit_end_cause_id == "48"){
//                $s = "Atas Persetujuan Dokter";
//            }else{
//                $s = "null";
//            }
//            return $s;
//        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tgl_meninggal', 'label'=>'Kejadian Meninggal'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'klb_name', 'label'=>'Status KLB'],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa_px','label'=>'Diagnosa Primer',
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

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Diagnosa Sekunder','label'=>'Diagnosa Sekunder',
        'value'=>function($data){
            $s=[];
            foreach ($data->diagnosa_px as $row){
                if (!empty($row)){
                    if ($row['f3'] == '2'){
                        $s[] = $row['f2'];
                    }
                }else{
                    $s[]='null';
                }
            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil_penunjang', 'label'=>'hasil laboratorium',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                foreach ($data->billing_inacbg as $biaya){
                    if ($biaya['f2'] == 'laboratorium'){
                        $tarif= $biaya['f3'];
                        if($row['f2'] == "LAB PK" || $row['f2'] == "PATOLOGI ANATOMI"){
                            $s[] =$data->visit_date."#". $row['f3']."# ".$row['f4'];
//                    $s[] =$data->visit_date.", ". json_encode($data->tagihan_pelayanan);

                        }
                    }
                }

            }
            return json_encode($s);
        }],
    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil_penunjang', 'format'=>'html', 'label'=>'hasil radiologi',
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
//            $s = [];
//            foreach ($data->list_obat as $row){
//                $s[] = $row['f1'].$row['f3'];
//            }
//            return json_encode($s);

            return json_encode($data->list_obat);
        },
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Pemulasaraan jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Pemulasaran Jenazah') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kantong jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Kantong Jenazah') !== false){
                    $s[] =$row['f2'].", ". $row['f3'];
                }

            }
            return json_encode($s);
        }],
//
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'peti jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Peti Jenazah') !== false){
                    $s[] = $row['f2'].": ". $row['f3'];
                }

            }
            return json_encode($s);
        }],
//
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'plastik jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Plastik Erat') !== false){
                    $s[] =$row['f2'].": ". $row['f3'];
                }

            }
            return json_encode($s);
        }],
//
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Desinfektan jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Desenfiktan Jenazah') !== false){
                    $s[] = $row['f2'].": ".$row['f3'];
                }

            }
            return json_encode($s);
        }],
//
    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'transport Mobil',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Transport Mobil Jenazah') !== false){
                    $s[] =$row['f2'].": ". $row['f3'];
                }

            }
            return json_encode($s);
        }],
//
    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'Desinfektan Mobil jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Desenfiktan Mobil Jenazah') !== false ){
                    $s[] =$row['f2'].": ". $row['f3'];
                }

            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'billing_inacbg','label'=>'Total Tarif RS',
        'value'=>function($data){
            $tarifRS=0;
            foreach ($data->billing_inacbg as $row){
               $tarifRS += $row['f3'];

            }
            return json_encode($tarifRS);
        }],

//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'status_grouper', 'label'=>'status'],

];

