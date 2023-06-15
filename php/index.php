<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $prenom = $_POST['firstname'];
        $nom = $_POST['lastname'];
        $age = $_POST['old'];
        $taille = $_POST['size'];
        $genre = $_POST['sexe'];

        $table = array();

        $table['firstname'] = $prenom;
        $table['lastname'] = $nom;
        $table['old'] = $age;
        $table['size'] = $taille;
        $table['sexe'] = $genre;

    $_SESSION['table'] = $table;
}
?>

<?php include 'includes/head.inc.html'; ?>

<?php include 'includes/header.inc.html'; ?>
<div class='container'>
    <div class='row'>

        <div class='col-3'>
            <?php include 'includes/ul.inc.php'; ?>
        </div>

        <div class='col-9'>
            <a id="id" href="?idPage=form" type="button" class="btn btn-primary btn-lg" name='donnees'>Ajouter des données</a>
            <?php
            if (isset($_GET["idPage"])) {
                    
                switch($_GET['idPage']) {

                case 'form':
                    echo '<style>#id {display:none};</style>';
                    include "./includes/form.inc.html";
                    break;
                case 'debug':
                    echo '<style>#id {display:none};</style>';
                    echo '===> Lecture du tableau avec la fonction print_r()';
                    echo '<pre>';
                    print_r($_SESSION['table']);
                    echo '</pre>';
                    break;
                case 'concat':
                    echo '<style>#id {display:none};</style>';
                    $table = $_SESSION['table'];

                    echo '===> Construction d\'une phrase avec le contenu du tableau<br>';

                    echo 'Bonjour ' . $table['sexe'] . ' ' . $table['firstname']. ' ' . $table['lastname']. '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . $table['size'] . 'm.<br><br>';

                    echo '===> Construction d\'une phrase après MAJ du tableau<br>';

                    echo 'Bonjour ' . $table['sexe'] . ' ' . ucfirst( $table['firstname']). ' ' . strtoupper($table['lastname']). '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . $table['size'] . 'm.<br><br>';

                    echo '===> Affichage d\'une virgule à la place du point pour la taille<br>';

                    echo 'Bonjour ' . $table['sexe'] . ' ' . ucfirst( $table['firstname']). ' ' . strtoupper($table['lastname']). '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . str_replace('.',',',$table['size']). 'm.';

                    break;
                case 'bouc':
                    echo '<style>#id {display:none};</style>';
                    $table = $_SESSION['table'];
                    echo '===> Lecture du tableau a l\'aide d\'une boucle foreach<br><br>';
                    foreach ($table as $key => $value) {
                        # code...
                        echo 'à la ligne n°0 correspond la clé '. $key .' et contient "'. $value .'"<br>';
                    }
                    break;
                case 'fonc':
                    echo '<style>#id {display:none};</style>';
                    echo '===> Lecture du tableau a l\'aide d\'une boucle foreach<br><br>';
                    function readTable(){
                        $table = $_SESSION['table'];
                        foreach ($table as $key => $value) {
                            # code...
                            echo 'à la ligne n°0 correspond la clé '. $key .' et contient "'. $value .'"<br>';
                        }
                    };
                    readTable();
                    break;
                case 'supp':
                    break;
                default:
            }
            }
            ?>
        </div>

    </div>   
</div>
<br>
<?php include 'includes/footer.inc.html'; ?>
