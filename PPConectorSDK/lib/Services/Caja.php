<?php 
namespace PPConnectorSDK\Services;
use PPConnectorSDK\Models\Body;
use PPConnectorSDK\Package\Package;

class Caja 
{
    
    private $endpoint;
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
        $headers = array();
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($endpoint, $headers);
        $this->package = new Package();
    }
    
    public function Caja ($model, $authToken, $secretKey)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body_model = new Body();
        $body_model->body = $this->package->GetPackage($model, $secretKey);
        $json_model = json_encode($body_model);
        $RESTResponse = $this->restClient->post("caja", $json_model);
        return $RESTResponse;
    }

    public function DeleteCajaById ($authToken, $cajaId)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->delete("caja/delete?cajaId=".$cajaId, "");
        return $RESTResponse;
    }

    public function DeleteCajaByCodigo ($authToken, $codigo)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->delete("caja/delete?codigo=".$codigo, "");
        return $RESTResponse;
    }

    public function GetDetailCajaById ($authToken, $cajaId)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->get("caja-details/detail?cajaId=".$cajaId, "");
        return $RESTResponse;
    }

    public function GetDetailCajaByCodigo ($authToken, $codigo)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $RESTResponse = $this->restClient->get("caja-details/detail?codigo=".$codigo, "");
        return $RESTResponse;
    }
}

?>