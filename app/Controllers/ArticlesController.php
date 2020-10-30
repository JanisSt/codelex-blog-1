<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Comment;

class ArticlesController
{
    private array $articles;

    public function index()
    {
        $articlesQuery = query()
            ->select('*')
            ->from('articles')
            ->orderBy('created_at', 'desc')
            ->execute()
            ->fetchAllAssociative();

        $articles = [];

        foreach ($articlesQuery as $article) {
            $articles[] = new Article(
                (int)$article['id'],
                $article['title'],
                $article['content'],
                $article['created_at']
            );
        }

        return require_once __DIR__ . '/../Views/ArticlesIndexView.php';
    }

    public function show(array $vars)
    {
        $articleQuery = query()
            ->select('*')
            ->from('articles')
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute()
            ->fetchAssociative();

        $commentsQuery = query()
            ->select('*')
            ->from('comments')
            ->where('article_id = :articleId')
            ->setParameter('articleId', (int)$vars['id'])
            ->orderBy('created_at', 'desc')
            ->execute()
            ->fetchAllAssociative();

        $comments = [];

        foreach ($commentsQuery as $comment) {
            $comments[] = new Comment(
                $comment['id'],
                $comment['article_id'],
                $comment['name'],
                $comment['content'],
                $comment['created_at'],
            );
        }

        $article = new Article(
            (int)$articleQuery['id'],
            $articleQuery['title'],
            $articleQuery['content'],
            $articleQuery['created_at'],
        );

        return require_once __DIR__ . '/../Views/ArticlesShowView.php';
    }

    public function delete(array $vars)
    {
        query()
            ->delete('articles')
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute();

        header('Location: /');
    }

    public function create()
    {
        return require_once __DIR__ . '/../Views/ArticlesCreateView.php';
    }

    public function add()
    {
        if (isset($_POST)) {
            $articleQuery = query()
                ->insert('articles')
                ->values([
                    'title' => '?',
                    'content' => '?'
                ])
                ->setParameter(0, $_POST['title'])
                ->setParameter(1, $_POST['content']);
            $articleQuery->execute();
            $this->index();
        }
    }

    public function edit(array $vars)
    {

        $articleQuery = query()
            ->select('*')
            ->from('articles')
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute()
            ->fetchAssociative();


        $article = new Article(
            (int)$articleQuery['id'],
            $articleQuery['title'],
            $articleQuery['content'],
            $articleQuery['created_at'],
        );


        return require_once __DIR__ . '/../Views/ArticlesEditView.php';
    }

    public function update(array $vars)
    {
        query()
            ->update('articles')
            ->set('title', ':title')
            ->set('content', ':content')
            ->setParameters([
                'title' => $_POST['title'],
                'content' => $_POST['content']
            ])
            ->where('id=:id')
            ->setParameter('id', $vars['id'])
            ->execute();
        header('Location: /articles/' . $vars['id'] . '/edit');

    }
}