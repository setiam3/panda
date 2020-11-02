<?php
namespace app\models;
use Yii;
class MvPendapatan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'finance.mv_pendapatan';
    }
    public function rules()
    {
        return [
            [['tgl_tagihan', 'tgl_kunjungan', 'tgl_bayar', 'tgl_selesai_kunjungan'], 'safe'],
            [['srv_from', 'unit_kunjungan', 'type_unit_kunjungan', 'id_paramedis', 'class_id', 'shift', 'surety_id', 'tagihan_pasien', 'tarifcito_value', 'bill_id', 'billing_id', 'dpjp_id', 'empcat_id', 'kasir_id', 'tarif_id', 'srv_id', 'visit_id', 'loket_id', 'visit_status', 'srv_status', 'billing_qty', 'total_dijamin', 'par_id2'], 'default', 'value' => null],
            [['srv_from', 'unit_kunjungan', 'type_unit_kunjungan', 'id_paramedis', 'class_id', 'shift', 'surety_id', 'tagihan_pasien', 'tarifcito_value', 'bill_id', 'billing_id', 'dpjp_id', 'empcat_id', 'kasir_id', 'tarif_id', 'srv_id', 'visit_id', 'loket_id', 'visit_status', 'srv_status', 'billing_qty', 'total_dijamin', 'par_id2'], 'integer'],
            [['kode_tagihan', 'kelompok_tagihan', 'nama_pasien', 'nama_paramedis', 'class_name', 'srv_type', 'kode', 'bill_name', 'pelaksana_2', 'delegasi'], 'string'],
            [['jumlah_terbayar', 'jumlah_retur'], 'number'],
            [['srv_from_name', 'nama_unit_kunjungan', 'penjamin_tagihan'], 'string', 'max' => 50],
            [['no_rm_pasien'], 'string', 'max' => 10],
            [['sep_no'], 'string', 'max' => 100],
            [['pxsurety_no'], 'string', 'max' => 20],
        ];
    }
    public function attributeLabels()
    {
        return [
            'tgl_tagihan' => 'Tgl Tagihan',
            'tgl_kunjungan' => 'Tgl Kunjungan',
            'tgl_bayar' => 'Tgl Bayar',
            'srv_from' => 'Srv From',
            'srv_from_name' => 'Srv From Name',
            'unit_kunjungan' => 'Unit Kunjungan',
            'nama_unit_kunjungan' => 'Nama Unit Kunjungan',
            'type_unit_kunjungan' => 'Type Unit Kunjungan',
            'kode_tagihan' => 'Kode Tagihan',
            'kelompok_tagihan' => 'Kelompok Tagihan',
            'no_rm_pasien' => 'No Rm Pasien',
            'nama_pasien' => 'Nama Pasien',
            'id_paramedis' => 'Id Paramedis',
            'nama_paramedis' => 'Nama Paramedis',
            'class_id' => 'Class ID',
            'shift' => 'Shift',
            'class_name' => 'Class Name',
            'surety_id' => 'Surety ID',
            'penjamin_tagihan' => 'Penjamin Tagihan',
            'tagihan_pasien' => 'Tagihan Pasien',
            'jumlah_terbayar' => 'Jumlah Terbayar',
            'srv_type' => 'Srv Type',
            'tarifcito_value' => 'Tarifcito Value',
            'jumlah_retur' => 'Jumlah Retur',
            'kode' => 'Kode',
            'bill_id' => 'Bill ID',
            'bill_name' => 'Bill Name',
            'billing_id' => 'Billing ID',
            'dpjp_id' => 'Dpjp ID',
            'empcat_id' => 'Empcat ID',
            'kasir_id' => 'Kasir ID',
            'tarif_id' => 'Tarif ID',
            'srv_id' => 'Srv ID',
            'visit_id' => 'Visit ID',
            'tgl_selesai_kunjungan' => 'Tgl Selesai Kunjungan',
            'loket_id' => 'Loket ID',
            'visit_status' => 'Visit Status',
            'srv_status' => 'Srv Status',
            'billing_qty' => 'Billing Qty',
            'total_dijamin' => 'Total Dijamin',
            'sep_no' => 'Sep No',
            'pxsurety_no' => 'Pxsurety No',
            'par_id2' => 'Par Id2',
            'pelaksana_2' => 'Pelaksana 2',
            'delegasi' => 'Delegasi',
        ];
    }
}
