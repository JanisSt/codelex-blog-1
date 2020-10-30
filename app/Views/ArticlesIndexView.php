<h1>Articles</h1>
<a href="articles/create">Add new</a>
<?php foreach ($articles as $article): ?>
    <h3>
        <a href="/articles/<?php echo $article->id(); ?>">
            <?php echo $article->title(); ?>
        </a>
    </h3>

    <p><?php echo $article->content(); ?></p>
    <p>
        <small>
            <?php echo $article->createdAt(); ?>
        </small>
    </p>
    <hr>
    <form method="post" action="/articles/<?php echo $article->id(); ?>">
        <input type="hidden" name="_method" value="DELETE"/>
        <button type="submit" onclick="return confirm('Are you sure?');">Delete</button>
    </form>

    <a href="/articles/<?php echo $article->id(); ?>/edit">Edit</a>
    <hr>
<?php endforeach; ?>
