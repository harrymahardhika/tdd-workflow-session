<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function visit_index_page_returns_ok(): void
    {
        $this->get(route('news.index'))
            ->assertOk();
    }

    /**
     * @test
     */
    public function visit_create_page_returns_ok(): void
    {
        $this->get(route('news.create'))
            ->assertOk();
    }

    /**
     * @test
     */
    public function visit_edit_page_returns_correct_news(): void
    {
        $news = News::factory()->create();
        $otherNews = News::factory()->create();

        $this->get(route('news.edit', $news))
            ->assertOk()
            ->assertViewHas('news')
            ->assertSee($news->title)
            ->assertSee($news->body)
            ->assertDontSee($otherNews->title);
    }

    /**
     * @test
     */
    public function it_can_store_news(): void
    {
        $request = News::factory()->make();

        $this->post(route('news.store'), $request->toArray())
            ->assertRedirect(route('news.index'));

        $this->assertDatabaseHas('news', [
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }

    /**
     * @test
     */
    public function it_can_update_news(): void
    {
        $news = News::factory()->create();

        $request = News::factory()->make();

        $this->put(route('news.update', $news), $request->toArray())
            ->assertRedirect(route('news.index'));

        $news->refresh();

        self::assertSame($request->title, $news->title);
        self::assertSame($request->body, $news->body);
    }
}
