<?php

final class DefaultController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        View::show("home/view");
    }
}
