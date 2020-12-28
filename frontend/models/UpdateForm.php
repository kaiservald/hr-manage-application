<?php


namespace frontend\models;


use frontend\models\FileSystem;

use frontend\models\User;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UpdateForm extends Model
{
    /**
     * @var
     */
    public $id;
    public $first_name;
    public $last_name;
    public $username;

    public function rules()
    {
        return [
            [['id', 'first_name', 'last_name', 'username'], 'required'],
            [['first_name', 'last_name', 'username'], 'string'],
            [['id'], 'integer'],
        ];
    }

    public function loadParams()
    {
        $user = User::findOne($this->id);
        $this->username = $user->username;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
    }

    public function update()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = User::findOne($this->id);

        $user->username = $this->username;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        return $user->save();
    }
}