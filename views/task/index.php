<?php

use app\models\Task;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var Task $tasks */

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Task'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'taskId',
            'taskTitle',
            'taskDescription:ntext',
            'taskDueDate',
            'taskOwnerId',
            //'taskSubjectId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'taskId' => $model->taskId]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <div class="row">
        <?php foreach ($tasks as $task): ?>

            <?php
                $time = strtotime($task->taskDueDate);
                $dateFormatted = date('d.m H:i',$time);
            ?>

            <div class="col-3 p-1">
                <div class="card">
                    <div class="card-header">
                        <h5><?= $task->taskTitle ?><button class="btn float-end"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                </svg></button></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $task->taskSubject->subjectName ?> | bis <?= $dateFormatted ?></h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?= $task->taskDescription ?>
                        </p>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

</div>
