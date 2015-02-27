# Zabbix plugin for PHP Network Weathermap

This plugin integrates the Zabbix monitoring tool into [PHP Weathermap](http://www.network-weathermap.com), using [Zabbix JSON API](https://www.zabbix.com/documentation/2.0/manual/appendix/api/api).

## Requirements

The plugins requires:
* Zabbix >= 2.0 (but it is probably easy to adapt it for older releases)
* PHP Network Weathermap >= 0.97b (but it is easy to adapt it for older releases)

## Installation

Copy the content of the `lib` folder into the `lib` folder of your PHP Weathermap installation.

## Configuration

### Configuration of the new datasource for traffic

You have to configure the following parameters in your weathermap file global settings:

---

`SET zabbix_user username`

Zabbix username you want to connect with.

---

`SET zabbix_password password`

Zabbix password for the given user, you can connect with a `guest` account by ommitting this parameter.

---

`SET zabbix_url http://zabbix/zabbix/api_jsonrpc.php`

The Zabbix API URL used to make requests.

---

To configure a link, use the following `TARGET` syntax:

```
TARGET zabbix:keyname:hostname:input_item_name:output_item_name
```

with:

* `keyname`: the attribute you want to use to select items in the configuration, possible values:
  * `name` refers to the item name configured in Zabbix
  * `key_` refers to the key configured in Zabbix
  * `itemid` refers to the item id used by Zabbix
* `hostname`: the hostname of the host you want to use
* `input_item_name`: the input item identifier (according to what you put as keyname)
* `output_item_name`: the output item identifier (according to what you put as keyname)

For example:

```
TARGET zabbix:name:switch-01:GigabitEthernet3/8-IN:GigabitEthernet3/8-OUT
```

### Configuration of the Zabbix graphs integration

You have to configure the following parameters in yoour weathermap file:

---

`SET post_zabbix_graphs 1`

Enable the Zabbix integration for overlib graphs, using a specific `OVERLIBGRAPH` syntax.

---

`SET post_zabbix_graph_link 1`

Enable the links to the graph page in Zabbix, overriding the `INFOURL` links with link to a Zabbix graph.

---

`SET post_zabbix_graph_base_url https://zabbix/zabbix`

The URL to the Zabbix frontend used to generate the graphs links.

---

`SET post_zabbix_graph_width 420`

The graphs width in pixels, use `OVERLIBWIDTH` to improve the positionning of the popup image. This is the width of the actual graph, and the image will be larger.

---

`SET post_zabbix_graph_height 150`

The graph height in pixels, use `OVERLIBHEIGHT` to improve the positionning of the popup image. This is the height of the actual graph, and the image will be larger.

---

`SET post_zabbix_graph_period 86400`

The graph period in seconds.

---

To configure a graph, use the following `OVERLIBGRAPH` syntax, for nodes and links:

```
OVERLIBGRAPH zabbix:keyname:hostname:graph_name
```

with:

* `keyname`: the attribute you want to use to select items in the configuration, possible values:
  * `name` refers to the graph name configured in Zabbix
  * `graphid` refers to the graph is used by Zabbix
* `hostname`: the hostname of the host you want to use
* `graph_name`: the graph identifier (according to what you put as keyname)

For example:

```
OVERLIBGRAPH zabbix:name:switch-01:GigabitEthernet3/8
```

It can also be used with `INOVERLIBGRAPH` and `OUTOVERLIBGRAPH` (for links only):

```
INOVERLIBGRAPH zabbix:name:switch-01:GigabitEthernet3/8-IN
OUTOVERLIBGRAPH zabbix:name:switch-01:GigabitEthernet3/8-OUT
```

The generated `INFOURL` will be a link to the configured graph in your Zabbix frontend.

## TODO

* Improve the Zabbix API part or use an existing library
* Add support for other link attributes

## License

This plugins is licensed under GPLv2.