<?php
namespace app\controllers;
use Yii;
use app\models\MvPendapatan;
use app\models\MvPendapatanSearch;

class PendapatanController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $where='';
        $searchModel = new MvPendapatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionGeneratecol(){
        $model=(new MvPendapatan)->attributes;
        //echo "[[";
        foreach(array_keys($model) as $name){
            // echo "     [\n";
            // echo "         'class'=>'\kartik\grid\DataColumn',\n";
            // echo "         'attribute'=>'" . $name . "',\n";
            // echo "     ],\n".'<br>';
            //echo " ->andFilterWhere(['like', '".$name."', \$this->".$name."])".'<br>';

            //echo "'".$name."',";

        }
        //echo "],'safe'],";
    }

}
