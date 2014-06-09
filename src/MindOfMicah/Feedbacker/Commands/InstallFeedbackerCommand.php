<?php

namespace MindOfMicah\Feedbacker\Commands;

class InstallFeedbackerCommand
{
    public function __construct(\MindOfMicah\Feedbacker\GeneratorGenerator $g)
    {
        $this->generator = $g;
    }

    public function fire()
    {
        $this->generator->generate(
            $this->argument('name'), 
            $this->buildFieldString(),
            3
        ); 
    }

    private function buildFieldString()
    {
        $param_string = 'email:string, message:text';
        
        $fields = $this->option('fields');
        if ($fields) {
            $param_string.= ', ' . $fields;
        }

        return $param_string;
   }
}
