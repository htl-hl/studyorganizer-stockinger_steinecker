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

    public static function doneIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                </svg>';
    }

    public static function updateIcon()
    {
      return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>';
    }


}
