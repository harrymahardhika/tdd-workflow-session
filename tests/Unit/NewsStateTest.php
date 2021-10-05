<?php

namespace Tests\Unit;

use App\Models\News;
use App\NewsState;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class NewsStateTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_get_news_state(): void
    {
        $newsState = new NewsState();

        self::assertTrue($newsState->setState());
    }
}
