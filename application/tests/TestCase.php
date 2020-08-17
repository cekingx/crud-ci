<?php

class TestCase extends CIPHPUnitTestCase
{
    public static function setUpBeforeClass()
    {
        $CI =& get_instance();
        $CI->load->database();
    }
}
