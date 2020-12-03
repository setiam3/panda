<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\SwitchInput;

$this->title = 'Form Mantoel';
$this->params['breadcrumbs'][] = ['label' => 'Mantoel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="mantoel-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
            'action' => \yii\helpers\Url::to(['mantoel/preview']),'method' => 'get','enableClientValidation' => true,
        'options' => [
            'validateOnSubmit' => true,
            'class' => 'form'
        ],
        ]) ?>
    <div class="col-md-6">
        <?= $form->field($model, 'surety_name')->widget(\kartik\select2\Select2::classname(),[
            'data' => \yii\helpers\ArrayHelper::map(\app\models\MantoelSearch::find()->all(),'surety_name','surety_name'),
            'language' => 'de',
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
//            'name' => 'surety_name'
        ])->label('Jenis Penjamain') ?>
        <?= $form->field($model, 'visit_date')->widget(\kartik\daterange\DateRangePicker::className(),[
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
        ])->label('tanggal kunjung') ?>

        <?= $form->field($model, 'jns_layanan')->widget(\kartik\select2\Select2::classname(),[
            'data' => ['RI'=>'RI','RJ'=>'RJ','IGD'=>'IGD'],
            'language' => 'de',
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Select a state ...','multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ])->label('Pelayanan') ?>

        <?= $form->field($model, 'unit_layanan')->widget(\kartik\select2\Select2::classname(),[
            'data' => \yii\helpers\ArrayHelper::map((new \yii\db\Query())
                ->from('admin.ms_unit')
                ->where(['in','unit_type',[21,22,23]])
                ->all(),
                'unit_name','unit_name'),
            'language' => 'de',
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Select a state ...','multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ])->label('unit pelayanan') ?>

        <div class="form-group">
            <?= Html::submitButton('Preview', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

