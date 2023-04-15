<?php
declare(strict_types=1);

namespace CakeCloudinary\Test\TestCase\Controller\Component;

use CakeCloudinary\Controller\Component\HelperComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * CakeCloudinary\Controller\Component\HelperComponent Test Case
 */
class HelperComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \CakeCloudinary\Controller\Component\HelperComponent
     */
    protected $Helper;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Helper = new HelperComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Helper);

        parent::tearDown();
    }
}
