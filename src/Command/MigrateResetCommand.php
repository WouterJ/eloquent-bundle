<?php

namespace WouterJ\EloquentBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class MigrateResetCommand extends BaseMigrateCommand
{
    protected function configure()
    {
        $this->setName('eloquent:migrate:reset')
            ->setDescription('Rollback all database migrations')
            ->setHelp(<<<EOH
The <info>%command.name%</info> rolls back all migrations.

    <info>php %command.full_name%</info>
EOH
            )
            ->setDefinition([
                new InputOption('database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'),
                new InputOption('force', null, InputOption::VALUE_NONE, 'Force the operation to run in production.'),
                new InputOption('pretend', null, InputOption::VALUE_NONE, 'Dump the SQL queries that would be run.'),
            ])
        ;
    }

    protected function execute(InputInterface $i, OutputInterface $o)
    {
        if (!$i->getOption('force') && !$this->askConfirmationInProd($i, $o)) {
            return;
        }

        $migrator = $this->getMigrator();
        $migrator->setConnection($i->getOption('database'));

        if (!$migrator->repositoryExists()) {
            $o->writeln('<error>Migration table not found.</>');

            return 1;
        }

        $migrator->reset($i->getOption('pretend'));

        foreach ($migrator->getNotes() as $note) {
            $o->writeln($note);
        }
    }
}
