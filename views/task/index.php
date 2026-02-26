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
                        <h5><?= $task->taskTitle ?>
                            <?= \yii\bootstrap5\Html::a(Task::doneIcon(),
                                    Url::to(["task/delete", "taskId" => $task->taskId]),
                                    ["class" => "btn float-end",
                                            "data-method" => "POST",
                                            "data-confirm" => "Are you sure?"])
                            ?>
                            <?= \yii\bootstrap5\Html::a(Task::updateIcon(),
                                    Url::to(["task/update", "taskId" => $task->taskId]),
                                    ["class" => "btn float-end"])
                            ?>
                            <button class="btn float-end"></button><button class="btn float-end"></button></h5>
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
