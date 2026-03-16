<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * VerifyFOrm is the model behind the verify form.
 */
class VerifyForm extends Model
{
    public $email;
    public $verificationCode;

    public function rules()
    {
        return [
            [['email', 'verificationCode'], 'required'],
        ];
    }

    public function verify()
    {
        $user = User::findByEmail($this->email);
        if ($user == null || $user->isVerified()) {
            return false;
        }

        if ($user->verificationCode == $this->verificationCode) {
            $user->verificationCode = null;
            $user->save();
            return true;
        }

        return false;
    }
}
