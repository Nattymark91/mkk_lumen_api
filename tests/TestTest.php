<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Loans;

class TestTest extends TestCase
{
    public function testGet()
    {
        $response = $this->get('/api/loans');
        $this->assertEquals(200, $this->response->status());
    }

    public function testPost () 
    {
        $response = $this->call('POST', '/api/loans/create', array(
            'title' => 'loanForTest',
            'sum' => 555
        ));
        $this->assertEquals(201, $this->response->status());
    }

    public function testDelete ()
    {   
        $testloan = Loans::where('title', 'loanForTest')->get();
        $id = $testloan[0]->id;
        $response = $this->delete("/api/loans/{$id}");
        $this->assertEquals(200, $this->response->status());
    }
}
