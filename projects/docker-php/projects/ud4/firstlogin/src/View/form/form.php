<form method="POST" action="index.php?controller=User&amp;action=process">
    <link rel="stylesheet" href="./form.css">

<?php if (isset($errores['login'])): ?>
            <?= $errores['login']?>
        <?php endif?>
    <p>
        <label for="username">username</label>
        <input required type="text" placeholder="username..." name="data[username]" id="username" value="<?=($username ?? '')?>" />
        <?php if (isset($errores['username'])): ?>
            <?= $errores['username']?>
        <?php endif?>
    </p>

    <p>
        <label for="password">Password</label>
        <input required type="password" placeholder="password..." name="data[password]" id="password" />
        <?php if (isset($errores['password'])): ?>
            <?= $errores['password']?>
        <?php endif?>
    </p>

    <input type="submit" />

</form>
