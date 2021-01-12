<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * Test if the app route is here.
     *
     * @return void
     */
    public function testApplicationReady()
    {
        $response = $this->get('route("any")');
        $response->assertStatus(200);
    }

    /**
     * Test if we can create a new product.
     *
     * @return void
     */
    public function testCreateNewProductSuccess()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->postJson(route('products.store'), [
            // u use the hash of the created file to do not get unique name error in validation
            'name' => substr($file->hashName(), 0, 10),
            'description' => 'productX description',
            'price' => 100,
            'categories' => '[1,2]',
            'image' => $file,
        ]);

        // the first run of this test sould give

        $response->assertStatus(201);
        Storage::disk('public')->assertExists('products/'.$file->hashName());

    }

    /**
     * Should not be created (I check that validation works fine & not any product stored).
     *
     * @return void
     */
    public function testCreateNewProductFailed()
    {
        $response = $this->postJson(route('products.store'), [
            'name' => 'xxxxxxxxxxxxxx',
        ]);

        // In the case the product is arleady exists we will get 422 status code
        $response->assertStatus(422);

        // see the problem (incopleted form)
        $response->dump();
    }
}
