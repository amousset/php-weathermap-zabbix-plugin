<?php

class WeatherMapPostProcessorZabbix extends WeatherMapPostProcessor 
{
	function run(&$map)
	{
		$enable = $map->get_hint('post_zabbix_graphs');

		if($enable)
		{
			$this->zabbixApi = new SimpleZabbixApi($map->get_hint('zabbix_url'), $map->get_hint('zabbix_user'), $map->get_hint('zabbix_password'));
			if ($this->zabbixApi->isConnected()) {
				$keyname = $map->get_hint('post_zabbix_key');
				$baseUrl = $map->get_hint('post_zabbix_graph_base_url');
				$addGraphLink = $map->get_hint('post_zabbix_graph_link');
				$graphWidth = $map->get_hint('post_zabbix_graph_width');
				$graphHeight = $map->get_hint('post_zabbix_graph_height');
				$graphPeriod = $map->get_hint('post_zabbix_graph_period');

				foreach (array_merge($map->links, $map->nodes) as $item) {
					foreach (range(0, 1) as $k) {
						$graph = $item->overliburl[$k];

						if (count($graph) == 1) {
							if(preg_match('/^zabbix:([-a-zA-Z0-9_\.\/]+):([-a-zA-Z0-9_\.\/]+)$/', $graph[0], $matches))
							{
								$host = $matches[1];
								$key = $matches[2];

								wm_debug ("Zabbix ReadData: Found (".$host.",".$key.")\n");

								$graphId = $this->zabbixApi->getGraphId($host, $keyname, $key);
								if (isset($graphId)) {
									if ($addGraphLink) { 
										$item->infourl[$k] = $baseUrl.'/charts.php?form_refresh=1&fullscreen=0&graphid='.$graphId;
									}
									$item->overliburl[$k][0] = $baseUrl.'/chart2.php?width='.$graphWidth.'&height='.
										$graphHeight.'&period='.$graphPeriod.'&stime=now&graphid='.$graphId;
								}
							}
						}
					}
				}
			}
		}
	}
}
