<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MvPendapatan;

class MvPendapatanSearch extends MvPendapatan
{
    public $createTimeStart,$createTimeEnd;
    public function rules()
    {
        return [
            [['tgl_tagihan','tgl_kunjungan','tgl_bayar','srv_from','srv_from_name','unit_kunjungan','nama_unit_kunjungan','type_unit_kunjungan','kode_tagihan','kelompok_tagihan','no_rm_pasien','nama_pasien','id_paramedis','nama_paramedis','class_id','shift','class_name','surety_id','penjamin_tagihan','tagihan_pasien','jumlah_terbayar','srv_type','tarifcito_value','jumlah_retur','kode','bill_id','bill_name','billing_id','dpjp_id','empcat_id','kasir_id','tarif_id','srv_id','visit_id','tgl_selesai_kunjungan','loket_id','visit_status','srv_status','billing_qty','total_dijamin','sep_no','pxsurety_no','par_id2','pelaksana_2','delegasi',],'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = null)
    {
        $query = MvPendapatan::find()->where($where);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['visit_id'=>$this->visit_id]);

        $dates = explode(' - ', $this->tgl_kunjungan);
        if((bool) strtotime($dates[0]) && (bool) strtotime ($dates[1])) {
            $this->createTimeStart = $dates[0];
            $this->createTimeEnd = $dates[1];
        }

        $query->andFilterWhere(['like', 'tgl_tagihan', $this->tgl_tagihan])
        // ->andFilterWhere(['> =','tgl_kunjungan', $this->createTimeStart])
        // ->andFilterWhere(['<','tgl_kunjungan', $this->createTimeEnd])
            ->andFilterWhere(['between', 'tgl_kunjungan', $this->createTimeStart,$this->createTimeEnd])
            ->andFilterWhere(['like', 'tgl_bayar', $this->tgl_bayar])
            ->andFilterWhere(['like', 'srv_from', $this->srv_from])
            ->andFilterWhere(['like', 'srv_from_name', $this->srv_from_name])
            ->andFilterWhere(['like', 'unit_kunjungan', $this->unit_kunjungan])
            ->andFilterWhere(['like', 'nama_unit_kunjungan', $this->nama_unit_kunjungan])
            ->andFilterWhere(['like', 'type_unit_kunjungan', $this->type_unit_kunjungan])
            ->andFilterWhere(['like', 'kode_tagihan', $this->kode_tagihan])
            ->andFilterWhere(['like', 'kelompok_tagihan', $this->kelompok_tagihan])
            ->andFilterWhere(['like', 'no_rm_pasien', $this->no_rm_pasien])
            ->andFilterWhere(['like', 'nama_pasien', $this->nama_pasien])
            ->andFilterWhere(['like', 'id_paramedis', $this->id_paramedis])
            ->andFilterWhere(['like', 'nama_paramedis', $this->nama_paramedis])
            ->andFilterWhere(['like', 'class_id', $this->class_id])
            ->andFilterWhere(['like', 'shift', $this->shift])
            ->andFilterWhere(['like', 'class_name', $this->class_name])
            //->andFilterWhere(['like', 'surety_id', $this->surety_id])
            ->andFilterWhere(['like', 'penjamin_tagihan', $this->penjamin_tagihan])
            ->andFilterWhere(['like', 'tagihan_pasien', $this->tagihan_pasien])
            ->andFilterWhere(['like', 'jumlah_terbayar', $this->jumlah_terbayar])
            ->andFilterWhere(['like', 'srv_type', $this->srv_type])
            ->andFilterWhere(['like', 'tarifcito_value', $this->tarifcito_value])
            ->andFilterWhere(['like', 'jumlah_retur', $this->jumlah_retur])
            ->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'bill_id', $this->bill_id])
            ->andFilterWhere(['like', 'bill_name', $this->bill_name])
            ->andFilterWhere(['like', 'billing_id', $this->billing_id])
            ->andFilterWhere(['like', 'dpjp_id', $this->dpjp_id])
            ->andFilterWhere(['like', 'empcat_id', $this->empcat_id])
            ->andFilterWhere(['like', 'kasir_id', $this->kasir_id])
            ->andFilterWhere(['like', 'tarif_id', $this->tarif_id])
            ->andFilterWhere(['like', 'srv_id', $this->srv_id])
            ->andFilterWhere(['like', 'tgl_selesai_kunjungan', $this->tgl_selesai_kunjungan])
            ->andFilterWhere(['like', 'loket_id', $this->loket_id])
            ->andFilterWhere(['like', 'visit_status', $this->visit_status])
            ->andFilterWhere(['like', 'srv_status', $this->srv_status])
            ->andFilterWhere(['like', 'billing_qty', $this->billing_qty])
            ->andFilterWhere(['like', 'total_dijamin', $this->total_dijamin])
            ->andFilterWhere(['like', 'sep_no', $this->sep_no])
            ->andFilterWhere(['like', 'pxsurety_no', $this->pxsurety_no])
            ->andFilterWhere(['like', 'par_id2', $this->par_id2])
            ->andFilterWhere(['like', 'pelaksana_2', $this->pelaksana_2])
            ->andFilterWhere(['like', 'delegasi', $this->delegasi]);
        return $dataProvider;
    }
}
