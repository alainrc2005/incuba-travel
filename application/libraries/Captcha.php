<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/17/2017
 * Time: 5:52 PM
 */
class Captcha {

    private $options;

    function __construct() {
        $this->options = array(
            'min_length' => 6,
            'max_length' => 6,
            // some easy-to-confuse letters taken out C/G I/l Q/O h/b
            'characters' => 'ABDEFHKLMNOPRSTUVWXZabdefghikmnopqrstuvwxyz',
            'perturbation' => 0,
            'imgwid' => 200,
            'imghgt' => 44,
            'numcirc' => 0,
            'numlines' => 4,
            'font'=>FCPATH.'assets/fonts/captcha'.mt_rand(1,5).'.ttf'
        );
    }

    public function generateCaptcha() {
        $result['code'] = '';
        $length = mt_rand($this->options['min_length'], $this->options['max_length']);
        while( strlen($result['code']) < $length ) {
            $result['code'] .= substr($this->options['characters'], mt_rand() % (strlen($this->options['characters'])), 1);
        }
        $result['img'] = $this->warped_text_image($this->options['imgwid'],$this->options['imghgt'],$result['code']);
        return $result;
    }

    function frand()
    {
        return 0.0001*rand(0,9999);
    }

    // wiggly random line centered at specified coordinates
    function randomline($img, $col, $x, $y)
    {
        $theta = ($this->frand()-0.5)*M_PI*0.7;
        $len = rand($this->options['imgwid']*0.4,$this->options['imgwid']*0.7);
        $lwid = rand(0,2);

        $k = $this->frand()*0.6+0.2; $k = $k*$k*0.5;
        $phi = $this->frand()*6.28;
        $step = 0.5;
        $dx = $step*cos($theta);
        $dy = $step*sin($theta);
        $n = $len/$step;
        $amp = 1.5*$this->frand()/($k+5.0/$len);
        $x0 = $x - 0.5*$len*cos($theta);
        $y0 = $y - 0.5*$len*sin($theta);

        for ($i = 0; $i < $n; ++$i) {
            $x = $x0+$i*$dx + $amp*$dy*sin($k*$i*$step+$phi);
            $y = $y0+$i*$dy - $amp*$dx*sin($k*$i*$step+$phi);
            imagefilledrectangle($img, $x, $y, $x+$lwid, $y+$lwid, $col);
        }
    }

// amp = amplitude (<1), num=numwobb (<1)
    function imagewobblecircle($img, $xc, $yc, $r, $wid, $amp, $num, $col)
    {
        $dphi = 1;
        if ($r > 0)
            $dphi = 1/(6.28*$r);
        $woffs = rand(0,100)*0.06283;
        for ($phi = 0; $phi < 6.3; $phi += $dphi) {
            $r1 = $r * (1-$amp*(0.5+0.5*sin($phi*$num+$woffs)));
            $x = $xc + $r1*cos($phi);
            $y = $yc + $r1*sin($phi);
            imagefilledrectangle($img, $x, $y, $x+$wid, $y+$wid, $col);
        }
    }

// make a distorted copy from $tmpimg to $img. $wid,$height apply to $img,
// $tmpimg is a factor $iscale bigger.
    function distorted_copy($tmpimg, $img, $width, $height, $iscale)
    {
        $numpoles = 3;

        // make an array of poles AKA attractor points
        for ($i = 0; $i < $numpoles; ++$i) {
            do {
                $px[$i] = rand(0, $width);
            } while ($px[$i] >= $width*0.3 && $px[$i] <= $width*0.7);
            do {
                $py[$i] = rand(0, $height);
            } while ($py[$i] >= $height*0.3 && $py[$i] <= $height*0.7);
            $rad[$i] = rand($width*0.4, $width*0.8);
            $tmp = -$this->frand()*0.15-0.15;
            $amp[$i] = $this->options['perturbation'] * $tmp;
        }

        // get img properties bgcolor
        $bgcol = imagecolorat($tmpimg, 1, 1);
        $width2 = $iscale*$width;
        $height2 = $iscale*$height;

        // loop over $img pixels, take pixels from $tmpimg with distortion field
        for ($ix = 0; $ix < $width; ++$ix)
            for ($iy = 0; $iy < $height; ++$iy) {
                $x = $ix;
                $y = $iy;
                for ($i = 0; $i < $numpoles; ++$i) {
                    $dx = $ix - $px[$i];
                    $dy = $iy - $py[$i];
                    if ($dx == 0 && $dy == 0)
                        continue;
                    $r = sqrt($dx*$dx + $dy*$dy);
                    if ($r > $rad[$i])
                        continue;
                    $rscale = $amp[$i] * sin(3.14*$r/$rad[$i]);
                    $x += $dx*$rscale;
                    $y += $dy*$rscale;
                }
                $c = $bgcol;
                $x *= $iscale;
                $y *= $iscale;
                if ($x >= 0 && $x < $width2 && $y >= 0 && $y < $height2)
                    $c = imagecolorat($tmpimg, $x, $y);
                imagesetpixel($img, $ix, $iy, $c);
            }
    }

    function warped_text_image($width, $height, $string)
    {
        // internal variablesinternal scale factor for antialias
        $iscale = 3;

        // initialize temporary image
        $width2 = $iscale*$width;
        $height2 = $iscale*$height;
        $tmpimg = imagecreate($width2, $height2);
        imagecolorallocatealpha ($tmpimg, 192, 192, 192, 100);
        $col = imagecolorallocate($tmpimg, 0, 0, 0);

        // init final image
        $img = imagecreate($width, $height);
        imagepalettecopy($img, $tmpimg);
        imagecopy($img, $tmpimg, 0,0 ,0,0, $width, $height);

        // put straight text into $tmpimage
        $fsize = $height2*0.5;
        $bb = imageftbbox($fsize, 0, $this->options['font'], $string);
        $tx = $bb[4]-$bb[0];
        $ty = $bb[5]-$bb[1];
        $x = floor($width2/2 - $tx/2 - $bb[0]);
        $y = round($height2/2 - $ty/2 - $bb[1]);
        imagettftext($tmpimg, $fsize, 0, $x, $y, -$col, $this->options['font'], $string);

        // addgrid($tmpimg, $width2, $height2, $iscale, $col); // debug

        // warp text from $tmpimg into $img
        $this->distorted_copy($tmpimg, $img, $width, $height, $iscale);

        // add wobbly circles (spaced)
        for ($i = 0; $i < $this->options['numcirc']; ++$i) {
            $x = $width * (1+$i) / ($this->options['numcirc']+1);
            $x += (0.5-$this->frand())*$width/$this->options['numcirc'];
            $y = rand($height*0.1, $height*0.9);
            $r = $this->frand();
            $r = ($r*$r+0.2)*$height*0.2;
            $lwid = rand(0,2);
            $wobnum = rand(1,4);
            $wobamp = $this->frand()*$height*0.01/($wobnum+1);
            $this->imagewobblecircle($img, $x, $y, $r, $lwid, $wobamp, $wobnum, $col);
        }

        // add wiggly lines
        for ($i = 0; $i < $this->options['numlines']; ++$i) {
            $x = $width * (1+$i) / ($this->options['numlines']+1);
            $x += (0.5-$this->frand())*$width/$this->options['numlines'];
            $y = rand($height*0.1, $height*0.9);
            $this->randomline($img, $col, $x, $y);
        }

        return $img;
    }

}