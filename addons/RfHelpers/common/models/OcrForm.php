<?php


namespace addons\RfHelpers\common\models;


use yii\base\Model;

class OcrForm extends Model
{
    public $image;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'image' => '图片',
        ];
    }
}