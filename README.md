# CakePHP Cloudinary Plugin

The CakePHP Cloudinary Plugin provides an easy-to-use wrapper for the Cloudinary PHP SDK to enable easy file uploads to your Cloudinary account in CakePHP projects.

Install the plugin using composer
## Installation


```bash
composer require jovialcore/cake-cloudinary
```

You will also need to configure the Cloudinary credentials in the `app.php` file:

```php
// config/app_local.php
// In the return block, add: 

    // ...
    'Cloudinary' => [
        'default' => [
            'cloud_name' => 'your_cloud_name',
            'api_key' => 'your_api_key',
            'api_secret' => 'your_api_secret',
            'secure' => true // use HTTPS
        ],
    ],
    // ...
];
```

## Usage

To use the Cloudinary component in your controller, you need to load it in your `initialize` method:

```php
// src/Controller/YourController.php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class YourController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('CakeCloudinary.Cloudinary');
    }

    // ...
}
```

### Uploading an asset

The `$file` parameter can be a file path, a `File` object or a `$this->request->getUploadedFiles()` |  `$this->request->getUploadedFile();` object.

Quickily upload an asset and return a secure url 
```php
$this->Cloudinary->upload($file, ['getUrl' => 'true']);
```

Quickily upload a video asset and return a secure url 
```php
$this->Cloudinary->uploadVideo($file, ['getUrl' => 'true']);
```

Quickily upload any file (e.g, pdf, csv, etc) asset and return a secure url 
```php
$this->Cloudinary->uploadFile($file, ['getUrl' => 'true']);
```
The assets method can also take an array of options as second argument. The options array can include any of the options supported by the Cloudinary API. See the [Cloudinary PHP Image Upload API documentation](https://cloudinary.com/documentation/php_image_and_video_upload#server_side_upload) for a list of available options.
Example: 
```php
$this->Cloudinary->upload($file,[
    'folder' => 'my_cloudinary_folder',
      'public_id' => 'my_video_name',
]);
```
The asset method/apis also returns a response object that contains the uploaded image's metadata, including its URL and public ID. You can retrieve the URL of the uploaded image using the `getUrl` or `getSecureUrl` methods of the Cloudinary component:

```php
$url = $this->Cloudinary->getUrl(); // get url of uploaded file (http)

$secureUrl = $this->Cloudinary->getSecureUrl(); //  get secureUrl of the uploaded asst

$publicId = $this->Cloudinary->getPublicId(); // get public Id of the uploaded asset

$originalFIleName = $this->Cloudinary->getOriginalFileName(); // get the asset name before it was uploaded to cloudinary

$resourceType = $this->Cloudinary->getUploadedAt(); // get the time the asset as uploaded

$extension = $this->Cloudinary->getExtension(); // get file extension of the uploaded asset e.g jpg, .pdf, .png, etc

$fileType = $this->Cloudinary->getFileType(); // get asset type. E.g, image, video, etc. 

$fileSize = $this->Cloudinary->getFileSize(); //get uploaded asset file's size by defaults, it returns a human readable file size like 20MB, 20kb, etc

// If you prefer to get just the raw bytes, 
$fileizeInBytes = this->Cloudinary->getFileSize(['human_readable' => false]);


$height = $this->Cloudinary->getHeight(); // get asset height

$width = $this->Cloudinary->getWidth(); // get asset width
```
#### Delete assets

```php
$res = $this->Cloudinary->delete($publidId);
```

#### Fetching remote assets
```php
// get url from an asset

$url = $this->Cloudinary->fetchUrl($publicId);

```



## Credits
- [Chidiebere Chukwudi](https://github.com/jovialcore)
- [All Contributors](../../contributors)

This plugin drew inspiration from the [Laravel Cloudinary Package](https://github.com/cloudinary-devs/cloudinary-laravel)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
