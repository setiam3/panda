<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PandaSearch extends Panda
{
    public function rules()
    {
        return [
            [['visit_id',
                'visit_date',
                'px_id',
                'px_norm',
                'px_noktp',
                'px_name',
                'px_sex',
                'px_address',
                'surety_id',
                'surety_name',
                'visit_status',
                'sep_no',
                'pxsurety_no',
                'visit_end_date',
                'ruang_rawat_px',
                'jns_layanan',
                'class_id',
                'visit_end_cause_id',
                'kelas_pelayanan',
                'diagnosa_px',
                'tindakan_px',
                'tagihan_pelayanan',
                'visit_end_doctor_name',
                'klb_id',
                'klb_name',
                'transfer_id',
                'status_grouper',
                'grouper_code',
                'visit_id_klaim',
                'unit_layanan',
                'hasil_penunjang',
                'list_obat',
            ],'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = null)
    {
        $query = Panda::find()->where($where);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
//        $query->andFilterWhere([
//            'visit_id'=>$this->visit_id,
//            'px_id'=>$this->px_id,
//            'class_id'=>$this->class_id,
//            'klb_id'=>$this->klb_id,
//            'px_norm'=>$this->px_norm,
//            'surety_id'=>$this->surety_id,
//            'visit_status'=>$this->visit_status,
//            'visit_end_cause_id'=>$this->visit_end_cause_id,
//            'visit_id_klaim'=>$this->visit_id_klaim,
//            'transfer_id'=>$this->transfer_id,
//            'klb_id'=>$this->klb_id,
//            'class_id'=>$this->class_id,
//            'visit_end_cause_id'=>$this->visit_end_cause_id,
//        ]);
        $dates = explode(' - ', $this->visit_date);
        if((bool) strtotime($dates[0]) && (bool) strtotime ($dates[1])) {
            $this->createTimeStart = $dates[0];
            $this->createTimeEnd = $dates[1];
        }
        $query
            ->andFilterWhere(['like', 'visit_id', $this->visit_id])
            ->andFilterWhere(['like', 'visit_date', $this->visit_date])
            ->andFilterWhere(['like', 'px_id', $this->px_id])
            ->andFilterWhere(['like', 'px_norm', $this->px_norm])
            ->andFilterWhere(['like', 'px_noktp', $this->px_noktp])
            ->andFilterWhere(['like', 'px_name', $this->px_name])
            ->andFilterWhere(['like', 'px_sex', $this->px_sex])
            ->andFilterWhere(['like', 'px_address', $this->px_address])
            ->andFilterWhere(['like', 'surety_id', $this->surety_id])
            ->andFilterWhere(['like', 'surety_name', $this->surety_name])
            ->andFilterWhere(['like', 'visit_status', $this->visit_status])
            ->andFilterWhere(['like', 'sep_no', $this->sep_no])
            ->andFilterWhere(['like', 'pxsurety_no', $this->pxsurety_no])
            ->andFilterWhere(['like', 'visit_end_date', $this->visit_end_date])
            ->andFilterWhere(['like', 'ruang_rawat_px', $this->ruang_rawat_px])
            ->andFilterWhere(['like', 'jns_layanan', $this->jns_layanan])
            ->andFilterWhere(['like', 'class_id', $this->class_id])
            ->andFilterWhere(['like', 'visit_end_cause_id', $this->visit_end_cause_id])
            ->andFilterWhere(['like', 'kelas_pelayanan', $this->kelas_pelayanan])
            ->andFilterWhere(['like', 'diagnosa_px', $this->diagnosa_px])
            ->andFilterWhere(['like', 'tindakan_px', $this->tindakan_px])
            ->andFilterWhere(['like', 'tagihan_pelayanan', $this->tagihan_pelayanan])
            ->andFilterWhere(['like', 'visit_end_doctor_name', $this->visit_end_doctor_name])
            ->andFilterWhere(['like', 'klb_id', $this->klb_id])
            ->andFilterWhere(['like', 'klb_name', $this->klb_name])
            ->andFilterWhere(['like', 'transfer_id', $this->transfer_id])
            ->andFilterWhere(['like', 'status_grouper', $this->status_grouper])
            ->andFilterWhere(['like', 'grouper_code', $this->grouper_code])
            ->andFilterWhere(['like', 'visit_id_klaim', $this->visit_id_klaim])
            ->andFilterWhere(['like', 'unit_layanan', $this->unit_layanan])
            ->andFilterWhere(['like', 'hasil_penunjang', $this->hasil_penunjang])
            ->andFilterWhere(['like', 'list_obat', $this->list_obat]);
        return $dataProvider;
    }
}
