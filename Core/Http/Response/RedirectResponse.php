<?php

namespace Core\Http\Response;


class RedirectResponse
{
    public function __construct($path) {
        header('Location: '.$path);
    }
}