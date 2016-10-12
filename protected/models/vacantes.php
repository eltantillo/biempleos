<?php

/**
 * This is the model class for table "vacantes".
 *
 * The followings are the available columns in table 'vacantes':
 * @property string $id
 * @property string $id_empresa
 * @property string $id_localidad
 * @property string $puesto
 * @property integer $sueldo
 * @property string $ofrece
 * @property string $requisitos
 * @property boolean $disponibilidad
 * @property string $fecha_publicacion
 * @property string $fecha_finalizacion
 * @property boolean $activa
 */
class vacantes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vacantes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_empresa, id_localidad, puesto, sueldo, ofrece, requisitos', 'required'),
			array('id_empresa, id_localidad', 'length', 'max'=>10),
			array('puesto', 'length', 'max'=>20),
            array('sueldo', 'numerical', 'integerOnly'=>true),
            array('activa', 'boolean'),
            array('disponibilidad', 'boolean'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_empresa, id_localidad, puesto, sueldo, ofrece, requisitos, disponibilidad, fecha_publicacion', 'safe', 'on'=>'search'),
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
			'lista_aspirantes' => array(self::HAS_MANY, 'ListaAspirantes', 'id_vacante'),
			'id_empresa0' => array(self::BELONGS_TO, 'Empresas', 'id_empresa'),
			'id_localidad0' => array(self::BELONGS_TO, 'Localidades', 'id_localidad'),
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
			'id_localidad' => 'Local',
			'puesto' => 'Puesto',
			'sueldo' => 'Sueldo',
			'ofrece' => 'Ofrece',
			'requisitos' => 'Requisitos',
			'disponibilidad' => 'Disponibilidad',
			'fecha_publicacion' => 'Fecha Publicacion',
            'fecha_finalizacion' => 'Fecha Finalizacion',
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

		$criteria->compare('id_localidad',$this->id_localidad,true);

		$criteria->compare('puesto',$this->puesto,true);

		$criteria->compare('sueldo',$this->sueldo,true);

		$criteria->compare('ofrece',$this->ofrece,true);

		$criteria->compare('requisitos',$this->requisitos,true);

		$criteria->compare('disponibilidad',$this->disponibilidad,true);

		$criteria->compare('fecha_publicacion',$this->fecha_publicacion,true);

		return new CActiveDataProvider('vacantes', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return vacantes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}