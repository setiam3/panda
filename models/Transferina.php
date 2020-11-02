<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yanmed.v_transfer_ina".
 *
 * @property int|null $visit_id
 * @property string|null $visit_date
 * @property int|null $px_id
 * @property string|null $px_norm
 * @property string|null $px_noktp
 * @property string|null $px_name
 * @property string|null $px_sex
 * @property string|null $px_address
 * @property int|null $surety_id
 * @property string|null $surety_name
 * @property int|null $visit_status
 * @property string|null $sep_no
 * @property string|null $pxsurety_no
 * @property string|null $visit_end_date
 * @property string|null $ruang_rawat_px
 * @property string|null $jns_layanan
 * @property int|null $class_id
 * @property int|null $visit_end_cause_id
 * @property string|null $kelas_pelayanan
 * @property string|null $diagnosa_px
 * @property string|null $tindakan_px
 * @property string|null $billing_inacbg
 * @property string|null $visit_end_doctor_name
 * @property int|null $klb_id
 * @property string|null $klb_name
 * @property int|null $transfer_id
 * @property string|null $status_grouper
 * @property string|null $grouper_code
 * @property int|null $visit_id_klaim
 * @property string|null $unit_layanan
 * @property string|null $hasil_penunjang
 */
class Transferina extends \yii\db\ActiveRecord
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
            [['visit_date', 'visit_end_date', 'ruang_rawat_px', 'kelas_pelayanan', 'billing_inacbg', 'unit_layanan', 'hasil_penunjang'], 'safe'],
            [['px_noktp', 'px_address', 'jns_layanan', 'diagnosa_px', 'tindakan_px', 'visit_end_doctor_name', 'klb_name', 'status_grouper', 'grouper_code'], 'string'],
            [['px_norm'], 'string', 'max' => 10],
            [['px_name', 'surety_name'], 'string', 'max' => 50],
            [['px_sex'], 'string', 'max' => 1],
            [['sep_no'], 'string', 'max' => 100],
            [['pxsurety_no'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'visit_id' => 'Visit ID',
            'visit_date' => 'Visit Date',
            'px_id' => 'Px ID',
            'px_norm' => 'Px Norm',
            'px_noktp' => 'Px Noktp',
            'px_name' => 'Px Name',
            'px_sex' => 'Px Sex',
            'px_address' => 'Px Address',
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
            'hasil_penunjang' => 'Hasil Penunjang',
        ];
    }
}
