# Zabbix plugin for PHP Network Weathermap

This plugin integrates the Zabbix monitoring tool into [PHP Weathermap](http://www.network-weathermap.com), using [Zabbix JSON API](https://www.zabbix.com/documentation/2.0/manual/appendix/api/api).

## Installation

Copy the content of the `lib` folder into the `lib` folder of your PHP Weathermap installation.

### Configuration of the new datasource for traffic

You have to configure the following parameters in your weathermap file global settings:

* `SET zabbix_user username` : Zabbix username
* `SET zabbix_password password` : Zabbix password
* `SET zabbix_url http://zabbix/zabbix/api_jsonrpc.php` : the Zabbix API URL
* `SET zabbix_key name` : the attributes you want to use to select items in the configuration

You can connect with a `guest` account by ommitting the password parameter.

To configure a link, use the following syntax:

```
TARGET zabbix:hostname:input_item_name:output_item_name
```

For example:

```
TARGET zabbix:switch-01:GigabitEthernet3/8-IN:GigabitEthernet3/8-OUT
```

### Configuration of the Zabbix graphs integration

You have to configure the following parameters in yoour weathermap file:

* `SET post_zabbix_graphs 1` : enable the overlib graphs
* `SET post_zabbix_graph_links 1` : enable the links to the graph page in Zabbix
* `SET post_zabbix_graph_base_url https://zabbix/zabbix` : the URL to the Zabbix frontend for the graphs links
* `SET post_zabbix_key name` : the attributes you want to use to select graphs in the configuration
* `SET post_zabbix_graph_width 420` : the graphs width in pixels
* `SET post_zabbix_graph_height 150` : the graph height in pixels
* `SET post_zabbix_graph_period 86400` : the graph period in seconds

To configure a graph, use the following syntax:

```
OVERLIBGRAPH overliburl:hostname:graph_name
```

```
OVERLIBGRAPH overliburl:switch-01:GigabitEthernet3/8
```

## TODO

* Improve the Zabbix API part or use an existing library
* Add support for links and graphs on nodes

## License

This plugins is licensed under GPLv2.
