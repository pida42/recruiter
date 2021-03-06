<?php

namespace Recruiter;

use Exception;

trait WorkableBehaviour
{
    protected $parameters;

    public function __construct($parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function asJobOf(Recruiter $recruiter)
    {
        return $recruiter->jobOf($this);
    }

    public function execute() {
        throw new Exception('Workable::execute() need to be implemented');
    }

    public function export()
    {
        return $this->parameters;
    }

    public static function import($parameters)
    {
        return new static($parameters);
    }
}
