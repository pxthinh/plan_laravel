<?php

namespace Tests\Unit;

use App\Http\Controllers\PostController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\User;

class PostTest extends TestCase
{
    use RefreshDatabase;
    protected $postController;

    public function setUp() : void
    {
        parent::setUp();
       
        $this->postController = new PostController;
    }

    public function tearDown(): void
    {
        Post::truncate();
    }

    public function test_create_post(){
        $data = [
            "user_id" => 12,
            "title" => "1321",
            "body" => "jjj",
            "price" => 23
        ];

        // Gọi hàm tạo
        $post = $this->postController->create($data);
        // Kiểm tra xem kết quả trả về có là thể hiện của lớp Category hay không
        $this->assertInstanceOf(Post::class, $post);
        // Kiểm tra data trả về
        $this->assertEquals($post->user_id,12);
        $this->assertEquals($post->title,"1321");
        $this->assertEquals($post->body,"jjj");
        $this->assertEquals($post->price,23);
    }

    public function test_update_post(){
        $data = [
            "user_id" => 12,
            "title" => "1321",
            "body" => "jjj",
            "price" => 23
        ];

        $post = Post::create($data);

        $dataUpdate = [
            "user_id" => 12,
            "title" => "1321dsdsd",
            "body" => "jjjdsa",
            "price" => 231
        ];

        // Gọi hàm tạo
        $post = $this->postController->updated($post,$data);
        // Kiểm tra xem kết quả trả về có là thể hiện của lớp Category hay không
        $this->assertInstanceOf(Post::class, $post);
        // Kiểm tra data trả về
        $this->assertEquals($post->user_id,12);
        $this->assertEquals($post->title,"1321");
        $this->assertEquals($post->body,"jjj");
        $this->assertEquals($post->price,23);
    }
}
