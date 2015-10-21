<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rate".
 *
 * @property integer $id
 * @property integer $price
 * @property string $name
 * @property integer $speed
 */
class Rate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'speed'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Price',
            'name' => 'Name',
            'speed' => 'Speed',
        ];
    }
}
