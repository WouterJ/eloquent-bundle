<?php

namespace WouterJ\EloquentBundle\Migrations;

use Illuminate\Database\Migrations\MigrationCreator;

/**
 * A bridge between Illuminate\Database and Symfony.
 *
 * This removes the dependency on Illuminate\Filesystem in favor
 * of PHP's file_*_contents() functions for filesystem tasks.
 *
 * @author Wouter de Jong <wouter@wouterj.nl>
 */
class Creator extends MigrationCreator
{
    // Override constructor to remove Illuminate\Filesystem dep
    public function __construct()
    { }

    /** {@inheritdoc} */
    public function create($name, $path, $table = null, $create = false)
    {
        $path = $this->getPath($name, $path);
        $stub = $this->getStub($table, $create);

        file_put_contents($path, $this->populateStub($name, $stub, $table));

        $this->firePostCreateHooks();

        return $path;
    }

    /** {@inheritdoc} */
    protected function getStub($table, $create)
    {
        $file = 'blank.stub';
        if (null !== $table) {
            $file = $create ? 'create.stub' : 'update.stub';
        }

        file_get_contents($this->getStubPath().'/'.$file);
    }
}
