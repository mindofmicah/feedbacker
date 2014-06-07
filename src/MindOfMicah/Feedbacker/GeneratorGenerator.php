<?php

namespace MindOfMicah\Feedbacker;

use Illuminate\Foundation\Artisan;

class GeneratorGenerator
{
    protected $artisan;

    public function generate()
    {
        if (is_null($this->artisan)) {
            throw new \Exception;
        }

        return true;
    }

    public function artisan(Artisan $artisan)
    {
        $this->artisan = $artisan;
    }
}
