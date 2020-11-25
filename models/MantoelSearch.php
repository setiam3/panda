<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class MantoelSearch extends PiringMangkok
{
    public $createTimeStart,$createTimeEnd,$tgl_pulang;
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
            'hasil_laborat',
            'hasil_penunjang',
            'hasil_radoilogi',
            'pemulasaraan_jenazah',
            'kantong_jenazah',
            'peti_jenazah',
            'plastik_jenazah',
            'desinfektan_jenazah',
            'transport_mobil',
            'desinfektan_mobil',
            'terapi',
//            'hak_kelas_px'
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

//        $dataProvider->setSort([
//            'attributes' => [
//                'retribusi' => [
//                    'asc' => ['tagihan_pelayanan' => SORT_ASC],
//                    'desc' => ['tagihan_pelayanan' => SORT_DESC],
//                    'label' => 'Your_label',
//                    'default' => SORT_ASC
//                ],'defaultOrder' => [ 'retribusi' => SORT_DESC ],],]);

                $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'visit_id'=>$this->visit_id,
            'px_id'=>$this->px_id,
//            'surety_class_id'=>$this->surety_class_id,
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
//        $unit = new Expression('lower(unit_layanan::text) like \'%'.strtolower($this->unit_layanan).'%\'');
        $unit = new Expression('unit_layanan::text similar to \'%('.implode($this->unit_layanan,'|').')%\'');
        $kelas_pelayanan = new Expression('lower(kelas_pelayanan::text) like \'%'.strtolower($this->kelas_pelayanan).'%\'');
        $ruang_rawat = new Expression('lower(ruang_rawat_px::text) like \'%'.strtolower($this->ruang_rawat_px).'%\'');
        $diagnosa = new Expression('lower(diagnosa_px::text) like \'%'.strtolower($this->diagnosa_px).'%\'');
        $diagnosaS = new Expression('lower(diagnosa_px::text) like \'%'.strtolower($this->diagnosa_pxs).'%\'');
        $retribusi = new Expression('lower(tagihan_pelayanan::text) like \'%'.strtolower($this->retribusi).'%\'');
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
        $visit_date = new Expression('visit_date::date between\''.$this->createTimeStart.'\'and\''.$this->createTimeEnd.'\'');
        $birthdate = new Expression('TO_CHAR (px_birthdate::date,\'dd-mm-yyyy\') LIKE \'%'.$this->px_birthdate.'%\'');
        $tglsep = new Expression('TO_CHAR (sep_tgl::date,\'dd-mm-yyyy\') LIKE \'%'.$this->sep_tgl.'%\'');
        $tglmeninggal = new Expression('TO_CHAR (tgl_meninggal::date,\'dd-mm-yyyy\') LIKE \'%'.$this->tgl_meninggal.'%\'');
        $tgl_pulang = new Expression('TO_CHAR (visit_end_date::date,\'dd-mm-yyyy\') LIKE \'%'.$this->tgl_pulang.'%\'');
        $query
            ->andFilterWhere(['between', 'visit_date', $this->createTimeStart,$this->createTimeEnd])
            ->andWhere($visit_date)
            ->andFilterWhere(['like', 'px_noktp', $this->px_noktp])
            ->andFilterWhere(['like', 'lower(px_name)', strtolower($this->px_name)])
            ->andFilterWhere(['like', 'lower(px_sex)', strtolower($this->px_sex)])
            ->andFilterWhere(['like', 'lower(px_address)', strtolower($this->px_address)])
            ->andFilterWhere(['like', 'lower(surety_name)', strtolower($this->surety_name)])
            ->andFilterWhere(['like', 'sep_no', $this->sep_no])
            ->andFilterWhere(['like', 'pxsurety_no', $this->pxsurety_no])
//            ->andFilterWhere(['between', 'visit_end_date', $this->createTimeStart,$this->createTimeEnd])
            ->andWhere($tgl_pulang)
            ->andWhere($birthdate)
            ->andWhere($tglsep)
            ->andWhere($tglmeninggal)
//            ->andFilterWhere(['like', 'text(ruang_rawat_px)', $this->ruang_rawat_px])
            ->andWhere($ruang_rawat)
            ->andFilterWhere(['=', 'lower(jns_layanan)', strtolower($this->jns_layanan)])
//            ->andFilterWhere(['like', 'kelas_pelayanan', $this->kelas_pelayanan])
            ->andWhere($kelas_pelayanan)
            ->andWhere($diagnosa)//diagnosa primer
            ->andWhere($diagnosaS)//diagnosa sekunder
            ->andFilterWhere(['like', 'tindakan_px', $this->tindakan_px])
            ->andFilterWhere(['like', 'billing_inacbg', $this->billing_inacbg])
            ->andFilterWhere(['like', 'lower(visit_end_doctor_name)', strtolower($this->visit_end_doctor_name)])
            ->andFilterWhere(['like', 'lower(klb_name)', strtolower($this->klb_name)])
            ->andFilterWhere(['like', 'status_grouper', $this->status_grouper])
            ->andFilterWhere(['like', 'grouper_code', $this->grouper_code])
            ->andFilterWhere(['like', 'krs', $this->krs])
            ->andWhere($retribusi)
            ->andWhere($hasil_laborat)
            ->andWhere($hasil_radoilogi)
            ->andWhere($terapi)
            ->andWhere($pemulasaraan)
            ->andWhere($kantong_jenazah)
            ->andWhere($kantong_jenazah)
            ->andWhere($peti_jenazah)
            ->andWhere($plastik_jenazah)
            ->andWhere($desinfektan_jenazah)
            ->andWhere($transport_mobil)
            ->andWhere($desinfektan_mobil)
            ->andFilterWhere(['like', 'lower(cara_pulang)',strtolower($this->cara_pulang)])
//            ->andFilterWhere(['like', 'unit_layanan',(string)$this->unit_layanan]);
            ->andWhere($unit);
        return $dataProvider;
    }
}
