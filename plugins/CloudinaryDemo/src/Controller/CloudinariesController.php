<?php

namespace CloudinaryDemo\Controller;

use CloudinaryDemo\Controller\AppController;

class CloudinariesController extends AppController
{
    public function index()
    {
        $cloudinaries = $this->fetchTable('CloudinaryDemo.Cloudinary');
    }
}
