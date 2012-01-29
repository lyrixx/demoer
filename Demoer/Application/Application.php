<?php

namespace Demoer\Application;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Finder\Finder;

class Application extends BaseApplication
{
    private $finder;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
        parent::__construct('Demoer');
    }

    public function getFinder()
    {
        return $this->finder;
    }

}
