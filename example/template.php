<?php
$strTemplateFile = "template.tpl.html";
$strContent = "This is the content!";


include_once ("../tpl.class.inc.php"); // include class file
$refTPL = new tpl(); // instantiate object
$arrContent['content'] = $strContent; // create block for [content]
$refTPL->go($strTemplateFile, $arrContent); // process template
echo $refTPL->get_content(); // display processed template
?>
