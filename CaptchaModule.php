<?php

class CaptchaModule extends Module {

    protected $id = 'minicore-captcha';

    public function __construct() {
        $framework = Framework::instance();
        $framework->add([
            'captchaController' => 'CaptchaController'
        ]);
    }

    public function init() {
        /** @var Router $router */
        $framework = Framework::instance();
        $router = $framework->get('router');
        $router->add([
            ['captcha', 'captchaController', 'image']
        ]);
    }

}