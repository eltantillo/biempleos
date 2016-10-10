<?php
class PanelModule extends CWidget
{
    $btn = 'none';
    $title = 'Titulo';
    $modelo = null;
    
    public function init()
    {
        // this method is called by CController::beginWidget()
    }
 
    public function run()
    {
        // this method is called by CController::endWidget()
        $this->renderPartial('panelWidget');
    }
}
?>