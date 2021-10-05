<?php

namespace App\Actions;

use App\Models\News;

class SaveNews
{
    private $news;
    private $attributes;
    public function __construct(News $news, array $attributes = [])
    {
        $this->news = $news;
        $this->attributes = $attributes;
    }

    public function handle()
    {
        $this->news->fill($this->attributes)->save();
    }
}
