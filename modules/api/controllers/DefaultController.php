<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\SignupForm;
use app\models\LoginForm;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'sign-up' => ['POST'],
                    'login' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        return array('info' => 'Flutter Template Project API');
    }

    public function actionCheckAccessMain($headers) {
        if ($headers['app_mobile_token'] != 'asfafasfdsajeej89sadfasjfbwasfsagipPajjqwidbQBiadq') {
            throw new ForbiddenHttpException('Application Mobile Token Not Valid');
        }
    }

    public function actionSignUp() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain(yii::$app->request->headers);

        try {
            $signupForm = new SignupForm();
            $signupForm->attributes = \yii::$app->request->post();
            if ($signupForm->validate()) {
                $user = $signupForm->signup();
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success signup', 'data' => $user);
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed signup', 'data' => $signupForm->getErrors());
            }
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }
    
    public function actionLogin()
    {
        
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain(yii::$app->request->headers);
        
        
        try {
            $model = new LoginForm(['scenario' => 'apiLoginScenario']);
            $model->attributes = \yii::$app->request->post();
            if ($model->validate()) {
                $user = $model->apiLogin();
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success login', 'data' => $user);
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed login', 'data' => $model->getErrors());
            }
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

}
