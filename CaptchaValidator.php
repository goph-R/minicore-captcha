<?php

class CaptchaValidator extends Validator {

    /** @var UserSession */
    private $userSession;

    public function __construct() {
        parent::__construct();
        $framework = Framework::instance();
        $this->userSession = $framework->get('userSession');
        $this->message = "Didn't match";
    }

    protected function doValidate($value) {
        $data = new CaptchaData();
        $data->setArray($this->userSession->get('captcha_data'));
        return strtolower($value) == strtolower($data->getCode());
    }
}