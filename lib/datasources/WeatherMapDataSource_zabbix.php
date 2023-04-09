<?php
// Zabbix pluggable datasource for PHP Weathermap 0.9
// - reads a pair of values from the JSON API

// TARGET zabbix:host:in:out

require_once(__DIR__."/../SimpleZabbixApi.php");

class WeatherMapDataSource_zabbix extends WeatherMapDataSource {

	private $zabbixApi;

	function Init(&$map)
	{
		$this->zabbixApi = new SimpleZabbixApi($map->get_hint('zabbix_url'), $map->get_hint('zabbix_user'), $map->get_hint('zabbix_password'));
		return $this->zabbixApi->isConnected();
	}

	function Recognise($targetstring)
	{
		if(preg_match("/^zabbix:([-a-zA-Z0-9_\.\/\[\]]+):([-a-zA-Z0-9_\.\/\[\]]+):([-a-zA-Z0-9_\.\/\[\],]+):([-a-zA-Z0-9_\.\/\[\],]+)$/", $targetstring, $matches))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function ReadData($targetstring, &$map, &$item)
	{
		$data[IN] = null;
		$data[OUT] = null;
		$data_time = 0;

		if(preg_match("/^zabbix:([-a-zA-Z0-9_\.\/\[\]]+):([-a-zA-Z0-9_\.\/\[\],]+):([-a-zA-Z0-9_\.\/\[\]]+):([-a-zA-Z0-9_\.\/\[\],]+)$/", $targetstring, $matches))
		{
			$zabbix_uri = $map->get_hint('zabbix_uri');

			$zabbix_key = $matches[1];
			$host = $matches[2];
			$in = $matches[3];
			$out = $matches[4];

			wm_debug ("Zabbix ReadData: Found (".$host.",".$in.",".$out.")\n");

			$raw_out_value = $this->zabbixApi->getItemLastValue($host, $zabbix_key, $out);
			$raw_in_value = $this->zabbixApi->getItemLastValue($host, $zabbix_key, $in);
			$in_value = $raw_in_value["lastvalue"];
			$out_value = $raw_out_value["lastvalue"];
			$data_time = $raw_out_value["lastclock"];

			if (isset($in_value)) {
				$data[IN] = $in_value;
			}
			if (isset($out_value)) {
				$data[OUT] = $out_value;
			}
		}

		wm_debug("Zabbix ReadData: Returning (".($data[IN]===null?'null':$data[IN]).",".($data[OUT]===null?'null':$data[IN]).",$data_time)\n");

		return (array($data[IN], $data[OUT], $data_time));
	}
}
