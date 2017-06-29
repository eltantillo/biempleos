<?php

/**
 * This is the model class for table "aspirantes".
 *
 * The followings are the available columns in table 'aspirantes':
 * @property string $id
 * @property string $fecha_actualizacion
 * @property string $foto
 * @property string $nombre
 * @property string $fecha_nacimiento
 * @property integer $sexo
 * @property string $nacionalidad
 * @property double $estatura
 * @property double $peso
 * @property integer $estado_civil
 * @property string $calle
 * @property string $numero
 * @property string $colonia
 * @property string $codigo_postal
 * @property string $curp
 * @property string $rfc
 * @property string $nss
 * @property string $afore
 * @property string $cartilla_militar
 * @property string $pasaporte
 * @property integer $licencia
 * @property integer $clase_licencia
 * @property string $numero_licencia
 * @property integer $deportista
 * @property string $deporte
 * @property integer $club
 * @property string $pasatiempo
 * @property string $meta
 * @property integer $estudio
 * @property string $escuela
 * @property string $inicio
 * @property string $finalizacion
 * @property integer $titulo
 * @property string $idioma
 * @property integer $porcentaje
 * @property string $funciones_oficina
 * @property string $maquinaria_oficina
 * @property string $software
 * @property string $otras_funciones
 * @property integer $trabajo_anterior
 * @property double $tiempo_trabajo
 * @property string $compania
 * @property string $direccion
 * @property string $telefono
 * @property string $puesto
 * @property double $sueldo_inicial
 * @property double $sueldo_final
 * @property string $motivo_separacion
 * @property string $nombre_jefe
 * @property string $puesto_jefe
 * @property string $nombre_ref1
 * @property string $domicilio_ref1
 * @property string $telefono_ref1
 * @property string $ocupacion_ref1
 * @property string $tiempo_ref1
 * @property string $nombre_ref2
 * @property string $domicilio_ref2
 * @property string $telefono_ref2
 * @property string $ocupacion_ref2
 * @property string $tiempo_ref2
 * @property string $nombre_ref3
 * @property string $domicilio_ref3
 * @property string $telefono_ref3
 * @property string $ocupacion_ref3
 * @property string $tiempo_ref3
 * @property integer $parientes
 * @property integer $afianzado
 * @property integer $sindicato
 * @property integer $seguro_vida
 * @property integer $viajar
 * @property integer $cambiar_residencia
 * @property integer $otros_ingresos
 * @property double $importe_ingresos
 * @property integer $conyuge_trabaja
 * @property double $percepcion
 * @property integer $casa_propia
 * @property double $valor_casa
 * @property integer $paga_renta
 * @property double $renta
 * @property integer $dependientes
 * @property integer $automovil
 * @property integer $deudas
 * @property double $importe_deudas
 * @property string $acreedor
 * @property double $abono_mensual
 * @property double $gastos_mensuales
 */
