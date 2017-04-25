<?php
/**
 * UserEntryForm class.
 * UserEntryForm is the data structure for keeping
 * user entry form data. It is used by the 'update' and 'create' actions of 'admin/UserController'.
 */
class UserEntryForm extends CFormModel
{
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $company;
    public $phone;    
    public $is_banned;
    public $is_admin;    
    public $industry_asi;
    public $industry_ppai;
    public $industry_sage;
    public $industry_upic;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, first_name, last_name, email, company', 'required'),
            array('username, company', 'length', 'max'=>32),
            array('phone', 'length', 'max'=>20),
            array('industry_asi, industry_ppai, industry_sage, industry_upic', 'length', 'max'=>10),
            array('first_name, last_name', 'length', 'max'=>45),            
            array('email', 'length', 'max'=>64),                        
            array('email', 'email'), 
            array('email, username', 'field_unique'),             
            array('is_banned', 'in', 'range'=>array('no', 'yes')),                        
            array('is_admin', 'boolean'),
            array('is_admin', 'changable'),                                    
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(            
            'username' => 'User Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'company' => 'Company',
            'phone' => 'Phone',                        
            'is_admin' => 'Administrator permissions',
            'is_banned'=> 'Banned',
            'industry_asi'=>'ASI #',
            'industry_ppai'=>'PPAI #',
            'industry_sage'=>'SAGE #',
            'industry_upic'=>'UPIC #',            
        );
    }

    public function init($id=NULL)
    {        
        if (isset($id)) {
            $user=User::model()->findByPk($id);            

            if($user===null)
                throw new CHttpException(404,'The requested page does not exist.');

            $this->id = $user->id;            
            $this->username = $user->username;
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->company = $user->company;
            $this->phone = $user->phone;            
            $this->is_banned = $user->is_banned;
            $this->is_admin = $this->isAdmin();
            $this->industry_asi = $user->industry_asi;
            $this->industry_ppai = $user->industry_ppai;
            $this->industry_sage = $user->industry_sage;
            $this->industry_upic = $user->industry_upic;
            //$this->birthday = $user->birthday;
            //$this->updated_at = $user->updated_at;
        }
    }

    public function changable($attribute, $params)
    {        
        $curr_user = Yii::app()->user;
        if (!$curr_user->isGuest && $curr_user->id ===$this->id && !$this->is_admin) {
            $this->addError ('is_admin', 'You can not allowed to change admin role for yourself');
            $this->is_admin = true;
        }
    }
    
    public function field_unique($attribute, $params)
    {        
        $user = User::model()->findByAttributes(array($attribute=>$this->$attribute));
        if ($user && $user->id !==$this->id) {
            $this->addError($attribute, "The $attribute already exists.");            
        }
    }
    
    public function assignAdminRole($assign = true) 
    {           
            $auth=Yii::app()->authManager;        
            if ($assign) $auth->assign('admin', $this->id);
            else $auth->revoke('admin', $this->id);                            
    }
    
    public function isAdmin()
    {
        $auth=Yii::app()->authManager;        
        return $auth->checkAccess('admin', $this->id);
    }
    
    public function userExists()
    {
        $user=User::model()->findByPk($this->id);            
        return $user!==null;                
    }
    
    public function save()
    {
        if ($this->validate()) {
            $user = User::model()->findByPk($this->id);                        
            
            if ($user === NULL)
            {
                // create new user
                $user = new User();                
                $user->attributes = $this->attributes;
                
                //$user->birthday = empty($this->birthday) ? NULL : $this->birthday;
                if ($user->save()) {
                    $this->id = $user->id;
                    $this->assignAdminRole($this->is_admin);
                    
                    $userCredentials = new UserCredentials();                                
                    $userCredentials->user_id = $user->id;                
                    $userCredentials->type_id = UserCredentials::CREDENTIALS_PASSWORD;                
                    $userCredentials->password = md5(time()); //md5($this->password);                
                    $userCredentials->save();
                }
            }
            else
            {
                // update existent user                
                $user->attributes = $this->attributes;                
                if ($user->id != Yii::app()->user->id) $user->is_banned = $this->is_banned;
                $user->save();                                
                
                if ($this->is_admin && !$this->isAdmin()) $this->assignAdminRole($this->is_admin);                               
                if (!$this->is_admin && $this->isAdmin()) $this->assignAdminRole(false);      
                
                
            }
            
            return $user;
        }
        
        return false;
    }
}
