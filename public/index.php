<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
    
    <section class="container">


        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <select name="format">
                <option value="pdf"> PDF </option>
                <option value="docx"> Word </option>
            </select>
            <input type="submit" value="Change">
        </form>
    </section>

</body>
</html>
