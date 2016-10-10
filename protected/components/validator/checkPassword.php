<?php
class checkPassword extends CValidator {
    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
     */
    protected function validateAttribute($object,$attribute) {
        $usuario = Yii::app()->user->usuario;
        if ($usuario->contrasena !== md5($object->$attribute))
        	$this->addError($attribute, 'La contraseña es incorrecta.');
    }
    
    /**
     * Returns the JavaScript needed for performing client-side validation.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     * @return string the client-side validation script.
     * @see CActiveForm::enableClientValidation
     */
    public function clientValidateAttribute($object,$attribute) {
        $usuario = Yii::app()->user->usuario;

        $condition = $usuario->contrasena !== md5($object->$attribute);

        return "$.ajax({
            url: '" . Yii::app()->createUrl('empresas/checkPwd') . "',
            type: 'POST',
            data: {
                password:$('div.old input').val()
            },
            dataType:'text',
            async:false,
            success: function(data) {
                if (data == 'false')
                    messages.push(".CJSON::encode('La contraseña es incorrecta.').");
                else if (data == 'error')
                    messages.push(".CJSON::encode('No se han proporcionado datos.').");
            }
        });";
    }
}
// http://www.yiiframework.com/wiki/168/create-your-own-validation-rule/
?>