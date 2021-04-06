<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
    }

    public function about($id)
    {
        echo "This is the about page: " . $id;
    }
}
