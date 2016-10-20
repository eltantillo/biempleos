<?php

/**
 * This is the model class for table "usuarios_empresas".
 *
 * The followings are the available columns in table 'usuarios_empresas':
 * @property string $id
 * @property string $id_empresa
 * @property string $usuario
 * @property string $contrasena
 
 --$usuario=correo
 */
class usuarios_empresas extends CActiveRecord
{
    public $repeatPassword;
    public $newPassword;
    public $oldPassword;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios_empresas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario, contrasena, repeatPassword', 'required', 'on'=>'registrar'),
            array('usuario', 'unique', 'message'=>"Esta cuenta ya fue registrada", 'on'=>'registrar'),
            array('contrasena', 'match', 'allowEmpty'=>false, 'pattern'=>'/^((?!.*\s)(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[a-z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*[a-z])(?=.*[A-Z]).{8,})$/', 'message'=>'Contraseña inválida', 'on'=>'registrar'),
            array('repeatPassword', 'compare', 'compareAttribute'=>'contrasena', 'message'=>"Las contraseñas no coinciden", 'on'=>'registrar'),
            
			array('oldPassword, newPassword, repeatPassword', 'required', 'on'=>'actualizar'),
            array('oldPassword', 'application.components.validator.checkPassword', 'on'=>'actualizar'),
            array('newPassword', 'match', 'allowEmpty'=>false, 'pattern'=>'/^((?!.*\s)(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[a-z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*[a-z])(?=.*[A-Z]).{8,})$/', 'message'=>'Contraseña inválida', 'on'=>'actualizar'),
            array('repeatPassword', 'compare', 'compareAttribute'=>'newPassword', 'message'=>"Las contraseñas no coinciden", 'on'=>'actualizar'),
            
			array('id_empresa', 'length', 'max'=>10),
			array('usuario', 'length', 'max'=>264),
            array('usuario', 'email', 'allowEmpty'=>false, 'pattern'=>'/^[\w.%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/', 'message'=>'Introduce un correo válido'),
            //array('usuario', 'exist', 'allowEmpty'=>false, 'message'=>'Este usuario ya existe. Utiliza otro', 'on'=>'registrar'),
			array('contrasena, oldPassword, repeatPassword, newPassword', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_empresa, usuario, contrasena', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'id_empresa0' => array(self::BELONGS_TO, 'Empresas', 'id_empresa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'id_empresa' => 'Id Empresa',
			'usuario' => 'Correo',
			'contrasena' => 'Contraseña',
            'repeatPassword' => 'Confirmar Contraseña',
            'oldPassword' => 'Contraseña Actual',
            'newPassword' => 'Contraseña Nueva',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);

		$criteria->compare('id_empresa',$this->id_empresa,true);

		$criteria->compare('usuario',$this->usuario,true);

		$criteria->compare('contrasena',$this->contrasena,true);

		return new CActiveDataProvider('usuarios_empresas', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return usuarios_empresas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
