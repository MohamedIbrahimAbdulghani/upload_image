
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <h1 class=" text-center bg-success p-2">Upload File Using PHP</h1>
    <div class="container">
        <div class="row">
            <form action="<?php  ?>" class="col-sm-6" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <button type="submit" name = "submit"  class="btn btn-primary">Submit</button>
            </form>

            <div class="col-sm-6">
                <?php 
                $errors = "";
                $success = "";
                if($_SERVER["REQUEST_METHOD"] == "POST"): 
                    $image = $_FILES["image"];
                    
                    $image_name = $image["name"];
                    $image_type = $image["type"];
                    $image_tmp_name = $image["tmp_name"];
                    $image_error = $image["error"];
                    $image_size = $image["size"];

                    if(!empty($image_name)):
                        $extension = pathinfo($image_name);
                        $original_name = $extension["filename"];
                        $original_extension = $extension["extension"];
                        $allowed_array = array("png", "jpg", "jpeg", "gif");
                        if(in_array($original_extension, $allowed_array)):
                            if($image_error === 0):
                                if($image_size < 200000):
                                    $new_image_name = uniqid("", true) . "." . $original_extension;
                                    $destnotion = "uploads/" . $new_image_name;
                                    move_uploaded_file($image_tmp_name, $destnotion);
                                    $success = "Uploaded Image";
                                else:
                                    $errors = "Your File Is To Big";
                                endif;
                            else:
                                $errors = "Your Have An Error";
                            endif;
                        else:
                            $errors = "Your File Not Allowed Please Choose Allowed File";
                        endif;
                    else:
                        $errors = "Please Choose Image";
                    endif;

                endif; ?>

            <?php if(isset($_POST["submit"])): ?>
                <?php if(!empty($errors)): ?>
                        <h2 class="alert alert-danger col text-center"><?php echo $errors ?></h2>
                <?php endif; ?>
                <?php if(empty($errors)): ?>
                        <h2 class="alert alert-success col text-center"><?php echo $success ?></h2>
                <?php endif; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>