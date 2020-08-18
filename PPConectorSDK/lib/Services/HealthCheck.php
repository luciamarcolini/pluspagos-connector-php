<?php 
namespace PPConnectorSDK\Services;

class HealthCheck 
{
    
    public function __construct($endpoint)
    {
        $headers = array();
		$this->restClient = new \PPConnectorSDK\Services\RESTClient($endpoint, $headers);
    }
    
    public function GetHealthCheck ()
    {
        $RESTResponse = $this->restClient->get("health", "");
        return $RESTResponse;
    }
}

?>