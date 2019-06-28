<?php

namespace app\controllers;

use Yii;
//use yii\filters\AccessControl;
/* use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm; */
use yii\rest\ActiveController;
/* use yii\data\ArrayDataProvider;
use yii\httpclient\Client;
use yii\helpers\Json; */

class EmployeeController extends ActiveController 
{
	public $modelClass = 'app\models\Employee\Employee';
}