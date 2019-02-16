<?php

class CaptchaData {

    private $fonts = [];
    private $color = '#CCCCCC';
    private $backgroundColor = '#272727';
    private $code;
    private $width = 200;
    private $height = 60;

    public function __construct() {
        $this->addFonts([
            'BrokenGlass.otf',
            'glashou.ttf'
        ]);
    }

    public function setCode($value) {
        $this->code = $value;
    }

    public function getCode() {
        return $this->code;
    }

    public function setBackgroundColor($value) {
        $this->backgroundColor = $value;
    }

    public function getBackgroundColor() {
        return $this->backgroundColor;
    }

    public function setColor($value) {
        $this->color = $value;
    }

    public function getColor() {
        return $this->color;
    }

    public function addFonts($fonts) {
        foreach ($fonts as $font) {
            $this->fonts[] = dirname(__FILE__).'/fonts/'.$font;
        }
    }

    public function getFonts() {
        return $this->fonts;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($value) {
        $this->width = $value;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($value) {
        $this->height = $value;
    }

    public function getArray() {
        return [
            'code' => $this->code,
            'color' => $this->color,
            'background_color' => $this->backgroundColor,
            'fonts' => $this->fonts,
            'width' => $this->width,
            'height' => $this->height
        ];
    }

    public function setArray($array) {
        if (isset($array['code'])) {
            $this->code = $array['code'];
        }
        if (isset($array['color'])) {
            $this->color = $array['color'];
        }
        if (isset($array['background_color'])) {
            $this->backgroundColor = $array['background_color'];
        }
        if (isset($array['fonts'])) {
            $this->fonts = $array['fonts'];
        }
        if (isset($array['width'])) {
            $this->width = $array['width'];
        }
        if (isset($array['height'])) {
            $this->height = $array['height'];
        }
    }

}