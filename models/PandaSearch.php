<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class PandaSearch extends PiringMangkok
{
    public $createTimeStart,$createTimeEnd;
    public $krs,$tempat_layanan, $tgl_pulang;
    public $diagnosa_pxs,$retribusi,$hasil_laborat,$hasil_radoilogi,$terapi,$pemulasaraan_jenazah,$kantong_jenazah,
        $peti_jenazah,$plastik_jenazah,$desinfektan_jenazah,$transport_mobil,$desinfektan_mobil,$hak_pelayanan;
    public function rules()
    {
        return [
            [['visit_id', 'visit_date', 'px_id', 'px_norm', 'px_noktp', 'px_name', 'px_sex', 'px_address', 'surety_id',
                'surety_name', 'visit_status', 'sep_no', 'pxsurety_no',
                'visit_end_date',
                'ruang_rawat_px', 'jns_layanan', 'class_id', 'visit_end_cause_id', 'kelas_pelayanan',
                'diagnosa_px',
                'diagnosa_pxs',
                'tindakan_px',
                'tindakan_px2',
                'px_birthdate',
//            'billing_inacbg',
                'visit_end_doctor_name',
                'klb_id',
                'klb_name',
                'transfer_id',
                'status_grouper',
                'grouper_code',
                'visit_id_klaim',
                'unit_layanan',
                'sep_tgl',
                'tgl_meninggal',
                'tgl_pulang',
                'krs',
                'tagihan_pelayanan',
                'cara_pulang',
                'hasil_laborat',
                'retribusi',
                'hasil_penunjang',
                'hasil_radoilogi',
                'pemulasaraan_jenazah',
                'kantong_jenazah',
                'peti_jenazah',
                'plastik_jenazah',
                'desinfektan_jenazah',
                'transport_mobil',
                'desinfektan_mobil',
                'list_obat',
                'tempat_layanan',
                'tgl_pulang','terapi',
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
            'sort' =>false
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
            'visit_end_cause_id'=>$this->visit_end_cause_id,
        ]);

        $dates = explode(' - ', $this->visit_date);
        if((bool) strtotime($dates[0]) && (bool) strtotime ($dates[1])) {
            $this->createTimeStart = $dates[0];
            $this->createTimeEnd = $dates[1];
        }

        if (empty($this->unit_layanan)){
            $unit = new Expression('unit_layanan::text similar to \'%%\'');
        }else{
            $unit = new Expression('unit_layanan::text similar to \'%('.implode($this->unit_layanan,'|').')%\'');
        }

        $tgl_pulang = new Expression('TO_CHAR (visit_end_date::date,\'dd-mm-yyyy\') LIKE \'%'.$this->tgl_pulang.'%\'');

        $birthdate = new Expression('TO_CHAR (px_birthdate::date,\'dd-mm-yyyy\') LIKE \'%'.$this->px_birthdate.'%\'');
        $tempatL = new Expression('unit_layanan::text like \'%'.$this->tempat_layanan.'%\'');
        $diagnosa = new Expression('lower(diagnosa_px::text) like \'%'.strtolower($this->diagnosa_px).'%\'');
        $diagnosaS = new Expression('lower(diagnosa_px::text) like \'%'.strtolower($this->diagnosa_pxs).'%\'');
        $hasil_laborat = new Expression('lower(hasil_penunjang::text) like \'%'.strtolower($this->hasil_laborat).'%\'');
        $hasil_radoilogi = new Expression('lower(hasil_penunjang::text) like \'%'.strtolower($this->hasil_radoilogi).'%\'');
        $terapi = new Expression('lower(list_obat::text) like \'%'.strtolower($this->terapi).'%\'');

        $pemulasaraan = new Expression('lower(tagihan_pelayanan::text) like \'%'.strtolower($this->pemulasaraan_jenazah).'%\'');
        $kantong_jenazah = new Expression('lower(tagihan_pelayanan::text) like \'%'.strtolower($this->kantong_jenazah).'%\'');
        $peti_jenazah = new Expression('lower(tagihan_pelayanan::text) like \'%'.strtolower($this->peti_jenazah).'%\'');
        $plastik_jenazah = new Expression('lower(tagihan_pelayanan::text) like \'%'.strtolower($this->plastik_jenazah).'%\'');
        $desinfektan_jenazah = new Expression('lower(tagihan_pelayanan::text) like \'%'.strtolower($this->desinfektan_jenazah).'%\'');
        $transport_mobil = new Expression('lower(tagihan_pelayanan::text) like \'%'.strtolower($this->transport_mobil).'%\'');
        $desinfektan_mobil = new Expression('lower(tagihan_pelayanan::text) like \'%'.strtolower($this->desinfektan_mobil).'%\'');
        $query
            ->andFilterWhere(['between', 'visit_date', $this->createTimeStart,$this->createTimeEnd])
            ->andFilterWhere(['like', 'px_norm', $this->px_norm])
            ->andFilterWhere(['like', 'px_noktp', $this->px_noktp])
            ->andWhere($birthdate)
            ->andWhere($tgl_pulang)
            ->andWhere($terapi)
            ->andFilterWhere(['like', 'px_name', $this->px_name])
            ->andFilterWhere(['like', 'px_sex', $this->px_sex])
            ->andFilterWhere(['like', 'px_address', $this->px_address])
            ->andFilterWhere(['like', 'surety_name', $this->surety_name])
            ->andFilterWhere(['like', 'sep_no', $this->sep_no])
            ->andFilterWhere(['like', 'pxsurety_no', $this->pxsurety_no])
            ->andFilterWhere(['between', 'visit_end_date', $this->createTimeStart,$this->createTimeEnd])
            ->andFilterWhere(['like', 'ruang_rawat_px', $this->ruang_rawat_px])
            ->andFilterWhere(['like', 'krs', $this->krs])
            ->andFilterWhere(['like', 'jns_layanan', $this->jns_layanan])
            ->andFilterWhere(['like', 'kelas_pelayanan', $this->kelas_pelayanan])
            ->andWhere($diagnosa)
            ->andWhere($diagnosaS)
            ->andFilterWhere(['like', 'tindakan_px', $this->tindakan_px])
            ->andFilterWhere(['like', 'tagihan_pelayanan', $this->tagihan_pelayanan])
            ->andFilterWhere(['like', 'visit_end_doctor_name', $this->visit_end_doctor_name])
            ->andFilterWhere(['like', 'klb_id', $this->klb_id])
            ->andFilterWhere(['like', 'klb_name', $this->klb_name])
            ->andFilterWhere(['like', 'status_grouper', $this->status_grouper])
            ->andFilterWhere(['like', 'grouper_code', $this->grouper_code])
            ->andWhere($tempatL)
            ->andWhere($unit)
            ->andWhere($hasil_laborat)
            ->andWhere($hasil_radoilogi)
            ->andFilterWhere(['like', 'list_obat', $this->list_obat])
            ->andFilterWhere(['like', 'cara_pulang', $this->cara_pulang])
            ->andWhere($pemulasaraan)
            ->andWhere($peti_jenazah)
            ->andWhere($plastik_jenazah)
            ->andWhere($desinfektan_jenazah)
            ->andWhere($transport_mobil)
            ->andWhere($desinfektan_mobil)
            ->andWhere($kantong_jenazah);
        return $dataProvider;
    }
}
