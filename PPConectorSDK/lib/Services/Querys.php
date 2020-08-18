<?php 
namespace PPConnectorSDK\Services;

class Querys 
{
    
  private $endpoint;
  public function __construct($endpoint)
  {
	$this->endpoint = $endpoint;
	$headers = array();
	$this->restClient = new \PPConnectorSDK\Services\RESTClient($endpoint, $headers);
  }

  public function GetTransactions ($authToken, $transaccionId = "", $fechaDesde = "", $fechaHasta = "", $estadoTransaccion = "", $transaccionComercioId = "", $numeroSucursal = "", $caja = "", $pagina = "", $cantidad = "")
  {
	$authorization  = sprintf("Authorization: Bearer %s", $authToken);
	$new_headers = array(
		'Cache-Control: no-cache',
		'content-type: application/json',
		$authorization
	);
	$this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
	$querys = sprintf("?transaccionId=%s&fechaDesde=%s&fechaHasta=%s&estadoTransaccion=%s&transaccionComercioId=%s&numeroSucursal=%s&caja=%s&pagina=%s&cantidad=%s", $transaccionId, $fechaDesde, $fechaHasta, $estadoTransaccion, $transaccionComercioId, $numeroSucursal, $caja, $pagina, $cantidad);
	$RESTResponse = $this->restClient->get(sprintf("transactions%s", $querys), "");
	return $RESTResponse;
  }

  public function GetTransactionByTxComercioId($authToken, $transaccionComercioId = "")
  {
	$authorization  = sprintf("Authorization: Bearer %s", $authToken);
	$new_headers = array(
		'Cache-Control: no-cache',
		'content-type: application/json',
		$authorization
	);
	$this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
	$RESTResponse = $this->restClient->get(sprintf("transaction/%s", $transaccionComercioId), "");
	return $RESTResponse;
  }

  public function GetTransactionsAgrupador($authToken, $ente = "", $pagina = "", $cantidad = "")
  {
	$authorization  = sprintf("Authorization: Bearer %s", $authToken);
	$new_headers = array(
		'Cache-Control: no-cache',
		'content-type: application/json',
		$authorization
	);
	$this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
	$RESTResponse = $this->restClient->get("grouper-transactions?ente=".$ente."&pagina=".$pagina."&cantidad=".$cantidad, "");
	return $RESTResponse;
  }

  public function GetTransactionByTxComercioIdAgrupador ($authToken, $transaccionComercioId)
  {
	$authorization  = sprintf("Authorization: Bearer %s", $authToken);
	$new_headers = array(
		'Cache-Control: no-cache',
		'content-type: application/json',
		$authorization
	);
	$this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
	$RESTResponse = $this->restClient->get("grouper-transaction/".$transaccionComercioId, "");
	return $RESTResponse;
  }

  public function GetDataComercio($authToken, $ente, $cuit, $qrData)
  {
	$authorization  = sprintf("Authorization: Bearer %s", $authToken);
	$new_headers = array(
		'Cache-Control: no-cache',
		'content-type: application/json',
		$authorization
	);
	$this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
	$RESTResponse = $this->restClient->get("get-data-comercio?ente=".$ente."&cuit=".$cuit."&qrData=".$qrData, "");
	return $RESTResponse;
  }

  public function GetAllPaymentMethods($authToken)
  {
	$authorization  = sprintf("Authorization: Bearer %s", $authToken);
	$new_headers = array(
		'Cache-Control: no-cache',
		'content-type: application/json',
		$authorization
	);
	$this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
	$RESTResponse = $this->restClient->get("payment-methods-all", "");
	return $RESTResponse;
  }
}

?>