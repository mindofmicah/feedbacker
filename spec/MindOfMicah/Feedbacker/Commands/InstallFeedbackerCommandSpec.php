<?php

namespace spec\MindOfMicah\Feedbacker\Commands;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InstallFeedbackerCommandSpec extends ObjectBehavior
{
    public function let(\MindOfMicah\Feedbacker\GeneratorGenerator $g)
    {
        $this->beAnInstanceOf('spec\MindOfMicah\Feedbacker\Commands\InstallFeedbackerCommandMock');
        $this->beConstructedWith($g);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Feedbacker\Commands\InstallFeedbackerCommand');
    }

    public function it_should_generate_with_only_a_model_name(\MindOfMicah\Feedbacker\GeneratorGenerator $g)
    {
        $g->generate('hi', 'email:string, message:text', 3)->shouldBeCalled();
        $this->beConstructedWith($g);
        $this->fire()->shouldBe(null);
    }

    public function it_should_allow_extra_fields_to_be_passed_in(\MindOfMicah\Feedbacker\GeneratorGenerator $g)
    {
        $g->generate('hi', 'email:string, message:text, extra1:val1, extra2:val2', 3)->shouldBeCalled();
        $this->beAnInstanceOf('spec\MindOfMicah\Feedbacker\Commands\InstallFeedbackerCommandWithParams');
        $this->beConstructedWith($g);
        $this->fire()->shouldBe(null);
    }
}


class InstallFeedbackerCommandMock extends \MindOfMicah\Feedbacker\Commands\InstallFeedbackerCommand
{
    public function argument($name)
    {
        return 'hi';
    }
    public function option($name)
    {
        return null;
    }
}
class InstallFeedbackerCommandWithParams extends InstallFeedbackerCommandMock
{
    public function option($name)
    {
        return 'extra1:val1, extra2:val2';
    }
}
