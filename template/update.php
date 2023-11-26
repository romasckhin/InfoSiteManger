<?php

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);
    $cid = $_POST['cid'];


    $uploadedFileName = $_FILES['image']['name'];
    $destinationPath = 'static/images/' . $uploadedFileName;

    if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] !== '') {
        move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath);
        $image = $uploadedFileName;
    }
    else {
        $image = $result['image'];
    }

    $id = $route[2];
    $update = updateAticle($id, $title, $url, $descr_min, $description, $cid, $image);

    if ($update) {
        // setcookie("alert", "update ok", time() + 60 * 10);
        header('Location: /admin');
    }
}

?>


<h1>update</h1>

<form action="" method='post' enctype='multipart/form-data'>
    <p>Title: <input type="text" name="title" value="<?php echo $result['title'] ?>"></p>
    <p>URL: <input type="text" name="url" value="<?php echo $result['url'] ?>" ></p>
    <p>Descr_min: <textarea type="text" name="descr_min" ><?php echo $result['descr_min'] ?></textarea></p>
    <p>Description: <textarea type="text" name="description"><?php echo $result['description'] ?></textarea></p>
    <p>
        Caregory:
        <select name='cid'>
            <?php
                $out = '';
                foreach($category as $item) {
                    if ($item['id'] === $result['cid']) {
                        $out .= '<option value="' . $item['id'] . '" selected>' . $item['title'] . '</option>';
                    }
                    $out .= '<option value="' . $item['id'] . '">' . $item['title'] . '</option>';
                }
                echo $out;
            ?>
        </select>
    </p>
    <p>Photo: <input type="file" name="image"  value="<?php echo $result['image'] ?>"></p>
    <?php
        if (isset($result['image']) && $result['image'] !== '') {
            echo '<img src="/static/images/'. $result['image'].'" style="width:100px" >';
        }
    ?>
    <p><input type="submit" name="submit" value='update'></p>
</form>