<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'taskTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taskDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'taskDueDate')->textInput() ?>

    <?= $form->field($model, 'taskOwnerId')->textInput() ?>

    <?= $form->field($model, 'taskSubjectId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
