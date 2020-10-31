<a href="/">Back</a>
<form method="post" action="/register<?php echo $referral ? '?r=' . $referral : null; ?>">
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required/>
    </div>

    <div>
        <label for="email">E-Mail</label>
        <input type="email" id="email" name="email" required/>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required/>
    </div>

    <div>
        <label for="password_confirmation">Password confirmation</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required/>
    </div>

    <?php if($user): ?>
        <div>
            <strong>Referred by: <?php echo $user['name']; ?></strong>
        </div>
    <?php endif; ?>

    <button type="submit">Register</button>
</form>