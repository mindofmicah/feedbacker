<?php

namespace spec\MindOfMicah\Feedbacker\Exceptions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InvalidArgumentExceptionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('apple', 'email');
    }
    public function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Feedbacker\Exceptions\InvalidArgumentException');
    }
    public function it_should_extend_the_base_extension_class()
    {
        $this->shouldBeAnInstanceOf('\Exception');
    }

    public function it_should_format_the_message_based_off_of_passed_in_params()
    {
        $this->beConstructedWith('apple', 'email');
        $this->getMessage()
            ->shouldEqual('InvalidArgumentException: expected a(n) "email", but received a(n) string(apple)');
    }
}
