<form action="processLogin" method="post">
    <label for="email">Email</label>
    <input type="text" name="data[email]" id="email" value="<?= $email ?? "" ?>">

    <label for="password">Password</label>
    <input type="text" name="data[password]" id="password">

    <input type="submit" value="Send" id="submit">
</form>

<p>
        <?php if(!empty($errors)):?>
        <?php foreach($errors as $error):?>
        <p>
            <?=$error?>
        </p>
        <?php endforeach;?>
    <?php endif;?>
</p>