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
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Command\Command;

/**
 * Loads tasks for ORM
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait loadOrmTasks
{
    /**
     * Clear all metadata cache of the various cache drivers
     */
    public function ormClear_cacheMetadata($opt = ['flush' => false])
    {
        $command = new Command\ClearCache\MetadataCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Clear all result cache of the various cache drivers
     */
    public function ormClear_cacheResult($opt = ['flush' => false])
    {
        $command = new Command\ClearCache\ResultCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Clear all query cache of the various cache drivers
     */
    public function ormClear_cacheQuery($opt = ['flush' => false])
    {
        $command = new Command\ClearCache\QueryCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Processes the schema and either create it directly on EntityManager Storage Connection or generate the SQL output
     */
    public function ormSchemaCreate($opt = ['dump-sql' => false])
    {
        $command = new Command\SchemaTool\CreateCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Executes (or dumps) the SQL needed to update the database schema to match the current mapping metadata
     */
    public function ormSchemaUpdate($opt = ['dump-sql' => false, 'force' => false, 'complete' => false])
    {
        $command = new Command\SchemaTool\UpdateCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Drop the complete database schema of EntityManager Storage Connection or generate the corresponding SQL output
     */
    public function ormSchemaDrop($opt = ['dump-sql' => false, 'force' => false, 'full-database' => false])
    {
        $command = new Command\SchemaTool\DropCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Verify that Doctrine is properly configured for a production environment
     */
    public function ormEnsure_production_settings($opt = ['complete' => false])
    {
        $command = new Command\EnsureProductionSettingsCommand;

        $this->runDoctrineCommand($command);
    }

    /**
     * Adds options to a symfony command
     *
     * @param Command $command
     * @param array   $opt
     */
    protected function runDoctrineCommand(Command $command, array $opt)
    {
        $helperSet = $this->getEntityManagerHelperSet();
        $command->setHelperSet($helperSet);

        $command = $this->taskSymfonyCommand($command);

        foreach ($opt as $key => $value) {
            $command->opt($key, $value);
        }

        $command->run();
    }

    /**
     * Returns an EntityManager helper set
     */
    abstract protected function getEntityManagerHelperSet();
}
