<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 21/01/2016
 * Time: 18:40
 */

namespace Core\Service;


class Logger
{
    private $file;

    public function __construct($file) {
        $this->file = ROOT_DIR.$file;
    }

    private function exist() {
        return (file_exists($this->file));
    }

    public function writeLine($line) {
        $content = "";
        if ($this->exist()) {
            $content = file_get_contents($this->file);
        }
        $content .= 'IP: '.$_SERVER['REMOTE_ADDR'].' | ';
        $content .= $line."\n";
        file_put_contents($this->file, $content);
    }
}