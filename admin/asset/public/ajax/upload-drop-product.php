<?php
    require '../../../../config/db.php';

    if(isset($_FILES['file']['name'])){
       
        $file_names = '';

        $total = count($_FILES['file']['name']);


        for($i = 0 ; $i < $total ; $i++ ){
            $filename  = $_FILES['file']['name'][$i];
            $extension = pathinfo($filename , PATHINFO_EXTENSION);

            $valie_extensions = array("png" , "jpg" , "jpeg");
            
            if(in_array($extension , $valie_extensions)){
                $new_name = rand().".".$extension;
                $path = "../uploads-drop/".$new_name;

                move_uploaded_file($_FILES['file']['tmp_name'][$i] , $path);
            
                $file_names .= $new_name  . " , ";
            }
            else{
                echo 'false';
            }
        }

        $sql = "INSERT INTO `uploads` (`file_name`) VALUES ('{$file_names}') ";

        if(mysqli_query($conn , $sql)){
            echo 'true';
        }
        else{
            echo 'false';
        }

    }

?>