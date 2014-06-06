<?php
namespace MindOfMicah\Feedbacker;

use MindofMicah\Feedbacker\Entities\Feedback;
use MindOfMicah\Feedbacker\Poster;

class Feedbacker
{
    /**
     * Create an instance of the Feedbacker class
     *
     * @param Poster $poster reference to the Poster class
     *
     * @return Feedbacker
     */
    public function __construct(Poster $poster)
    {
        $this->poster = $poster;
    }

    /**
     * Utility to push the new feedback information into the database
     *
     * @param string $email   Email address associated with the feedback
     * @param string $message Message to be saved with the feedback
     *
     * @return Feedback
     */
    public function submit($email, $message)
    {
        $a = $this->poster->post($email, $message); 
        return $a;
    }
}
