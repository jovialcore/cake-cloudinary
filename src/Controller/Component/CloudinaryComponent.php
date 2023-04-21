<?php

declare(strict_types=1);

namespace CakeCloudinary\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Cloudinary;
use InvalidArgumentException;

/**
 * Cloudinary component
 * Reference:
 * https://cloudinary.com/documentation/php_image_and_video_upload#server_side_upload
 *
 * another useful resource : https://cloudinary.com/documentation/image_upload_api_reference#upload
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



    // loading the helper component
    protected $components = ['CakeCloudinary.Helper'];





    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->startUpCloudinary();
    }


    // retrieve cloudinray config  and instantiate the default php sdk cloudinary class
    public function startUpCloudinary()
    {
        $cloudinaryConfig = Configure::read('Cloudinary.default');


        $this->cloudinary = new Cloudinary($cloudinaryConfig);
    }


    // wrap the cloudinary upload functionality

    public function uploadApi()
    {
        return $this->cloudinary->uploadApi();
    }

    // wrap the adminApi functionality

    public function adminApi()
    {
        return $this->cloudinary->adminApi();
    }


    // upload an asset to your cloudinary account. Asset can be formdata object, file path, DATA URI

    public function upload(string|object $file, array $options = [], array $url = [])
    {
        $this->response = $this->uploadApi()->upload($file, $options);


        $this->Helper->getSecureUrlFromArgsArr(func_get_args(), $this->response);


        return $this->response;
    }


    // upload a video asset to your cloudinary account. Video Asset can be formdata object, file path, DATA URI

    public function uploadVideo(string|object $file, array $options = [], array $url = [])
    {
        $this->response = $this->uploadApi()->upload($file, $options);

        $this->Helper->getSecureUrlFromArgsArr(func_get_args(), $this->response);


        return $this->response;
    }

    // upload any typeof file to cloudinary account

    public function uploadFile($file, array $options = [], array $url = [])
    {
        $anyFileParams  = ['resource_type' =>  'auto'];

        $options = array_merge($options, $anyFileParams);
        $this->response = $this->uploadApi()->upload($file, $options);

        $this->Helper->getSecureUrlFromArgsArr(func_get_args(), $this->response);

        return $this->response;
    }

    // upload an asset to cloudinary without being authenticated i.e unsigned
    public function unsignedUpload(string $file, $uploadPreset, array $options = [])
    {
        return $this->response = $this->uploadApi()->unsignedUpload($file, $uploadPreset, $options);
    }

    // upload an asset to cloudinary asynchronously without being authenticated i.e unsigned
    public function unsignedUploadAsync(string $file, $uploadPreset, array $options = [])
    {
        return $this->response = $this->uploadApi()->unsignedUploadAsync($file, $uploadPreset, $options);
    }

    // upload an asset to asychronously to cloduinary
    public function uploadAsync($file, array $options = [])
    {
        return $this->response = $this->uploadApi()->uploadAsync($file, $options);
    }


     // delete any asset  from cloudinray account
    public function delete($publicId, $options = [])
    {
        return $this->uploadApi()->destroy($publicId, $options);
    }


    // delete an image  from cloudinray account

    public function deleteImage($image, array $options = [])
    {
        return $this->response = $this->uploadApi()->destroy($image, $options);
    }

    // delete video from cloudinary

    public function deleteVideo($video, array $options = [])
    {
        $videoparam  = ['resource_type' =>  'video'];

        $options = array_merge($options, $videoparam);

        return $this->response = $this->uploadApi()->destroy($video, $options);
    }


    // upload explicit ref : https://cloudinary.com/documentation/image_upload_api_reference#explicit

    public function explicit($publicId, $options = [])
    {
        return $this->uploadApi()->explicit($publicId, $options);
    }


    // rename file from cloudinary
    public function rename(string $oldname, string $newname, array $options = [])
    {
        return $this->uploadApi()->rename($oldname, $newname, $options);
    }


    // rename async file from cloudinary
    public function renameAsync(string $oldname, string $newname, array $options = [])
    {
        return $this->uploadApi()->renameAsync($oldname, $newname, $options);
    }


    // get url
    public function getUrl()
    {
        return $this->response['url'];
    }

    //get secure url (https)

    public function getSecureUrl()
    {
        return $this->response['secure_url'];
    }

    //get public id

    public function getPublicId()
    {
        return $this->response['public_id'];
    }


    // get asset id
    public function getAssetId()
    {
        return $this->response['asset_id'];
    }


    // get format
    public function getExtention()
    {
        return $this->response['format'];
    }

    // get original filename  before it was uploaded to Cloudinary

    public function getOriginalFileName()
    {
        return $this->response['original_filename'];
    }


    // get resource type. e.g image , video
    public function getResourceType()
    {
        return $this->response['resource_type'];
    }


    // get time/date of upload
    public function getUploadedAt()
    {
        return $this->response['created_at'];
    }


    // get version id
    public function getVersionId()
    {
        return $this->response['version_id'];
    }


    //get version of the uploaded cloudinary asset
    public function getVersion()
    {
        return $this->response['version'];
    }


    //get signature of the uploaded cloudinary asset
    public function getSignature()
    {
        return $this->response['signature'];
    }

    //get width of the uploaded cloudinary asset
    public function getWidth()
    {
        return $this->response['width'];
    }

    //get height of the uploaded cloudinary asset
    public function getHeight()
    {
        return $this->response['height'];
    }

    //get extension of the uploaded cloudinary asset
    public function getExtension()
    {
        return $this->response['format'];
    }

    //get filetype of the uploaded cloudinary asseti
    public function getFileType()
    {
        return $this->response['resource_type'];
    }

    //get time uploaded of the uploaded cloudinary asset
    public function getTimeUploaded()
    {
        return $this->response['created_at'];
    }

    //get tags of the uploaded cloudinary asset
    public function getTags()
    {
        return $this->response['tags'];
    }

    //get pages
    public function getPages()
    {
        return $this->response['pages'];
    }

    //get file size in human readable format as default
    // cconfirm if dev wants bytes size in normal format

    public function getFileSize(array $option = ['human_readable' => true])
    {
        $bytes =  $this->response['bytes'];


        // confirm if dev wants bytes size in human readable format
        if ($option['human_readable'] === false) {
            return $bytes;
        }


        return $this->Helper->human_readable_file_size($bytes);
    }


    /**
     *
     * ||||| fetching instance of resource w from remote with current configuration
     */

    // get new image with exisiting instance configuration

    public function fetchImage($publicId)
    {
        return $this->cloudinary->image($publicId);
    }

    // get new video with exisiting instance configuration


    public function fetchVideo($publicId)
    {
        return $this->cloudinary->video($publicId);
    }


    // get new file with exisiting instance configuration

    public function fetchFile($publicId)
    {
        return $this->cloudinary->raw($publicId);
    }


    public function fetchResource($data)
    {
        try {
            return $this->adminApi()->asset($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function fetchUrl($publicId)
    {
        $resource = $this->fetchResource($publicId);
        return $resource['securl_url'] ?? '';
    }


    /**
     * TO dos:
     * api method to attach a folder when uploading
     * uploadApis (individual assets) : rename
     * unsigned upload
     * Admin Apis
     * Create collages
     * tags
     * context,
     * text api,
     *check if file was uploaded successfully
     * and some functionalities like image video creation, and creation of collages that doesn't support collages yet
     *
     */
}
