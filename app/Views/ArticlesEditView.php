<a href="/">Back</a>
<br>
<h1>Edit <?php echo $article->title(); ?></h1>

<form method="post" action="/articles/<?php echo $article->id(); ?>">
    <?php var_dump($article->id()) ?>
    <input type="hidden" name="_method" value="PUT">
    Content: <br><textarea name="title" id="title" cols="30" rows="10"><?php echo $article->title(); ?></textarea> <br>
    Content: <br><textarea name="content" id="content" cols="30" rows="10"><?php echo $article->content(); ?></textarea><br>

    <button type="submit">Submit</button>


</form>


