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
		$empresa = usuarios_empresas::model()->findByAttributes(array('usuario'=>$this->username));
		$aspirante = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$this->username));
		
		if ($empresa===null && $aspirante === null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if ($empresa!=null && $empresa->contrasena !== md5($this->password) || $aspirante!=null && $aspirante->contrasena !== md5($this->password)){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else{
			$this->errorCode=self::ERROR_NONE;
			if ($empresa!=null){
				$this->_id = $empresa->id;
	            $this->setState('usuario', $empresa);
	            $this->setState('empresa', empresas::model()->findByPk($empresa->id_empresa));
	            $this->setState('tipo', 'empresa');
			}
			else{
				$this->_id = $aspirante->id;
	            $this->setState('usuario', $aspirante);
	            $this->setState('aspirante', aspirantes::model()->findByPk($aspirante->id_aspirante));
	            $this->setState('tipo', 'aspirante');
			}
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
        
        $user = usuarios_empresas::model()->findByAttributes(array('usuario'=>$identity->username));
        $identity->_id = $user->id;
        $identity->setState('usuario', $user);
        $identity->setState('empresa', empresas::model()->findByPk($user->id_empresa));
        return $identity;
    }
}