<?php

class AutoLoader
{
    private $dirs;

    public function register()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    public function setDirs($dir)
    {
        $this->dirs[] = $dir;
    }

    public function autoload($className)
    {
        foreach ($this->dirs as $dir) {
            $file = $dir . '/' . $className . '.php';
            if (is_readable($file)) {
                require_once $file;
                return;
            }
        }
    }
}
