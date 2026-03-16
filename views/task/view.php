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


    <!--
    <?php

    echo '<pre>'.print_r("Test1",TRUE).'</pre>';

    $sent = Yii::$app->mailer->compose()
            ->setFrom('jonathan.steinecker@proton.me')
            ->setTo("jonathan.steinecker@proton.me")
            ->setSubject('Test Subject')
            ->setTextBody('Test Inhalt')
            ->send();

    echo '<pre>'.print_r($sent,TRUE).'</pre>';

    ?>
    -->


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->isDone): ?>
            <span class="btn btn-secondary btn-sm disabled"><?= Yii::t('app', 'Edit') ?></span>
        <?php else: ?>
            <?= Html::a(Yii::t('app', 'Edit'), ['update', 'taskId' => $model->taskId], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php endif; ?>
        <?php if ($model->isDone): ?>
            <span class="btn btn-success btn-sm disabled"><?= Yii::t('app', 'Done') ?></span>
        <?php else: ?>
            <?= Html::a(Yii::t('app', 'Done'), ['done', 'taskId' => $model->taskId], [
                'class' => 'btn btn-success btn-sm',
                'data' => [
                    'confirm' => Yii::t('app', 'Mark this task as done?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <div class="card">
        <div class="card-body">
            <?= Html::encode($model->taskDescription) ?>
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
