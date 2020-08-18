<?php 
namespace PPConnectorSDK;
use PPConnectorSDK\Services\HealthCheck;
use PPConnectorSDK\Services\Token;
use PPConnectorSDK\Services\Querys;
use PPConnectorSDK\Services\Caja;
use PPConnectorSDK\Services\Orders;
use PPConnectorSDK\Services\Refunds;
use PPConnectorSDK\Services\Payment;
use PPConnectorSDK\Models\AmbienteEnum;

class Connector 
{
    const endPointSand = "https://sandboxpp.asjservicios.com.ar:9003/";
    const endPointProd = "https://botonpp.asjservicios.com.ar:8082/";
    const endPointTest = "https://testingpp.asjservicios.com.ar:9100/";
    public function __construct($ambiente)
    {
        if ($ambiente == AmbienteEnum::Sandbox)
            $this->endPoint = self::endPointSand;
        else if ($ambiente == AmbienteEnum::Produccion)
            $this->endPoint = self::endPointProd;
        else if ($ambiente == AmbienteEnum::Test)
            $this->endPoint = self::endPointTest;

		$this->healthCheck = new HealthCheck($this->endPoint);
		$this->tokenService = new Token($this->endPoint);
        $this->querysService = new Querys($this->endPoint);
        $this->cajaService = new Caja($this->endPoint);
        $this->orderService = new Orders($this->endPoint);
        $this->refundsService = new Refunds($this->endPoint);
        $this->paymentService = new Payment($this->endPoint);
    }
    
    public function HealthCheck()
    {
        return $this->healthCheck->GetHealthCheck();
    }

    //TOKENS

    public function GetAuthenticationToken($model)
    {
        return $this->tokenService->GetAuthenticationToken($model);
    }

    public function GetPaymentToken($paymentModel, $authToken, $secretKey)
    {
        return $this->tokenService->GetPaymentToken($paymentModel, $authToken, $secretKey);
    }

    //QUERYS

    public function GetTransactions($authToken, $transaccionId = "", $fechaDesde = "", $fechaHasta = "", $estadoTransaccion = "", $transaccionComercioId = "", $numeroSucursal = "", $caja = "", $pagina = "", $cantidad = "")
    {
        return $this->querysService->GetTransactions($authToken, $transaccionId, $fechaDesde, $fechaHasta, $estadoTransaccion, $transaccionComercioId, $numeroSucursal, $caja, $pagina, $cantidad);
    }

    public function GetTransactionByTxComercioId($authToken, $transaccionComercioId = "")
    {
        return $this->querysService->GetTransactionByTxComercioId($authToken, $transaccionComercioId);
    }

    public function GetTransactionsAgrupador ($authToken, $ente = "", $pagina = "", $cantidad = "")
    {
        return $this->querysService->GetTransactionsAgrupador($authToken, $ente, $pagina, $cantidad);
    }
    
    public function GetTxByTransaccionComercioIdAgrupador ($authToken, $transaccionComercioId)
    {
        return $this->querysService->GetTransactionByTxComercioIdAgrupador($authToken, $transaccionComercioId);
    }

    public function GetDataComercio ($authToken, $ente = "", $cuit = "", $qrData = "")
    {
        return $this->querysService->GetDataComercio($authToken, $ente, $cuit, $qrData);
    }

    public function GetAllPaymentMethods ($authToken)
    {
        return $this->querysService->GetAllPaymentMethods($authToken);
    }

    //REFUNDS

    public function Refund ($authToken, $model, $secretKey)
    {
        return $this->refundsService->ExecuteRefund($model, $authToken, $secretKey);
    }

    //CAJAS

    public function Caja ($model, $authToken, $secretKey)
    {
        return $this->cajaService->Caja($model, $authToken, $secretKey);
    }

    public function DeleteCajaById ($authToken, $cajaId)
    {
        return $this->cajaService->DeleteCajaById($authToken, $cajaId);
    }

    public function DeleteCajaByCodigo($authToken, $codigo)
    {
        return $this->cajaService->DeleteCajaByCodigo($authToken, $codigo);
    }

    public function GetDetailCajaById ($authToken, $cajaId)
    {
        return $this->cajaService->GetDetailCajaById($authToken, $cajaId);
    }

    public function GetDetailCajaByCodigo ($authToken, $codigo)
    {
        return $this->cajaService->GetDetailCajaByCodigo($authToken, $codigo);
    }

    //ORDER

    public function Order ($model, $codigo, $authToken, $secretKey, $ttlPreference = 0)
    {
        return $this->orderService->CreateOrder($model, $codigo, $authToken, $secretKey, $ttlPreference);
    }

    public function GetOrder ($authToken, $codigo)
    {
        return $this->orderService->GetOrder($authToken, $codigo);
    }

    public function GetOrderById ($authToken, $id)
    {
        return $this->orderService->GetOrderById($authToken, $id);
    }

    public function DeleteOrder ($authToken, $codigo)
    {
        return $this->orderService->DeleteOrder($authToken, $codigo);
    }

    public function GetOrderByCajaId ($authToken, $cajaId)
    {
        return $this->orderService->GetOrderByCajaId($authToken, $cajaId);
    }

    //PAYMENTS

    public function ExecutePayment ($model, $paymentToken, $authToken, $secretKey)
    {
        return $this->paymentService->ExecutePayment($model, $paymentToken, $authToken, $secretKey);
    }

    public function GetPaymentMethods ($authToken)
    {
        return $this->paymentService->GetPaymentMethods($authToken);
    }

    public function GetPaymentMethodsAgrupador($authToken, $ente)
    {
        return $this->paymentService->GetPaymentMethodsAgrupador($authToken, $ente);
    }

    public function DoPaymentRequest ($paymentData, $authToken, $secretKey)
    {
        return $this->paymentService->ExecuteStoredCardPayment($paymentData, $authToken, $secretKey);
    }

    public function SaveSaldoPlusPagos ($authToken, $model, $secretKey)
    {
        return $this->paymentService->SaveSaldoPlusPagos($authToken, $model, $secretKey);
    }

    public function GetPromotionWithDiscount ($authToken, $model, $secretKey)
    {
        return $this->paymentService->GetPromotionWithDiscount($authToken, $model, $secretKey);
    }

    public function StoreCard ($model, $authToken, $secretKey)
    {
        return $this->paymentService->StoreCard($model, $authToken, $secretKey);
    }

    public function DeleteStoredCardByUserId ($authToken, $userId, $cardId)
    {
        return $this->paymentService->DeleteStoredCard ($authToken, $userId, $cardId);
    }

    public function GetListadoTarjetasByUserId ($authToken, $userId)
    {
        return $this->paymentService->GetListadoTarjetasByUSerId ($authToken, $userId);
    }

    public function StoredCardPaymentRequest ($paymentModel, $authToken, $secretKey)
    {
        return $this->paymentService->StoredCardPayment($paymentModel, $authToken, $secretKey);
    }
}

?>