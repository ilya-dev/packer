<?php

class TestCase extends PHPUnit_Framework_TestCase {

    protected $subject;

    protected function setUp()
    {
        $class = str_replace('Test', '', get_class($this));

        $this->subject = new $class;
    }

}
