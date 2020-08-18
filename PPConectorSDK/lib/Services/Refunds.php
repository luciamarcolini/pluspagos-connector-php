<?php 
namespace PPConnectorSDK\Services;
use PPConnectorSDK\Models\Body;
use PPConnectorSDK\Package\Package;

class Refunds 
{
    
    private $endpoint;
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
        $headers = array();
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($endpoint, $headers);
        $this->package = new Package();
    }

    public function ExecuteRefund($model, $authToken, $secretKey)
    {
        $authorization  = sprintf("Authorization: Bearer %s", $authToken);
        $new_headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            $authorization
        );
        $this->restClient = new \PPConnectorSDK\Services\RESTClient($this->endpoint, $new_headers);
        $body = new Body();
        $body->body = $this->package->GetPackage($model, $secretKey);
        $json_body = json_encode($body);
        $RESTResponse = $this->restClient->post("refund", $json_body);
        return $RESTResponse;
    }
}