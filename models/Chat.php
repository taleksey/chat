<?php

namespace app\models;


use yii\db\ActiveRecord;

/**
 * Model Chat
 *
 * @property integer $id
 * @property string $message
 * @property integer $user_id
 * @property string $created_date
 */
class Chat extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'chat';
    }

    public function rules()
    {
        return [
            ['message', 'required']
        ];
    }

    /**
     * @param string $stringType
     * @return string
     */
    public function getDate($stringType = 'd.m.Y H:i')
    {
        $selectDateTime = new \DateTime($this->created_date);

        return $selectDateTime->format($stringType);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
         return $this->hasOne(User::className(), ['id' => 'user_id'])
             ->one()
         ;
    }


    /**
     * @return array|ActiveRecord[]
     */
    public static function getAllMessages()
    {
        return self::find()
            ->all()
        ;
    }


}
