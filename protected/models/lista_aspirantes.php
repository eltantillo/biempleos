<?php

/**
 * This is the model class for table "lista_aspirantes".
 *
 * The followings are the available columns in table 'lista_aspirantes':
 * @property string $id
 * @property string $id_vacante
 * @property string $id_aspirante
 * @property string $cita
 * @property string $fecha_creacion
 */
class lista_aspirantes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lista_aspirantes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cita, fecha_creacion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_vacante, id_aspirante, cita, fecha_creacion', 'safe', 'on'=>'search'),
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
			'id_vacante0' => array(self::BELONGS_TO, 'Vacantes', 'id_vacante'),
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
			'id_vacante' => 'Id Vacante',
			'id_aspirante' => 'Id Aspirante',
			'cita' => 'Cita',
			'fecha_creacion' => 'Fecha Creacion',
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

		$criteria->compare('id_vacante',$this->id_vacante,true);

		$criteria->compare('id_aspirante',$this->id_aspirante,true);

		$criteria->compare('cita',$this->cita,true);

		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider('lista_aspirantes', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return lista_aspirantes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}