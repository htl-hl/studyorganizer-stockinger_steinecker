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
    <?php
        $openTasks = [];
        $doneTasks = [];
        foreach ($tasks as $task) {
            if ((bool)$task->isDone) {
                $doneTasks[] = $task;
            } else {
                $openTasks[] = $task;
            }
        }
    ?>

    <div class="row">
        <?php foreach ($openTasks as $task): ?>

            <?php
                $time = strtotime($task->taskDueDate);
                $date_formatted = date('d.m.Y',$time);
                $now = time();
                $remaining = max($time - $now, 0);
                $remaining_days = $remaining / 86400;
                $is_done = (bool)$task->isDone;

                $colours = array();
                $colours[14] = "primary";
                $colours[7] = "warning";
                $colours[1] = "danger";

                $colour = "secondary";

                if (!$is_done) {
                    foreach ($colours as $threshold => $colour_option) {
                        if ($threshold >= $remaining_days) {
                            $colour = $colour_option;
                        }
                    }
                } else {
                    $colour = "success";
                }
            ?>

            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="card h-100<?= $is_done ? ' border-success' : '' ?>">
                    <div class="card-header bg-<?= $colour ?>"></div>
                    <div class="card-header">
                        <h5> <?= Html::a($task->taskTitle, ['task/view', 'taskId' => $task->taskId], ['class' => 'text-decoration-none']) ?>
                            <?php if ($is_done): ?>
                                <span class="btn float-end text-success"><?= Task::doneIcon() ?></span>
                            <?php else: ?>
                                <?= \yii\bootstrap5\Html::a(Task::doneIcon(),
                                        Url::to(["task/done", "taskId" => $task->taskId]),
                                        ["class" => "btn float-end",
                                                "data-method" => "POST",
                                                "data-confirm" => "Mark this task as done?"])
                                ?>
                            <?php endif; ?>
                            <?php if (!$is_done): ?>
                                <?= \yii\bootstrap5\Html::a(Task::updateIcon(),
                                        Url::to(["task/update", "taskId" => $task->taskId]),
                                        ["class" => "btn float-end"])
                                ?>
                            <?php endif; ?>
                            <button class="btn float-end"></button><button class="btn float-end"></button></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= Html::encode($task->taskSubject->subjectName) ?>, <?= Html::encode($task->taskTeacher->teacherName) ?> | bis <?= Html::encode($date_formatted) ?></h6>                    </div>
                    <div class="card-body">
                        <p class="card-text text-truncate">
                            <?= $task->taskDescription ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <hr>
    <h1>Completed Tasks</h1>
    <div class="row">
        <?php foreach ($doneTasks as $task): ?>

            <?php
                $time = strtotime($task->taskDueDate);
                $date_formatted = date('d.m.Y',$time);
                $now = time();
                $remaining = max($time - $now, 0);
                $remaining_days = $remaining / 86400;
                $is_done = (bool)$task->isDone;

                $colours = array();
                $colours[14] = "primary";
                $colours[7] = "warning";
                $colours[1] = "danger";

                $colour = "secondary";

                if (!$is_done) {
                    foreach ($colours as $threshold => $colour_option) {
                        if ($threshold >= $remaining_days) {
                            $colour = $colour_option;
                        }
                    }
                } else {
                    $colour = "success";
                }
            ?>

            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="card h-100<?= $is_done ? ' border-success' : '' ?>">
                    <div class="card-header bg-<?= $colour ?>"></div>
                    <div class="card-header">
                        <h5> <?= Html::a($task->taskTitle, ['task/view', 'taskId' => $task->taskId], ['class' => 'text-decoration-none']) ?>
                            <?php if ($is_done): ?>
                                <span class="btn float-end text-success"><?= Task::doneIcon() ?></span>
                            <?php else: ?>
                                <?= \yii\bootstrap5\Html::a(Task::doneIcon(),
                                        Url::to(["task/done", "taskId" => $task->taskId]),
                                        ["class" => "btn float-end",
                                                "data-method" => "POST",
                                                "data-confirm" => "Mark this task as done?"])
                                ?>
                            <?php endif; ?>
                            <?php if (!$is_done): ?>
                                <?= \yii\bootstrap5\Html::a(Task::updateIcon(),
                                        Url::to(["task/update", "taskId" => $task->taskId]),
                                        ["class" => "btn float-end"])
                                ?>
                            <?php endif; ?>
                            <button class="btn float-end"></button><button class="btn float-end"></button></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= Html::encode($task->taskSubject->subjectName) ?>, <?= Html::encode($task->taskTeacher->teacherName) ?> | bis <?= Html::encode($date_formatted) ?></h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-truncate">
                            <?= $task->taskDescription ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
