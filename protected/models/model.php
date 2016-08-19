<?php

/**
 * This is the model class for table "usuarios_aspirantes".
 *
 * The followings are the available columns in table 'usuarios_aspirantes':
 * @property string $id
 * @property string $id_aspirante
 * @property string $correo
 * @property string $contrasena
 * @property string $gcmKey
 */
class model extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios_aspirantes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_aspirante, correo, contrasena, gcmKey', 'required'),
			array('id_aspirante', 'length', 'max'=>10),
			array('correo', 'length', 'max'=>254),
			array('contrasena', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_aspirante, correo, contrasena, gcmKey', 'safe', 'on'=>'search'),
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
			'id_aspirante0' => array(self::BELONGS_TO, 'Aspirantes', 'id_aspirante'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'id_aspirante' => 'Id Aspirante',
			'correo' => 'Correo',
			'contrasena' => 'Contrasena',
			'gcmKey' => 'Gcm Key',
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

		$criteria->compare('id_aspirante',$this->id_aspirante,true);

		$criteria->compare('correo',$this->correo,true);

		$criteria->compare('contrasena',$this->contrasena,true);

		$criteria->compare('gcmKey',$this->gcmKey,true);

		return new CActiveDataProvider('model', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return model the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}