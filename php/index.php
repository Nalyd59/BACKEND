// phpinfo();

<?php include 'includes/head.inc.html'; ?>

<?php include 'includes/header.inc.html'; ?>

<div class="d-inline-flex p-1">

<?php include 'includes/ul.inc.php' ?>

<button href="?idPage=form" type="button" class="btn btn-primary btn-lg">  Ajouter des données</button>

<?php
if (isset($_GET["idPage"])) {
    switch($_GET['idPage']) {
        case 'form':
            include "./includes/form.inc.html";
            break;
        default:
            include("./includes/404.inc.html");
    }
    }else {
        include "./includes/form2.inc.html";
    }
?>
</div>


<?php include 'includes/footer.inc.html'; ?>
