<?php

declare(strict_types=1);

namespace CakeCloudinary\Controller\Component;

use Cake\Controller\Component;
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



    public function human_readable_file_size($bytes)
    {
        $i = floor(log($bytes, 1024));

        round($bytes / pow(1024, $i), [0, 0, 2, 2, 3][$i]) . ['B', 'KB', 'MB', 'GB', 'TB'][$i];
    }
}
