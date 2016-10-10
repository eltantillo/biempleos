<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = usuarios_empresas::model()->findByAttributes(array('usuario'=>$this->username));
		
		if ($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if ($user->contrasena !== md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
			$this->_id = $user->id;
            $this->setState('usuario', $user);
            $this->setState('empresa', empresas::model()->findByPk($user->id_empresa));
		}
		return !$this->errorCode;
	}

	public function getId(){
		return $this->_id;
	}
    
    public static function createAuthenticatedIdentity($username)
    {
        $identity=new self($username,'');
        $identity->errorCode=self::ERROR_NONE;
        return $identity;
    }
}