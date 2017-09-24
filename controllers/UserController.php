<?php

namespace app\controllers;

use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class UserController extends Controller
{
    private $rememberUser = true;
    private $rememberTime = 3600 * 24 * 30;

    /**
     * Create User and login him
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionCreate()
    {
        $postUser = Yii::$app->request->post('User');

        if (empty($postUser['nick'])) {
            throw new BadRequestHttpException('Nick is empty.');
        }

        $nick = $postUser['nick'];

        $user = User::findUserByNick($nick);

        if (null === $user) {
            $model = new User();
            $request = \Yii::$app->getRequest();
            if ($request->isPost && $request->isAjax && $model->load(Yii::$app->request->post())) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                $isSavedUser = $model->save();
                Yii::$app->user->login($model, $this->rememberUser ? $this->rememberTime : 0);
                return ['success' => $isSavedUser, 'create' => true, 'user' => ['nick' => $model->nick, 'city' => (string)$model->city, 'id' => $model->id]];
            }
        } else {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            \Yii::$app->user->login($user, $this->rememberUser ? $this->rememberTime : 0);
            return ['success' => true, 'create' => false, 'user' => ['nick' => $user->nick, 'city' => (string)$user->city, 'id' => $user->id]];
        }

        throw new BadRequestHttpException('Request is not correct.');
    }

    /**
     * @return array
     */
    public function actionValidate()
    {
        $model = new User();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        return [];
    }
}