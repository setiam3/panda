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
        'value'=>function($data){
            $visit =date('d-m-Y',strtotime($data->visit_date));
            return $visit;
        },
        'attribute'=>'visit_date',
        'filterType' => GridView::FILTER_DATE_RANGE,
        'filterWidgetOptions' => ([
            'attribute' => 'only_date',
            'presetDropdown' => true,
            'convertFormat' => false,
            'pluginOptions' => [
                'separator' => ' - ',
                'format' => 'DD-MM-YYYY',
                'locale' => [
                    'format' => 'DD-MM-YYYY'
                ],
            ],
        ]),
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tgl_pulang', 'label'=>'Tanggal Pulang',
        'value'=>function($data){
            $visit_end_date = date('d-m-Y',strtotime($data->visit_end_date));
            return $visit_end_date;
        },
//        'headerOptions' => ['style' => 'width:100%'],
//        'format' => 'date',
//        'filterType' => GridView::FILTER_DATE,
//        'filterWidgetOptions' => [
//            'size' => 'xs',
//            'pluginOptions' => [
//                'format' => 'DD-MM-YYYY',
//                'autoWidget' => true,
//                'autoclose' => true,
//                'todayHighlight' => true
//            ]
//        ]
    ],
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
            $tgl_lahir = date('d-m-Y',strtotime($data->px_birthdate));
            return $tgl_lahir.'('.$usia.')';
        }, 'label'=>'Tanggal Lahir (usia)'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_norm', 'label'=>'No Rekam Medis'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_noktp', 'label'=>'No NIK'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pxsurety_no', 'label'=>'No Kartu BPJS'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_no', 'label'=>'no SEP'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_tgl', 'label'=>'Tanggal SEP',
        'value'=>function($data){
            $sep=date('d-m-Y', strtotime($data->sep_tgl));
            return $sep;
        },
//        'headerOptions' => ['style' => 'width:100%'],
//        'format' => 'date',
//        'filterType' => GridView::FILTER_DATE,
//        'filterWidgetOptions' => [
//            'size' => 'xs',
//            'pluginOptions' => [
//                'format' => 'DD-MM-YYYY',
//                'autoWidget' => true,
//                'autoclose' => true,
//                'todayHighlight' => true
//            ]
//        ]
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'retribusi', 'label'=>'Retribusi',
        'value'=>function($data){
            $s = [];
            foreach ($data->tagihan_pelayanan as $row){
                if ($row['f2'] == 'PENDAFTARAN'){
                    $s []= 'Rp. '.$row['f4'];
                }
            }
//            return json_encode($s);
            return implode($s,',');
        }
    ],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id', 'label'=>'visit'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kelas_pelayanan',
        'value'=>function($data){
            foreach ($data->kelas_pelayanan as $row){
                $s[] = $row['f3'];
            }
//            return json_encode($s);
            return implode($s,', ');
        },
        'label'=>'Kelas Perawatan',
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'hak_pelayanan',
        'value'=>function($data){
            $s=[];
            foreach ($data->kelas_pelayanan as $row){
                if($row['f2'] > $data->surety_class_id and $row['f1'] == "RI"){

                    if($row['f3'] == 'NON KELAS'){
                        $s[] = 'KELAS 3';
                    }elseif ($row['f3'] == 'KELAS 3'){
                        $s[] = 'KELAS 2';
                    }elseif ($row['f3'] == 'KELAS 2'){
                        $s[] = 'KELAS 1';
                    }elseif ($row['f3'] == 'KELAS 1'){
                        $s[] = 'KELAS VIP';
                    }elseif ($row['f3'] == 'ELAS VIP'){
                        $s[] = 'KELAS VVIP';
                    }else{
                        $s = '';
                    }
                }
                elseif ($row['f2'] = $data->surety_class_id and $row['f1'] == "RI"){
                    $s[] = $row['f3'];
                }
            }
//            return json_encode($s);
            return implode($s,', ');
        },
        'label'=>'Hak Kelas',
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'ruang_rawat_px',
        'value'=>function($data){
            foreach ($data->ruang_rawat_px as $row){

                if ($row['f3'] !== 'LAB PK' and $row['f3'] !== 'RADIOLOGI'){
                    $s[] = $row['f3'].$row['f4']." ( ". date('d-m-Y',strtotime($row['f1'])).' - '.date('d-m-Y',strtotime($row['f2'])).") ";

                }elseif ($row['f3'] !== 'RADIOLOGI' and $row['f3'] !== 'LAB PK'){
                    $s[] = $row['f3'].$row['f4']." ( ". date('d-m-Y',strtotime($row['f1'])).' - '.date('d-m-Y',strtotime($row['f2'])).") ";
                }
            }
//            return json_encode($s);
            return implode($s,', ');
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tgl_meninggal', 'label'=>'Kejadian Meninggal',
        'value'=>function($data){
    $tgl_meninggal = date('d-m-Y',strtotime($data->tgl_meninggal));
    return $tgl_meninggal;
        }],
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
//            return json_encode($data->diagnosa_px);
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
//            return json_encode($s);
            return implode($s,', ');
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa_px','label'=>'kondisi lain','format'=>"html",
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
//            return json_encode($s);
            return implode($s,', ');
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil_laborat', 'label'=>'hasil laboratorium','format' => 'html',//tanggal older
        'value'=>function($data){
            $s=$tarif=[];
            foreach($data->hasil_penunjang as $row){
//                foreach ($data->tagihan_pelayanan as $biaya){
//                    if ($biaya['f3'] == $row['f3']){
//                        $tarif = $biaya['f4'];
                        $tarif = 0;
                        if($row['f2'] == "LAB PK" || $row['f2'] == "PATOLOGI ANATOMI"){
                            $s[] = $row['f3']." ".$row['f6'].", ".$row['f4']." (".date('d-m-Y',strtotime($row['f5'])).") <br>";
//
//
//                        }
//                    }
                }

            }
            return implode($s,', ');
        }],
    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil_radoilogi', 'format'=>'html', 'label'=>'hasil radiologi',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
//                foreach ($data->tagihan_pelayanan as $biaya) {
//                    if ($biaya['f3'] == $row['f3']) {
//                        $tarif = $biaya['f4'];
                        if ($row['f2'] == "RADIOLOGI") {
//                            $s[] = $row['f3'] . ', '.$tarif.", ". date('d-m-Y', strtotime($row['f5'])).', '. $row['f4'];
                            $s[] = $row['f3'] . ', '.$row['f6'].", ". date_format(date_create($row['f5']),'d-m-Y' ).', '. $row['f4'];
//                    $s[] = date('d-m-Y',strtotime($data->visit_date)).", ".$row['f3'].", ".$row['f4'];
//                    $nm[] = $row['f3'];//biaya
                        }
//                    }
//                }
            }
            return implode($s);
        }],
    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'terapi',
        'value'=>function($data){
            $s = [];
            foreach ($data->list_obat as $row){
                if (empty($row['f1'])){
                    $s = 'null';
                }else{
                    $s[] = $row['f1'].$row['f3'].$row['f4'];
                }
            }
            return json_encode($s);

//            return json_encode($data->list_obat);
        },
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pemulasaraan_jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Pemulasaran Jenazah') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kantong_jenazah',
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'peti_jenazah',
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'plastik_jenazah',
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'desinfektan_jenazah',
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
    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'transport_mobil',
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
    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'desinfektan_mobil',
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
            return json_encode('Rp. '.$tarifRS);
        }],

//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'status_grouper', 'label'=>'status'],

];

