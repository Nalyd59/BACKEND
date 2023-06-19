<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    function valid_int($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        if (!ctype_digit($donnees)) {
            session_destroy();
            echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données ERRORER</div>';
        }
        return $donnees;
    }
    function valid_float($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        if (!is_numeric($donnees)) {
            session_destroy();
            echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données ERRORER</div>';
        }
        return $donnees;
    }
    function valid_string($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        if (!ctype_alpha($donnees)) {
            session_destroy();
            echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données ERRORER</div>';
        }
        return $donnees;
    }
    function valid_img($donnees){

        $path = 'uploaded/'.$_FILES['photo']['name'];

        if(empty($donnees) || pathinfo($path)['extension'] == 'pdf'){
            session_destroy();
            echo "<script>alert('image incorrect')</script>";
        }else{move_uploaded_file($_FILES['photo']['tmp_name'], $path);}
        return $donnees;
    }

    $prenom = valid_string($_POST['firstname']);
    $nom = valid_string($_POST['lastname']);
    $age = valid_int($_POST['old']);
    $taille = valid_float($_POST['size']);
    $genre = $_POST['sexe'];
    $color = $_POST['color'];
    $birth = $_POST['birth'];
    $img = valid_img($_FILES['photo']['name']);
    
    

    $table = array();

    $table['firstname'] = $prenom;
    $table['lastname'] = $nom;
    $table['old'] = $age;
    $table['size'] = $taille;
    $table['sexe'] = $genre;
    $table['color'] = $color;
    $table['birth'] = $birth;
    $table['image'] = $img;

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
            <a id="id" href="?id=form" type="button" class="btn btn-primary btn-lg" name='donnees'>Ajouter des données</a>
            <a id="id" href="?id=form2" type="button" class="btn btn-primary btn-lg" name='donnees'>Ajouter plus des données</a>
            <?php
            
            if (isset($_GET['id'])) {

                switch($_GET['id']) {

                case 'form':

                    echo '<style>#id {display:none};</style>';
                    include "./includes/form.inc.html";
                    break;

                case 'form2':
                    echo '<style>#id {display:none};</style>';
                    include "./includes/form2.inc.php";
                    break;

                case 'debug':

                    echo '<style>#id {display:none};</style>';
                    
                    if (empty($_SESSION['table'])) {
                        # code...
                        echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données ERRONÉES</div>';
                    }else {
                        # code...
                        echo '===> Lecture du tableau avec la fonction print_r()';
                        echo '<pre>';
                        print_r($_SESSION['table']);
                        echo '</pre>';
                        
                    }

                    break;

                case 'concat':

                    echo '<style>#id {display:none};</style>';

                    if (empty($_SESSION['table'])) {
                        # code...
                        echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données ERRONÉES</div>';
                    }else{
                        $table = $_SESSION['table'];
                        echo '===> Construction d\'une phrase avec le contenu du tableau<br>';
                        echo 'Bonjour ' . $table['sexe'] . ' ' . $table['firstname']. ' ' . $table['lastname']. '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . $table['size'] . 'm.<br><br>';
                        echo '===> Construction d\'une phrase après MAJ du tableau<br>';
                        echo 'Bonjour ' . $table['sexe'] . ' ' . ucfirst( $table['firstname']). ' ' . strtoupper($table['lastname']). '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . $table['size'] . 'm.<br><br>';
                        echo '===> Affichage d\'une virgule à la place du point pour la taille<br>';
                        echo 'Bonjour ' . $table['sexe'] . ' ' . ucfirst( $table['firstname']). ' ' . strtoupper($table['lastname']). '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . str_replace('.',',',$table['size']). 'm.';
                    }
                    
                    break;

                case 'bouc':

                    echo '<style>#id {display:none};</style>';

                    if (empty($_SESSION['table'])) {
                        # code...
                        echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données ERRONÉES</div>';
                    }else {
                        # code...
                        $table = $_SESSION['table'];
                        echo '===> Lecture du tableau a l\'aide d\'une boucle foreach<br><br>';
                        $n = 0;
                        foreach ($table as $key => $value) {
                            echo 'à la ligne n°'. $n++ .' correspond la clé '. $key .' et contient "'. $value .'"<br>';
                        }
                    }
                    
                    break;

                case 'fonc':

                    echo '<style>#id {display:none};</style>';
                    if (empty($_SESSION['table'])) {
                        # code...
                        echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données ERRONÉES</div>';
                    }else {
                        # code...
                        echo '===> Lecture du tableau a l\'aide d\'une fonction<br><br>';
                        function readTable(){
                            $table = $_SESSION['table'];
                            $n = 0;
                            foreach ($table as $key => $value) {
                                echo 'à la ligne n°'. $n++ .' correspond la clé '. $key .' et contient "'. $value .'"<br>';
                            }
                        };
                        readTable();
                    }
                    
                    break;

                case 'supp':

                    echo '<style>#hide {visibility: hidden}</style>';session_destroy();
                    echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données supprimés</div>';
                    
                    break;

                case 'home':

                    session_destroy();

                default:
            
            }}
            ?>
        </div>

    </div>   
</div>
<br>
<?php include 'includes/footer.inc.html'; ?>
