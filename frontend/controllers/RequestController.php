<?php

namespace frontend\controllers;

use frontend\models\FileSystem;
use frontend\models\Vacancy;
use Yii;
use frontend\models\Request;
use frontend\models\RequestSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (!Yii::$app->user->can('viewRequest', ['request' => $model])) {
            throw new ForbiddenHttpException("User can't view this request");
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($vacancy_id = 1)
    {
        $model = new Request();
        $vacancy = Vacancy::findOne($vacancy_id);

        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post())) {
                $model->resumeFile = UploadedFile::getInstance($model, 'resumeFile');
                $model->resume = Yii::$app->security->generateRandomString() . '.' . $model->resumeFile->extension;
                if ($model->save()) {
                    if ($model->uploadResume()) {
                        return $this->redirect(['view', 'id' => $model->request_id]);
                    } else {
                        FileSystem::deleteFile($model->getFolder() . $model->resume);
                    }
                }
            }
        } else {
            $model->loadParams();
        }


        return $this->render('create', [
            'model' => $model,
            'vacancy' => $vacancy
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!Yii::$app->user->can('updateRequest', ['request' => $model])) {
            throw new ForbiddenHttpException("User can't update request");
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->request_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionMy()
    {
        $query = Request::find()->where(['created_by' => Yii::$app->user->getId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('my', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('deleteRequest')) {
            throw new ForbiddenHttpException("Ви не можете видалити даний запит");
        }
        $model = $this->findModel($id);
        FileSystem::deleteFile($model->getFolder() . $model->resume);
        $this->findModel($id)->delete();

        return $this->redirect(['vacancy/view', 'id' => $model->vacancy->vacancy_id]);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
