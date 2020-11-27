<?php

namespace app\controllers;
use app\models\MantoelSearch;
use app\models\PandaSearch;
use Yii;
use app\models\Panda;
use yii\i18n\Formatter;

class PandaController extends \yii\web\Controller
{
    public function coba($visid){
        $sql = "SELECT ruang_rawat_px from yanmed.v_panda where visit_id ='$visid'";
        $datas = Yii::$app->db->createCommand($sql)->queryAll();
        $table='<table>';
        foreach ($datas as $data){
            $table.='<tr>';
            $lain_3=json_decode($data['ruang_rawat_px']);

            foreach ($lain_3 as $r){
                $KMasuk[] = $r->f1;
                $KKemluar[] = $r->f2;
                $KRuangan[] = $r->f3;


                $table.= '<td>';
                $table.= '<table>';
                $table.= '<tr class="title">';
                $table.= '<th>tgl masuk </th> <th>tgl keluar </th> <th>ruangan </th>';
                $table.= '</tr>';
                $table.= '<tr>';
                $table.= '<td>'.date('Y-m-d',strtotime($r->f1)).'</td>';
                $table.= '<td>'.date('Y-m-d',strtotime($r->f2)).'</td>';
                $table.= '<td>'.$r->f3.'</td>';
                $table.= '</tr>';
                $table.= '</table>';
            $table.= '</td>';

            }
            $table.= '</tr>';
        }
        $table.= '</table>';
        return $table;

    }

    public function actionIndex()
    {
        $model= new PandaSearch();
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
        $searchModel = new PandaSearch();
        $dataProvider = $searchModel->search($param);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }





    public function actionIndex1()
    {
        $where='';
        $searchModel = new PandaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGeneratecol(){
        $model=(new Panda())->attributes;
        echo "[[";
        foreach(array_keys($model) as $name){
//             echo "     [\n";
//             echo "         'class'=>'\kartik\grid\DataColumn',\n";
//             echo "         'attribute'=>'" . $name . "',\n";
//             echo "     ],\n".'<br>';
             echo " ->andFilterWhere(['like', '".$name."', \$this->".$name."])".'<br>';
//
//            echo "'".$name."',".'<br>';

        }
//        echo "],'safe'],";
    }

}
