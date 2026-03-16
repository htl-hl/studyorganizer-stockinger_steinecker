<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var $dropdown */
/** @var $teacherDropdown  */

$this->title = Yii::t('app', 'Create Task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dropdown' => $dropdown,
        'teacherDropdown' => $teacherDropdown
    ]) ?>

</div>
