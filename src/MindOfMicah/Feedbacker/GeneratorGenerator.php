<?php

namespace MindOfMicah\Feedbacker;

use Illuminate\Foundation\Artisan;

class GeneratorGenerator
{
    protected $artisan;

    const GEN_MIGRATION = 1;
    const GEN_MODEL = 2;

    /**
     * Generate the laravel generators based off of passed in information
     *
     * @param string  $name   Name of the model / table
     * @param string  $fields Which fields will be added to the table
     * @param integer $flags  Flag to denote which generators should be fired
     *
     * @return boolean
     */
    public function generate($name, $fields, $flags = null)
    {
        if (is_null($this->artisan)) {
            throw new \Exception;
        }

        if ($flags & self::GEN_MIGRATION) {
            $this->artisan->call(
                'generate:migration', 
                ['migrationName' => $this->buildMigrationName($name), 'fields' => $fields]
            );
        }

        if ($flags & self::GEN_MODEL) {
            $this->artisan->call(
                'generate:model', 
                ['modelName' => $name
            ]);
        }
        return true;
    }

    /**
     * Create the name to be used in creating the database migration
     *
     * @param string $name name of the model/table
     *
     * @return string
     */
    private function buildMigrationName($name)
    {
        return "create_{$name}_table";
    }

    /**
     * Setter injection to be able to run artisan commands from the class
     *
     * @param Artisan $artisan Instance of artisan to run commands
     *
     * @return GeneratorGenerator
     */
    public function artisan(Artisan $artisan)
    {
        $this->artisan = $artisan;
        return $this;
    }
}
