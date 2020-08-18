<?php 
namespace PPConnectorSDK\Services;

 class RESTClient 
 {
    private $endpoint;
    private $headers = array();
	private $url = NULL;
	private $statusCodeResponse = array(200, 201, 204);

	public function __construct($endpoint, $headers)
	{
        $this->endpoint = $endpoint;
        $this->headers = $headers;
    }
    
	public function setUrl($url)
	{
		$this->url = $this->endpoint.$url;
	}

	public function getUrl($url)
	{
		return $this->url;
	}


	public function get($action, $data, $query = array()) 
	{
		$this->setUrl($action);
		return $this->RESTService("GET", $data, $query);
	}

	public function post($action, $data)
	{
		$this->setUrl($action);

		return $this->RESTService("POST", $data);
	}

	public function put($action, $data)
	{
		$this->setUrl($action);

		return $this->RESTService("PUT", $data);
	}

	public function delete($action, $data)
	{
		$this->setUrl($action);

		return $this->RESTService("DELETE", $data);
	}
	//RESTResource
	private function RESTService($method = "GET", $data, $query = array())
	{
		
		$header_http = array(
			'Cache-Control: no-cache',
			'content-type: application/json',
		);

		$curl = curl_init();
		if(count($query) > 0) 
		{
			curl_setopt($curl, CURLOPT_URL, $this->url."?".http_build_query($query));
		} else 
		{
			curl_setopt($curl, CURLOPT_URL, $this->url);
		}
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_ENCODING, "");
		curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30000);
		curl_setopt($curl, CURLOPT_TIMEOUT, 60000);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		set_time_limit(120);
		if (empty($this->headers))
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header_http);
		}
		else 
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
		}

		$response = curl_exec($curl);
		$codeResponse = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if($response == false && !in_array($codeResponse, $this->statusCodeResponse))
		{
			$err = "curl error: ".curl_error($curl);
			throw new \Exception($err);
		}

		curl_close($curl);
		return $response;
	}
 }
?>