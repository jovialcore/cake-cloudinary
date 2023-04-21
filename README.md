# CakePHP Cloudinary Plugin

The CakePHP Cloudinary Plugin provides an easy-to-use wrapper for the Cloudinary PHP SDK to enable easy file uploads to your Cloudinary account in CakePHP projects.

## Installation

Install the plugin using composer:

```bash
composer require cloudinary/cakephp-cloudinary
```

Then, load the plugin by adding the following line in your `config/bootstrap.php` file:

```php
Plugin::load('Cloudinary');
```

## Configuration

Add your Cloudinary configuration in `app.php`:

```php
'Cloudinary' => [
    'default' => [
        'cloud_name' => 'YOUR_CLOUD_NAME',
        'api_key' => 'YOUR_API_KEY',
        'api_secret' => 'YOUR_API_SECRET',
    ]
],
```

## Usage

### Instantiating Cloudinary

To start using Cloudinary, you need to first instantiate the Cloudinary PHP SDK in your controller using the `startUpCloudinary()` method:

```php
public function startUpCloudinary()
{
    $cloudinaryConfig = Configure::read('Cloudinary.default');

    $this->cloudinary = new Cloudinary($cloudinaryConfig);
}
```

### Uploading assets

To upload an asset to your Cloudinary account, you can use the `upload()` method. The first parameter can be a file path, a `FormData` object or a `data URI`. The second parameter is an array of upload options, and the third parameter is an array of Cloudinary URL options.

```php
public function upload(string|object $file, array $options = [], array $url = [])
{
    $this->response = $this->uploadApi()->upload($file, $options);

    $this->Helper->getSecureUrlFromArgsArr(func_get_args(), $this->response);

    return $this->response;
}
```

For example:

```php
$this->startUpCloudinary();

$this->upload('path/to/your/file.jpg', ['folder' => 'my_folder']);
```

### Uploading videos

To upload a video asset to your Cloudinary account, you can use the `uploadVideo()` method. The first parameter can be a file path, a `FormData` object or a `data URI`. The second parameter is an array of upload options, and the third parameter is an array of Cloudinary URL options.

```php
public function uploadVideo(string|object $file, array $options = [], array $url = [])
{
    $this->response = $this->uploadApi()->upload($file, $options);

    $this->Helper->getSecureUrlFromArgsArr(func_get_args(), $this->response);

    return $this->response;
}
```

For example:

```php
$this->startUpCloudinary();

$this->uploadVideo('path/to/your/video.mp4', ['resource_type' => 'video']);
```

### Uploading any file

To upload any type of file to your Cloudinary account, you can use the `uploadFile()` method. The first parameter can be a file path, a `FormData` object or a `data URI`. The second parameter is an array of upload options, and the third parameter is an array of Cloudinary URL options.

```php
public function uploadFile($file, array $options = [], array $url = [])
{
    $anyFileParams  = ['resource_type' =>  'auto'];

    $options = array_merge($options, $anyFileParams);
    $this->response = $this->uploadApi()->upload($file, $options);

    $this->Helper->getSecureUrlFromArgsArr(func_get_args(), $this->response);

    return $this->response;
}
