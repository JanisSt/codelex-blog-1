<a href="/">Back</a>
<h1><?php echo $article->title(); ?></h1>
<p><?php echo $article->content(); ?></p>
<p>
    <small>
        <b><?php echo $article->createdAt(); ?></b>
    </small>
</p>
<hr />
<?php if (! empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <b><?php echo $comment->name() ?></b> <?php echo $comment->content(); ?>
                <small><?php echo $comment->createdAt(); ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <strong>No comments.</strong>
<?php endif; ?>
<hr />
<form method="post" action="/articles/<?php echo $article->id(); ?>/comments">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" style="display:block;" />
    </div>

    <div>
        <label for="content">Comment</label>
        <textarea name="content" id="content" rows="5" cols="30" style="display: block;"></textarea>
    </div>

    <button type="submit">Submit</button>
</form>