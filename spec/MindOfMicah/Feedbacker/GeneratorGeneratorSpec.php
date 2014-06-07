<?php

namespace spec\MindOfMicah\Feedbacker;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


require (__DIR__ . '/../../../stubs/Artisan.php');

class GeneratorGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Feedbacker\GeneratorGenerator');
    }

    function it_requires_an_instance_of_artisan() {
        $this->shouldThrow('\Exception')->duringGenerate();
    }

    function it_blah(\Illuminate\Foundation\Artisan $artisan) {
        $this->artisan($artisan);
        $this->generate()->shouldBe(true);
    }
}
