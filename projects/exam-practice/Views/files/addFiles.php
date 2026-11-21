<form method="POST" action="addFiles" enctype="multipart/form-data">

        <label for="gameName">Name</label>
        <input type="text" name="data[gameName]" id="gameName" value="<?=$gameName ?? "" ?>">

        <label for="gameDescription">Description</label>
        <input type="text" name="data[description]" id="gameDescription" value="<?=$description ?? "" ?>">

        <label for="gameAuthor">Author</label>
        <input type="text" name="data[author]" id="gameAuthor" value="<?=$author ?? "" ?>">

        <label  for="gameCategory">Game Category</label>
        <input type="text" name="data[category]" id="submitButton" value="<?=$category ?? "" ?>">

        <input type="file" name="data" id="file">
        <input type="submit" value="Upload Game" id="submitButton">
    </form>
    <p>
        <? $errors ?>
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
            <p>
                <?= $error ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
    </p>