<?php


namespace Raistlfiren\GPS\GPX\Model\Route;


use Raistlfiren\GPS\GPX\Model\Collection;

class RouteCollection extends Collection
{

    private $routes;

    public function add(Route $route)
    {
        $this->routes[] = $route;

        return $this;
    }

    public function hasRoutes()
    {
        if (is_array($this->routes))
            return TRUE;

        return FALSE;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getIteratorConstant()
    {
        return 'getRoutes';
    }

    /**
     * @param integer $offset
     * @return Route
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }
}