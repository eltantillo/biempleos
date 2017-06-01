<?php
include_once('phpjasperxml/class/tcpdf/tcpdf.php');
include_once("phpjasperxml/class/PHPJasperXML.inc.php");

global $server, $db, $user, $pass, $version, $pgport, $pchartfolder;
include_once ('phpjasperxml/setting.php');

class PDFAspirante extends PHPJasperXML {
    public function downloadPDF($id) {
        global $server, $db, $user, $pass;
        
        $PHPJasperXML = new PHPJasperXML();
        //$PHPJasperXML->debugsql=true;
        $PHPJasperXML->arrayParameter=array("id"=>$id);
        $PHPJasperXML->load_xml_file("formato/report1.jrxml");

        $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
        $PHPJasperXML->outpage("D", 'prueba.pdf');    //page output method I:standard output  D:Download file
    }
}


/*
//Import the PhpJasperLibrary
include_once('PhpJasperLibrary/tcpdf/tcpdf.php');
include_once("PhpJasperLibrary/PHPJasperXML.inc.php");

//database connection details
global $server, $db, $user, $pass, $version, $pgport, $pchartfolder;
$server="192.168.0.11";
$db="lcs_ims";
$user="web";
$pass="abc123@#";
$version="0.8b";
$pgport=5432;
$pchartfolder="./class/pchart2";

class PDFAspirante extends PHPJasperXML {
    public function downloadPDF($id) {
        global $server, $db, $user, $pass;
        
        //display errors should be off in the php.ini file
        ini_set('display_errors', 0);
        //setting the path to the created jrxml file
        $xml =  simplexml_load_file(dirname(__FILE__) . '/formato/report1.jrxml');

        $PHPJasperXML = new PHPJasperXML();
        //$PHPJasperXML->debugsql=true;
        //$PHPJasperXML->arrayParameter=array("parameter1"=>1);
        $PHPJasperXML->xml_dismantle($xml);

        $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
        $PHPJasperXML->outpage("D", 'prueba.pdf');    //page output method I:standard output  D:Download file
    }
}
*/
?>