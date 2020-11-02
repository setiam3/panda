<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yanmed.patient".
 *
 * @property int $px_id
 * @property string|null $px_norm Nomor Rekam Medis
 * @property string|null $px_noktp Nomor KTP
 * @property string|null $px_nokk Nomor Kartu Keluarga
 * @property string $px_name Nama Pasien
 * @property string $px_sex Jenis Kelamin, diisi L/P
 * @property string|null $px_birthdate Tanggal Lahir
 * @property string|null $px_bloodgroup Golongan Darah
 * @property string|null $px_father Nama Ortu Laki2
 * @property string|null $px_mother Nama Ortu Pr
 * @property string|null $px_status Status Perkawinan
 * @property string|null $px_couple Nama Pasangan (Suami/Isteri)
 * @property string|null $px_phone Telp/HP
 * @property string|null $px_address Alamat detil pasien (Nama Jalan, No rumah, dst)
 * @property string|null $px_resident desa/kelurahan
 * @property string|null $px_district kecamatan
 * @property string|null $px_city kota / kabupaten
 * @property string|null $px_prov provinsi
 * @property string|null $px_nik Nomor Pegawai (NIK / NIP / NRP)
 * @property int|null $company_id Perusahaan / Kesatuan Militer
 * @property int|null $position_id Jabatan / Pangkat
 * @property int|null $religion_id Agama
 * @property int|null $edu_id Pendidikan terakhir
 * @property int|null $work_id Pekerjaan Sekarang
 * @property string|null $px_reg Waktu registrasi
 * @property int|null $px_regby diregistrasi oleh
 * @property bool|null $px_active
 * @property string|null $px_born Tempat Kelahiran
 * @property string|null $rm_startdate
 * @property int|null $user_id
 * @property string|null $user_act
 * @property string|null $user_ip
 * @property string|null $user_mac
 * @property int|null $brm_status_id
 * @property bool|null $is_complain
 * @property bool|null $is_owner
 * @property bool|null $is_vip
 * @property int|null $id_kesatuan
 * @property string|null $work_lain hanya diisi ketika work_id = LAINNYA 
 * @property string|null $status_visit_khusus KPB : Kejadian Biasa, KPL : Kejadian Pasien Luar
 * @property string|null $status_id_khusus PB : Pasien Biasa, PL : Pasien Luar
 * @property string|null $no_suratrujukan nomor surat rujukan
 * @property string|null $tglakhir_suratrujukan tanggal berakhir surat rujukan
 * @property int|null $pencatat_suratrujukan petugas entry surat rujukan
 * @property string|null $waktucatat_suratrujukan waktu entry surat rujukan
 * @property string|null $px_id_ektp isi dengan ID e-KTP (beda dnegan nomor KTP)
 * @property string|null $px_alias isi dengan nama alias pasien
 * @property int|null $px_type
 * @property string|null $px_norm_old
 * @property int|null $barcode_printed
 * @property string|null $px_rfid
 * @property string|null $dmk_poli
 * @property bool|null $is_data_migrasi
 * @property int|null $lag_id bahasa
 * @property int|null $tribe_id suku
 * @property bool|null $is_sinkron_dukcapil
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yanmed.patient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['px_name', 'px_sex'], 'required'],
            [['px_birthdate', 'px_reg', 'rm_startdate', 'user_act', 'tglakhir_suratrujukan', 'waktucatat_suratrujukan'], 'safe'],
            [['px_address', 'work_lain', 'dmk_poli'], 'string'],
            [['company_id', 'position_id', 'religion_id', 'edu_id', 'work_id', 'px_regby', 'user_id', 'brm_status_id', 'id_kesatuan', 'pencatat_suratrujukan', 'px_type', 'barcode_printed', 'lag_id', 'tribe_id'], 'default', 'value' => null],
            [['company_id', 'position_id', 'religion_id', 'edu_id', 'work_id', 'px_regby', 'user_id', 'brm_status_id', 'id_kesatuan', 'pencatat_suratrujukan', 'px_type', 'barcode_printed', 'lag_id', 'tribe_id'], 'integer'],
            [['px_active', 'is_complain', 'is_owner', 'is_vip', 'is_data_migrasi', 'is_sinkron_dukcapil'], 'boolean'],
            [['px_noktp', 'px_nokk', 'px_nik', 'user_ip', 'user_mac', 'no_suratrujukan', 'px_id_ektp', 'px_rfid'], 'string', 'max' => 20],
            [['px_name', 'px_alias'], 'string', 'max' => 50],
            [['px_sex'], 'string', 'max' => 1],
            [['px_bloodgroup', 'px_prov'], 'string', 'max' => 2],
            [['px_father', 'px_mother', 'px_couple', 'px_born'], 'string', 'max' => 30],
            [['px_status'], 'string', 'max' => 15],
            [['px_phone'], 'string', 'max' => 64],
            [['px_resident', 'px_norm_old'], 'string', 'max' => 10],
            [['px_district'], 'string', 'max' => 6],
            [['px_city'], 'string', 'max' => 4],
            [['status_visit_khusus', 'status_id_khusus'], 'string', 'max' => 5],
            [['brm_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminMsReff::className(), 'targetAttribute' => ['brm_status_id' => 'reff_id']],
            [['px_type'], 'exist', 'skipOnError' => true, 'targetClass' => AdminMsReff::className(), 'targetAttribute' => ['px_type' => 'reff_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'px_id' => 'Px ID',
            'px_norm' => 'Px Norm',
            'px_noktp' => 'Px Noktp',
            'px_nokk' => 'Px Nokk',
            'px_name' => 'Px Name',
            'px_sex' => 'Px Sex',
            'px_birthdate' => 'Px Birthdate',
            'px_bloodgroup' => 'Px Bloodgroup',
            'px_father' => 'Px Father',
            'px_mother' => 'Px Mother',
            'px_status' => 'Px Status',
            'px_couple' => 'Px Couple',
            'px_phone' => 'Px Phone',
            'px_address' => 'Px Address',
            'px_resident' => 'Px Resident',
            'px_district' => 'Px District',
            'px_city' => 'Px City',
            'px_prov' => 'Px Prov',
            'px_nik' => 'Px Nik',
            'company_id' => 'Company ID',
            'position_id' => 'Position ID',
            'religion_id' => 'Religion ID',
            'edu_id' => 'Edu ID',
            'work_id' => 'Work ID',
            'px_reg' => 'Px Reg',
            'px_regby' => 'Px Regby',
            'px_active' => 'Px Active',
            'px_born' => 'Px Born',
            'rm_startdate' => 'Rm Startdate',
            'user_id' => 'User ID',
            'user_act' => 'User Act',
            'user_ip' => 'User Ip',
            'user_mac' => 'User Mac',
            'brm_status_id' => 'Brm Status ID',
            'is_complain' => 'Is Complain',
            'is_owner' => 'Is Owner',
            'is_vip' => 'Is Vip',
            'id_kesatuan' => 'Id Kesatuan',
            'work_lain' => 'Work Lain',
            'status_visit_khusus' => 'Status Visit Khusus',
            'status_id_khusus' => 'Status Id Khusus',
            'no_suratrujukan' => 'No Suratrujukan',
            'tglakhir_suratrujukan' => 'Tglakhir Suratrujukan',
            'pencatat_suratrujukan' => 'Pencatat Suratrujukan',
            'waktucatat_suratrujukan' => 'Waktucatat Suratrujukan',
            'px_id_ektp' => 'Px Id Ektp',
            'px_alias' => 'Px Alias',
            'px_type' => 'Px Type',
            'px_norm_old' => 'Px Norm Old',
            'barcode_printed' => 'Barcode Printed',
            'px_rfid' => 'Px Rfid',
            'dmk_poli' => 'Dmk Poli',
            'is_data_migrasi' => 'Is Data Migrasi',
            'lag_id' => 'Lag ID',
            'tribe_id' => 'Tribe ID',
            'is_sinkron_dukcapil' => 'Is Sinkron Dukcapil',
        ];
    }
}
