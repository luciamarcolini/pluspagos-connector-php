<?php
include_once dirname(__FILE__)."/../vendor/autoload.php";
// use PPConnectorSDK\Package\Package_obfuscated;
use PPConnectorSDK\Models\DatosTarjeta;
use PPConnectorSDK\Models\PaymentModel;
use PPConnectorSDK\Models\CajaModel;
use PPConnectorSDK\Models\OrderModel;
use PPConnectorSDK\Models\RefundModel;
use PPConnectorSDK\Models\TokenModel;
use PPConnectorSDK\Models\UserData;
use PPConnectorSDK\Models\StoredCardModel;
use PPConnectorSDK\Models\SaldoPlusPagosModel;
use PPConnectorSDK\Models\SaveTarjetaModel;
use PPConnectorSDK\Models\AmbienteEnum;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$connector = new \PPConnectorSDK\Connector(AmbienteEnum::Sandbox);
$model = new StdClass();
$model->{'guid'} = "d1050b9c-4805-4ea3-8f66-6a601490010a";
$model->{'frase'} = "JyPQ8nFbazpTF1aCZLCVexboOmVxeiKYE8c+PScTsQg=";


$token = $connector->GetAuthenticationToken($model);
$content = json_decode($token, true);
$tokenVal = $content["data"];
$phrase = "SolucionesAndinas_9b59b264-5168-42aa-801d-fd27ca454503";
echo("<br><br>TOKEN<br>");
echo($tokenVal);

echo("<br><br>Prueba<br>");
// $token_model = new TokenModel();
// $token_model->Comercio = "d1050b9c-4805-4ea3-8f66-6a601490010a";
// $token_model->UrlDominio = "www.google.com";
// $token_model->Productos = array("test", "asd");
// $token_model->TotalOperacion = "5000";
// $token_model->SucursalComercio = "0";
// $token_model->TransaccionComercioId = "Test123Test";
// $token_model->Ip = "::1";
// $token_model->CodigoCaja = "Test123456";

$datosTarjeta = new DatosTarjeta();
$datosTarjeta->AñoVencimiento = "37";
$datosTarjeta->MesVencimiento = "12";
$datosTarjeta->CodigoTarjeta = "337";
$datosTarjeta->DocumentoTitular = "34004923";
$datosTarjeta->Email = "asd@asd.com";
$datosTarjeta->FechaNacimientoTitular = "21021995";
$datosTarjeta->NumeroPuertaResumen = "20";
$datosTarjeta->NumeroTarjeta = "778899000000519004";
$datosTarjeta->TipoDocumento = "DNI";
$datosTarjeta->TitularTarjeta = "APELLIDO493/NOMBRE493";

// $payment = new PaymentModel();
// $payment->DatosTarjeta = $datosTarjeta;
// $payment->AceptaHabeasData = "True";
// $payment->AceptTerminosyCondiciones = "True";
// $payment->CantidadCuotas = "1";
// $payment->IPCliente = "::1";
// $payment->MedioPagoId = "7";

$userData = new UserData();
$userData->UserId = "258";
$userData->UsuarioBanco = "False";
$userData->Direccion = null;
$userData->Documento = "34004923";
$userData->Email = "damaian13.fg@gmail.com";
$userData->FechaNacimiento = null;
$userData->BancoId = "3";
$userData->IMEI = null;

$doPayment = new StoredCardModel();
$doPayment->Comercio = "d1050b9c-4805-4ea3-8f66-6a601490010a";
$doPayment->SucursalComercio = null;
$doPayment->Productos = array('Test', 'Prueba');
$doPayment->Importe = "4000";
$doPayment->TransaccionComercioId = "Quee????";
$doPayment->Ip = "::1";
$doPayment->AceptaHabeasData = "False";
$doPayment->AceptaTerminosCondiciones = "True";
$doPayment->Cuotas = "1";
$doPayment->CodigoTarjeta = null;
$doPayment->TarjetaId = "1177";
$doPayment->CodigoVerificacion = "337";
$doPayment->Ente = "232323";
$doPayment->MontoBruto = "4000";
$doPayment->MontoDescuento = null;
$doPayment->PromocionId = null;
$doPayment->UserData = $userData;
$doPayment->TipoPago = "7";
$doPayment->QrData = null;

// $saldoPP = new SaldoPlusPagosModel();
// $saldoPP->Comercio = "d1050b9c-4805-4ea3-8f66-6a601490010a";
// $saldoPP->Ente = "232323";
// $saldoPP->Importe = "100";
// $saldoPP->SucursalComercio = null;
// $saldoPP->TransaccionComercioId = "Whats?";
// $saldoPP->TipoPago = "4";
// $saldoPP->UserData = array("BancoId" => "0", "UserId" => "1234");
// $saldoPP->QrData = null;
// $saldoPP->MontoBruto = null;
// $saldoPP->MontoDescuento = null;
// $saldoPP->PromocionId = null;

$saveCard = new SaveTarjetaModel();
$saveCard->UserData = $userData;
$saveCard->DatosTarjeta = $datosTarjeta;
$saveCard->MedioPagoId = "7";

$aad = $connector->StoredCardPaymentRequest($doPayment, $tokenVal, $phrase);
// $tokenTx = json_decode($aad, true);
echo("<br><br>Payment<br>");
// $dddd = $connector->ExecutePayment ($payment, $tokenTx["data"], $tokenVal, $phrase);
echo("<br><br>");
var_dump($aad);
echo("<br><br>");

// $caja = new CajaModel();
// $caja->Nombre = "Test";
// $caja->Codigo = "Test12345678";
// $caja->SucursalComercioId = "3014";
// $caja->Fixed_Amount = "False";
// $responseCaja = $connector->Caja($caja, $tokenVal, $phrase);
// var_dump($responseCaja);

?>