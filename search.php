<?php
session_start();

include_once "functions.php";
include_once "config.php";
$result=1;
$user_id=$_SESSION['id'] ?? 0;
$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_set_charset($connection,"utf8");
if(!$connection){
   throw new Exception("Databse connection failed!!");
}

if(!$user_id){
    header("location:index.php");
    die();
}
$action=$_POST['action'] ?? "";
if('search'==$action){
    $search_char=$_POST['alphabet'] ?? '';
    //echo $search_char
    if($search_char){
        $query="SELECT word,meaning FROM words WHERE user_id='{$user_id}' AND word LIKE '{$search_char}%'";
        
        $result=mysqli_query($connection,$query);
        

        
    }
}
else{
    header("Location:words.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo/Tasks</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="voc">
<div class="sidebar">
    <h4>Menu</h4>
    <ul class="menu">
        <li><a href="words.php" class="menu-item" >Back Words Page</a></li>
        
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
<div class="container" id="main">

    <h1 class="maintitle">
        <i class="fas fa-language"></i> <br/>My Vocabularies
    </h1>
    <div class="wordsc helement" id="words">
        <div class="row">
            <div class="column column-50">
                <div class="alphabets">
                <form action="search.php" method="post">
                    <select name="alphabet" id="alphabets">
                        <option value="all">All Words</option>
                        <option value="A">A#</option>
                        <option value="B">B#</option>
                        <option value="C">C#</option>
                        <option value="D">D#</option>
                        <option value="E">E#</option>
                        <option value="F">F#</option>
                        <option value="G">G#</option>
                        <option value="N">N#</option>
                        <option value="M">M#</option>
                    </select>
                    <input type="hidden" name="action" value="search">
                    <button class="float-right" name="submit" value="submit">Search</button>
                    </form>
                </div>
            </div>
            
            
            </div>
        </div>
        <hr>

        <table class="words" >
            <thead>
            <tr>
                <th width="20%">Word</th>
                <th>Definition</th>
            </tr>
            </thead>
            
            <tbody>
                <?php 
                      if(mysqli_num_rows($result)>0){
                        
                      while($data=mysqli_fetch_assoc($result)){ 
                ?>
			       <tr>
                       <td><?php echo $data['word'] ?></td>
                       <td><?php echo $data['meaning'] ?></td>
                   </tr>
                       <?php }
                      
                      } ?>       
            </tbody>
        </table>
    </div>

   
</body>
<script src="//code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="assets/js/script.js"></script>
</html>