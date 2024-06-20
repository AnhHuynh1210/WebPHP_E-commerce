<?php
class Item
{
    var $id= "";
    var $name = "";
    var $brand = "";
    var $img = "";
    var $price = "";
    var $quality = 1;
    var $max = "";
    function __contruct($id,$name,$brand,$img,$price,$quality,$max)
    {
        $this->id .= $id; 
        $this->name .= $name; 
        $this->brand .= $brand; 
        $this->img .= $img;
        $this->price .= $price; 
        $this->quality = $quality;
        $this->max .= $max;
    }
    function toString()
    {
        return  $this->id . 
        $this->name .
        $this->brand .
        $this->img.
        $this->price.
        $this->max;
    }
    function upQuality($quality)
    {
        $this->quality += $quality;
    }

}
?>