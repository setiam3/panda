<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin.ms_unit".
 *
 * @property int $unit_id
 * @property string|null $unit_code
 * @property string $unit_name
 * @property string|null $unit_nickname
 * @property int $unit_level
 * @property bool $unit_islast
 * @property bool $unit_active
 * @property int|null $unit_type
 * @property int|null $unit_inpatient_status
 * @property int|null $unit_support_status
 * @property int $unit_id_parent
 * @property int|null $ut_id Tipe Unit Pelayanan (Loket, Poli, Lab, RI, dll)
 * @property string|null $kodeaskes
 * @property int|null $inap
 * @property bool|null $is_vip
 * @property bool|null $no_retrib
 * @property string|null $group_finder
 * @property bool|null $show_pm
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin.ms_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_name'], 'required'],
            [['unit_level', 'unit_type', 'unit_inpatient_status', 'unit_support_status', 'unit_id_parent', 'ut_id', 'inap'], 'default', 'value' => null],
            [['unit_level', 'unit_type', 'unit_inpatient_status', 'unit_support_status', 'unit_id_parent', 'ut_id', 'inap'], 'integer'],
            [['unit_islast', 'unit_active', 'is_vip', 'no_retrib', 'show_pm'], 'boolean'],
            [['unit_code'], 'string', 'max' => 20],
            [['unit_name'], 'string', 'max' => 50],
            [['unit_nickname'], 'string', 'max' => 35],
            [['kodeaskes'], 'string', 'max' => 3],
            [['group_finder'], 'string', 'max' => 255],
            [['unit_type'], 'exist', 'skipOnError' => true, 'targetClass' => AdminMsCategoryUnit::className(), 'targetAttribute' => ['unit_type' => 'catunit_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unit_id' => 'Unit ID',
            'unit_code' => 'Unit Code',
            'unit_name' => 'Unit Name',
            'unit_nickname' => 'Unit Nickname',
            'unit_level' => 'Unit Level',
            'unit_islast' => 'Unit Islast',
            'unit_active' => 'Unit Active',
            'unit_type' => 'Unit Type',
            'unit_inpatient_status' => 'Unit Inpatient Status',
            'unit_support_status' => 'Unit Support Status',
            'unit_id_parent' => 'Unit Id Parent',
            'ut_id' => 'Ut ID',
            'kodeaskes' => 'Kodeaskes',
            'inap' => 'Inap',
            'is_vip' => 'Is Vip',
            'no_retrib' => 'No Retrib',
            'group_finder' => 'Group Finder',
            'show_pm' => 'Show Pm',
        ];
    }
}
