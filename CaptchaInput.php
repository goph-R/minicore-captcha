<?php

class CaptchaInput extends Input {

    /** @var UserSession */
    private $userSession;

    /** @var CaptchaData */
    private $data;

    public function __construct(Framework $framework, $name, $defaultValue = '') {
        parent::__construct($framework, $name, $defaultValue);
        $this->userSession = $framework->get('userSession');
        $this->data = new CaptchaData();
        $code = $this->generateRandomString(5);
        $this->data->setCode($code);
    }

    private function generateRandomString($length) {
        $characters = 'ABCDEFJKLMPRSTUVWXYZ97654321';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getData() {
        return $this->data;
    }

    public function fetch() {
        $this->userSession->set('captcha_data', $this->data->getArray());
        $result = '<input type="text"';
        $result .= ' id="'.$this->getId().'"';
        $result .= ' name="'.$this->form->getName().'['.$this->getName().']"';
        $result .= ' value=""';
        $result .= $this->getClassHtml();
        $result .= '><img src="'.route_url('captcha', ['time' => time()]).'">';
        return $result;
    }

}