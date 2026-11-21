<form action="processRegister" method="post">
    <label for="email">Email</label>
    <input type="text" name="data[email]" id="email" value="<?= $email ?? "" ?>">

    <label for="password">Password</label>
    <input type="text" name="data[password]" id="password">

    <label for="passwordR">Password Repeat</label>
    <input type="text" name="data[passwordR]" id="passwordR">

    <input type="submit" value="Send" id="submit">


    <?php if(!empty($errors)):?>
        <?php foreach($errors as $error):?>
        <p>
            <?=$error?>
        </p>
        <?php endforeach;?>
    <?php endif;?>
</form>