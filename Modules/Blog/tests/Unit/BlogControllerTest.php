<?php

namespace Modules\Blog\Tests\Unit;

use Tests\TestCase;
use Modules\Blog\Http\Controllers\BlogController;

class BlogControllerTest extends TestCase
{
    public function test_blog_controller_index_returns_view()
    {
        $controller = new BlogController();
        $response = $controller->index();

        $this->assertEquals('blog::index', $response->getName());
    }
}
