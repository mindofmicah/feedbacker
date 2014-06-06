<?php

namespace spec\MindOfMicah\Feedbacker;

use MindOfMicah\Feedbacker\Entities\Feedback;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PosterSpec extends ObjectBehavior
{
    public function let(Feedback $feedback)
    {
        $this->beConstructedWith($feedback);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Feedbacker\Poster');
    }

    public function it_should_create_a_new_instance_from_post_utility(Feedback $feedback)
    {
        $feedback->fill(['email'=>'email@site.com','message'=>'message'])
            ->willReturn(true)->shouldBeCalled();

        $feedback->save()->willReturn(true)->shouldBeCalled();
        $this->beConstructedWith($feedback);
        $message = $this->post('email@site.com', 'message');
        $message->shouldBeAnInstanceOf('MindOfMicah\Feedbacker\Entities\Feedback');
    }

    public function it_should_allow_extra_params(Feedback $feedback)
    {
        $feedback->fill(['email'=>'e@s.com', 'message'=>'message'])->shouldBeCalled();
        $feedback->setAttribute('param1', 'key1')->shouldBeCalled();
        $feedback->setAttribute('param2', 'key2')->shouldBeCalled();
        $feedback->save()->shouldBeCalled();

        $this->beConstructedWith($feedback);
        $message = $this->post('e@s.com', 'message', ['param1'=>'key1', 'param2'=>'key2']);
    }

    public function it_should_throw_an_exception_if_an_invalid_email_is_passed()
    {
        $this->shouldThrow('MindOfMicah\Feedbacker\Exceptions\InvalidArgumentException')->duringPost('invalid-email', 'message');        
    }

}
