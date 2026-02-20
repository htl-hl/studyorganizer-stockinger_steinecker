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
                $date_formatted = date('d.m H:i',$time);
                $now = time();
                $remaining = max($time - $now, 0);
                $remaining_days = $remaining / 86400;

                $colours = array();
                $colours[14] = "primary";
                $colours[7] = "warning";
                $colours[1] = "danger";

                $colour = "secondary";

                foreach ($colours as $threshold => $colour_option) {
                    if ($threshold >= $remaining_days) {
                        $colour = $colour_option;
                    }
                }
            ?>

            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="card h-100">
                    <div class="card-header bg-<?= $colour ?>"></div>
                    <div class="card-header">
                        <h5><?= $task->taskTitle ?><button class="btn float-end"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                </svg></button><button class="btn float-end"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg></button></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $task->taskSubject->subjectName ?> | bis <?= $date_formatted ?></h6>
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
