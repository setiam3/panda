<?php

namespace app\controllers;

use app\models\MantoelSearch;
use app\models\PiringMangkok;
use app\models\PiringMangkokSearch;
use yii\db\Expression;
use Yii;

class MantoelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model= new MantoelSearch();
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    public function actionPreview(){
        $request = \Yii::$app->request;
        if (empty($request)){
            $param = \Yii::$app->request->queryParams;
        }else{
            $param=$request->queryParams;
        }
        $searchModel = new MantoelSearch();
        $dataProvider = $searchModel->search($param);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionRefresh(){
        $sql = "REFRESH MATERIALIZED VIEW yanmed.v_transfer_ina";
        $aa = Yii::$app->db->createCommand($sql)->queryAll();
        echo 'berhasil';

    }



//    public function actionGeneratecol(){
//        $model=(new PiringMangkok())->attributes;
//        echo "[[";
//        foreach(array_keys($model) as $name){
////             echo "     [\n";
////             echo "         'class'=>'\kartik\grid\DataColumn',\n";
////             echo "         'attribute'=>'" . $name . "',\n";
////             echo "     ],\n".'<br>';
////             echo " ->andFilterWhere(['like', '".$name."', \$this->".$name."])".'<br>';
////
////            echo "'".$name."',".'<br>';
//
//        }
//        echo "],'safe'],";
//    }

}
