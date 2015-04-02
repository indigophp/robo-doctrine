# Robo Doctrine

[![Latest Version](https://img.shields.io/github/release/indigophp/robo-doctrine.svg?style=flat-square)](https://github.com/indigophp/robo-doctrine/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/robo-doctrine.svg?style=flat-square)](https://packagist.org/packages/indigophp/robo-doctrine)

**Doctrine (DBAL, ORM) tasks for Robo Task Runner.**


## Install

Via Composer

``` bash
$ composer require indigophp/robo-doctrine
```


## Usage

1. Use one of the task loader traits in your `RoboFile`
2. Run commands as usual


### ORM commands

```
orm:clear-cache-metadata         Clear all metadata cache of the various cache drivers
orm:clear-cache-query            Clear all query cache of the various cache drivers
orm:clear-cache-result           Clear all result cache of the various cache drivers
orm:convert-d1-schema            Converts Doctrine 1.X schema into a Doctrine 2.X schema
orm:convert-mapping              Convert mapping information between supported formats
orm:ensure-production-settings   Verify that Doctrine is properly configured for a production environment
orm:generate-entities            Generate entity classes and method stubs from your mapping information
orm:generate-proxies             Generates proxy classes for entity classes
orm:generate-repositories        Generate repository classes from your mapping information
orm:info                         Show basic information about all mapped entities
orm:run-dql                      Executes arbitrary DQL directly from the command line
orm:schema-create                Processes the schema and either create it directly on EntityManager Storage Connection or generate the SQL output
orm:schema-drop                  Drop the complete database schema of EntityManager Storage Connection or generate the corresponding SQL output
orm:schema-update                Executes (or dumps) the SQL needed to update the database schema to match the current mapping metadata
orm:validate-schema              Validate the mapping files
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/robo-doctrine/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
