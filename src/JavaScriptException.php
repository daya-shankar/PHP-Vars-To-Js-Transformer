<?php

namespace Laracasts\Utilities\JavaScript;

class JavaScriptException extends \Exception {

    /**
     * The exception message.
     *
     * @var string
     */
    protected $message =
        'JavaScript configuration must be published. Use: "php artisan config:publish laracasts/utilities".';
}
