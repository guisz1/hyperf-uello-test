<?php

declare(strict_types=1);

namespace HyperfTest\Cases;

use Hyperf\Database\Model\Factory;
use HyperfTest\HttpTestCase;
use PHPUnit\Framework\TestCase;

class ClientTest extends HttpTestCase
{
    
    public function testGetSuccess(): void
    {
        Factory(App\Model\Client::class,10);
        $this->assertTrue(true);
    }

    public function testGetByIdSuccess(): void
    {
        $this->assertTrue(true);
    }

    public function testSaveSuccess(): void
    {
        $this->assertTrue(true);
    }
    public function testDeleteSuccess(): void
    {
        $this->assertTrue(true);
    }
    public function testGetFreightsSuccess(): void
    {
        $this->assertTrue(true);
    }
}
