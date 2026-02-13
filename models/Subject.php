<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SUBJECT".
 *
 * @property int $subjectId
 * @property string $subjectName
 *
 * @property Task[] $tasks
 */
class Subject extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SUBJECT';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subjectName'], 'required'],
            [['subjectName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subjectId' => Yii::t('app', 'Subject ID'),
            'subjectName' => Yii::t('app', 'Subject Name'),
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TaskQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['taskSubjectId' => 'subjectId']);
    }

    /**
     * {@inheritdoc}
     * @return SUBJECTQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SUBJECTQuery(get_called_class());
    }

}
