<?php

declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cloudinary\Api\Upload\UploadApi;
use CloudinaryDemo\Model\Entity\Cloudinary;

/**
 * GeneralFunctions component
 */

class CloudinaryComponent extends Component
{
    private $cloudinaryConfig;

    private $cloudinary;

    // retrieve the cloudinray config and set to cloudinaryConfig ;
    public function __construct()
    {
        $this->cloudinaryConfig = Configure::read('cloudinary.default.cloudinary_link');
    }

    public function initialize(array $config): void
    {
    }

    // instantiate the default php sdk cloudinary class
    public function startUpCloudinary()
    {
        $this->cloudinary = new Cloudinary($this->cloudinaryConfig);
    }


    public function upload()
    {
        $this->cloudinary->upload();
    }
}
