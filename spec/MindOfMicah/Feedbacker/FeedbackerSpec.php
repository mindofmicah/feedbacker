<?php
namespace spec\MindOfMicah\Feedbacker;

use MindOfMicah\Feedbacker\Entities\Feedback;
use MindOfMicah\Feedbacker\Poster;
use MindOfMicah\Feedbacker\Exceptions\InvalidArgumentException;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FeedbackerSpec extends ObjectBehavior
{
    public function let(Poster $poster)
    {
        $this->beConstructedWith($poster);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Feedbacker\Feedbacker');
    }

    public function it_should_throw_an_exception_if_the_email_is_not_valid(Poster $poster)
    {
        $email = 'ttmail.com';
        $message = 'this is my message';

        $poster->post($email, $message)
            ->willThrow(new InvalidArgumentException($email, 'email'))
            ->shouldBeCalled();

        $this->beConstructedWith($poster);

        $this->shouldThrow('\MindOfMicah\Feedbacker\Exceptions\InvalidArgumentException')
            ->duringSubmit($email, $message);
    }

    public function it_should_return_a_feedback_object_if_successful(Poster $poster)
    {
        $poster->post('micah@whamdonk.com', 'this is my message')
            ->willReturn(new Feedback);

        $this->submit('micah@whamdonk.com', 'this is my message')
            ->shouldReturnAnInstanceOf('\MindOfMicah\Feedbacker\Entities\Feedback');
    }
}
