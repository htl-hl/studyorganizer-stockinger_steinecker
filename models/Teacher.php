<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TEACHER".
 *
 * @property int $teacherId
 * @property string $teacherName
 * @property int $active
 */
class Teacher extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TEACHER';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacherName', 'active'], 'required'],
            [['active'], 'integer'],
            [['teacherName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacherId' => Yii::t('app', 'Teacher ID'),
            'teacherName' => Yii::t('app', 'Teacher Name'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TEACHERQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TEACHERQuery(get_called_class());
    }

}
