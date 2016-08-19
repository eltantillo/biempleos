<?php

/**
 * This is the model class for table "localidades".
 *
 * The followings are the available columns in table 'localidades':
 * @property string $id
 * @property string $id_empresa
 * @property string $calle
 * @property string $numero
 * @property string $colonia
 * @property string $codigo_postal
 * @property string $pais
 * @property string $estado
 * @property string $ciudad
 */
class localidades extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'localidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_empresa, calle, numero, colonia, codigo_postal, pais, estado, ciudad', 'required'),
			array('id_empresa, numero, codigo_postal, pais, estado, ciudad', 'length', 'max'=>10),
			array('calle, colonia', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_empresa, calle, numero, colonia, codigo_postal, pais, estado, ciudad', 'safe', 'on'=>'search'),
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
			'vacantes' => array(self::HAS_MANY, 'Vacantes', 'id_localidad'),
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
			'calle' => 'Calle',
			'numero' => 'Numero',
			'colonia' => 'Colonia',
			'codigo_postal' => 'Codigo Postal',
			'pais' => 'Pais',
			'estado' => 'Estado',
			'ciudad' => 'Ciudad',
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

		$criteria->compare('calle',$this->calle,true);

		$criteria->compare('numero',$this->numero,true);

		$criteria->compare('colonia',$this->colonia,true);

		$criteria->compare('codigo_postal',$this->codigo_postal,true);

		$criteria->compare('pais',$this->pais,true);

		$criteria->compare('estado',$this->estado,true);

		$criteria->compare('ciudad',$this->ciudad,true);

		return new CActiveDataProvider('localidades', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return localidades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}