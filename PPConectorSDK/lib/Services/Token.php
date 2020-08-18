<?php 
namespace PPConnectorSDK\Services;
use PPConnectorSDK\Models\Body;
use PPConnectorSDK\Package\Package;
class Token 
{
    private $endpoint;
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
        $headers = array();
		$this->restClient = new \PPConnectorSDK\Services\RESTClient($endpoint, $headers);
        $this->package = new Package();
    }
    
    public function GetAuthenticationToken ($model)
    {
        $json_data = json_encode($model);
        $RESTResponse = $this->restClient->post("sesion", $json_data);
        return $RESTResponse;
    }

    public function GetPaymentToken ($model, $authToken, $secretKey)
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
        $RESTResponse = $this->restClient->post("tokens", $json_model);
        return $RESTResponse;
    }
}

?>