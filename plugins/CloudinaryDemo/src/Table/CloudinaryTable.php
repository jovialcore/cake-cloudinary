<?php

namespace CloudinaryDemo\Model\Table;

use Cake\ORM\Table;


class CloudinaryTable extends Table
{
    public function initialize( array $config) : void {
        $this->hasMany('CloudinaryDemo.AltName');
    }
}
