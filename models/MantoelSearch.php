<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class MantoelSearch extends PiringMangkok
{
    public $createTimeStart,$createTimeEnd;
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
//            'visit_end_date',
            'ruang_rawat_px',
            'jns_layanan',
            'class_id',
            'visit_end_cause_id',
            'kelas_pelayanan',
            'diagnosa_px',
            'tindakan_px',
            'billing_inacbg',
            'visit_end_doctor_name',
            'klb_id',
            'klb_name',
            'transfer_id',
            'status_grouper',
            'grouper_code',
            'visit_id_klaim',
            'unit_layanan',
//            'sep_tgl',
            'krs',
            'tagihan_pelayanan',
            'cara_pulang'
            ],'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = PiringMangkok::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'visit_id'=>$this->visit_id,
            'px_id'=>$this->px_id,
            'class_id'=>$this->class_id,
            'klb_id'=>$this->klb_id,
            'px_norm'=>$this->px_norm,
            'surety_id'=>$this->surety_id,
            'visit_status'=>$this->visit_status,
            'visit_end_cause_id'=>$this->visit_end_cause_id,
            'visit_id_klaim'=>$this->visit_id_klaim,
            'transfer_id'=>$this->transfer_id,
            'klb_id'=>$this->klb_id,
            'class_id'=>$this->class_id,
            'visit_end_cause_id'=>$this->visit_end_cause_id,
            ]);
        $dates = explode(' - ', $this->visit_date);
        if((bool) strtotime($dates[0]) && (bool) strtotime ($dates[1])) {
            $this->createTimeStart = $dates[0];
            $this->createTimeEnd = $dates[1];
        }
        $unit = new Expression('lower(unit_layanan::text) like \'%'.strtolower($this->unit_layanan).'%\'');
        $kelas_pelayanan = new Expression('lower(kelas_pelayanan::text) like \'%'.strtolower($this->kelas_pelayanan).'%\'');
        $ruang_rawat = new Expression('lower(ruang_rawat_px::text) like \'%'.strtolower($this->ruang_rawat_px).'%\'');
        $diagnosa = new Expression('lower(diagnosa_px::text) like \'%'.strtolower($this->diagnosa_px).'%\'');
        $query
            ->andFilterWhere(['between', 'visit_date', $this->createTimeStart,$this->createTimeEnd])
            ->andFilterWhere(['like', 'px_noktp', $this->px_noktp])
            ->andFilterWhere(['like', 'lower(px_name)', strtolower($this->px_name)])
            ->andFilterWhere(['like', 'lower(px_sex)', strtolower($this->px_sex)])
            ->andFilterWhere(['like', 'lower(px_address)', strtolower($this->px_address)])
            ->andFilterWhere(['like', 'lower(surety_name)', strtolower($this->surety_name)])
            ->andFilterWhere(['like', 'sep_no', $this->sep_no])
            ->andFilterWhere(['like', 'pxsurety_no', $this->pxsurety_no])
//            ->andFilterWhere(['between', 'visit_end_date', $this->createTimeStart,$this->createTimeEnd])
//            ->andFilterWhere(['like', 'visit_end_date', $this->createTimeEnd])
            ->andFilterWhere(['like', 'text(ruang_rawat_px)', $this->ruang_rawat_px])
            ->andWhere($ruang_rawat)
            ->andFilterWhere(['like', 'lower(jns_layanan)', strtolower($this->jns_layanan)])
//            ->andFilterWhere(['like', 'kelas_pelayanan', $this->kelas_pelayanan])
            ->andWhere($kelas_pelayanan)
//            ->andFilterWhere(['like', 'diagnosa_px', $this->diagnosa_px])
            ->andWhere($diagnosa)
            ->andFilterWhere(['like', 'tindakan_px', $this->tindakan_px])
            ->andFilterWhere(['like', 'billing_inacbg', $this->billing_inacbg])
            ->andFilterWhere(['like', 'visit_end_doctor_name', $this->visit_end_doctor_name])
            ->andFilterWhere(['like', 'lower(klb_name)', strtolower($this->klb_name)])
            ->andFilterWhere(['like', 'status_grouper', $this->status_grouper])
            ->andFilterWhere(['like', 'grouper_code', $this->grouper_code])
            ->andFilterWhere(['like', 'krs', $this->krs])
//            ->andFilterWhere(['like', 'unit_layanan',(string)$this->unit_layanan]);
            ->andWhere($unit);
        return $dataProvider;
    }
}
