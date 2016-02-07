<?php

namespace Core\Http\Response;


/**
 * Class RedirectResponse
 * @package Core\Http\Response
 */
class RedirectResponse
{
    /**
     * RedirectResponse constructor.
     * @param $path
     */
    public function __construct($path) {
        header('Location: '.$path);
    }
}