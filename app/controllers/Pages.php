<?php

class Pages
{
    public function __construct()
    {
    }

    public function index()
    {
        echo "This is the homepage";
    }

    public function about($id)
    {
        echo "This is the about page: " . $id;
    }
}
