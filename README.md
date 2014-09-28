# Zabbix plugin for PHP Network Weathermap

This plugin inegrates Zabbix into PHP Weathermap, using Zabbix API.

## Installation

Copy the content of the `lib` folder into the `lib` folder of your PHP Weathermap installation.

### Configuration of the new datasource for traffic

You have to configure the following parameters in yoour weathermap file :

* `SET zabbix_user username` : Zabbix username
* `SET zabbix_password password` : Zabbix password
* `SET zabbix_url http://zabbix/zabbix/api_jsonrpc.php` : the URL to the Zabbix API
* `SET zabbix_key name` : the attributes you want to use to select items in the configuration

You can connect with a guest account by ommitting the password parameter :

```SET zabbix_user guest```

### Configuration of the Zabbix graphs integration

You have to configure the following parameters in yoour weathermap file :

* `SET post_zabbix_graphs 1` : enable the overlib graphs
* `SET post_zabbix_graph_links 1` : enable the links to the graph page in Zabbix
* `SET post_zabbix_graph_base_url https://zabbix/zabbix/chart2.php` : the URL to the Zabbix frontend
* `SET post_zabbix_graph_width 420` : the graphs width in pixels
* `SET post_zabbix_graph_height 150` : the graph height in pixels
* `SET post_zabbix_graph_period 86400` : the graph period in seconds

## License

This plugins is licensed under 
