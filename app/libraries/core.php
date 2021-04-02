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
    }

    public function getUrl()
    {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }
}
