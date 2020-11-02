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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id', ],
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_norm', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_noktp', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_name', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_sex', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'px_address', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_id',],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_name', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_status',
//        'filterType' => GridView::FILTER_SELECT2,
//        'filter' => ['10'=>'10','30'=>'Non Aktif'],
//        'filterWidgetOptions' => [
//            'pluginOptions' => ['allowClear' => true],
//        ],
//        'filterInputOptions' => ['placeholder' => 'status'],
        ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_no', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pxsurety_no', ],
//    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_date', ],
    [ 'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'visit_end_date',
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

    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'ruang rawat px',
        'value'=>function($data){
            return json_encode($data->ruang_rawat_px);
        }
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jns_layanan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'class_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_cause_id', ],
//
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'diagnosa_px', 'format'=>'html'],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tindakan_px', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'Kelas pelayanan',
        'value'=>function($data){
            return json_encode($data->kelas_pelayanan);
        }
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'billing',
        'value'=>function($data){
            return json_encode($data->billing_inacbg);
        }
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'unit layanan',
        'value'=>function($data){
            return json_encode($data->unit_layanan);
        }
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_end_doctor_name', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'klb_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'klb_name', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'transfer_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'status_grouper', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'grouper_code', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id_klaim', ],


    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view},{downPDF},{grouper}',
        'buttons' => [

                'view' => function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-comment"></span> Sent WA', $url,
                        [ 'title' => Yii::t('app', 'Sent WA'), 'class'=>'btn btn-primary btn-md', 'target' => '_blank', 'data' => ['pjax' => '0'], 'id'=>'sentwa']) ;
                },

//            'downPDF' => function ($url, $model) {
//                return  Html::a('<span class="glyphicon glyphicon-save-file"></span> download pdf', $url,
//                    [ 'title' => Yii::t('app', 'Sent WA'), 'class'=>'btn btn-primary btn-md', ]) ;
//            },
            'grouper' => function ($url, $model) {
                return  Html::a('<span class="glyphicon glyphicon-download-alt"></span> tarik grouper', $url,
                    [ 'title' => Yii::t('app', 'Sent WA'), 'class'=>'btn btn-primary btn-md',]) ;
            },
        ],


        'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                $id = $model->visit_id;
                $url = \yii\helpers\Url::toRoute(['piring-mangkok/sentwa', 'id' => $model->visit_id]);
                return $url;
            }
            if ($action === 'downPDF') {
                $id = $model->visit_id;
                $url = \yii\helpers\Url::toRoute(['piring-mangkok/pdf', 'id' => $model->visit_id]);
                return $url;
            }
            if ($action === 'grouper') {
                $id = $model->visit_id;
                $url = \yii\helpers\Url::toRoute(['piring-mangkok/garik-grouper', 'id' => $model->visit_id]);
                return $url;
            }
        },
    ],

];

