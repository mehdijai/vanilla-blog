<?php

class ContactController extends Controller
{
    public function index()
    {
        extract($this->data);
        require("views/contact.view.php");
    }
}
