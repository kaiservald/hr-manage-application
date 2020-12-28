<?php


namespace frontend\models;


use frontend\models\FileSystem;
use frontend\models\User;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UpdateImageForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $newImageName;
    public $oldImageName;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function updateImage($id)
    {
        if (!$this->validate()) {
            return null;
        }
        $user = User::findOne($id);
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        $this->setNewImageName();
        if ($this->upload()) {
            $this->oldImageName = $user->image;
            $user->image = $this->newImageName;
            if ($user->save()) {
                FileSystem::deleteFile($this->getFolder() . $this->oldImageName);
                return true;
            } else {
                FileSystem::deleteFile($this->getFolder() . $this->newImageName);
                return null;
            }
        }
    }

    public function setNewImageName()
    {
        $this->newImageName = Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
    }

    public function getFolder()
    {
        return Yii::getAlias("@frontend") . '/web/images/user/';
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs($this->getFolder() . $this->newImageName);
            return true;
        } else {
            return false;
        }
    }
}