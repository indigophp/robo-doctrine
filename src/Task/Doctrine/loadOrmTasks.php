<?php

/*
 * This file is part of the Robo Doctrine package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Robo\Task\Doctrine;

use Doctrine\ORM\Tools\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

/**
 * Loads tasks for ORM
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait loadOrmTasks
{
    /**
     * Clear all metadata cache of the various cache drivers
     *
     * @param array $opt
     *
     * @option $flush If defined, cache entries will be flushed instead of deleted/invalidated
     */
    public function ormClearCacheMetadata($opt = ['flush' => false])
    {
        $validOpts = ['flush'];
        $command = new Command\ClearCache\MetadataCommand;

        $this->runDoctrineCommand($command, $opt, $validOpts);
    }

    /**
     * Clear all result cache of the various cache drivers
     *
     * @param array $opt
     *
     * @option $flush If defined, cache entries will be flushed instead of deleted/invalidated
     */
    public function ormClearCacheResult($opt = ['flush' => false])
    {
        $validOpts = ['flush'];
        $command = new Command\ClearCache\ResultCommand;

        $this->runDoctrineCommand($command, $opt, $validOpts);
    }

    /**
     * Clear all query cache of the various cache drivers
     *
     * @param array $opt
     *
     * @option $flush If defined, cache entries will be flushed instead of deleted/invalidated
     */
    public function ormClearCacheQuery($opt = ['flush' => false])
    {
        $validOpts = ['flush'];
        $command = new Command\ClearCache\QueryCommand;

        $this->runDoctrineCommand($command, $opt, $validOpts);
    }

    /**
     * Processes the schema and either create it directly on EntityManager Storage Connection or generate the SQL output
     *
     * @param array $opt
     *
     * @option $dump-sql Instead of try to apply generated SQLs into EntityManager Storage Connection, output them
     */
    public function ormSchemaCreate($opt = ['dump-sql' => false])
    {
        $validOpts = ['dump-sql'];
        $command = new Command\SchemaTool\CreateCommand;

        $this->runDoctrineCommand($command, $opt, $validOpts);
    }

    /**
     * Executes (or dumps) the SQL needed to update the database schema to match the current mapping metadata
     *
     * @param array $opt
     *
     * @option $dump-sql Dumps the generated SQL statements to the screen (does not execute them)
     * @option $force    Causes the generated SQL statements to be physically executed against your database
     * @option $complete If defined, all assets of the database which are not relevant to the current metadata will be dropped
     */
    public function ormSchemaUpdate($opt = ['dump-sql' => false, 'force' => false, 'complete' => false])
    {
        $validOpts = ['dump-sql', 'force', 'complete'];
        $command = new Command\SchemaTool\UpdateCommand;

        $this->runDoctrineCommand($command, $opt, $validOpts);
    }

    /**
     * Drop the complete database schema of EntityManager Storage Connection or generate the corresponding SQL output
     *
     * @param array $opt
     *
     * @option $dump-sql Instead of try to apply generated SQLs into EntityManager Storage Connection, output them
     * @option $force    Don't ask for the deletion of the database, but force the operation to run
     * @option $complete Instead of using the Class Metadata to detect the database table schema, drop ALL assets that the database contains
     */
    public function ormSchemaDrop($opt = ['dump-sql' => false, 'force' => false, 'full-database' => false])
    {
        $validOpts = ['dump-sql', 'force', 'full-database'];
        $command = new Command\SchemaTool\DropCommand;

        $this->runDoctrineCommand($command, $opt, $validOpts);
    }

    /**
     * Verify that Doctrine is properly configured for a production environment
     *
     * @param array $opt
     *
     * @option $complete Flag to also inspect database connection existence
     */
    public function ormEnsureProductionSettings($opt = ['complete' => false])
    {
        $validOpts = ['complete'];
        $command = new Command\EnsureProductionSettingsCommand;

        $this->runDoctrineCommand($command, $opt, $validOpts);
    }

    /**
     * Converts Doctrine 1.X schema into a Doctrine 2.X schema
     *
     * @param string $fromPath The path of Doctrine 1.X schema information
     * @param string $toType   The destination Doctrine 2.X mapping type
     * @param string $destPath The path to generate your Doctrine 2.X mapping information
     * @param array  $from     Optional paths of Doctrine 1.X schema information
     * @param array  $opt
     *
     * @option $extend     Defines a base class to be extended by generated entity classes
     * @option $num-spaces Defines the number of indentation spaces
     */
    public function ormConvertD1Schema(
        $fromPath,
        $toType,
        $destPath,
        $from,
        $to,
        $opt = ['extend' => null, 'num-spaces' => 4]
    ) {
        $validOpts = ['extend', 'num-spaces'];
        $command = new Command\ConvertDoctrine1SchemaCommand;

        $arg = [
            'from-path' => $fromPath,
            'to-type'   => $toType,
            'dest-path' => $destPath,
            'from'      => $from,
            'to'        => $to,
        ];

        $this->runDoctrineCommand($command, $opt, $validOpts, $arg);
    }

    /**
     * Generate repository classes from your mapping information
     *
     * @param string $destPath The path to generate your repository classes
     * @param array  $opt
     *
     * @option $filter A string pattern used to match entities that should be processed
     */
    public function ormGenerateRepositories($destPath, $opt = ['filter' => null])
    {
        $validOpts = ['filter'];
        $command = new Command\GenerateRepositoriesCommand;

        $arg = [
            'dest-path' => $destPath,
        ];

        $this->runDoctrineCommand($command, $opt, $validOpts, $arg);
    }

    /**
     * Generate entity classes and method stubs from your mapping information
     *
     * @param string $destPath The path to generate your repository classes
     * @param array  $opt
     *
     * @option $filter               A string pattern used to match entities that should be processed
     * @option $generate-annotations Flag to define if generator should generate annotation metadata on entities
     * @option $generate-methods     Flag to define if generator should generate stub methods on entities
     * @option $regenerate-entities  Flag to define if generator should regenerate entity if it exists
     * @option $update-entities      Flag to define if generator should only update entity if it exists
     * @option $extend               Defines a base class to be extended by generated entity classes
     * @option $num-spaces           Defines the number of indentation spaces
     */
    public function ormGenerateEntities(
        $destPath,
        $opt = [
            'filter'               => null,
            'generate-annotations' => false,
            'generate-methods'     => true,
            'regenerate-entities'  => false,
            'update-entities'      => true,
            'extend'               => false,
            'num-spaces'           => 4,
        ]
    ){
        $validOpts = [
            'filter',
            'generate-annotations',
            'generate-methods',
            'regenerate-entities',
            'update-entities',
            'extend',
            'num-spaces',
        ];
        $command = new Command\GenerateEntitiesCommand;

        $arg = [
            'dest-path' => $destPath,
        ];

        $this->runDoctrineCommand($command, $opt, $validOpts, $arg);
    }

    /**
     * Generates proxy classes for entity classes
     *
     * @param string $destPath The path to generate your proxy classes. If none is provided, it will attempt to grab from configuration
     * @param array  $opt
     *
     * @option $filter A string pattern used to match entities that should be processed
     */
    public function ormGenerateProxies($destPath = null, $opt = ['filter' => null])
    {
        $validOpts = ['filter'];
        $command = new Command\GenerateProxiesCommand;

        $arg = [
            'dest-path' => $destPath,
        ];

        $this->runDoctrineCommand($command, $opt, $validOpts, $arg);
    }

    /**
     * Convert mapping information between supported formats
     *
     * @param string $toType   The mapping type to be converted
     * @param string $destPath The path to generate your entities classes
     * @param array  $opt
     *
     * @option $filter        A string pattern used to match entities that should be processed
     * @option $force         Force to overwrite existing mapping files
     * @option $from-database Whether or not to convert mapping information from existing database
     * @option $extend        Defines a base class to be extended by generated entity classes
     * @option $num-spaces    Defines the number of indentation spaces
     * @option $namespace     Defines a namespace for the generated entity classes, if converted from database
     */
    public function ormConvertMapping(
        $toType,
        $destPath,
        $opt = [
            'filter'        => null,
            'force'         => null,
            'from-database' => null,
            'extend'        => null,
            'num-spaces'    => 4,
            'namespace'     => null,
        ]
    ) {
        $validOpts = [
            'filter',
            'force',
            'from-database',
            'extend',
            'num-spaces',
            'namespace',
        ];
        $command = new Command\ConvertMappingCommand;

        $arg = [
            'to-type'   => $toType,
            'dest-path' => $destPath,
        ];

        $this->runDoctrineCommand($command, $opt, $validOpts, $arg);
    }

    /**
     * Executes arbitrary DQL directly from the command line
     *
     * @param string $dql The DQL to execute
     * @param array  $opt
     *
     * @option $hydrate      Hydration mode of result set. Should be either: object, array, scalar or single-scalar
     * @option $first-result The first result in the result set
     * @option $max-result   The maximum number of results in the result set
     * @option $depth        Dumping depth of Entity graph
     */
    public function ormRunDql(
        $dql,
        $opt = [
            'hydrate'      => 'object',
            'first-result' => null,
            'max-result'   => null,
            'depth'        => 7,
        ]
    ) {
        $validOpts = [
            'hydrate',
            'first-result',
            'max-result',
            'depth',
        ];
        $command = new Command\RunDqlCommand;

        $arg = [
            'dql' => $dql,
        ];

        $this->runDoctrineCommand($command, $opt, $arg);
    }

    /**
     * Validate the mapping files
     */
    public function ormValidateSchema()
    {
        $command = new Command\ValidateSchemaCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Show basic information about all mapped entities
     */
    public function ormInfo()
    {
        $command = new Command\InfoCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Adds options to a symfony command
     *
     * @param SymfonyCommand $command
     * @param array          $opt
     * @param array          $validOpts
     * @param array          $arg
     */
    protected function runDoctrineCommand(SymfonyCommand $command, array $opt = [], array $validOpts = [], array $arg = [])
    {
        $helperSet = $this->getEntityManagerHelperSet();
        $command->setHelperSet($helperSet);

        $command = $this->taskSymfonyCommand($command);

        foreach ($opt as $key => $value) {
            if (!in_array($key, $validOpts)) {
                continue;
            }

            $command->opt($key, $value);
        }

        foreach ($arg as $key => $value) {
            $command->arg($key, $value);
        }

        $command->run();
    }

    /**
     * Returns an EntityManager helper set
     */
    abstract protected function getEntityManagerHelperSet();
}
