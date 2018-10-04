<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Synchronizer Token Pattern - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<h1 class="form-title">Synchronizer Token Pattern Sample</h1>
<div class="form-class">
    <form action="../Server/token.php" method="POST">
        <input type="hidden" id="token" name="token" value="token">
        <input type="text" id="tokenEdit" name="editedToken" value="editedToken" onChange="tokenEditor();">
        <button type="button" id="assignToken" onClick="tokenEditor();">Change the Token</button>
        <button type="submit" name="submitCsrf">Submit</button>
        <?php
            if(isset($_COOKIE['csrf_session'])){
                echo 
                    '<button type="submit" value="Logout" name="logout">Logout</button>';
            }
        ?>
    </form> 
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
    $(document).ready(function(){
        $.ajax({
            url:'../Server/token.php',
            type:'POST',
            async:false,
            data:{'csrf':'<?php echo $_COOKIE["csrf_session"] ?>'},
            success:function(data){
                document.getElementById("token").value = data;
                document.getElementById("tokenEdit").value = data;
            },
            error:function(xhr,options,error){
                console.log("Error");
            }
        });
    });

    function tokenEditor(){
        if(document.getElementById("token").value == document.getElementById("tokenEdit").value){
            alert("Please change the token by typing in the text field!");
        }
        else{
            document.getElementById("token").value = document.getElementById("tokenEdit").value;
            alert("Token changed successfully, now submit to see the results.");
        } 
    }
</script>
    
</body>
</html>