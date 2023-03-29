<?php
declare(strict_types=1);

namespace CakeCloudinary\Test\TestCase\Controller\Component;

use CakeCloudinary\Controller\Component\CloudinaryComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * CakeCloudinary\Controller\Component\CloudinaryComponent Test Case
 */
class CloudinaryComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \CakeCloudinary\Controller\Component\CloudinaryComponent
     */
    protected $Cloudinary;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Cloudinary = new CloudinaryComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Cloudinary);

        parent::tearDown();
    }
}
