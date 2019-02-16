<?php

class CaptchaModule extends Module {

    protected $id = 'minicore-captcha';

    public function __construct(Framework $framework) {
        parent::__construct($framework);
        $framework->add([
            'captchaController' => 'CaptchaController'
        ]);
    }

    public function init() {
        $controller = $this->framework->get('captchaController');
        /** @var Router $router */
        $router = $this->framework->get('router');
        $router->addRoute('captcha', [$controller, 'image']);
    }

}