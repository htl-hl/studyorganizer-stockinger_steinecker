<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TASK".
 *
 * @property int $taskId
 * @property string $taskTitle
 * @property string|null $taskDescription
 * @property string|null $taskDueDate
 * @property int $taskOwnerId
 * @property int $taskSubjectId
 *
 * @property User $taskOwner
 * @property Subject $taskSubject
 */
class Task extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TASK';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taskDescription', 'taskDueDate'], 'default', 'value' => null],
            [['taskTitle', 'taskOwnerId', 'taskSubjectId'], 'required'],
            [['taskDescription'], 'string'],
            [['taskDueDate'], 'safe'],
            [['taskOwnerId', 'taskSubjectId'], 'integer'],
            [['taskTitle'], 'string', 'max' => 255],
            [['taskOwnerId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['taskOwnerId' => 'id']],
            [['taskSubjectId'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['taskSubjectId' => 'subjectId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'taskId' => Yii::t('app', 'Task ID'),
            'taskTitle' => Yii::t('app', 'Task Title'),
            'taskDescription' => Yii::t('app', 'Task Description'),
            'taskDueDate' => Yii::t('app', 'Task Due Date'),
            'taskOwnerId' => Yii::t('app', 'Task Owner ID'),
            'taskSubjectId' => Yii::t('app', 'Task Subject ID'),
        ];
    }

    /**
     * Gets query for [[TaskOwner]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getTaskOwner()
    {
        return $this->hasOne(User::class, ['id' => 'taskOwnerId']);
    }

    /**
     * Gets query for [[TaskSubject]].
     *
     * @return \yii\db\ActiveQuery|SUBJECTQuery
     */
    public function getTaskSubject()
    {
        return $this->hasOne(Subject::class, ['subjectId' => 'taskSubjectId']);
    }

    /**
     * {@inheritdoc}
     * @return TASKQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TASKQuery(get_called_class());
    }

}
