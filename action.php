<?php
    session_start();

    $dir = 'C:\wamp64\www\upload_files\assets\img\\';
    $input_name = 'file';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES[$input_name]) ){
        $name     = $_FILES[$input_name]['name'];
        $type     = $_FILES[$input_name]['type'];
        $tmp_name = $_FILES[$input_name]['tmp_name'];
        $error    = $_FILES[$input_name]['error'];
        $size     = $_FILES[$input_name]['size'];

        switch ($error) {
            case UPLOAD_ERR_OK:
                $_SESSION['msg'] = 'File uploaded successfully.';
                break;
            case UPLOAD_ERR_INI_SIZE:
                $_SESSION['msg'] = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $_SESSION['msg'] = 'The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $_SESSION['msg'] = 'The uploaded file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $_SESSION['msg'] = 'No file was uploaded.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $_SESSION['msg'] = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $_SESSION['msg'] = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
                break;
            case UPLOAD_ERR_EXTENSION:
                $_SESSION['msg'] = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
                break;
            default:
                $_SESSION['msg'] = 'Unknown upload error.';
            break;
        }

        if($error !== UPLOAD_ERR_OK){
            header("Location: upload.php");
            die();
        }
        else{
            $mimetype = mime_content_type($tmp_name);
            if ($mimetype!="image/jpeg" && $mimetype!="image/png") {
                $_SESSION['msg'] = 'Upload error: Invalid file type: '.$mimetype;
                header("Location: upload.php");
                die();
            }
            else if(is_uploaded_file($tmp_name) === false){
                $_SESSION['msg'] = 'Upload error: Invalid file definition.';
                header('Location: upload.php');
                die();
            }
            else{
                $uploadName = $name;
                $ext = strtolower(pathinfo($uploadName, PATHINFO_EXTENSION));
                $filename = round(microtime(true)).mt_rand().'.'.$ext; 

                move_uploaded_file($tmp_name, $dir.$filename);

                header("Location: upload.php");
            }
        }
    }   
    else{
        $_SESSION['msg'] = "File field is empty!";
        header("Location: upload.php");
    }
?>
