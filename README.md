# Zabbix plugin for PHP Network Weathermap

This plugin integrates the Zabbix monitoring tool into [PHP Weathermap](http://www.network-weathermap.com), using [Zabbix JSON API](https://www.zabbix.com/documentation/2.0/manual/appendix/api/api).

## Requirements

The plugins requires:
* Zabbix >= 2.0 (but it is probably easy to adapt it for older releases)
* PHP Network Weathermap >= 0.97b (but it is easy to adapt it for older releases)

## Installation

Copy the content of the `lib` folder into the `lib` folder of your PHP Weathermap installation.

## Documentation

A complete documentation is available on the project [wiki](https://github.com/amousset/php-weathermap-zabbix-plugin/wiki).

## TODO

* Improve the Zabbix API part or use an existing library
* Add support for other link attributes

## License

This plugins is licensed under GPLv2.
