<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TranslationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    // public function test_admin_can_view_all_translations()
    // {
    //     // create translation
    //     // assert see translation->en , translation->mn
    //     $response = $this->get('translations');
    //     $response->assertStatus(403);
    // }

    public function test_admin_can_create_translation()
    {
        $translation  = factory('App\Translation')->create();

        $response = $this->get('/translations/'. $translation->id);

        $response->assertSee($translation->en);
    }

}
