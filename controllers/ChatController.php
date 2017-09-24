<?php

namespace app\controllers;

use app\models\Chat;
use app\models\User;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\web\ErrorAction;

class ChatController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('You are not allowed to access this page');
                }
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $user = new User();
        $chat = new Chat();
        $createdUsers = User::getAllUsers();
        $createdMessages = Chat::getAllMessages();
        $currentUserId = Yii::$app->user->id;
        return $this->render('index',
            ['user'          => $user,
             'createdUsers'  => $createdUsers,
             'chat'          => $chat,
             'messages'      => $createdMessages,
             'currentUserId' => $currentUserId
            ]
        );
    }

    public function actionCreate()
    {
        $chat = new Chat();
        $request = \Yii::$app->getRequest();

        if ($request->isPost && $request->isAjax && $chat->load(Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $userId = Yii::$app->user->id;
            $chat->user_id = $userId;
            $isSavedChat = $chat->save();
            $user = User::findIdentity($userId);
            $chat->refresh();
            return ['success' => $isSavedChat,
                    'chat'    => [
                        'message'     => $chat->message,
                        'nick'        => $user->nick,
                        'createdTime' => $chat->getDate()
                    ]
            ];
        }

        throw new BadRequestHttpException('Request is not correct.');
    }

    /**
     * @return array
     */
    public function actionValidate()
    {
        $model = new Chat();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        return [];
    }
}
