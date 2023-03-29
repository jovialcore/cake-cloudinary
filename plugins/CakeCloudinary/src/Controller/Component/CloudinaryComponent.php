<?php

declare(strict_types=1);

namespace CakeCloudinary\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Cloudinary;

/**
 * Cloudinary component
 */
class CloudinaryComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];
    private $cloudinary;

    protected $response;


    public function __construct()
    {
        $this->startUpCloudinary();
    }


    public function initialize(array $config): void
    {
    }


    // retrieve cloudinray config  and instantiate the default php sdk cloudinary class
    public function startUpCloudinary()
    {
        $cloudinaryConfig = Configure::read('cloudinary.default');

        $this->cloudinary = new Cloudinary($cloudinaryConfig);
    }


    // expose cloudinary upload functionality

    public function uploadApi()
    {
        return $this->cloudinary->uploadApi();
    }


    // upload a file to ccloudinary account

    public function upload()
    {
        return $this->response = $this->uploadApi()->upload();
    }
}
