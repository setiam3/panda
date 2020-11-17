<?php

namespace app\controllers;

use app\models\MantoelSearch;
use app\models\PiringMangkok;
use app\models\PiringMangkokSearch;

class MantoelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $where='';
        $searchModel = new MantoelSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams,$where);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
//    public function actionGeneratecol(){
//        $model=(new PiringMangkok())->attributes;
//        echo "[[";
//        foreach(array_keys($model) as $name){
////             echo "     [\n";
////             echo "         'class'=>'\kartik\grid\DataColumn',\n";
////             echo "         'attribute'=>'" . $name . "',\n";
////             echo "     ],\n".'<br>';
//            // echo " ->andFilterWhere(['like', '".$name."', \$this->".$name."])".'<br>';
////
//            echo "'".$name."',".'<br>';
//
//        }
//        echo "],'safe'],";
//    }

}
