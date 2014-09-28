<?php
class SimpleZabbixApi {

	private $apiUrl = "";
	private $authToken = "";

	function __construct($apiUrl, $username, $password) {
		$this->apiUrl = $apiUrl;	
		return $this->auth($username, $password);
	}

	function isConnected() {
		return ($this->authToken != "");
	}

	function jsonRequest($data) {

		$jsonData = json_encode($data);	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
	
		curl_close($ch);
		return json_decode($response, true);
	}
	
	function request($method, $params) {
		$data = array(
			'jsonrpc' => '2.0',
			'method' => $method,
			'params' => $params,
			'id' => '2'
		);

		if ($this->authToken != "") {
			$data['auth'] = $this->authToken;
		}
		return $this->jsonRequest($data);
	}
	
	function auth($username, $password) {
		if (is_null($password)) {
			$login_params = array(
				'user' => $username
			);
		} else {
			$login_params = array(
				'user' => $username,
				'password' => $password
			);
		}

		$result = $this->request("user.login", $login_params);

		if (isset($result['result']) and $result['result'] != "") {
			$this->authToken = $result['result'];
			return true;
		} else {
			return false;
		}
	}
	
	function getItemLastValue($host, $keyname, $key) {
		$params = array(
			"output"=> "extend",
			"filter"=> array(
				$keyname => $key
			),
			"host"=> $host
		);
	
		$result = $this->request("item.get", $params);
	
		if (isset($result['result']) and count($result['result']) == 1) {
			return $result['result'][0]['lastvalue'];
		} else {
			return null;
		}
	}

	function getHostId($host) {
		$params = array(
			"filter"=> array(
				'limit' => 1
			),
			"host"=> $host
		);

		$result = $this->request("item.get", $params);

		if (isset($result['result']) and count($result['result']) > 0) {
			return $result['result'][0]['hostid'];
		} else {
			return null;
		}
	}

	function getGraphId($host, $keyname, $key) {
		$params = array(
			"output"=> "extend",
			"filter"=> array(
				$keyname => $key
			),
			"hostids"=> array(
				$this->getHostId($host)
			)
		);

		$result = $this->request("graph.get", $params);
	
		if (isset($result['result']) and count($result['result']) == 1) {
			return $result['result'][0]['graphid'];
		} else {
			return null;
		}
	}
}
