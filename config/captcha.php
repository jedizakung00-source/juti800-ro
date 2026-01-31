<?php
session_start();

class SvgCaptcha
{
    private $code;
    private $characters;
    private $width;
    private $height;

    public function __construct($width = 200, $height = 50, $characters = 6)
    {
        $this->width = $width;
        $this->height = $height;
        $this->characters = $characters;
        $this->code = $this->generateCode();
        $_SESSION['security_code'] = $this->code;
    }

    private function generateCode()
    {
        $possible = '23456789bcdfghjkmnpqrstvwxyz';
        $code = '';
        for ($i = 0; $i < $this->characters; $i++) {
            $code .= $possible[random_int(0, strlen($possible) - 1)];
        }
        return $code;
    }

    public function render()
    {
        header('Content-Type: image/svg+xml');
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="'.$this->width.'" height="'.$this->height.'" style="background:#fff;">';

        // Noise lines
        for ($i = 0; $i < 5; $i++) {
            $x1 = rand(0, $this->width);
            $y1 = rand(0, $this->height);
            $x2 = rand(0, $this->width);
            $y2 = rand(0, $this->height);
            $color = 'rgb('.rand(100,200).','.rand(100,200).','.rand(100,200).')';
            $svg .= '<line x1="'.$x1.'" y1="'.$y1.'" x2="'.$x2.'" y2="'.$y2.'" stroke="'.$color.'" stroke-width="1" />';
        }

        // Render characters
        $fontSize = $this->height * 0.6;
        $spacing = $this->width / ($this->characters + 1);
        for ($i = 0; $i < strlen($this->code); $i++) {
            $x = $spacing * ($i + 1);
            $y = rand($fontSize, $this->height - 5);
            $rotation = rand(-20, 20);
            $color = 'rgb('.rand(0,100).','.rand(0,100).','.rand(0,100).')';
            $char = $this->code[$i];
            $svg .= '<text x="'.$x.'" y="'.$y.'" fill="'.$color.'" font-size="'.$fontSize.'" font-family="Arial" transform="rotate('.$rotation.' '.$x.','.$y.')">'.$char.'</text>';
        }

        $svg .= '</svg>';
        echo $svg;
    }
}

$width = isset($_GET['width']) ? (int)$_GET['width'] : 200;
$height = isset($_GET['height']) ? (int)$_GET['height'] : 50;
$characters = isset($_GET['characters']) ? (int)$_GET['characters'] : 6;

$captcha = new SvgCaptcha($width, $height, $characters);
$captcha->render();
