<?php
/*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        // If url is set
        if (isset($_GET['url'])) {
            $url = $this->getUrl();

            // Look in controllers for first value of $url
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists, set as current Controller
                $this->currentController = ucwords($url[0]);

                // Unset Index 0
                unset($url[0]);
            }
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;

        // Check for 2nd part of url
        if (isset($url[1])) {
            // Check if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unset Index 1
                unset($url[1]);
            }
        }

        // Get params
        if (isset($url)) {
            $this->params = $url ? array_values($url) : [];
        }

        // Callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }
}
