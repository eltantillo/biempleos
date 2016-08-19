<?php

/**
 * This is the model class for table "empresas".
 *
 * The followings are the available columns in table 'empresas':
 * @property string $id
 * @property string $nombre
 * @property string $activa
 */
class empresas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required'),
			array('nombre', 'length', 'max'=>64),
			array('activa', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, activa', 'safe', 'on'=>'search'),
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
			'localidades' => array(self::HAS_MANY, 'Localidades', 'id_empresa'),
			'usuarios_empresases' => array(self::HAS_MANY, 'UsuariosEmpresas', 'id_empresa'),
			'vacantes' => array(self::HAS_MANY, 'Vacantes', 'id_empresa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'nombre' => 'Nombre de la Empresa',
			'activa' => 'Activa',
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

		$criteria->compare('nombre',$this->nombre,true);

		$criteria->compare('activa',$this->activa,true);

		return new CActiveDataProvider('empresas', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return empresas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
