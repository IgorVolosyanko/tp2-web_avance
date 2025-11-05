<?php 

$msg=null;
if(isset($_GET['msg']) && $_GET['msg'] == 1){
    $msg = "Please check name!";
}elseif(isset($_GET['msg']) && $_GET['msg'] == 2){
    $msg = "Please email!";
}


require_once('header.php')
?>
    <div class="container">
        <form  action="books-index.php" method="post">
            <h1>Se connecter</h1>
            <span class="text-danger"><?= $msg ?></span>
            <label for="name">Nom</label>
            <input id="name" name="nom" type="name">
            <label for="email">courriel</label>
            <input id="email" name="courriel" type="email">
            <input type="submit" value="Se connecter" class="btn">
        </form>
    </div>
<?php 
require_once('footer.php')
?>