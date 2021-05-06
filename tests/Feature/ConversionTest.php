<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConversionTest extends TestCase
{
    /**
     * Test getting all conversions
     *
     * @return void
     */
    public function test_getting_all_conversions()
    {
        $response = $this->get('/api/conversions');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'integer',
                    'roman',
                    'count',
                    'created_at'
                ]
            ]
        ]);
    }

    /**
     * Test getting top 10 conversions
     *
     * @return void
     */
    public function test_getting_top_conversions()
    {
        $response = $this->get('/api/conversions/top');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'integer',
                    'roman',
                    'count',
                    'created_at'
                ]
            ]
        ]);
        $response->assertJsonCount(10, 'data');
    }

    /**
     * Test converting integer to the roman numerals
     *
     * @return void
     */
    public function test_create_conversion()
    {
        $response = $this->post('/api/conversions/convert', ['integer' => 33]);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'integer' => 33,
                'roman' => 'XXXIII',
            ]
        ]);
    }
}
