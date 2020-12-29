<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vacancy".
 *
 * @property int $vacancy_id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $created_by
 * @property string $created_at
 * @property int $request_id
 *
 * @property User $createdBy
 * @property Request $request
 */
class Vacancy extends \yii\db\ActiveRecord
{

    public $status_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacancy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'status_id'], 'required'],
            [['description'], 'string'],
            [['status_id'], 'integer'],
            [['title'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vacancy_id' => 'Vacancy ID',
            'title' => 'Заголовок',
            'description' => 'Опис',
            'username' => "Ким створено",
            'created_at' => "Час створення",
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUsername()
    {
        return $this->user->username;
    }
    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['vacancy_id' => 'vacancy_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['status_id' => 'status_id']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_by = Yii::$app->user->getId();
            $this->created_at = Date("Y-m-d h:i:s");
            $this->status_id = 1;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
