<?php

namespace Therour\WpApiClientTests\Models;

use Therour\WpApiClient\Models\WpPost;
use Therour\WpApiClientTests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_posts()
    {
        $posts = WpPost::get();
        $this->assertInstanceOf(
            \Illuminate\Support\Collection::class,
            $posts
        );
        $this->assertTrue($posts->every(function ($item) {
            return $item instanceof WpPost;
        }));
    }

    /** @test */
    public function it_can_retrieve_post_by_id()
    {
        $id = 17502;
        $this->assertInstanceOf(WpPost::class, WpPost::find($id));
    }
}
