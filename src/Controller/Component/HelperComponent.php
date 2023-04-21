<?php

declare(strict_types=1);

namespace CakeCloudinary\Controller\Component;

use Cake\Controller\Component;
use InvalidArgumentException;
use Cake\Controller\ComponentRegistry;

/**
 * Helper component
 */
class HelperComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];


    // credits : https://gist.github.com/liunian/9338301?permalink_comment_id=3581430#gistcomment-3581430

    public function initialize(array $config): void
    {
        parent::initialize($config);
    }

    public function human_readable_file_size($bytes)
    {
        $i = floor(log($bytes, 1024));

        round($bytes / pow(1024, $i), [0, 0, 2, 2, 3][$i]) . ['B', 'KB', 'MB', 'GB', 'TB'][$i];
    }


    public function fine()
    {
        echo "jovialcore is";
    }


    public function getSecureUrlFromArgsArr(array $functionArg, $response)
    {
        foreach ($functionArg as $key => $param) {
            //confirm that the argument we want is of an array type
            if (is_array($functionArg[$key])) {
                //check if the key of the  array is 'getUrl'
                if (array_keys($functionArg[$key])[0]  == 'getUrl') {
                    //check if the getUrl key's value is a boolean type
                    if (is_bool($functionArg[$key]['getUrl'])) {
                        //check if the value of getUrl  is set to true
                        if ($functionArg[$key]['getUrl'] == true) {
                            // return secure url
                            return  $response['secure_url'];
                        } else {
                            // return default rxesponse
                            return  $response;
                        }
                    } else {
                        throw new InvalidArgumentException('the getUrl key value must be a type of boolean');
                    }
                } else {
                    throw new InvalidArgumentException("the array key must be type of this string 'getUrl' ");
                }
            }
        }
    }
}
