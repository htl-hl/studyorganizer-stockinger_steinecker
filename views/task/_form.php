<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $dropdown */
/** @var array $teacherDropdown */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'taskTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taskDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'taskDueDate')->widget(DatePicker::class, [
        'language' => 'de',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <?= $form->field($model, 'taskSubjectId')->dropDownList($dropdown) ?>
    <?= $form->field($model, 'taskTeacherId')->dropDownList($teacherDropdown) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
