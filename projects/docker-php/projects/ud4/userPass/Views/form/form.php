<form method="POST" action="index.php?controller=contactrequest&amp;action=process">

    <?$errores?>

    <p>
        <label for="username">username</label>
        <input required type="text" placeholder="username..." name="data[username]" id="username" />
    </p>

    <p>
        <label for="password">password</label>
        <input required type="password" placeholder="password..." name="data[lastname]" id="password" />
    </p>

    <input type="submit" />
</form>