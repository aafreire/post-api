<?php

namespace just;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\SapiEmitter;
use Psr\Http\Message\ServerRequestInterface;
use just\Plugins\PluginInterface;

class Application
{
    private $serviceContainer;

    /**
     * Application constructor.
     * @param $serviceContainer
     */
    public function __construct(ServiceContainerInterface $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    /* Recupera um serviço */
    public function service($name)
    {
        return $this->serviceContainer->get($name);
    }

    /* Adiciona um serviço */
    public function addService(string $name, $service)
    {
        if (is_callable($service)) {
            $this->serviceContainer->addLazy($name, $service);
        } else {
            $this->serviceContainer->add($name, $service);
        }
    }

    /* instalação de um novo plugin */
    public function plugin(PluginInterface $plugin)
	{
	    $plugin->register($this->serviceContainer);
	}

	public function get($path, $action, $name = null)
	{
	    $routing = $this->service('routing');
	    $routing->get($name, $path, $action);
	    return $this;
	}

    public function post($path, $action, $name = null)
    {
        $routing = $this->service('routing');
        $routing->post($name, $path, $action);
        return $this;
    }

    public function put($path, $action, $name = null)
    {
        $routing = $this->service('routing');
        $routing->put($name, $path, $action);
        return $this;
    }

    public function delete($path, $action, $name = null)
    {
        $routing = $this->service('routing');
        $routing->delete($name, $path, $action);
        return $this;
    }

	public function start()
	{
	    $route = $this->service('route');
        /** @var ServerRequestInterface $request */
        $request = $this->service(RequestInterface::class);

        if(!$route){
            echo "Page not found";
            exit;
        }

        foreach ($route->attributes as $key => $value){
            $request = $request->withAttribute($key,$value);
        }

        $callable = $route->handler;
        $response = $callable($request);

        $this->emitResponse($response);
	}

    protected function emitResponse(ResponseInterface $response)
    {
        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }
}