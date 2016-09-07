<?php

class WebServiceController extends Controller{
	private $separadorPrimario = '>';
	private $separadorSecundario = '<';

	public function actionPayPal(){
		if(isset($_GET['success']) && (bool)$_GET['success'] === true){
			if (PayPal::process($_GET['paymentId'], $_GET['PayerID'])){
				echo "Payment was made.";
			}
			else{
				echo "There was an error with the payment.";
			}
		}
		else{
			PayPal::checkout('Producto', 10.5);
		}
	}

	public function actionListaVacantes(){
		if (isset($_POST['fallout4'])){
			$busqueda = Functions::decifrar($_POST['busqueda']);
			$pagina   = Functions::decifrar($_POST['pagina']);
			$email    = Functions::decifrar($_POST['email']);

			$usuario   = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));
			$aspirante = aspirantes::model()->findByAttributes(array('id'=>$usuario->id_aspirante));

			$criteria = new CDbCriteria;
			$criteria->order = 'sueldo DESC';
			$criteria->addSearchCondition('activa', true, true, 'AND');

			if ($busqueda != "null"){
				$criteria->addSearchCondition('puesto', $busqueda, true, 'OR');
				$criteria->addSearchCondition('ofrece', $busqueda, true, 'OR');
				$criteria->addSearchCondition('requisitos', $busqueda, true, 'OR');
			}

			$vacantes = vacantes::model()->findAll($criteria);

			$gap   = 0;
			$limit = 10 * $pagina;
			$count = 0;
			$start = $limit - 9;
			//$limit--;

			$tempString = "";

			foreach ($vacantes as $vacante) {
				$count++;
				if ($count < $start){
					continue;
				}
				else{
					$aplicacion = lista_aspirantes::model()->findAllByAttributes(array('id_vacante'=>$vacante->id,'id_aspirante'=>$aspirante->id, 'activa'=>true));
					if ($aplicacion == null){
						$empresa = empresas::model()->findByAttributes(array('id'=>$vacante->id_empresa));
						$tempString .= $vacante->id . $this->separadorSecundario . $empresa->nombre . $this->separadorSecundario . $vacante->puesto . $this->separadorPrimario;
					}
					else{
						$gap++;
					}
					if ($count >= $limit + $gap){
						break;
					}
				}
			}


			$totalPaginas = floor((count($vacantes) - 1 - $gap) / 10) + 1;

			$string  = $totalPaginas . $this->separadorPrimario . $pagina . $this->separadorPrimario;
			$string .= $tempString;

