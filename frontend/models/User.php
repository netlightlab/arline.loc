<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use common\models\User as CUser;
use yii\web\NotFoundHttpException;

class User extends Model
{
    public $username;
    public $password;
    public $email;
    public $fio;
    public $cars;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['fio', 'trim'],
            ['cars', 'trim'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
        /*return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];*/
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function createUser()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new CUser();
        $user->fio = $this->fio;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->save() ? $user : null;

        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('editor');
        $auth->assign($authorRole, $user->id);

        return $user;
    }


    /**
     * Update user.
     *
     * @return boolean the saved model or null if saving fails
     */
    public function updateUser($id)
    {
        $model = $this::findModel($id);

        $this->username ? $model->username = $this->username : $model->username;
        $this->fio ? $model->fio = $this->fio : $model->fio;
        $this->email ? $model->email = $this->email : $model->email;

        $model->cars = serialize($this->cars);

        if($this->password){
            $model->setPassword($this->password);
        }

        if($model->save()){
            return true;
        }

        return false;
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = CUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public static function getUsers(){
        return CUser::find();
    }
}
