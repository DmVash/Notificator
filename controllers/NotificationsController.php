<?php

namespace app\controllers;

use Yii;
use app\models\SendingNotifications;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ViewedNotifications;
use yii\filters\AccessControl;

/**
 * NotificationsController implements the CRUD actions for SendingBrowserNotifications model.
 */
class NotificationsController extends Controller
{
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'view', 'admin', 'create', 'index', 'view', 'update'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'view'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],

                ],
            ],
        ];
    }

    /**
     * Lists all SendingBrowserNotifications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SendingNotifications::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdmin()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SendingNotifications::find(),
        ]);

        return $this->render('admin', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single SendingBrowserNotifications model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $viewed = new ViewedNotifications();
        if(!$viewed->findOne(['user_id' => Yii::$app->user->id, 'notice_id' => $id])) {
            $viewed->user_id = Yii::$app->user->id;
            $viewed->notice_id = $id;
            $viewed->save();
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SendingBrowserNotifications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SendingNotifications();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->sendNotifications();
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SendingBrowserNotifications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the SendingBrowserNotifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SendingBrowserNotifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SendingNotifications::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
