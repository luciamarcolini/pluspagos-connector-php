<?php 
namespace PPConnectorSDK\Services;
use PPConnectorSDK\Models\Body;
use PPConnectorSDK\Package\Package;

class Payment
{
    private $endpoint;
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
        $headers = array();
		$this->restClient = new \PPConnectorSDK\Services\RESTClient($endpoint, $headers);
        $this->package = new Package();
    }

    public function ExecutePayment($model, $paymentToken, $authToken, $secretKey)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $xToken  = sprintf("X-Token: %s", $paymentToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization,
            $xToken
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body_model = new Body();
        $body_model->body = $this->package->GetPackage($model, $secretKey, $paymentToken, true);
        $json_body = json_encode($body_model, JSON_UNESCAPED_UNICODE);
        $RESTResponse = $this->restClient->post("payment", $json_body);
        return $RESTResponse;
    }

    public function GetPaymentMethods ($authToken)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->get("payment-methods", "");
        return $RESTResponse;
    }

    public function GetPaymentMethodsAgrupador ($authToken, $ente)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->get("payment-methods-agrupador?Ente=".$ente, "");
        return $RESTResponse;
    }

    public function ExecuteStoredCardPayment ($paymentModel, $authToken, $secretKey)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body_model = new Body();
        $body_model->body = $this->package->GetPackage($paymentModel, $secretKey);
        $json_body = json_encode($body_model, JSON_UNESCAPED_UNICODE);
        $RESTResponse = $this->restClient->post("payment-request", $json_body);
        return $RESTResponse;
    }

    public function SaveSaldoPlusPagos ($authToken, $model, $secretKey)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body_model = new Body();
        $body_model->body = $this->package->GetPackage($model, $secretKey);
        $json_body = json_encode($body_model, JSON_UNESCAPED_UNICODE);
        $RESTResponse = $this->restClient->post("save-saldo", $json_body);
        return $RESTResponse;
    }

    public function StoreCard ($model, $authToken, $secretKey)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body_model = new Body();
        $body_model->body = $this->package->GetPackage($model, $secretKey, $secretKey, true);
        $json_body = json_encode($body_model, JSON_UNESCAPED_UNICODE);
        $RESTResponse = $this->restClient->post("store-card", $json_body);
        return $RESTResponse;
    }

    public function GetPromotionWithDiscount ($authToken, $model, $secretKey)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body_model = new Body();
        $body_model->body = $this->package->GetPackage($model, $secretKey);
        $json_body = json_encode($body_model, JSON_UNESCAPED_UNICODE);
        $RESTResponse = $this->restClient->post("get-promotion-with-discount", $json_body);
        return $RESTResponse;
    }

    public function DeleteStoredCard ($authToken, $userId, $cardId)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->post("stored-card/delete/".$userId."?CardId=".$cardId, "");
        return $RESTResponse;
    }

    public function GetListadoTarjetasByUserId ($authToken, $userId)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->get("list-cards?userId=".$userId, "");
        return $RESTResponse;
    }

    public function StoredCardPayment ($paymentModel, $authToken, $secretKey)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json;charset=utf-8',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body_model = new Body();
        $body_model->body = $this->package->GetPackage($paymentModel, $secretKey);
        $json_body = json_encode($body_model, JSON_UNESCAPED_UNICODE);
        $RESTResponse = $this->restClient->post("payment-stored-card-request", $json_body);
        return $RESTResponse;
    }
}

?>

