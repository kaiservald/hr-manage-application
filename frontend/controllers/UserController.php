<?php

namespace frontend\controllers;

use frontend\models\UpdateForm;
use frontend\models\UpdateImageForm;
use frontend\models\FileSystem;
use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'my', 'update', 'update-image'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'my', 'update', 'update-image'],
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionMy()
    {
        $user = $this->findModel(Yii::$app->user->getId());
        return $this->render('view', [
            'model' => $user,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    */

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateImage($id)
    {
        if (!Yii::$app->user->can('updateUser', ['user' => $id])) {
            throw new ForbiddenHttpException("Not enough permissions");
        }
        $model = new UpdateImageForm();
        if (Yii::$app->request->isPost && $model->updateImage($id))  {
            Yii::$app->session->setFlash('success', 'Success! Your image has successfully updated!');
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('update-image', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can('updateUser', ['user' => $id])) {
            throw new ForbiddenHttpException("Not enough permissions");
        }
        $model = new UpdateForm();
        $model->id = $id;
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->update()) {
                Yii::$app->session->setFlash('success', 'Success! Your data has successfully updated!');
                return $this->redirect(['view', 'id' => $id]);
            }
        } else {
            $model->loadParams();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    */
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
