<?php

namespace frontend\controllers;

use common\models\tables\User;
use common\models\tables\File;
use common\models\tables\Project;
use Yii;
use common\models\tables\Task;
use common\models\search\TaskSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @param integer $project_id
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new Taskearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionIndex()
    {
        $model = new Project();
        $query = $model::find()
            ->joinWith('task')
            ->orWhere(['task.initiator_id' => Yii::$app->user->id])
            ->orWhere(['task.responsible_id' => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5  // как сделать чтобы пагинация работала именно по проектам?
            ],
        ]);

        return $this->render('//site/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @param integer $project_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($project_id, $id)
    {
        $modelFile = new File();
        $modelProject = Project::findOne($project_id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'listView' => false,
            'modelFile' => $modelFile,
            'modelProject' => $modelProject
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $project_id
     * @return mixed
     */
    public function actionCreate($project_id)
    {
        $model = new Task();
        $modelFile = new File();
        $modelProject = Project::findOne($project_id);
        $modelUsers = User::find()->select(['id', 'username'])->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->project_id = $project_id;
            $model->initiator_id = Yii::$app->user->id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            foreach (UploadedFile::getInstances($modelFile, 'file') as $file) {
                $modelFile->file = $file;
                $modelFile->uploadFile($model->id);
                $modelFile = new File();
            }


            return $this->redirect(['view', 'id' => $model->id, 'project_id' => $model->project_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelUsers' => $modelUsers,
            'modelFile' => $modelFile,
            'modelProject' => $modelProject
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $project_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($project_id, $id)
    {
        $model = $this->findModel($id);
        $modelFile = new File();
        $modelUsers = User::find()->select(['id', 'username'])->all();
        $modelProject = Project::findOne($project_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            foreach (UploadedFile::getInstances($modelFile, 'file') as $file) {
                $modelFile->file = $file;
                $modelFile->uploadFile($model->id);
                $modelFile = new File();
            }
            //TODO delete old File
            return $this->redirect(['project_id' => $project_id, 'view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelUsers' => $modelUsers,
            'modelFile' => $modelFile,
            'modelProject' => $modelProject
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        //TODO delete old File
        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
