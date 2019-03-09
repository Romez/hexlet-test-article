<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Support\Collection;
use Tests\TestCase;
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

        $this->post(route('article.store'), $requestBody);

        $this->assertDatabaseHas('articles', $requestBody);
    }

    public function testReadArticle() {
        factory(Article::class, 10)->create();

        $articles = $this->get(route('articles'))->viewData('articles');

        $this->assertCount(10, $articles);
    }

    public function testUpdateArticle() {
        $article = factory(Article::class)->create();
        $articleId = $article->id;

        $requestBody = [
            'name' => $this->faker->sentence(),
            'body' => $this->faker->paragraph()
        ];

        $this->patch(route('article.update', ['id' => $articleId]), $requestBody);

        $expectedData = array_merge($requestBody, ['id' => $articleId]);

        $this->assertDatabaseHas('articles', $expectedData);
    }

    public function testDeleteArticle() {
        $article = factory(Article::class)->create();
        $articleId = $article->id;

        $this->delete(route('article.destroy', ['id' => $articleId]));

        $this->assertDatabaseMissing('articles', [
            'id' => $articleId
        ]);
    }
}
