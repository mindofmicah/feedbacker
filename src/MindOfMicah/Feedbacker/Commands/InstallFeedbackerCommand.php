<?php

namespace MindOfMicah\Feedbacker\Commands;
use Illuminate\Filesystem\Filesystem;
class InstallFeedbackerCommand
{
    public function __construct(\MindOfMicah\Feedbacker\GeneratorGenerator $g, Filesystem $f)
    {
        $this->generator = $g;
        $this->file = $f;
    }

    public function fire()
    {
        $this->generator->generate(
            $this->argument('name'), 
            $this->buildFieldString(),
            3
        ); 

        $route_name = 'feedback';
        $this->file->append('app/routes.php', 'Route::get(\'' . $route_name . '\', \'FeedbackerController@create\')');
        $this->file->append('app/routes.php', 'Route::post(\'' . $route_name . '\', \'FeedbackerController@store\')');
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
