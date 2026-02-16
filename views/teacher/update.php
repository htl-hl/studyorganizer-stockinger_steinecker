<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Teacher $model */

$this->title = Yii::t('app', 'Update Teacher: {name}', [
    'name' => $model->teacherId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Teachers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->teacherId, 'url' => ['view', 'teacherId' => $model->teacherId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
