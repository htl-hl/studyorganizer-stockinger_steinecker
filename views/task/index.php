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
                        <h5><?= $task->taskTitle ?></h5>
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
