<?php

use anthelme\SignUp;
use PHPUnit\Framework\TestCase;
class SignUpTestApi extends TestCase
{
    public function testCreate()
    {
        $signup=new SignUp("localhost","api","root","");
       // $stu=array("first_name"=>"anthelme","last_name"=>"teko","email"=>"teko@gmail.com");
        
        $signup->create(array("first_name"=>"anthelme","last_name"=>"teko","email"=>"teko@gmail.com"));
    }
    public function delete()
    {

    }
}