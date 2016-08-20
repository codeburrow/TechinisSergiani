<?php
namespace Kourtis\Transformers;
/**
 * Created by PhpStorm.
 * User: antony
 * Date: 7/28/16
 * Time: 3:21 AM
 */

class URL_Transformer
{
    public function removeSpacesAndParentheses($data)
    {
        $a = explode(" ", $data);
        $a = implode("-", $a);
        $a = explode("?", $a);
        $a = implode("-", $a);

        return $a;
    }
    
}