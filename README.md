# Zabbix plugin for PHP Network Weathermap

This plugin integrates the Zabbix monitoring tool into [PHP Weathermap](http://www.network-weathermap.com), using [Zabbix JSON API](https://www.zabbix.com/documentation/2.0/manual/appendix/api/api).

## Requirements

The plugins requires:
* Zabbix >= 2.0 (but it is probably easy to adapt it for older releases)
* PHP Network Weathermap >= 0.97b (but it is easy to adapt it for older releases)

## Installation

Copy the content of the `lib` folder into the `lib` folder of your PHP Weathermap installation.

### Configuration of the new datasource for traffic

You have to configure the following parameters in your weathermap file global settings:

* `SET zabbix_user username` : Zabbix username you want to connect with.
* `SET zabbix_password password` : Zabbix password for the given user, you can connect with a `guest` account by ommitting this parameter.
* `SET zabbix_url http://zabbix/zabbix/api_jsonrpc.php` : The Zabbix API URL used to make requests.
* `SET zabbix_key name` : The attributes you want to use to select items in the configuration. `name` refers to the item name configured in Zabbix, `key_` to the item key.

To configure a link, use the following `TARGET` syntax:

```
TARGET zabbix:hostname:input_item_name:output_item_name
```

For example:

```
TARGET zabbix:switch-01:GigabitEthernet3/8-IN:GigabitEthernet3/8-OUT
```

### Configuration of the Zabbix graphs integration

You have to configure the following parameters in yoour weathermap file:

* `SET post_zabbix_graphs 1` : Enable the Zabbix integration for overlib graphs, using a specific `OVERLIBGRAPH` syntax.
* `SET post_zabbix_graph_links 1` : Enable the links to the graph page in Zabbix, overriding the `INFOURL` of links configured with a Zabbix graph.
* `SET post_zabbix_graph_base_url https://zabbix/zabbix` : The URL to the Zabbix frontend used to generate the graphs links.
* `SET post_zabbix_key name` : The attributes you want to use to select graphs in the configuration. `name` refers to the graph name configured in Zabbix.
* `SET post_zabbix_graph_width 420` : The graphs width in pixels,, use `OVERLIBWIDTH` with the same value to improve the positionning of the popup image.
* `SET post_zabbix_graph_height 150` : The graph height in pixels, use `OVERLIBHEIGHT` with the same value to improve the positionning of the popup image.
* `SET post_zabbix_graph_period 86400` : The graph period in seconds.

To configure a graph, use the following syntax:

```
OVERLIBGRAPH zabbix:hostname:graph_name
```

For example:

```
OVERLIBGRAPH zabbix:switch-01:GigabitEthernet3/8
```

## TODO

* Improve the Zabbix API part or use an existing library
* Add support for links and graphs on nodes, and maybe other link attributes

## License

This plugins is licensed under GPLv2.
