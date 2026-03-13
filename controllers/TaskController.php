<?php

namespace app\controllers;

use app\models\Subject;
use app\models\Task;
use app\models\TaskSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'done' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Redirect to login if user is a guest
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        $tasks = Task::find()
            ->joinWith("taskSubject")
            ->where(['taskOwnerId' => Yii::$app->user->identity->getId()])
            ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tasks' => $tasks
        ]);
    }

    /**
     * Displays a single Task model.
     * @param int $taskId Task ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($taskId)
    {

        return $this->render('view', [
            'model' => $this->findModel($taskId),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Task();
        $subjects = Subject::find()->all();
        $dropdown = ArrayHelper::map($subjects, 'subjectId', "subjectName");

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->taskOwnerId = Yii::$app->user->id;
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'dropdown' => $dropdown,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $taskId Task ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($taskId)
    {
        $model = $this->findModel($taskId);
        if ($model->isDone) {
            throw new ForbiddenHttpException(Yii::t('app', 'Completed tasks cannot be edited.'));
        }
        $subjects = Subject::find()->all();
        $dropdown = ArrayHelper::map($subjects, 'subjectId', "subjectName");

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'taskId' => $model->taskId]);
        }

        return $this->render('update', [
            'model' => $model,
            'dropdown' => $dropdown,
        ]);
    }

    /**
     * Marks an existing Task model as done.
     * If saving is successful, the browser will be redirected to the 'index' page.
     * @param int $taskId Task ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDone($taskId)
    {
        $model = $this->findModel($taskId);
        if (!$model->isDone) {
            $model->isDone = 1;
            $model->save(false, ['isDone']);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $taskId Task ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($taskId)
    {
        if (($model = Task::findOne(['taskId' => $taskId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
