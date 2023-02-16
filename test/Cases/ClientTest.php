<?php

declare(strict_types=1);

namespace HyperfTest\Cases;

use HyperfTest\HttpTestCase;

class ClientTest extends HttpTestCase
{
    
    public function testGetSuccessWithNoData(): void
    {

        $data = $this->client->get('/clients');
        
        $this->assertSame([],$data);
    }

    public function testGetByIdSuccess(): void
    {
        $data = $this->client->get('/clients/1000000');
        
        $this->assertSame(null,$data);
    }

    public function testSaveSuccess(): void
    {
        $data = $this->client->post('/clients',[
            'name'=>'Mercado Livre'
        ]);
        
        $this->assertSame(null,$data);
    }
    public function testDeleteSuccess(): void
    {
        $data = $this->client->delete('/clients',[]);
        
        $this->assertSame(null,$data);
    }
    public function testGetFreightsSuccess(): void
    {
        $data = $this->client->get('/clients/freight/1000000',[]);
        
        $this->assertSame(null,$data);
    }
}
