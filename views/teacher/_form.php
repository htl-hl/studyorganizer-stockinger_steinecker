<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Teacher $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'teacherName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active', [
        'options' => ['class' => 'form-check form-switch mb-3'],
        'template' => "{input}\n{label}\n{error}",
        'labelOptions' => ['class' => 'form-check-label'],
    ])->checkbox([
        'class' => 'form-check-input',
        'role' => 'switch',
        'value' => 1,
        'uncheck' => 0,
    ], false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
