<?php

namespace just;

interface ServiceContainerInterface
{
	public function add(string $name, $service);

	public function addLazy(string $name, callable $callable);

	public function get(string $name);

	public function has(string $name);
}