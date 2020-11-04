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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_name', ],//jaminan
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jns_layanan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa primer',
        'value'=>function($data){
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_date', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tagihan_pelayanan','format'=>'html',
        'value'=>function($data){
            foreach ($data->tagihan_pelayanan as $row){
                if (!empty($row)){
                    $s[] = $row['f2'] ." ". $row['f3'] . "<br>";
                }else{
                    $s[]='null';
                }
            }
            return implode($s);
//            return json_encode($data->tagihan_pelayanan);
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'klb_name', ],//status covid

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_status', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_no', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pxsurety_no', ],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'ruang_rawat_px',
        'value'=>function($data){
            return json_encode($data->ruang_rawat_px);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'class_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_cause_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kelas_pelayanan',
        'value'=>function($data){
        return json_encode($data->kelas_pelayanan);
    }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tindakan_px',
        'value'=>function($data){
            return json_encode($data->tindakan_px);
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_doctor_name', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'klb_id', ],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'transfer_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'status_grouper', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'grouper_code', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id_klaim', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'unit_layanan',
        'value'=>function($data){
            return json_encode($data->unit_layanan);
        }],

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil_penunjang',
        'value'=>function($data){
            return json_encode($data->hasil_penunjang);
        }],

//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tanggal rapit',
//        'value'=>function($data){
//            return json_encode($data->visit_date);
//        }],
//
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil',
//        'value'=>function($data){
//            $s=[];
//        foreach ($data->hasil_penunjang as $row){
//        if (stripos($row['f3'],'COVID') !== false){
//            $s[] = $row['f4'];
//        }
////        else{
////            $s[] ="null";
////        }
//    }
//            return json_encode($s);
////            return json_encode($data->visit_date);
//        }],
//
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tanggal swab',
//        'value'=>function($data){
//            return json_encode($data->visit_date);
//        }],
//
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'hasil',
//        'value'=>function($data){
//    $s=[];
//            foreach ($data->hasil_penunjang as $row){
//                if (stripos($row['f3'],'swab') !== false){
//                    $s[] = $row['f4'];
//                }
////                else{
////                    $s[] ="null";
////                }
//            }
//            return json_encode($s);
////            return json_encode($data->visit_date);
//        }],

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
