<?php 
namespace PPConnectorSDK\Services;
use PPConnectorSDK\Models\Body;
use PPConnectorSDK\Package\Package;

class Orders 
{
    private $endpoint;
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
        $headers = array();
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($endpoint, $headers);
        $this->package = new Package();
    }

    public function CreateOrder ($model, $codigo, $authToken, $secretKey, $ttlPreference)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $preference = sprintf("X-Ttl-Preference: %d", $ttlPreference);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization,
            $preference
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body = new Body();
        $body->body = $this->package->GetPackage($model, $secretKey);
        $json_body = json_encode($body);
        $RESTResponse = $this->restClient->post("order/".$codigo, $json_body);
        return $RESTResponse;
    }

    public function GetOrder ($authToken, $codigo)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->get("order/".$codigo, "");
        return $RESTResponse;
    }

    public function GetOrderById ($authToken, $id)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->get("getorder/".$id, "");
        return $RESTResponse;
    }

    public function DeleteOrder ($authToken, $codigo)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->delete("order/".$codigo, "");
        return $RESTResponse;
    }

    public function GetOrderByCajaId ($authToken, $cajaId)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->get("caja/".$cajaId, "");
        return $RESTResponse;
    }
}
?>