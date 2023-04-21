## Installation

The recommended way to install the plugin is using Composer:

```bash
composer require cakephp-cloudinary/cloudinary
```

You will also need to configure the Cloudinary credentials in the `app.php` file:

```php
// config/app.php

return [
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

### Uploading an image

To upload an image to your Cloudinary account, you can call the `upload` method of the Cloudinary component. The method takes the file to be uploaded as the first argument and an array of options as the second argument:
// Upload the file to cloudinary and get a secure url in one liner
```php
$this->Cloudinary->upload($file, ['getUrl' => 'true']);
```
The `$file` parameter can be a file path, a `File` object or a `UploadedFile` object. The options array can include any of the options supported by the Cloudinary API. See the [Cloudinary PHP Image Upload API documentation](https://cloudinary.com/documentation/php_image_and_video_upload#server_side_upload) for a list of available options.
Example: 
```php
$this->Cloudinary->upload($file,[
    'folder' => 'my_cloudinary_folder',
      'public_id' => 'my_video_name',
], ['getUrl' => 'true']);
```
The `upload` method also returns a response object that contains the uploaded image's metadata, including its URL and public ID. You can retrieve the URL of the uploaded image using the `getUrl` or `getSecureUrl` methods of the Cloudinary component:

```php
$url = $this->Cloudinary->getUrl();
$secureUrl = $this->Cloudinary->getSecureUrl();
```

### Uploading a video

To upload a video to your Cloudinary account, you can call the `uploadVideo` method of the Cloudinary component. The method takes the video file to be uploaded as the first argument and an array of getUrl as part of the functions argument where you can specify if you want to quickly get secure url once an upload is successful. 

//  Quickly upload a video to Cloudinary and get a secure URL in one line of code
```php
$this->Cloudinary->uploadVideo($file, ['getUrl' => true]);
```
You can add `options` array as part of the parameter. The options array can include any of the options supported by the Cloudinary API. See the [Cloudinary PHP Image Upload API documentation](https://cloudinary.com/documentation/php_image_and_video_upload#server_side_upload) for a list of available options.

The `uploadVideo` method returns a response object that contains the uploaded video's metadata, including its URL and public ID. You can retrieve the URL of the uploaded video using the `getUrl` or `getSecureUrl` methods of the Cloudinary component:

```php
$url = $this->Cloudinary->getUrl();
$secureUrl = $this->Cloudinary->getSecureUrl();
```

### Uploading any file

To upload any type
