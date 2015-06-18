<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


 CModule::IncludeModule("iblock");
//проверка есть ли LIVEZAKAZ у этого пользователя
 
global $USER; 

//$USRpole = CUser::GetList(($by="ID"), ($order="desc"),array("ID"=>$USER->GetID()) ,array("SELECT"=>array("UF_*")));
//$data = $USRpole->GetNext(); 
$status="";
//$z=  $data[UF_LIVEZAKAZ];
//////////////////////////////активен ли livezakaz водителя в инфоблоке заказазов
	$arFilter = array( 	"ID"=>$z,   "IBLOCK_ID"=>5 ,"ACTIVE" => "Y" );
	$arSelect = Array("ACTIVE", "MODIFIED_BY","PROPERTY_vkorzine_ukogo_id","PROPERTY_voditel_live","PROPERTY_voditel_live");
	$res = CIBlockElement::GetList(Array("ID"=>"desc"), $arFilter, false, false, $arSelect);
												
	while($ob = $res->GetNextElement())
		{
												$arFields = $ob->GetFields();
												$busy=false;

												$vf=strlen($arFields[PROPERTY_VKORZINE_UKOGO_ID_VALUE])+strlen($arFields[PROPERTY_VODITEL_LIVE_VALUE]);
												if ($vf>0) { $busy=true;}

//												if (    $arFields[PROPERTY_VODITEL_LIVE_VALUE]==$USER->GetID()   ) { $busy=true; };// если этот заказ взят водителем который запрашивает
												
												if ($busy) 
												{
													$status=$arFields[PROPERTY_VODITEL_LIVE_VALUE];//кем то взят
												}
		}

//////////////////////////////активен ли livezakaz водителя в инфоблоке заказазов

 
if ($status=="") { 	$status=""; }
if ($status=="0") { 	$status=""; }

echo $status;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>

