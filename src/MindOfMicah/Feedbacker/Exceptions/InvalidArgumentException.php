<?php
namespace MindOfMicah\Feedbacker\Exceptions;

class InvalidArgumentException extends \Exception
{
    protected $variable;
    protected $expected_type;

    /**
     * Create a new instance of the InvalidArgumentException class
     *
     * @param mixed  $variable      variable that we tried to use 
     * @param string $expected_type expected type of the variable used
     *
     * @return InvalidArgumentException
     */
    public function __construct($variable, $expected_type)
    {
        $this->variable = $variable;
        $this->expected_type = $expected_type;

        parent::__construct($this->buildMessage());
    }

    /**
     * Create an echo-able string based off of the parameters
     *
     * @return string
     */
    private function buildMessage()
    {
        $r = new \ReflectionClass(get_class($this));

        return sprintf(
            '%s: expected a(n) "%s", but received a(n) %s(%s)', 
            $r->getShortName(), 
            $this->expected_type, 
            gettype($this->variable), 
            $this->variable
        );
    }
}