			if ($string == $totalPaginas . $this->separadorSecundario . $pagina . $this->separadorSecundario){
				$string = " ";
			}
			echo Functions::cifrar($string);
		}
		else{
			$this->render('listavacantes');
		}
	}

	public function actionDetalleVacante(){
		if (isset($_POST['fallout4'])){
			$id = Functions::decifrar($_POST['id']);

			$vacante = vacantes::model()->findByAttributes(array('id'=>$id));
			$empresa = empresas::model()->findByAttributes(array('id'=>$vacante->id_empresa));
			$localidad = localidades::model()->findByAttributes(array('id_empresa'=>$vacante->id_empresa));
			$direccion = $localidad->calle . " #" . $localidad->numero . " " . $localidad->colonia . " C.P. " . $localidad->codigo_postal;

			$string = $vacante->puesto . $this->separadorSecundario . $empresa->nombre . $this->separadorSecundario . $direccion . $this->separadorSecundario . $vacante->requisitos . $this->separadorSecundario . $vacante->ofrece . $this->separadorSecundario . $vacante->sueldo . '$/h';

			if ($string == ""){
				$string = " ";
			}

			echo Functions::cifrar($string);
		}
		else{
			$this->render('detallevacante');
		}
	}

	public function actionRegistroSolicitante(){
		if (isset($_POST['fallout4'])){
			$email    = Functions::decifrar($_POST['email']);
			$password = md5(Functions::decifrar($_POST['pass']));
			$gcmKey   = Functions::decifrar($_POST['gcmKey']);

			$usuario = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));

			if ($usuario == NULL){
				$aspirante = new aspirantes;
				$usuario   = new usuarios_aspirantes;

				$aspirante->save();
				$usuario->id_aspirante = $aspirante->id;
				$usuario->correo       = $email;
				$usuario->contrasena   = $password;
				$usuario->gcmKey       = $gcmKey;
				$usuario->save();

				echo Functions::cifrar("exito");
			}
			else{
				echo Functions::cifrar("error");
			}
		}
		else{
			$this->render('registrosolicitante');
		}
	}

	public function actionActualizarSolicitud(){
		if (isset($_POST['fallout4'])){
			$solicitud = Functions::decifrar($_POST['solicitud']);
			$email     = Functions::decifrar($_POST['email']);

			$usuario   = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));
			$aspirante = aspirantes::model()->findByAttributes(array('id'=>$usuario->id_aspirante));

			$aspirante->datos = $solicitud;
			$aspirante->save();

			echo Functions::cifrar("exito");
		}
		else{
			$this->render('borrarusuario');
		}
	}

	public function actionActualizarFoto(){
		if (isset($_POST['fallout4'])){
			$email = Functions::decifrar($_POST['email']);
			$foto  = Functions::decifrar($_POST['foto']);
			$foto  = base64_decode($foto);

			$dir     = "images/fotos/";
			$fileURI = $dir . md5($email);
			$file    = fopen($fileURI, "w");
			fwrite($file, $foto);
			fclose($file);

			$usuario   = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));
			$aspirante = aspirantes::model()->findByAttributes(array('id'=>$usuario->id_aspirante));

			$aspirante->foto = $fileURI;
			$aspirante->save();

			echo Functions::cifrar($fileURI);
		}
		else{
			$this->render('actualizarfoto');
		}
	}

	public function actionLoginSolicitante(){
		if (isset($_POST['fallout4'])){
			$email    = Functions::decifrar($_POST['email']);
			$password = md5(Functions::decifrar($_POST['pass']));
			$gcmKey   = Functions::decifrar($_POST['gcmKey']);

			$usuario   = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email, 'contrasena'=> $password, 'activo'=>true));

			$aspirante = aspirantes::model()->findByAttributes(array('id'=>$usuario->id_aspirante));

			$usuario->gcmKey = $gcmKey;
			$usuario->save();

			$string = "exito";
			if ($aspirante->datos != null){
				if ($aspirante->foto != null){
					$string = $aspirante->foto;
				}
				else{
					$string = "_noFoto_";
				}
				$string .= $this->separadorPrimario . $aspirante->datos;
			}
			echo Functions::cifrar($string);
		}
		else{
			$this->render('loginsolicitante');
		}
	}

	public function actionAplicarSolicitud(){
		if (isset($_POST['fallout4'])){
			$email = Functions::decifrar($_POST['email']);
			$id    = Functions::decifrar($_POST['id']);

			$usuario   = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));
			$aspirante = aspirantes::model()->findByAttributes(array('id'=>$usuario->id_aspirante));
			$vacante   = vacantes::model()->findByAttributes(array('id'=>$id));

			$aplicacion = new lista_aspirantes;
			$aplicacion->id_vacante = $vacante->id;
			$aplicacion->id_aspirante = $aspirante->id;
			$aplicacion->save();

			AndroidNotifications::send($usuario->gcmKey, 1, 'Aceptado');

			echo Functions::cifrar("exito");
		}
		else{
			$this->render('aplicarsolicitud');
		}
	}

	public function actionListaNotificaciones(){
		if (isset($_POST['fallout4'])){
			$email  = Functions::decifrar($_POST['email']);
			$pagina = Functions::decifrar($_POST['pagina']);

			$usuario      = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));
			$aspirante    = aspirantes::model()->findByAttributes(array('id'=>$usuario->id_aspirante));
			$aplicaciones = lista_aspirantes::model()->findAllByAttributes(array('id_aspirante'=>$aspirante->id, 'activa'=>true));

			$limit = 10 * $pagina;
			$count = 0;
			$start = $limit - 9;
			//$limit--;
			$totalPaginas = floor((count($aplicaciones) - 1) / 10) + 1;
			$string  = $totalPaginas . $this->separadorPrimario . $pagina . $this->separadorPrimario;

			foreach ($aplicaciones as $aplicacion) {
				$count++;
				if ($count < $start){
					continue;
				}
				else{
					$vacante = vacantes::model()->findByAttributes(array('id'=>$aplicacion->id_vacante));
					$empresa = empresas::model()->findByAttributes(array('id'=>$vacante->id_empresa));
					$estado  = "pd";
					if ($aplicacion->cita != null){
						$estado = "ac";
						if ($aplicacion->respuesta != null){
							$estado = $aplicacion->respuesta;
						}
					}
					$string .= $aplicacion->id . $this->separadorSecundario . $empresa->nombre . $this->separadorSecundario . $vacante->puesto . $this->separadorSecundario . $estado . $this->separadorPrimario;
					if ($count >= $limit){
						break;
					}
				}
			}

			echo Functions::cifrar($string);
		}
		else{
			$this->render('listanotificaciones');
		}
	}

	public function actionDetalleNotificacion(){
		if (isset($_POST['fallout4'])){
			$id    = Functions::decifrar($_POST['id']);
			$email = Functions::decifrar($_POST['email']);

			$usuario    = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));
			$aspirante  = aspirantes::model()->findByAttributes(array('id'=>$usuario->id_aspirante));
			$aplicacion = lista_aspirantes::model()->findByAttributes(array('id'=>$id));

			$vacante   = vacantes::model()->findByAttributes(array('id'=>$aplicacion->id_vacante));
			$empresa   = empresas::model()->findByAttributes(array('id'=>$vacante->id_empresa));
			$localidad = localidades::model()->findByAttributes(array('id_empresa'=>$vacante->id_empresa));
			$direccion = $localidad->calle . " #" . $localidad->numero . " " . $localidad->colonia . " C.P. " . $localidad->codigo_postal;

			$mensaje = "No hay mensaje.";
			if ($aplicacion->cita != null){
				$mensaje = "Reportate el " . $aplicacion->cita . " para una entrevista.";
			}

			$string = $vacante->puesto . $this->separadorSecundario . $empresa->nombre . $this->separadorSecundario . $direccion . $this->separadorSecundario . $vacante->requisitos . $this->separadorSecundario . $vacante->ofrece . $this->separadorSecundario . $vacante->sueldo . '$/h' . $this->separadorSecundario . $mensaje;

			if ($aplicacion->respuesta == 'na'){
				$aplicacion->activa = false;
				$aplicacion->save();
			}

			echo Functions::cifrar($string);
		}
		else{
			$this->render('detallenotificacion');
		}
	}

	public function actionRespuestaAspirante(){
		if (isset($_POST['fallout4'])){
			$id     = Functions::decifrar($_POST['id']);
			$email  = Functions::decifrar($_POST['email']);
			$estado = Functions::decifrar($_POST['estado']);

			$aplicacion = lista_aspirantes::model()->findByAttributes(array('id'=>$id));
			$string     = "error";
			$aplicacion->respuesta = $estado;

			if ($estado == 'na'){
				$aplicacion->activa = false;
				$aplicacion->save();
				$string = "exito";
			}
			else{
				if ($aplicacion->respuesta == 'pd'){
					$aplicacion->cita = NULL;
				}
				$aplicacion->save();
				$string = "exito";
			}
			

			echo Functions::cifrar($string);
		}
		else{
			$this->render('respuestaaspirante');
		}
	}

	public function actionRecuperarContrasena(){
		if (isset($_POST['fallout4'])){
			$email   = Functions::decifrar($_POST['email']);
			$usuario = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));

			if ($usuario != null){
				Mailer::sendMail(
					"Restablecimiento de la cuenta",
					$email ,
					"BiEmpleos",
					"noreply@biempleos.com",
					'<html>
			        <body>
			        <h1>Estimado usuario</h1>
			        <p>Usted ha indicado que ha olvidado su contrase&ntilde;a, por favor utilice el siguiente enlace para cambiarla</p>
			        <p><a href="' . Yii::app()->request->baseUrl . "/site/recover?id=" . md5($usuario->correo . $usuario->contrasena) . '">' . Yii::app()->request->baseUrl . "/site/recover?id=" . md5($usuario->correo . $usuario->contrasena) . '</a></p>
			        <p>Si usted no solicit&oacute; el cambio de contrase&ntilde;a, por favor ignore este correo electr&oacute;nico</p>
			        <p>Gracias por utilizar nuestros servicios.<br>With Love: BiEmpleos &hearts;</p>
			        </body>
			        </html>');
                echo Functions::cifrar("exito");
			else{
				echo Functions::cifrar("error");
			}
		}
		else{
			$this->render('recuperarcontrasena');
		}
	}

	public function actionBorrarUsuario(){
		if (isset($_POST['fallout4'])){
			$email     = Functions::decifrar($_POST['email']);
			$solicitud = Functions::decifrar($_POST['solicitud']);

			$usuario   = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));
			$aspirante = aspirantes::model()->findByAttributes(array('id'=>$usuario->id_aspirante));

			if (file_exists($aspirante->foto)){
				unlink($aspirante->foto);
			}

			$aspirante->datos = $solicitud;
			$aspirante->foto  = NULL;
			$usuario->activo  = false;
			$usuario->gcmKey  = "NULL";

			if ($aspirante->save() && $usuario->save()){
				echo Functions::cifrar("exito");
			}
			else{
				echo Functions::cifrar("error");
			}
		}
		else{
			$this->render('borrarusuario');
		}
	}

	public function actionDesconectarse(){
		if (isset($_POST['fallout4'])){
			$email   = Functions::decifrar($_POST['email']);
			$usuario = usuarios_aspirantes::model()->findByAttributes(array('correo'=>$email));
			
			$usuario->gcmKey = "NULL";

			if ($usuario->save()){
				echo Functions::cifrar("exito");
			}
			else{
				echo Functions::cifrar("error");
			}
		}
		else{
			$this->render('desconectarse');
		}
	}
}