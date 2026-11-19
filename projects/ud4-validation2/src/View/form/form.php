<form method="POST" action="index.php?controller=Form&amp;action=process">
    <link rel="stylesheet" href="./form.css">


    <p>
        <label for="firstName">Name</label>
        <input required type="text" placeholder="first name" name="data[firstName]" id="firstName"
            value="<?= ($firstName ?? '') ?>" />

    </p>

    <p>
        <label for="surname">Surname</label>
        <input required type="text" placeholder="surname..." name="data[surname]" id="surname" 
            value="<?= ($surname ?? '') ?>" />



    </p>

    <p>
        <label for="mail">Mail</label>
        <input required type="email" placeholder="mail..." name="data[mail]" id="name" 
        value="<?= ($mail ?? '') ?>" />

    </p>

    <p>
        <label for="phone">Phone</label>
        <input required type="text" placeholder="phone..." name="data[phone]" id="phone"
            value="<?= ($phone ?? '') ?>" />

    </p>

        <p>
        <label for="url">Url</label>
        <input required type="url" placeholder="https://..." name="data[url]" id="url"
            value="<?= ($url ?? '') ?>" />

    </p>

    <fieldset >
        <legend>Actual ocupation</legend>

        <label>
            <input type="radio" name="data[ocupation]" value="unemployed" required>
            unemployed
        </label>

        <label>
            <input type="radio" name="data[ocupation]" value="half">
            Half time
        </label>

        <label>
            <input type="radio" name="data[ocupation]" value="full">
            Full time
        </label>
    </fieldset>

    <!-- Lenguajes de programación --><fieldset>
    <legend>Programming languages</legend>

    <label>
        <input type="checkbox" name="data[languages][]" value="Python">
        Python
    </label>

    <label>
        <input type="checkbox" name="data[languages][]" value="PHP">
        PHP
    </label>

    <label>
        <input type="checkbox" name="data[languages][]" value="JavaScript">
        JavaScript
    </label>

    <label>
        <input type="checkbox" name="data[languages][]" value="Java">
        Java
    </label>

    <label>
        <input type="checkbox" name="data[languages][]" value="C++">
        C++
    </label>

</fieldset>

    <input type="submit" />

</form>

<?php if (!empty($errors)): ?>

    <?php foreach ($errors as $error): ?>

        <?php if (is_array($error)): ?>

            <?php foreach ($error as $suberror): ?>
                <p class="error">
                    <?= htmlspecialchars($suberror, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endforeach; ?>

        <?php else: ?>

            <p class="error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>

        <?php endif; ?>

    <?php endforeach; ?>

<?php endif; ?>