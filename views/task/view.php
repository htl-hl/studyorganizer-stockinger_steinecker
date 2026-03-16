<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Task $model */

$this->title = $model->taskTitle;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">
    <p>
    </p>

    <?php
        $isDone = (bool)$model->isDone;
        $dueDate = Yii::$app->formatter->asDate($model->taskDueDate, 'php:d.m.Y');
        $teacherName = $model->taskTeacher ? $model->taskTeacher->teacherName : '-';
        $subjectName = $model->taskSubject ? $model->taskSubject->subjectName : '-';
        $ownerName = $model->taskOwner ? ($model->taskOwner->username ?? $model->taskOwner->email ?? '-') : '-';
    ?>

    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0"><?= Html::encode($model->taskTitle) ?></h4>
                <div class="text-muted small">Fällig am <?= Html::encode($dueDate) ?></div>
            </div>
            <span class="badge bg-<?= $isDone ? 'success' : 'warning' ?> text-uppercase">
                <?= $isDone ? 'Erledigt' : 'Offen' ?>
            </span>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4 text-center">
                    <div class="text-muted small">Fach</div>
                    <div class="fw-semibold"><?= Html::encode($subjectName) ?></div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="text-muted small">Lehrkraft</div>
                    <div class="fw-semibold"><?= Html::encode($teacherName) ?></div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="text-muted small">Besitzer</div>
                    <div class="fw-semibold"><?= Html::encode($ownerName) ?></div>
                </div>
            </div>
            <div class="mb-3">
                <br>
                <div class="text-muted small">Beschreibung</div>
                <div class="border rounded p-3 bg-light">
                    <?= nl2br(Html::encode($model->taskDescription)) ?>
                </div>
            </div>
        </div>
    </div>

    <!--
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'taskId',
            'taskTitle',
            'taskDescription:ntext',
            'taskDueDate',
            'taskOwnerId',
            'taskSubjectId',
        ],
    ]) ?>
    -->

</div>
