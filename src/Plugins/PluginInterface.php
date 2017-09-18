<?php
namespace just\Plugins;

use just\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}