<?php

namespace frontend\controllers;

use frontend\models\Task;
use Yii;
use frontend\models\Solution;
use frontend\models\SolutionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SolutionController implements the CRUD actions for Solution model.
 */
class SolutionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Solution models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolutionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Solution model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->generateTestResultArray();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Solution model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($task_id = 1)
    {
        $model = new Solution();
        $task = Task::findOne($task_id);

        if ($model->load(Yii::$app->request->post())) {
            $model->test_result = "{}";
            $model->result = 0;

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->solution_id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
            'task' => $task
        ]);
    }

    /**
     * Deletes an existing Solution model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['my']);
    }

    public function actionMy()
    {
        $searchModel = new SolutionSearch();
        $params = Yii::$app->request->queryParams;
        $params['SolutionSearch']['user_id'] = Yii::$app->user->getId();
        $dataProvider = $searchModel->search($params);

        return $this->render('my', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Solution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Solution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Solution::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
