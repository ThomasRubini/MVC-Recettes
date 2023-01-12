<?php

final class HelloworldController
{
    public function defaultAction()
    {
        $O_helloworld =  new Helloworld();
        View::show('helloworld/view', array('helloworld' =>  $O_helloworld->getMessage()));

    }

    public function testformAction(Array $A_urlParams = null, Array $A_postParams = null)
    {

        View::show('helloworld/testform', array('formData' =>  $A_postParams));

    }

}