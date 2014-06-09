<?php

namespace spec\MindOfMicah\Feedbacker\Commands;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use \MindOfMicah\Feedbacker\GeneratorGenerator;
use Illuminate\Filesystem\Filesystem;

class InstallFeedbackerCommandSpec extends ObjectBehavior
{
    public function let(GeneratorGenerator $g, Filesystem $f)
    {
        $this->beAnInstanceOf('spec\MindOfMicah\Feedbacker\Commands\InstallFeedbackerCommandMock');
        $this->beConstructedWith($g, $f);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Feedbacker\Commands\InstallFeedbackerCommand');
    }

    public function it_should_generate_with_only_a_model_name(GeneratorGenerator $g, Filesystem $f)
    {
        $g->generate('hi', 'email:string, message:text', 3)->shouldBeCalled();
        $this->beConstructedWith($g, $f);
        $this->fire()->shouldBe(null);
    }

    public function it_should_allow_extra_fields_to_be_passed_in(GeneratorGenerator $g, Filesystem $f)
    {
        $g->generate('hi', 'email:string, message:text, extra1:val1, extra2:val2', 3)->shouldBeCalled();
        $this->beAnInstanceOf('spec\MindOfMicah\Feedbacker\Commands\InstallFeedbackerCommandWithParams');
        $this->beConstructedWith($g, $f);
        $this->fire()->shouldBe(null);
    }

    public function it_should_update_the_route_file_with_the_feedbacker_routes(GeneratorGenerator $g, Filesystem $f)
    {
        $f->append('app/routes.php', 'Route::get(\'feedback\', \'FeedbackerController@create\')')->willReturn(1)->shouldBeCalled();
        $f->append('app/routes.php', 'Route::post(\'feedback\', \'FeedbackerController@store\')')->willReturn(1)->shouldBeCalled();
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
