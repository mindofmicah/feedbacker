<?php
namespace spec\MindOfMicah\Feedbacker;

require (__DIR__ . '/../../../stubs/Artisan.php');

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Illuminate\Foundation\Artisan;
use MindOfMicah\Feedbacker\GeneratorGenerator;

class GeneratorGeneratorSpec extends ObjectBehavior
{
    public function let(Artisan $artisan)
    {
        $this->beConstructedWith($artisan);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Feedbacker\GeneratorGenerator');
    }

    function it_generates_a_migration_when_appropriate(Artisan $artisan) {
        $artisan->call(
            'generate:migration', 
            ['migrationName'=>'create_model_table','fields'=>'field=string']
        )->shouldBeCalled();
        
        $this->beConstructedWith($artisan);
        $this->generate('model', 'field=string', GeneratorGenerator::GEN_MIGRATION)
            ->shouldBe(true);
    }

    function it_generates_a_model_when_appropriate(Artisan $artisan) {
        $artisan->call(
            'generate:model', 
            ['modelName' => 'table']
        )->shouldBeCalled(); 

        $this->beConstructedWith($artisan);
        $this->generate('table', 'field=string', GeneratorGenerator::GEN_MODEL)
            ->shouldBe(true);
    }
}
