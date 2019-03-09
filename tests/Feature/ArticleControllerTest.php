<?php

namespace Tests;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    use WithFaker;

    public function testCreateArticle()
    {
        $requestBody = [
            'name' => $this->faker->sentence(),
            'body' => $this->faker->paragraph()
        ];

        $this->post(route('articles.store'), $requestBody);

        $this->assertDatabaseHas('articles', $requestBody);
    }

    public function testReadArticle() {
        factory(Article::class, 10)->create();

        $articles = $this->get(route('articles.index'))->viewData('articles');

        $this->assertCount(10, $articles);
    }

    public function testUpdateArticle() {
        $article = factory(Article::class)->create();
        $articleId = $article->id;

        $requestBody = [
            'name' => $this->faker->sentence(),
            'body' => $this->faker->paragraph()
        ];

        $this->patch(route('articles.update', ['id' => $articleId]), $requestBody);

        $expectedData = array_merge($requestBody, ['id' => $articleId]);

        $this->assertDatabaseHas('articles', $expectedData);
    }

    public function testDeleteArticle() {
        $article = factory(Article::class)->create();
        $articleId = $article->id;

        $this->delete(route('articles.destroy', ['id' => $articleId]));

        $this->assertDatabaseMissing('articles', [
            'id' => $articleId
        ]);
    }
}
