<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="date" name="date" id="date">
        <input type="submit" name="submit" value="Date">
    </form>
    <br><br><br>
    
    <?php
    if (isset($_POST["submit"])) {
        $date = $_POST["date"];

        $petsa = date('Y-m-d', strtotime($date));
        
        echo $petsa;
    }
    ?>
</body>
</html>
