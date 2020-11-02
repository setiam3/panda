<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yanmed.ms_surety".
 *
 * @property int $surety_id
 * @property string|null $surety_code
 * @property string $surety_name
 * @property bool $surety_active
 * @property int|null $own_id link dg farmasi.ms_ownership
 * @property bool|null $is_pm
 * @property string|null $jenis
 */
class Surety extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yanmed.ms_surety';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surety_id', 'surety_name', 'surety_active'], 'required'],
            [['surety_id', 'own_id'], 'default', 'value' => null],
            [['surety_id', 'own_id'], 'integer'],
            [['surety_active', 'is_pm'], 'boolean'],
            [['surety_code'], 'string', 'max' => 10],
            [['surety_name', 'jenis'], 'string', 'max' => 50],
            [['surety_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'surety_id' => 'Surety ID',
            'surety_code' => 'Surety Code',
            'surety_name' => 'Surety Name',
            'surety_active' => 'Surety Active',
            'own_id' => 'Own ID',
            'is_pm' => 'Is Pm',
            'jenis' => 'Jenis',
        ];
    }
}
