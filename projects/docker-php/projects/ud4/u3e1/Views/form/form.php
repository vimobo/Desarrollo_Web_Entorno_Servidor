<form method="POST" action="index.php?controller=contact&amp;action=process">
    <p>
        <label for="username">Name</label>
        <input required type="text" placeholder="Name..." name="data[username]" id="username" />
    </p>

    <p>
        <label for="lastname">Last name</label>
        <input required type="text" placeholder="Last name..." name="data[lastname]" id="lastname" />
    </p>
    <p>
        <label for="mail">Mail</label>
        <input required type="text" placeholder="Mail..." name="data[mail]" id="mail" />
    </p>
    <p>
        <label for="birth">Last name</label>
        <input required type="text" placeholder="Date of birth..." name="data[birth]" id="birth" />
    </p>
    <p>
        <label for="check">Accept condition terms</label>
        <input required type="checkbox" name="data[check]" id="check" />
    </p>

    <input type="submit" />
</form>