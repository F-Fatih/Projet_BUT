<?php
require_once "view_begin.php";

if(isset($data["error"])){
    ?>
    <script>
        alert("<?=$data["error"]?>");    
    </script>
    <?php
}

?>  
<link rel="stylesheet" href="Content/css/login.css">

<div class="forms">
    <form class="formLogin" action="./index.php?controller=auth&action=verifyCredentials" method="POST">
        <h1>CONNEXION</h1>
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="example@mail.com" name="email" required>

        <label for="passw"><b>Mot de passe</b></label>
        <input type="password" placeholder="**********" name="passw" required>

        <input type="submit" value="Se connecter" class="btn btn-warning">
    </form>

    <form class="formLogin" action="./index.php?controller=auth&action=createAccount" method="POST">
        <h1>INSCRIPTION</h1>
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="example@mail.com" name="email" required>

        <label for="username"><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Nom" name="username" required>

        <label for="passw"><b>Password</b></label>
        <input type="password" placeholder="**********" name="passw" required>

        <input type="submit" value="S'inscrire" class="btn btn-warning">
    </form>
</div>

<?php
require_once "view_end.php";
