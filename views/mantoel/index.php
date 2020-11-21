<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
CrudAsset::register($this);
$idmodal=md5($dataProvider->query->modelClass);
?>
<div class="row">
    <div class="row">
        <div class="row">
            <div class="row">
                <div class="pendapatan-index">
                    <div id="ajaxCrudDatatable">


                        <?=GridView::widget([
                            'id'=>'crud-datatable'.$idmodal,
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'pjax'=>true,
                            'columns' => require(__DIR__.'/_columns.php'),
                            'toolbar'=> [

                                ['content'=>
                                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                                    '{toggleData}'.
                                    '{export}'
                                ],
                            ],
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,
                            'panel' => [
                                'type' => 'primary',
                                'heading' => '<i class="glyphicon glyphicon-list"></i> Mantoel',
                                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                                'after'=>BulkButtonWidget::widget([
                                        'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                            ["bulk-delete"] ,
                                            [
                                                "class"=>"btn btn-danger btn-xs",
                                                'role'=>'modal-remote-bulk',
                                                'data-target'=>'#'.$idmodal,
                                                'data-confirm'=>false, 'data-method'=>false,
                                                'data-request-method'=>'post',
                                                'data-confirm-title'=>'Are you sure?',
                                                'data-confirm-message'=>'Are you sure want to delete this item'
                                            ]),
                                    ]).
                                    '<div class="clearfix"></div>',
                            ]
                        ])?>

                        <?= Html::endForm(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
