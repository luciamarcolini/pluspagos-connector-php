<?php
include_once dirname(__FILE__)."/../vendor/autoload.php";
use PPConnectorSDK\Models\AmbienteEnum;
use PPConnectorSDK\Models\TokenModel;
use PPConnectorSDK\Models\DatosTarjeta;
use PPConnectorSDK\Models\PaymentModel;
use PPConnectorSDK\Models\UserData;
use PPConnectorSDK\Models\StoredCardModel;
use PPConnectorSDK\Models\SaldoPlusPagosModel;
use PPConnectorSDK\Models\RefundModel;

$connector = new \PPConnectorSDK\Connector(AmbienteEnum::Sandbox);
$secretKey = "SolucionesAndinas_9b59b264-5168-42aa-801d-fd27ca454503";

$model = new StdClass();
$model->{'guid'} = "d1050b9c-4805-4ea3-8f66-6a601490010a";
$model->{'frase'} = "JyPQ8nFbazpTF1aCZLCVexboOmVxeiKYE8c+PScTsQg=";

$token = $connector->GetAuthenticationToken($model);

$content = json_decode($token, true);
$tokenVal = $content["data"];


// $userData = new UserData();
// $userData->UserId = "887225";
// $userData->UsuarioBanco = "False";
// $userData->Direccion = null;
// $userData->Documento = "34004923";
// $userData->Email = "test@gmail.com";
// $userData->FechaNacimiento = "12/01/1992";
// $userData->BancoId = "3";
// $userData->IMEI = null;

// $doPayment = new StoredCardModel();
// $doPayment->Comercio = "d1050b9c-4805-4ea3-8f66-6a601490010a";
// $doPayment->SucursalComercio = null;
// $doPayment->Productos = array('Test', 'Prueba');
// $doPayment->Importe = "4000";
// $doPayment->TransaccionComercioId = "12343Test1123";
// $doPayment->Ip = "::1";
// $doPayment->AceptaHabeasData = "False";
// $doPayment->AceptaTerminosCondiciones = "True";
// $doPayment->Cuotas = "1";
// $doPayment->CodigoTarjeta = null;
// $doPayment->TarjetaId = "1153";
// $doPayment->CodigoVerificacion = "337";
// $doPayment->Ente = "232323";
// $doPayment->MontoBruto = "4000";
// $doPayment->MontoDescuento = null;
// $doPayment->PromocionId = null;
// $doPayment->UserData = $userData;
// $doPayment->TipoPago = "14";
// $doPayment->QrData = null;

// $saldoPP = new SaldoPlusPagosModel();
// $saldoPP->Comercio = "d1050b9c-4805-4ea3-8f66-6a601490010a";
// $saldoPP->Ente = "232323";
// $saldoPP->Importe = "100";
// $saldoPP->SucursalComercio = null;
// $saldoPP->TransaccionComercioId = "Prueba123456?";
// $saldoPP->TipoPago = "4";
// $saldoPP->UserData = array("BancoId" => "0", "UserId" => "1234");
// $saldoPP->QrData = null;
// $saldoPP->MontoBruto = null;
// $saldoPP->MontoDescuento = null;
// $saldoPP->PromocionId = null;

$refund = new RefundModel();
$refund->TransaccionComercioId = '9876';
$refund->TransaccionId = '86877';
$devolucion = $connector->Refund($tokenVal, $refund, $secretKey);
var_dump($devolucion);


























// $token_model = new TokenModel();
// $token_model->Comercio = "d1050b9c-4805-4ea3-8f66-6a601490010a";
// $token_model->UrlDominio = "www.google.com";
// $token_model->Productos = array("test", "asd");
// $token_model->TotalOperacion = "5000";
// $token_model->SucursalComercio = null;
// $token_model->TransaccionComercioId = "Test1234Test";
// $token_model->Ip = "::1";
// $token_model->CodigoCaja = null;

// echo "<br><br>";
// $token_pago = $connector->GetPaymentToken($token_model, $tokenVal, $secretKey);
// var_dump($token_pago);
// $tokenTransaccion = json_decode($token_pago, true);

// echo "<br><br>";

// $datosTarjeta = new DatosTarjeta();
// $datosTarjeta->AñoVencimiento = "37";
// $datosTarjeta->MesVencimiento = "12";
// $datosTarjeta->CodigoTarjeta = "337";
// $datosTarjeta->DocumentoTitular = "34004923";
// $datosTarjeta->Email = "test@test.com";
// $datosTarjeta->FechaNacimientoTitular = "21021995";
// $datosTarjeta->NumeroPuertaResumen = "20";
// $datosTarjeta->NumeroTarjeta = "778899000000519004";
// $datosTarjeta->TipoDocumento = "DNI";
// $datosTarjeta->TitularTarjeta = "APELLIDO493/NOMBRE493";

// $payment = new PaymentModel();
// $payment->DatosTarjeta = $datosTarjeta;
// $payment->AceptaHabeasData = "True";
// $payment->AceptTerminosyCondiciones = "True";
// $payment->CantidadCuotas = "1";
// $payment->IPCliente = "::1";
// $payment->MedioPagoId = "7";

// $payment = $connector->ExecutePayment($payment, $tokenTransaccion["data"], $tokenVal, $secretKey);
// var_dump($payment);
?>