<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yanmed.visit".
 *
 * @property int $visit_id
 * @property string|null $reg_code
 * @property int|null $surety_id
 * @property int|null $ag_id
 * @property int|null $px_id
 * @property int|null $visit_counter
 * @property string $visit_date
 * @property string|null $visit_type
 * @property int|null $visit_age_d
 * @property int|null $visit_age_m
 * @property int|null $visit_age_y
 * @property string|null $visit_finish
 * @property int|null $reff_id asal rujukan
 * @property string|null $visit_desc catatan kunjungan
 * @property string|null $px_address Alamat domisili pasien
 * @property int|null $par_id user petugas loket
 * @property string|null $reg_no kolom untuk nomer pendaftaran
 * @property bool|null $sprint_statmedis
 * @property string|null $pxsurety_status
 * @property int|null $user_id
 * @property string|null $user_act
 * @property string|null $user_ip
 * @property string|null $user_mac
 * @property string|null $pxsurety_no
 * @property int|null $id_kesatuan
 * @property string|null $visit_end_date
 * @property int|null $visit_end_cause_id
 * @property int|null $visit_end_condition_id
 * @property int|null $visit_end_doctor_id
 * @property int|null $visit_end_service_id
 * @property int|null $visit_end_user_id
 * @property string|null $visit_case_end
 * @property string|null $visit_end_emergency_status
 * @property string|null $visit_end_igd_condition
 * @property string|null $nik
 * @property string|null $rs_rujukan
 * @property int|null $shift shift pada saat daftar
 * @property bool|null $verificated
 * @property int|null $verificator_id
 * @property string|null $verified_at
 * @property int|null $visit_status 60 : REGISTRASI RS, 55 : TANPA PEMBAYARAN RETRIBUSI, 50 : PEMBAYARAN RETRIBUSI, 40 : ANTRIAN POLI, 35 : BATAL, 30/20 : DILAYANI, 10 : PULANG
 * @property int|null $perujuk_id Referensi ke detil id perujuk, sesuai filter asal kunjungannya
 * @property int|null $transfer_id
 * @property string|null $no_suratrujukan nomor surat rujukan
 * @property string|null $tglakhir_suratrujukan tanggal berakhir surat rujukan
 * @property int|null $pencatat_suratrujukan petugas entry surat rujukan
 * @property string|null $waktucatat_suratrujukan waktu entry surat rujukan
 * @property bool|null $from_pm
 * @property string|null $sep_tgl
 * @property string|null $sep_faskes_asal
 * @property string|null $sep_icdcode_diagnosa_awal
 * @property string|null $sep_no
 * @property string|null $sep_catatan
 * @property string|null $sep_pekerjaan_peserta
 * @property string|null $sep_cob
 * @property int|null $visitnext_id realisasi dari table penjadwalan next visit
 * @property string|null $rfid_gelang
 * @property int|null $sep_print_counter
 * @property bool|null $is_merger
 * @property int|null $user_merger
 * @property string|null $act_merger
 * @property int|null $label_printed
 * @property int|null $tracer_printed
 * @property int|null $loket_printed
 * @property string|null $last_srv_status
 * @property string|null $tgl_meninggal
 * @property string|null $last_edit_krs buat simpan waktu terakhir edit krs 
 * @property string|null $akun akun android
 * @property string|null $status_pendaftaran
 * @property string|null $modifieddate
 * @property int|null $biaya_rs
 * @property bool|null $required_claim
 * @property int|null $klb_id
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yanmed.visit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surety_id', 'ag_id', 'px_id', 'visit_counter', 'visit_age_d', 'visit_age_m', 'visit_age_y', 'reff_id', 'par_id', 'user_id', 'id_kesatuan', 'visit_end_cause_id', 'visit_end_condition_id', 'visit_end_doctor_id', 'visit_end_service_id', 'visit_end_user_id', 'shift', 'verificator_id', 'visit_status', 'perujuk_id', 'transfer_id', 'pencatat_suratrujukan', 'visitnext_id', 'sep_print_counter', 'user_merger', 'label_printed', 'tracer_printed', 'loket_printed', 'biaya_rs', 'klb_id'], 'default', 'value' => null],
            [['surety_id', 'ag_id', 'px_id', 'visit_counter', 'visit_age_d', 'visit_age_m', 'visit_age_y', 'reff_id', 'par_id', 'user_id', 'id_kesatuan', 'visit_end_cause_id', 'visit_end_condition_id', 'visit_end_doctor_id', 'visit_end_service_id', 'visit_end_user_id', 'shift', 'verificator_id', 'visit_status', 'perujuk_id', 'transfer_id', 'pencatat_suratrujukan', 'visitnext_id', 'sep_print_counter', 'user_merger', 'label_printed', 'tracer_printed', 'loket_printed', 'biaya_rs', 'klb_id'], 'integer'],
            [['visit_date'], 'required'],
            [['visit_date', 'visit_finish', 'user_act', 'visit_end_date', 'verified_at', 'tglakhir_suratrujukan', 'waktucatat_suratrujukan', 'sep_tgl', 'act_merger', 'tgl_meninggal', 'last_edit_krs', 'modifieddate'], 'safe'],
            [['px_address', 'sep_catatan'], 'string'],
            [['sprint_statmedis', 'verificated', 'from_pm', 'is_merger', 'required_claim'], 'boolean'],
            [['reg_code', 'reg_no', 'pxsurety_status', 'last_srv_status'], 'string', 'max' => 10],
            [['visit_type'], 'string', 'max' => 1],
            [['visit_desc'], 'string', 'max' => 140],
            [['user_ip', 'user_mac', 'pxsurety_no', 'nik', 'no_suratrujukan', 'sep_icdcode_diagnosa_awal', 'rfid_gelang'], 'string', 'max' => 20],
            [['visit_case_end', 'visit_end_emergency_status', 'visit_end_igd_condition', 'rs_rujukan', 'status_pendaftaran'], 'string', 'max' => 255],
            [['sep_faskes_asal'], 'string', 'max' => 25],
            [['sep_no', 'sep_pekerjaan_peserta', 'sep_cob'], 'string', 'max' => 100],
            [['akun'], 'string', 'max' => 16],
            [['perujuk_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminMsPerujuk::className(), 'targetAttribute' => ['perujuk_id' => 'perujuk_id']],
            [['reff_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminMsReff::className(), 'targetAttribute' => ['reff_id' => 'reff_id']],
            [['reg_code'], 'exist', 'skipOnError' => true, 'targetClass' => AdminMsRegion::className(), 'targetAttribute' => ['reg_code' => 'reg_code']],
            [['visit_end_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminMsUser::className(), 'targetAttribute' => ['visit_end_user_id' => 'user_id']],
            [['par_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrEmployee::className(), 'targetAttribute' => ['par_id' => 'employee_id']],
            [['visit_end_doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrEmployee::className(), 'targetAttribute' => ['visit_end_doctor_id' => 'employee_id']],
            [['surety_id'], 'exist', 'skipOnError' => true, 'targetClass' => YanmedMsSurety::className(), 'targetAttribute' => ['surety_id' => 'surety_id']],
            [['visit_end_condition_id'], 'exist', 'skipOnError' => true, 'targetClass' => YanmedOutcondition::className(), 'targetAttribute' => ['visit_end_condition_id' => 'oc_id']],
            [['px_id'], 'exist', 'skipOnError' => true, 'targetClass' => YanmedPatient::className(), 'targetAttribute' => ['px_id' => 'px_id']],
            [['visit_end_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => YanmedServices::className(), 'targetAttribute' => ['visit_end_service_id' => 'srv_id']],
            [['transfer_id'], 'exist', 'skipOnError' => true, 'targetClass' => YanmedTransferInacbg::className(), 'targetAttribute' => ['transfer_id' => 'transfer_id']],
            [['visitnext_id'], 'exist', 'skipOnError' => true, 'targetClass' => YanmedVisitNextSchedule::className(), 'targetAttribute' => ['visitnext_id' => 'visitnext_id']],
            [['visit_end_cause_id'], 'exist', 'skipOnError' => true, 'targetClass' => YanmedWayout::className(), 'targetAttribute' => ['visit_end_cause_id' => 'wo_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'visit_id' => 'Visit ID',
            'reg_code' => 'Reg Code',
            'surety_id' => 'Surety ID',
            'ag_id' => 'Ag ID',
            'px_id' => 'Px ID',
            'visit_counter' => 'Visit Counter',
            'visit_date' => 'Visit Date',
            'visit_type' => 'Visit Type',
            'visit_age_d' => 'Visit Age D',
            'visit_age_m' => 'Visit Age M',
            'visit_age_y' => 'Visit Age Y',
            'visit_finish' => 'Visit Finish',
            'reff_id' => 'Reff ID',
            'visit_desc' => 'Visit Desc',
            'px_address' => 'Px Address',
            'par_id' => 'Par ID',
            'reg_no' => 'Reg No',
            'sprint_statmedis' => 'Sprint Statmedis',
            'pxsurety_status' => 'Pxsurety Status',
            'user_id' => 'User ID',
            'user_act' => 'User Act',
            'user_ip' => 'User Ip',
            'user_mac' => 'User Mac',
            'pxsurety_no' => 'Pxsurety No',
            'id_kesatuan' => 'Id Kesatuan',
            'visit_end_date' => 'Visit End Date',
            'visit_end_cause_id' => 'Visit End Cause ID',
            'visit_end_condition_id' => 'Visit End Condition ID',
            'visit_end_doctor_id' => 'Visit End Doctor ID',
            'visit_end_service_id' => 'Visit End Service ID',
            'visit_end_user_id' => 'Visit End User ID',
            'visit_case_end' => 'Visit Case End',
            'visit_end_emergency_status' => 'Visit End Emergency Status',
            'visit_end_igd_condition' => 'Visit End Igd Condition',
            'nik' => 'Nik',
            'rs_rujukan' => 'Rs Rujukan',
            'shift' => 'Shift',
            'verificated' => 'Verificated',
            'verificator_id' => 'Verificator ID',
            'verified_at' => 'Verified At',
            'visit_status' => 'Visit Status',
            'perujuk_id' => 'Perujuk ID',
            'transfer_id' => 'Transfer ID',
            'no_suratrujukan' => 'No Suratrujukan',
            'tglakhir_suratrujukan' => 'Tglakhir Suratrujukan',
            'pencatat_suratrujukan' => 'Pencatat Suratrujukan',
            'waktucatat_suratrujukan' => 'Waktucatat Suratrujukan',
            'from_pm' => 'From Pm',
            'sep_tgl' => 'Sep Tgl',
            'sep_faskes_asal' => 'Sep Faskes Asal',
            'sep_icdcode_diagnosa_awal' => 'Sep Icdcode Diagnosa Awal',
            'sep_no' => 'Sep No',
            'sep_catatan' => 'Sep Catatan',
            'sep_pekerjaan_peserta' => 'Sep Pekerjaan Peserta',
            'sep_cob' => 'Sep Cob',
            'visitnext_id' => 'Visitnext ID',
            'rfid_gelang' => 'Rfid Gelang',
            'sep_print_counter' => 'Sep Print Counter',
            'is_merger' => 'Is Merger',
            'user_merger' => 'User Merger',
            'act_merger' => 'Act Merger',
            'label_printed' => 'Label Printed',
            'tracer_printed' => 'Tracer Printed',
            'loket_printed' => 'Loket Printed',
            'last_srv_status' => 'Last Srv Status',
            'tgl_meninggal' => 'Tgl Meninggal',
            'last_edit_krs' => 'Last Edit Krs',
            'akun' => 'Akun',
            'status_pendaftaran' => 'Status Pendaftaran',
            'modifieddate' => 'Modifieddate',
            'biaya_rs' => 'Biaya Rs',
            'required_claim' => 'Required Claim',
            'klb_id' => 'Klb ID',
        ];
    }
}
