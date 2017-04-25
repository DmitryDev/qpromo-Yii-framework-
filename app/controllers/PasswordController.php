<?php

class PasswordController extends Controller
{          
    public function actionChange($token)
    {                
     
        if (isset($token))
            $token = Token::model()->findByAttributes(array('value'=> $token));
        else if (isset($_POST['token']))
            $token = Token::model()->findByAttributes(array('value'=> $_POST['token']));
        else
            $token = NULL;
                                      
        if ($token === NULL || $token->expired()) {            
            if ($token !== NULL && $token->expired()) $token->delete ();
            throw new CHttpException(403,'Password change link is wrong or expired');
        }
                
        $email = $token->tag;        
        $user = User::model()->findByAttributes(array('email'=>$email));        
                
        if ($user === NULL)
            throw new CHttpException(404,'Account with the email ' . $email.' was not found');
                
        $uc = UserCredentials::model()->findByAttributes(array('user_id'=>$user->id, 'type_id'=>  UserCredentials::CREDENTIALS_PASSWORD));
        
        if ($uc === NULL)
        {            
            $uc = new UserCredentials;
            $uc->user_id = $user->id;
            $uc->type_id = UserCredentials::CREDENTIALS_PASSWORD;
            $uc->password = md5(time());           
            $uc->save(false);
        }                                  
        
        // collect user input data
        if(isset($_POST['UserCredentials']))
        {
            $form = Yii::app()->request->getPost('UserCredentials');            
            $uc->password = md5($form['password']);
            $uc->password_repeat = md5($form['password_repeat']);
            
            // validate user input and redirect to the previous page if valid            
            $uc->validate();
            if ($form['password'] !== $form['password_repeat']) $uc->addError('password_repeat', 'Password must be repeated exactly.');
            if (trim($form['password']) ==='') $uc->addError('password', 'Password can not be empty.');
            
            if(!$uc->hasErrors()) {                                            
                $uc->save(false);
                $token->delete();
                Token::removeExpired();                
                Yii::app()->mailer->passwordChanged($user->email);
                Yii::app()->user->setFlash('notice', "Your password has been changed successfuly!");
                $this->redirect(Yii::app()->createUrl('site/index'));
            }
        }
 
        $this->pageTitle=Yii::app()->name . ' - Change Password';
        $this->render('change', array('token'=>$token->value, 'user'=>$user, 'model'=>$uc));
    }        
    
    public function actionRecovery() {                                        
        if (!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl);
        
        $model = new PwdRecoveryForm;
                
        // if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='pwd-recovery-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
            
		// collect user input data
		if(isset($_POST['PwdRecoveryForm'])) {
			$model->attributes=$_POST['PwdRecoveryForm'];

			if ($model->validate()) {                
                Yii::app()->mailer->forgotPassword($model->email);
                Yii::app()->user->setFlash('notice', "Your request has been sent! Check your e-mail for password recovery instructions.");
                $this->redirect($this->createUrl('site/index'));
            }            
		}
        
		// display the recovery form
        $this->pageTitle=Yii::app()->name . ' - Password Recovery';    
		$this->render('recovery',array('model'=>$model));        
    }
}

?>
