<?php 
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
if(isset($_SESSION["login"]) && $_SESSION["login"]==true)
{
    
}else{
    die("No ejecutes este archivo, primero es mejor index");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="./libs/css/style.css" type="text/css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        
        <form action="" method="post" class="login">
            <fieldset>
                <div class="form-group">
                <label for="usuario" class="form-group">Usuario:</label>
                <input type="text" name="usuario" id="usuario" class="form-control"/><br/>
                </div>
                <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" /><br/>
                </div>
                <input type="submit" name="entrar" value="Acceder" class="btn btn-primary"/>
            </fieldset>
        </form>
            
    </body>
</html>