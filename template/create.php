<?php

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);
    $cid = $_POST['cid'];

    // move_uploaded_file($_FILES['image']['tmp_name'], 'static/images/' . $_FILES['image']['tmp_name'] );

    $uploadedFileName = $_FILES['image']['name'];
    $destinationPath = 'static/images/' . $uploadedFileName;

    move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath);


    $image = $uploadedFileName;


    $create = creareAticle($title, $url, $descr_min, $description, $cid, $image);

    if ($create) {
        header('Location: /admin');
    }
}

?>


<h1>Create</h1>

<form action="" method='post' enctype='multipart/form-data'>
    <p>Title: <input type="text" name="title"></p>
    <p>URL: <input type="text" name="url"></p>
    <p>Descr_min: <textarea type="text" name="descr_min"></textarea></p>
    <p>Description: <textarea type="text" name="description"></textarea></p>
    <p>
        Caregory:
        <select name='cid'>
            <?php
                $out = '';
                foreach($category as $item) {
                    $out .= '<option value="' . $item['id'] . '">' . $item['title'] . '</option>';
                }
                echo $out;
            ?>
        </select>
    </p>
    <p>Photo: <input type="file" name="image"></p>
    <p><input type="submit" name="submit" value='create'></p>
</form>