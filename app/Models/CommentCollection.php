<?php

namespace App\Models;

class CommentCollection
{
    private array $items = [];

    public function __construct(array $comments)
    {
        $this->create($comments);
    }

    public function create(array $comments): void
    {
        foreach ($comments as $comment)
        {
            $this->items[] = new Comment(
                $comment['id'],
                $comment['article_id'],
                $comment['name'],
                $comment['content'],
                $comment['created_at'],
            );
        }
    }

    public function all(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}