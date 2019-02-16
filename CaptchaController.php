<?php

class CaptchaController extends Controller {

    public function image() {
        $data = new CaptchaData();
        $data->setArray($this->userSession->get('captcha_data'));
        $code = $data->getCode();
        $w = $data->getWidth();
        $h = $data->getHeight();
        $fonts = $data->getFonts();
        list($r, $g, $b) = sscanf($data->getColor(), "#%02x%02x%02x");
        list($br, $bg, $bb) = sscanf($data->getBackgroundColor(), "#%02x%02x%02x");
        $image = imagecreatetruecolor($w, $h);
        $color = imagecolorallocate($image, $r, $g, $b);
        $x = 5;
        imagefilter($image, IMG_FILTER_COLORIZE, $br, $bg, $bb);

        for ($i = 0; $i < strlen($code); $i++) {
            $size = mt_rand(30, 40);
            $char = $code[$i];
            $ext = strtolower(pathinfo($fonts[0], PATHINFO_EXTENSION));
            $func = 'imagefttext';
            $font = $fonts[mt_rand(0, count($fonts) - 1)];
            if ($ext == 'otf') {
                $box = imageftbbox($size, 0, $font, $char);
            } else {
                $box = imagettfbbox($size, 0, $font, $char);
                $func = 'imagettftext';
            }
            //function imagefttext ($image, $size, $angle, $x, $y, $color, $fontfile, $text, $extrainfo = null ) {}
            $bh = $box[7] - $box[1];
            $func($image, $size, 0, $x, ($h - $bh) / 2, $color, $font, $char);
            $x += $box[2] - $box[0] + 5;
        }

        for ($j = 0; $j < 10; $j++) {
            imageline($image, mt_rand(0, $x - 1), mt_rand(0, $h - 1), mt_rand(0, $x - 1), mt_rand(0, $h - 1), $color);
        }

        header('Content-Type: image/png');
        imagepng($image);
        $this->framework->finish();
    }

}