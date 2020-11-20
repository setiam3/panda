<?php

namespace app\models;

use Yii;

class PiringMangkok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yanmed.v_transfer_ina';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visit_id', 'px_id', 'surety_id', 'visit_status', 'class_id', 'visit_end_cause_id', 'klb_id', 'transfer_id', 'visit_id_klaim'], 'default', 'value' => null],
            [['visit_id', 'px_id', 'surety_id', 'visit_status', 'class_id', 'visit_end_cause_id', 'klb_id', 'transfer_id', 'visit_id_klaim'], 'integer'],
            [['visit_date', 'visit_end_date', 'kelas_pelayanan', 'billing_inacbg', 'unit_layanan','sep_tgl','tgl_meninggal','list_obat','tagihan_pelayanan'], 'safe'],
            [['px_address', 'ruang_rawat_px', 'jns_layanan', 'diagnosa_px', 'tindakan_px', 'visit_end_doctor_name','krs','cara_pulang'], 'string'],
            [['px_norm'], 'string', 'max' => 10],
            [['px_noktp', 'pxsurety_no', 'status_grouper', 'grouper_code'], 'string', 'max' => 20],
            [['px_name', 'surety_name', 'klb_name'], 'string', 'max' => 50],
            [['px_sex'], 'string', 'max' => 1],
            [['sep_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'visit_id' => 'Kunjungan',
            'visit_date' => 'Tanggal Kunjung',
            'px_id' => 'Px ID',
            'px_norm' => 'No RM',
            'px_noktp' => 'KTP',
            'px_name' => 'Nama',
            'px_sex' => 'Jenis Kelamin',
            'px_address' => 'Alamat',
            'surety_id' => 'Surety ID',
            'surety_name' => 'Surety Name',
            'visit_status' => 'Visit Status',
            'sep_no' => 'Sep No',
            'pxsurety_no' => 'Pxsurety No',
            'visit_end_date' => 'Visit End Date',
            'ruang_rawat_px' => 'Ruang Rawat Px',
            'jns_layanan' => 'Jns Layanan',
            'class_id' => 'Class ID',
            'visit_end_cause_id' => 'Visit End Cause ID',
            'kelas_pelayanan' => 'Kelas Pelayanan',
            'diagnosa_px' => 'Diagnosa Px',
            'tindakan_px' => 'Tindakan Px',
            'billing_inacbg' => 'Billing Inacbg',
            'visit_end_doctor_name' => 'Visit End Doctor Name',
            'klb_id' => 'Klb ID',
            'klb_name' => 'Klb Name',
            'transfer_id' => 'Transfer ID',
            'status_grouper' => 'Status Grouper',
            'grouper_code' => 'Grouper Code',
            'visit_id_klaim' => 'Visit Id Klaim',
            'unit_layanan' => 'Unit Layanan',
            'sep_tgl'=>'tgl sep',
            'list_obat'=>'list obat',
            'krs'=>'KRS',
            'tagihan_pelayanan'=>'TagihanPelayanan'
        ];
    }
//    public function getSurety(){
//        return $this->hasOne(Surety::className(), ['surety_id' => 'surety_id']);
//    }
}
