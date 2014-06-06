<?php

namespace spec\MindOfMicah\Feedbacker\Entities;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FeedbackSpec extends ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Feedbacker\Entities\Feedback');
    }

    public function it_extends_eloquent()
    {
        $this->shouldBeAnInstanceOf('Illuminate\Database\Eloquent\Model');
    }
}
