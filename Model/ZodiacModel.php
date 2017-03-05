<?php
    class ZodiacModel{
        public $id=0;
        public $name = "";
        public $color = "";
        public $sorting = 0;
        
       function __construct($id=0,$name="",$color="",$sorting=0){
            $this->id = (int)$id;
            $this->name = (string)$name;
            $this->color = (string)$color;
            $this->sorting = (int)$sorting;
        }
    }
?>