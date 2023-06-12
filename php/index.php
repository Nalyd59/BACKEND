// phpinfo();

<?php include 'includes/head.inc.html'; ?>

<?php include 'includes/header.inc.html'; ?>
<div class='container'>
    <div class='row'>

        <div class='col'><?php include 'includes/ul.inc.php'; ?></div>

        <div class='col'><a id="id" href="?idPage=form" type="button" class="btn btn-primary btn-lg">Ajouter des données</a></div>

        <div class='col'><?php if (isset($_GET["idPage"])) {
            switch($_GET['idPage']) {
                case 'form':
                    echo '<style>#id { display:none;}</style>';
                    include "./includes/form.inc.html";
                    break;
                case 'debug':
                    echo '<style>#id { display:none;}</style>';
                    $table = $_POST;
                    var_dump($table);
                    break;
                case 'concat':
                    echo '<style>#id { display:none;}</style>';
                    break;
                case 'bouc':
                    echo '<style>#id { display:none;}</style>';
                    break;
                case 'fonc':
                    echo '<style>#id { display:none;}</style>';
                    break;
                default:
                include("./includes/404.html");
        }}?>
        </div>
        
    </div>
    


</div>


<?php include 'includes/footer.inc.html'; ?>
