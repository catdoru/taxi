<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


global $USER;


$status="";//никем не взят

CModule::IncludeModule("iblock");

$arFilter = array( 	"ID"=>$z,   "IBLOCK_ID"=>5  );
												$arSelect = Array("ACTIVE", "MODIFIED_BY","PROPERTY_vkorzine_ukogo_id","PROPERTY_voditel_live");
												$res = CIBlockElement::GetList(Array("ID"=>"desc"), $arFilter, false, false, $arSelect);
												
												while($ob = $res->GetNextElement())
												{
												$arFields = $ob->GetFields();
												$busy=false;

												$vf=strlen($arFields[PROPERTY_VKORZINE_UKOGO_ID_VALUE])+strlen($arFields[PROPERTY_VODITEL_LIVE_VALUE]);
												if ($vf>0) { $busy=true;}

												if (    $arFields[PROPERTY_VODITEL_LIVE_VALUE]==$USER->GetID()   ) { $busy=false; };// если этот заказ взят водителем который запрашивает
												
												if ($arFields[ACTIVE]=="N")  
												{ 
												$busy=true; 
												//обнуляем у водиля livezakaz
//												$user = new CUser;
	//											$fields = Array( 												  "UF_LIVEZAKAZ"          => "" 												  );
											//	$user->Update($USER->GetID(), $fields);
												//$strError = $user->LAST_ERROR;
												//обнуляем у водиля livezakaz
												
												} 
												
												if ($busy) 
												{
													$status=$arFields[PROPERTY_VODITEL_LIVE_VALUE];//кем то взят
												}
												
												
												
												}
												
												

echo $status;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>