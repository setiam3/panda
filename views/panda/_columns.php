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


    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_name', ],
    //tgl lahir
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_norm', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_noktp', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_sex', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_address', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_name', ],//jaminan
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jns_layanan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa_px',
        'value'=>function($data){
            return json_encode($data->diagnosa_px);
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'list_obat',
        'value'=>function($data){
            return json_encode($data->list_obat);
        }],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_date', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_date', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tagihan_pelayanan',
        'value'=>function($data){
            return json_encode($data->tagihan_pelayanan);
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tagihan_pelayanan',
        'value'=>function($data){
            return json_encode($data->tagihan_pelayanan);
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
];
