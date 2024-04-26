<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/upload.css">

    <title>Upload Files System</title>

    <script>
        function preview() {
            var image = document.getElementById('image');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</head>
<body>    
    <form action="action.php" method="post" enctype="multipart/form-data">
        <img src="" alt="img" id="image">
        
        <input type="file" class="file" name="file" id="file" onchange="preview()">        
        
        <div class="btns">
            <a href="index.php" class="btn-view">View uploads</a>
            <input type="submit" class="btn-submit" name="btn-submit" id="btn-submit" value="Upload">
        </div>

        <div class="message">
            <?php 
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            ?>
        </div>
    </form>
</body>
</html>