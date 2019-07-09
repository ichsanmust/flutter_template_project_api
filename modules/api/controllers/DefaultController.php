<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\ChangePassword;
use app\models\MobileSession;
use app\models\Student;
use app\models\StudentSearch;

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
                    'check-session' => ['GET'],
                    'logout' => ['POST'],
                    'change-password' => ['POST'],
                    'list-student' => ['GET', 'HEAD'],
                    'update-student' => ['PUT', 'PATCH'],
                    'delete-student' => ['DELETE'],
                    'view-student' => ['GET', 'HEAD'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        return array('info' => 'Flutter Template Project API');
    }

    private function getApplicationMobileToken() {
        return 'asfafasfdsajeej89sadfasjfbwasfsagipPajjqwidbQBiadq';
    }

    public function actionCheckAccessMain($headers) {
        if ($headers['app_mobile_token'] != $this->getApplicationMobileToken()) {
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

    public function actionLogin() {

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
    }

    public function actionLogout() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain(yii::$app->request->headers);


        try {
            $postData = \yii::$app->request->post();
            $auth_key = (isset($postData['auth_key'])) ? $postData['auth_key'] : '';
            if ($auth_key != '') {
                $this->deleteSessionMobile($auth_key);
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success logout', 'data' => array());
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed logout', 'data' => array());
            }
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    private function deleteSessionMobile($auth_key) {
        MobileSession::updateAll(['status' => 0], ['=', 'auth_key', $auth_key]);
    }

    public function actionChangePassword() {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain(yii::$app->request->headers);


        try {
            $model = new ChangePassword(['scenario' => 'apiChangePasswordScenario']);
            $model->attributes = \yii::$app->request->post();
            if ($model->validate()) {
                $user = $model->changePassword();
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success change password', 'data' => $user);
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed change password', 'data' => $model->getErrors());
            }
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionCheckSession() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $headers = yii::$app->request->headers;
        $this->actionCheckAccessMain($headers);
        $user_mobile_token = $headers['user_mobile_token'];
        $session = MobileSession::find()->select([
                    "auth_key"
                ])
                ->where("auth_key = '" . $user_mobile_token . "' AND status = 1 AND valid_date_time >= NOW()")
                ->asArray()
                ->one();
        try {
            if ($session) {
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'User Token Valid', 'data' => array());
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'User Mobile Token Not Validd', 'data' => array());
            }
        } catch (Exception $e) {
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionCheckAccessRequest($headers) {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain($headers);

        $user_mobile_token = $headers['user_mobile_token'];
        $session = MobileSession::find()->select([
                    "auth_key"
                ])
                ->where("auth_key = '" . $user_mobile_token . "' AND status = 1 AND valid_date_time >= NOW()")
                ->asArray()
                ->one();

        if (!$session) {
            throw new ForbiddenHttpException('User Mobile Token Not Valid, maybe is expired, please login again');
        }
    }

    public function actionListStudent() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessRequest(yii::$app->request->headers);
        $params = Yii::$app->request->queryParams;

        $pageSize = (isset($params['per-page'])) ? $params['per-page'] : 10;
        if ($pageSize == 'true') {
            $pageSize = 10;
        } else if ($pageSize == 'false') {
            $pageSize = (0 == 1); // false
        }

        $page = (isset($params['page'])) ? $params['page'] : 1;

        try {
            $searchModel = new StudentSearch();
            $dataProvider = $searchModel->search($params, $pageSize);
            $total_item = $dataProvider->getTotalCount();

            $countPage = 1;
            if ($total_item > 0 && $pageSize != false) {
                $countPage = ceil($total_item / $pageSize);
            }

            if ($pageSize == false) {
                $dataProvider->pagination = false;
                $countPage = 1;
            }

            if ($page <= $countPage) {
                $data = $dataProvider->getModels();
            } else {
                $data = array();
            }

            $returnArray = array(
                'total_item' => $total_item,
                'count_page' => $countPage,
                'page' => ($pageSize != false ) ? (int) $page : false,
                'per_page' => ($pageSize != false ) ? (int) $pageSize : $pageSize,
                'data' => $data,
            );
            return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success get data', 'data' => $returnArray);
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionCreateStudent() {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessRequest(yii::$app->request->headers);

        try {
            $model = new Student(['scenario' => 'create']);
            $model->attributes = \yii::$app->request->post();
            if ($model->validate()) {
                $model->save();
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success create student', 'data' => $model);
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed create student', 'data' => $model->getErrors());
            }
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionUpdateStudent($id) {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessRequest(yii::$app->request->headers);

        try {
            $model = $this->findModelStudent($id);
            $model->attributes = \yii::$app->request->post();
            if ($model->validate()) {
                $model->save();
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success update student', 'data' => $model);
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed update student', 'data' => $model->getErrors());
            }
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionDeleteStudent($id) {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessRequest(yii::$app->request->headers);

        try {
            $model = $this->findModelStudent($id);
            $model->delete();
            return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success delete student', 'data' => $model);
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionViewStudent($id) {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessRequest(yii::$app->request->headers);

        try {
            $model = $this->findModelStudent($id);
            return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success view student', 'data' => $model);
        } catch (Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    protected function findModelStudent($id) {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Data Student does not exist.');
    }

}
