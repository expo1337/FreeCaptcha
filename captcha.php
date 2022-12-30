<?php
    function get_random_string()
    {
        $chars = array_merge(range("A", "Z"), range("a","z"),range(0, 9));
        $random_str = "";
        for($i=0; 6>$i; $i++)
            $random_str .= $chars[random_int(0, count($chars)-1)];
        return $random_str;
    }

    function create_captcha($captcha_string)
    {
        $width = 130;
        $height = 30; 
        $img = imagecreate($width, $height);
        // Catppucin colors uwaaaaaaaaaa -- Frappe palette
        $bg = array(48, 52, 70); // Base
        $fg[0] = array(198, 208, 245); // Text
        $fg[1] = array(242, 213, 207); // Rosewater
        $fg[2] = array(202, 158, 230); // Mauve
        $fg[3] = array(133, 193, 220); // Sapphire
        $fg[4] = array(166, 209, 137); // Green
        // Take a random color and create image 
        $color_pick = random_int(0, 4);
        $background_color = imagecolorallocate($img, $bg[0], $bg[1], $bg[2]);
        $text_color = imagecolorallocate($img, $fg[$color_pick][0], $fg[$color_pick][1], $fg[$color_pick][2]);
        $text_x = 30;
        // Different font every time?! :o
        $font_pick = random_int(0, 5);
        for($i=0; strlen($captcha_string)>$i; $i++)
        {
            $text_y = random_int(0, $height- ($height*0.60));
            imagestring($img, $font_pick, $text_x, $text_y, $captcha_string[$i], $text_color);
            $text_x += 10 + random_int(0, $width / 10 - 5);
        }
        imagepng($img);
        imagedestroy($img);
    }
 
  header("Content-Type: image/png");
   $captcha_string = get_random_string();
    create_captcha($captcha_string);
    session_start();
    $_SESSION["captcha"] = $captcha_string;
?>