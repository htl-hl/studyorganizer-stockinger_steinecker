<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\VerifyForm $verModel */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Verify';
?>
<div class="site-verify">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please enter your six digit verification code</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'verify-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($verModel, 'verificationCode')->textInput(['autofocus' => true]) ?>

            <?= $form->field($verModel, 'email')->textInput() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Verify', ['class' => 'btn btn-primary', 'name' => 'verify-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>