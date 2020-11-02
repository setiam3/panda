<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\Html;
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tgl_tagihan', ],
    [ 'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tgl_kunjungan',
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
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tgl_bayar', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'srv_from', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'srv_from_name', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'unit_kunjungan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'nama_unit_kunjungan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'type_unit_kunjungan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kode_tagihan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kelompok_tagihan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'no_rm_pasien', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'nama_pasien', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'id_paramedis', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'nama_paramedis', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'class_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'shift', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'class_name', ],
    //[ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'surety_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'penjamin_tagihan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tagihan_pasien', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jumlah_terbayar', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'srv_type', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tarifcito_value', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'jumlah_retur', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kode', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'bill_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'bill_name', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'billing_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'dpjp_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'empcat_id', ],
    //[ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'kasir_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tarif_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'srv_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'tgl_selesai_kunjungan', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'loket_id', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'visit_status', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'srv_status', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'billing_qty', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'total_dijamin', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'sep_no', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pxsurety_no', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'par_id2', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'pelaksana_2', ],
    [ 'class'=>'\kartik\grid\DataColumn', 'attribute'=>'delegasi', ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        // 'urlCreator' => function ($action, $model, $key, $index) {
        //     return Url::to([$action, 'id' => $key]);
        // },
        // 'buttons' => [
        //     'view' => function ($url, $model) {
        //         $idmodal = md5($model::className());
        //         $t = '@web/pendapatan/view?id=' . $model->id;
        //         return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $idmodal, 'title' => 'View', 'data-toggle' => 'tooltip']);
        //     },
        //     'update' => function ($url, $model) {
        //         $idmodal = md5($model::className());
        //         $t = '@web/pendapatan/update?id=' . $model->id;
        //         return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $idmodal, 'title' => 'Update', 'data-toggle' => 'tooltip']);
        //     },
        //     'delete' => function ($url, $model) {
        //         $idmodal = md5($model::className());
        //         $t = '@web/pendapatan/delete?id=' . $model->id;
        //         return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to($t), [
        //             'role' => 'modal-remote', 'data-target' => '#' . $idmodal, 'title' => 'Delete',
        //             'data-confirm' => false, 'data-method' => false,
        //             'data-request-method' => 'post',
        //             'data-toggle' => 'tooltip',
        //             'data-confirm-title' => 'Are you sure?',
        //             'data-confirm-message' => 'Are you sure want to delete this item'
        //         ]);
        //     },
        // ],
    ],

];
