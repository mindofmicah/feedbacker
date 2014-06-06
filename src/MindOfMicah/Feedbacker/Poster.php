<?php
namespace MindOfMicah\Feedbacker;

use MindOfMicah\Feedbacker\Exceptions\InvalidArgumentException;
use MindOfMicah\Feedbacker\Entities\Feedback;

class Poster
{
    /**
     * Create a new instance of the Poster class
     *
     * @param Feedback $model reference to the eloquent model
     *
     * @return Poster
     */
    public function __construct(Feedback $model)
    {
        $this->model = $model;
    }

    /**
     * Post the new feedback information towards the database
     *
     * @param string $email             email address to associate with the feed
     * @param string $message           message sent by the user
     * @param array  $additional_params extra parameters to push into the database
     *
     * @return Feedback
     */
    public function post($email, $message, array $additional_params = [])
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException($email, 'email');
        }

        $this->model->fill(compact('email', 'message'));

        foreach ($additional_params as $key => $value) {
            $this->model->$key = $value;
        }

        $this->model->save();

        return $this->model;
    }
}
