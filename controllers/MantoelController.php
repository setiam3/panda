<?php

namespace app\controllers;

use app\models\MantoelSearch;
use app\models\PiringMangkok;
use app\models\PiringMangkokSearch;
use yii\db\Expression;

class MantoelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model= new PiringMangkok();
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    public function actionPreview(){
        $request = \Yii::$app->request;
        $jenis_penjamin=$pelayanan=$unit_layanan=$createTimeStart=$createTimeEnd='';
        if ($request->post()){
            $jenis_penjamin = $request->post('PiringMangkok')['surety_name'];
            $pelayanan = $request->post('PiringMangkok')['jns_layanan'];
            $unit_layanan = $request->post('PiringMangkok')['unit_layanan'];
            $dates = $request->post('PiringMangkok')['visit_date'];
            $date = explode(' - ', $dates);

            if((bool) strtotime($date[0]) && (bool) strtotime ($date[1])) {
                $createTimeStart = $date[0];
                $createTimeEnd = $date[1];
            }
        }


        $searchModel = new MantoelSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams,$jenis_penjamin,$pelayanan,$unit_layanan,$createTimeStart,$createTimeEnd);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);






//        $where = new Expression('surety_name = 'APBD' and jns_layanan = 'RJ' and visit_date BETWEEN '2020-08-04 08:30:50' AND'2020-08-05 08:20:21'');


//        $where = new Expression('lower(unit_layanan::text) like \'%'.strtolower($this->unit_layanan).'%\'');
//

//        $datas = PiringMangkok::find()->where(['=','surety_name',$request->post('PiringMangkok')['surety_name']])->all();

//        var_dump($datas);
    }

    public function actionIndex1()
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