class aspirantes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aspirantes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sexo, estado_civil, licencia, clase_licencia, deportista, club, estudio, titulo, porcentaje, trabajo_anterior, parientes, afianzado, sindicato, seguro_vida, viajar, cambiar_residencia, otros_ingresos, conyuge_trabaja, casa_propia, paga_renta, dependientes, automovil, deudas', 'numerical', 'integerOnly'=>true),
			array('estatura, peso, tiempo_trabajo, sueldo_inicial, sueldo_final, importe_ingresos, percepcion, valor_casa, renta, importe_deudas, abono_mensual, gastos_mensuales', 'numerical'),
			array('fecha_actualizacion, foto, nombre, fecha_nacimiento, nacionalidad, calle, numero, colonia, codigo_postal, curp, rfc, nss, afore, cartilla_militar, pasaporte, numero_licencia, deporte, pasatiempo, meta, escuela, inicio, finalizacion, idioma, funciones_oficina, maquinaria_oficina, software, otras_funciones, compania, direccion, telefono, puesto, motivo_separacion, nombre_jefe, puesto_jefe, nombre_ref1, domicilio_ref1, telefono_ref1, ocupacion_ref1, tiempo_ref1, nombre_ref2, domicilio_ref2, telefono_ref2, ocupacion_ref2, tiempo_ref2, nombre_ref3, domicilio_ref3, telefono_ref3, ocupacion_ref3, tiempo_ref3, acreedor', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fecha_actualizacion, foto, nombre, fecha_nacimiento, sexo, nacionalidad, estatura, peso, estado_civil, calle, numero, colonia, codigo_postal, curp, rfc, nss, afore, cartilla_militar, pasaporte, licencia, clase_licencia, numero_licencia, deportista, deporte, club, pasatiempo, meta, estudio, escuela, inicio, finalizacion, titulo, idioma, porcentaje, funciones_oficina, maquinaria_oficina, software, otras_funciones, trabajo_anterior, tiempo_trabajo, compania, direccion, telefono, puesto, sueldo_inicial, sueldo_final, motivo_separacion, nombre_jefe, puesto_jefe, nombre_ref1, domicilio_ref1, telefono_ref1, ocupacion_ref1, tiempo_ref1, nombre_ref2, domicilio_ref2, telefono_ref2, ocupacion_ref2, tiempo_ref2, nombre_ref3, domicilio_ref3, telefono_ref3, ocupacion_ref3, tiempo_ref3, parientes, afianzado, sindicato, seguro_vida, viajar, cambiar_residencia, otros_ingresos, importe_ingresos, conyuge_trabaja, percepcion, casa_propia, valor_casa, paga_renta, renta, dependientes, automovil, deudas, importe_deudas, acreedor, abono_mensual, gastos_mensuales', 'safe', 'on'=>'search'),
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
			'usuarios_aspirantes' => array(self::HAS_MANY, 'UsuariosAspirantes', 'id_aspirante'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                  => 'Id',
			'fecha_actualizacion' => 'Fecha Actualizacion',
			'foto'                => 'Foto',
			'nombre'              => 'Nombre',
			'fecha_nacimiento'    => 'Fecha de Nacimiento',
			'sexo'                => 'Sexo',
			'nacionalidad'        => 'Nacionalidad',
			'estatura'            => 'Estatura',
			'peso'                => 'Peso',
			'estado_civil'        => 'Estado Civil',
			'calle'               => 'Calle',
			'numero'              => 'Numero',
			'colonia'             => 'Colonia',
			'codigo_postal'       => 'Codigo Postal',
			'curp'                => 'CURP',
			'rfc'                 => 'RFC',
			'nss'                 => 'Número de Seguro Social',
			'afore'               => 'AFORE',
			'cartilla_militar'    => 'Número de Cartilla del Servicio Militar',
			'pasaporte'           => 'Número de Pasaporte',
			'licencia'            => '¿Tiene licencia de manejo?',
			'clase_licencia'      => 'Clase de Licencia',
			'numero_licencia'     => 'Numero de Licencia',
			'deportista'          => '¿Practica algún deporte?',
			'deporte'             => '¿Cuál deporte?',
			'club'                => '¿Pertenece a algun club social o deportivo?',
			'pasatiempo'          => '¿Cuál es su pasatiempo favorito?',
			'meta'                => '¿Cuál es su meta en la vida?',
			'estudio'             => 'Último grado de estudios',
			'escuela'             => 'Nombre de la escuela',
			'inicio'              => 'Fecha de inicio',
			'finalizacion'        => 'Fecha de finalizacion',
			'titulo'              => 'Título recibido',
			'idioma'              => 'Otro idioma que domine hablar',
			'porcentaje'          => '¿En qué porcentaje?',
			'funciones_oficina'   => 'Funciones de oficina que domina',
			'maquinaria_oficina'  => 'Maquinaria de oficina o taller que sepa manejar',
			'software'            => 'Software que conoce',
			'otras_funciones'     => 'Otros trabajos o funciones que domina',
			'trabajo_anterior'    => '¿Ha trabajado antes?',
			'tiempo_trabajo'      => 'Tiempo que prestó sus servicios',
			'compania'            => 'Nombre de la compañía',
			'direccion'           => 'Direccion',
			'telefono'            => 'Teléfono',
			'puesto'              => 'Puesto desempeñado',
			'sueldo_inicial'      => 'Sueldo Mensual Inicial',
			'sueldo_final'        => 'Sueldo Mensual Final',
			'motivo_separacion'   => 'Motivo de su Separacion',
			'nombre_jefe'         => 'Nombre de su jefe directo',
			'puesto_jefe'         => 'Puesto de su jefe directo',
			'nombre_ref1'         => 'Nombre completo',
			'domicilio_ref1'      => 'Domicilio',
			'telefono_ref1'       => 'Telefono',
			'ocupacion_ref1'      => 'Ocupacion',
			'tiempo_ref1'         => 'Tiempo de conocerlo',
			'nombre_ref2'         => 'Nombre completo',
			'domicilio_ref2'      => 'Domicilio',
			'telefono_ref2'       => 'Telefono',
			'ocupacion_ref2'      => 'Ocupacion',
			'tiempo_ref2'         => 'Tiempo de conocerlo',
			'nombre_ref3'         => 'Nombre completo',
			'domicilio_ref3'      => 'Domicilio',
			'telefono_ref3'       => 'Telefono',
			'ocupacion_ref3'      => 'Ocupacion',
			'tiempo_ref3'         => 'Tiempo de conocerlo',
			'parientes'           => '¿Tiene parientes trabajando en esta empresa?',
			'afianzado'           => '¿Ha estado afianzado?',
			'sindicato'           => '¿Ha estado afiliado a algun sindicato?',
			'seguro_vida'         => '¿Tiene seguro de vida?',
			'viajar'              => '¿Puede viajar?',
			'cambiar_residencia'  => '¿Está dispuesto a cambiar su lugar de residencia?',
			'otros_ingresos'      => '¿Tiene usted otros ingresos?',
			'importe_ingresos'    => 'Importe Mensual',
			'conyuge_trabaja'     => '¿Su conyuge trabaja?',
			'percepcion'          => 'Percepcion Mensual',
			'casa_propia'         => '¿Vive en casa propia?',
			'valor_casa'          => 'Valor Aproximado',
			'paga_renta'          => '¿Paga renta?',
			'renta'               => 'Renta Mensual',
			'dependientes'        => 'Número de personas que dependen de usted',
			'automovil'           => '¿Tiene automovil propio?',
			'deudas'              => '¿Tiene deudas?',
			'importe_deudas'      => 'Importe',
			'acreedor'            => 'Acreedor',
			'abono_mensual'       => '¿Cuánto abona mensualmente?',
			'gastos_mensuales'    => '¿A cuanto ascienden sus gastos mensuales?',
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

		$criteria->compare('fecha_actualizacion',$this->fecha_actualizacion,true);

		$criteria->compare('foto',$this->foto,true);

		$criteria->compare('nombre',$this->nombre,true);

		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);

		$criteria->compare('sexo',$this->sexo);

		$criteria->compare('nacionalidad',$this->nacionalidad,true);

		$criteria->compare('estatura',$this->estatura);

		$criteria->compare('peso',$this->peso);

		$criteria->compare('estado_civil',$this->estado_civil);

		$criteria->compare('calle',$this->calle,true);

		$criteria->compare('numero',$this->numero,true);

		$criteria->compare('colonia',$this->colonia,true);

		$criteria->compare('codigo_postal',$this->codigo_postal,true);

		$criteria->compare('curp',$this->curp,true);

		$criteria->compare('rfc',$this->rfc,true);

		$criteria->compare('nss',$this->nss,true);

		$criteria->compare('afore',$this->afore,true);

		$criteria->compare('cartilla_militar',$this->cartilla_militar,true);

		$criteria->compare('pasaporte',$this->pasaporte,true);

		$criteria->compare('licencia',$this->licencia);

		$criteria->compare('clase_licencia',$this->clase_licencia);

		$criteria->compare('numero_licencia',$this->numero_licencia,true);

		$criteria->compare('deportista',$this->deportista);

		$criteria->compare('deporte',$this->deporte,true);

		$criteria->compare('club',$this->club);

		$criteria->compare('pasatiempo',$this->pasatiempo,true);

		$criteria->compare('meta',$this->meta,true);

		$criteria->compare('estudio',$this->estudio);

		$criteria->compare('escuela',$this->escuela,true);

		$criteria->compare('inicio',$this->inicio,true);

		$criteria->compare('finalizacion',$this->finalizacion,true);

		$criteria->compare('titulo',$this->titulo);

		$criteria->compare('idioma',$this->idioma,true);

		$criteria->compare('porcentaje',$this->porcentaje);

		$criteria->compare('funciones_oficina',$this->funciones_oficina,true);

		$criteria->compare('maquinaria_oficina',$this->maquinaria_oficina,true);

		$criteria->compare('software',$this->software,true);

		$criteria->compare('otras_funciones',$this->otras_funciones,true);

		$criteria->compare('trabajo_anterior',$this->trabajo_anterior);

		$criteria->compare('tiempo_trabajo',$this->tiempo_trabajo);

		$criteria->compare('compania',$this->compania,true);

		$criteria->compare('direccion',$this->direccion,true);

		$criteria->compare('telefono',$this->telefono,true);

		$criteria->compare('puesto',$this->puesto,true);

		$criteria->compare('sueldo_inicial',$this->sueldo_inicial);

		$criteria->compare('sueldo_final',$this->sueldo_final);

		$criteria->compare('motivo_separacion',$this->motivo_separacion,true);

		$criteria->compare('nombre_jefe',$this->nombre_jefe,true);

		$criteria->compare('puesto_jefe',$this->puesto_jefe,true);

		$criteria->compare('nombre_ref1',$this->nombre_ref1,true);

		$criteria->compare('domicilio_ref1',$this->domicilio_ref1,true);

		$criteria->compare('telefono_ref1',$this->telefono_ref1,true);

		$criteria->compare('ocupacion_ref1',$this->ocupacion_ref1,true);

		$criteria->compare('tiempo_ref1',$this->tiempo_ref1,true);

		$criteria->compare('nombre_ref2',$this->nombre_ref2,true);

		$criteria->compare('domicilio_ref2',$this->domicilio_ref2,true);

		$criteria->compare('telefono_ref2',$this->telefono_ref2,true);

		$criteria->compare('ocupacion_ref2',$this->ocupacion_ref2,true);

		$criteria->compare('tiempo_ref2',$this->tiempo_ref2,true);

		$criteria->compare('nombre_ref3',$this->nombre_ref3,true);

		$criteria->compare('domicilio_ref3',$this->domicilio_ref3,true);

		$criteria->compare('telefono_ref3',$this->telefono_ref3,true);

		$criteria->compare('ocupacion_ref3',$this->ocupacion_ref3,true);

		$criteria->compare('tiempo_ref3',$this->tiempo_ref3,true);

		$criteria->compare('parientes',$this->parientes);

		$criteria->compare('afianzado',$this->afianzado);

		$criteria->compare('sindicato',$this->sindicato);

		$criteria->compare('seguro_vida',$this->seguro_vida);

		$criteria->compare('viajar',$this->viajar);

		$criteria->compare('cambiar_residencia',$this->cambiar_residencia);

		$criteria->compare('otros_ingresos',$this->otros_ingresos);

		$criteria->compare('importe_ingresos',$this->importe_ingresos);

		$criteria->compare('conyuge_trabaja',$this->conyuge_trabaja);

		$criteria->compare('percepcion',$this->percepcion);

		$criteria->compare('casa_propia',$this->casa_propia);

		$criteria->compare('valor_casa',$this->valor_casa);

		$criteria->compare('paga_renta',$this->paga_renta);

		$criteria->compare('renta',$this->renta);

		$criteria->compare('dependientes',$this->dependientes);

		$criteria->compare('automovil',$this->automovil);

		$criteria->compare('deudas',$this->deudas);

		$criteria->compare('importe_deudas',$this->importe_deudas);

		$criteria->compare('acreedor',$this->acreedor,true);

		$criteria->compare('abono_mensual',$this->abono_mensual);

		$criteria->compare('gastos_mensuales',$this->gastos_mensuales);

		return new CActiveDataProvider('aspirantes', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return aspirantes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}