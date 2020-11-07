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

//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'ststus covid',
//        'value'=>function($data){
//            foreach ($data->hasil_penunjang as $row){
//                return $row['f4'];
//            }
//
//
//        }],

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
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_name', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_birthdate', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_norm', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_noktp', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_sex', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_address', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jaminan', 'value'=>function($data){return $data->surety_name;} ],//jaminan
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jns_layanan', ],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_id', ],
[ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'klb_name', 'value'=>"status covid"],
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'DPJP',
        'value'=>function($data){return $data->visit_end_doctor_name;}],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'cara pulang', 'value'=>function($data){return $data->visit_end_doctor_name;}],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tanggal masuk',
        'value'=>function($data){
            return json_encode($data->visit_date);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tanggal pulang',
        'value'=>function($data){
            return json_encode($data->visit_end_date);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'total los',
        'value'=>function($data){
            $tanggal1 = new DateTime($data->visit_date);
            $tanggal2 = new DateTime($data->visit_end_date);
            $perbedaan[] = $tanggal2->diff($tanggal1);
            return json_encode($perbedaan[0]->d);
            

        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jenis isolasi',
        'value'=>function($data){
    $masuk = $data->visit_date;
    $keluar = $data->visit_end_date;
            return json_encode($keluar);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'ruang_rawat_px',
        'value'=>function($data){
            return json_encode($data->ruang_rawat_px);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tanggal rapit',
        'value'=>function($data){
            return json_encode($data->visit_date);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil',
        'value'=>function($data){
            $s=[];
        foreach ($data->hasil_penunjang as $row){
            if (stripos($row['f3'],'COVID') !== false){
                $s[] = $row['f4'];
            }
        }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'bill',
        'value'=>function($data){
        $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'Pemeriksaan Rapid') !== false){
                    $s[] = $row['f3'];
                }
            }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tanggal swab',
        'value'=>function($data){
            return json_encode($data->visit_date);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil',
        'value'=>function($data){
        $s=[];
            foreach ($data->hasil_penunjang as $row){
                if (stripos($row['f3'],'swab') !== false){
                    $s[] = $row['f4'];
                }
            }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'bill',
        'value'=>function($data){
        $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'swab') !== false){
                    $s[] = $row['f3'];
                }
            }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tanggal pcr',
        'value'=>function($data){
            return json_encode($data->visit_date);
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil',
        'value'=>function($data){
            $s=[];
            foreach ($data->hasil_penunjang as $row){
                if (stripos($row['f3'],'REAL TIME PCR') !== false){
                    $s[] = $row['f4'];
                }
            }
            return json_encode($s);
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'bill',
        'value'=>function($data){
        $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'REAL TIME PCR') !== false){
                    $s[] = $row['f3'];
                }
            }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tanggal pcr tcm',
        'value'=>function($data){
            return json_encode($data->visit_date);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil',
        'value'=>function($data){
            $s=[];
            foreach ($data->hasil_penunjang as $row){
                if (stripos($row['f3'],'tcm') !== false){
                    $s[] = $row['f4'];
                }

            }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'bill',
        'value'=>function($data){
        $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'tcm') !== false){
                    $s[] = $row['f3'];
                }
            }
            return json_encode($s);
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

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Pemulasaraan jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'peti') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Peti jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'peti') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Peti jenazah',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'peti') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

        [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'plastik',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'plastik') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
//            return json_encode($data->visit_date);
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'Desinfektan',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'desinfektan') !== false){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],


        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'Mobil',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'mobil') !== false && stripos($row['f2'],'transport')){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'Mobil',
        'value'=>function($data){
            $s=[];
            foreach ($data->tagihan_pelayanan as $row){
                if (stripos($row['f2'],'mobil') !== false && stripos($row['f2'],'Desinfektan')){
                    $s[] = $row['f3'];
                }

            }
            return json_encode($s);
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'tarif rs',
        'value'=>function($data){
            $s=[];
            for($i=0;$i<count($data->tagihan_pelayanan);$i++){
                $s[] = $data->tagihan_pelayanan[$i]['f3'];

            }
            return json_encode(array_sum($s));
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'prosedur non bedah',
        'value'=>function($data){
            
            $s=[];
            foreach($data->billing_inacbg as $row){
                
                if($row['f2'] == "prosedur_non_bedah"){
                    $s=$row['f3'];
                }

            }
            return json_encode($s);
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'tenaga ahli',
        'value'=>function($data){
            return json_encode($data->visit_end_doctor_name);
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'radiologi',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                if($row['f2'] == "RADIOLOGI"){
                    $s[] = $row['f3'];
                }
            }
            return json_encode($s);
        }],

        // ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'rehabilitasi',
        // 'value'=>function($data){
        //     $s=[];
        //     foreach($data->hasil_penunjang as $row){
        //         if($row['f2'] == "RADIOLOGI"){
        //             $s[] = $row['f3'];
        //         }
        //     }
        //     return json_encode($s);
        // }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'laborat',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                if($row['f2'] == "LAB PK" || $row['f2'] == "PATOLOGI ANATOMI"){
                    $s[] = $row['f3'];
                }
            }
            return json_encode($s);
        }],
    //kamar
        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'ruangan',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                if(stripos($row['f2'],'ruangan') !== false){
                    $s[] = $row['f2'];
                }
            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'akomodasi',
        'value'=>function($data){
            $s=[];
            foreach($data->ruang_rawat_px as $row){
                    $s[] = $row['f3']. ': ' .$row['f6'];
            }
            return json_encode($s);
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'konsultasi',
        'value'=>function($data){
            
            $s=[];
            foreach($data->billing_inacbg as $row){
                
                if($row['f2'] == "konsultasi"){
                    $s=$row['f3'];
                }

            }
            return json_encode($s);
        }],

        ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'pelayanan darah',
        'value'=>function($data){
            $s=[];
                if ($data->unit_layanan[0]['f2'] == 'bank darah'){
                    foreach($data->tindakan_px as $row){
                        $s[]=$row['f2'];
                    }


            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil laborat',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                if($row['f2'] == "LAB PK" || $row['f2'] == "PATOLOGI ANATOMI"){
                    $s[] = $row['f4'];
                }
            }
            return json_encode($s);
        }],

    ['class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil radiologi', 'format'=>'html',
        'value'=>function($data){
            $s=[];
            foreach($data->hasil_penunjang as $row){
                if($row['f2'] == "RADIOLOGI"){
                    $s[] = $row['f4'];
                }
            }
            return json_encode($s);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'list_obat',
        'value'=>function($data){
            foreach ($data->list_obat as $row){
                if (!empty($row)){
                    $s[] = $row['f2'];
                }else{
                    $s[]='null';
                }
            }
            return implode($s);
//            return json_encode($data->list_obat);
        }],
        










    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}',
        'buttons' => [

            'view' => function ($url, $model) {
                return  Html::a('<span class="glyphicon glyphicon-comment"></span> Sent WA', $url,
                    [ 'title' => Yii::t('app', 'Sent WA'), 'class'=>'btn btn-primary btn-md', 'target' => '_blank', 'data' => ['pjax' => '0'], 'id'=>'sentwa']) ;
            },
        ],


        'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                $id = $model->visit_id;
                $url = \yii\helpers\Url::toRoute(['panda/sentwa', 'id' => $model->visit_id]);
                return $url;
            }
        },
    ],
];
