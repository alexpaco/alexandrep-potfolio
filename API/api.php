<?php
    ini_set('display_errors', 1);
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: content-type, x-xsrf-token');
    header('Access-Control-Allow-Methods: OPTIONS,POST,GET,PUT,DELETE');
	$nom_serveur = "localhost";
    $identifiant = "pacoret";
    $mdp = "IGcWnccPMKvTAo69";
    $nom_bd = "pacoret";

    $bdd = new PDO("mysql:host=$nom_serveur; dbname=$nom_bd; charset=utf8", $identifiant, $mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['projet'])){
        $projets = $bdd->query("SELECT id, nom AS Nom, url_site, image AS Image, description, langage AS Langages FROM projets");

        $projet = $projets->fetchAll(PDO::FETCH_OBJ);
    
        $data = json_encode($projet);
        print_r($data);
    }
    elseif(isset($_GET['langages'])){

        $langages = $bdd->query("SELECT image FROM langages");

        $langage = $langages->fetchAll(PDO::FETCH_OBJ);

        $data = json_encode($langage);
        print_r($data);
    }
    elseif(isset($_GET['contact'])){

        if(!empty($_GET['nom']) && !empty($_GET['mail']) && !empty($_GET['sujet']) && !empty($_GET['message'])){

            $nom = $_GET['nom'];
            $expediteur = $_GET['mail'];
            $message = $_GET['message'];
            $sujet = $_GET['sujet'];
            $mon_mail ="alexandre.p@codeur.online";

            $headers  = 'MIME-Version: 1.0'."\r\n";
            $headers .= 'From:'.$expediteur."\r\n";
            $headers .= 'Content-type: text/html;charset=UTF-8'."\r\n";
            $headers .='Content-Transfer-Encoding: 8bit';

            $envoi = mail($mon_mail,$sujet,$message,$headers);
            if($envoi){
                echo (json_encode('Votre message a bien été envoyé.'));
            }   
            else{
                echo (json_encode('votre message n\'a pas pu être envoyé.'));
            }
        }
    } 

    $method = $_SERVER['REQUEST_METHOD'];
    $input = json_decode(file_get_contents('php://input'),true);
    print_r($input);

    if(isset($_POST['ajoute'])){

        $nom = $_POST['nomProjet'];
        $urlSite = $_POST['urlProjet'];
        $langages = $_POST['langagesProjet'];
        $description = $_POST['descriptionProjet'];
        $cheminDosssier = realpath('api.php');
        $cheminDosssier = str_replace('api.php', '', $cheminDosssier);
        $cheminDosssier = $cheminDosssier."upload/";

        $url = "http://pacoret.chalon.codeur.online/API/upload/";

        $infoFichier = pathinfo($_FILES['nomImage']['name'], PATHINFO_EXTENSION);
        $newInfo  =strtolower($infoFichier);

        if($newInfo === 'jpg' || $newInfo === 'png'){

            if($_FILES['nomImage']['size'] <= 11180000){

                $cheminFuturImage = $cheminDosssier.$_FILES['nomImage']['name'];
                $nomDossier = $_FILES['nomImage']['tmp_name'];
                $move = move_uploaded_file($nomDossier, $cheminFuturImage);

                if($move){

                    $sql = $bdd->prepare("INSERT INTO projets(nom, url_site, image, description,langage) VALUES(?, ?, ?, ?, ?)");
                    $sql->execute(array($nom, $urlSite, $url.$_FILES['nomImage']['name'], $description, $langages));
                    echo "Le projet a bien été ajouté";

                }
                else{
                    $untest = $supprimer = preg_replace('/\?.*/', '', $_SERVER['HTTP_REFERER']);
                    header("Location:".$untest."?test=erreur de tranfert d'image");
                }
            }
            else{
                $untest = $supprimer = preg_replace('/\?.*/', '', $_SERVER['HTTP_REFERER']);
                header("Location:".$untest."?test=choisi une image plus légère");
            }
        }
        else{
            $untest = $supprimer = preg_replace('/\?.*/', '', $_SERVER['HTTP_REFERER']);
            header("Location:".$untest."?test=image de format jpg et png seulement");
        }
    }

    if(isset($_POST['modif'])){

        $projet = $_POST['select'];
        $ModifUrlProjet = $_POST['ModifUrlProjet'];
        $ModifLangages = $_POST['ModifLangagesProjet'];
        $ModifDescription = $_POST['ModifDescriptionProjet'];
        $cheminDosssier = realpath('api.php');
        $cheminDosssier = str_replace('api.php', '', $cheminDosssier);
        $cheminDosssier = $cheminDosssier."upload/";

        $url = "http://pacoret.chalon.codeur.online/API/upload/";
        $image = $url.$_FILES['ModifNomImage']['name'];

        $infoFichier = pathinfo($_FILES['ModifNomImage']['name'], PATHINFO_EXTENSION);
        $newInfo  =strtolower($infoFichier);

        if($newInfo === 'jpg' || $newInfo === 'png'){

            if($_FILES['ModifNomImage']['size'] <= 11180000){

                $cheminFuturImage = $cheminDosssier.$_FILES['ModifNomImage']['name'];
                $nomDossier = $_FILES['ModifNomImage']['tmp_name'];
                $move = move_uploaded_file($nomDossier, $cheminFuturImage);

                if($move){

                    $sql = $bdd->prepare("UPDATE projets SET url_site = '$ModifUrlProjet', image = '$image', description = '$ModifDescription', langage = '$ModifLangages' WHERE id = '$projet'");
                    $sql->execute();
                    echo "Le projet a bien été modifié";

                }
                else{
                    $untest = $supprimer = preg_replace('/\?.*/', '', $_SERVER['HTTP_REFERER']);
                    header("Location:".$untest."?test=erreur de tranfert d'image");
                }
            }
            else{
                $untest = $supprimer = preg_replace('/\?.*/', '', $_SERVER['HTTP_REFERER']);
                header("Location:".$untest."?test=choisi une image plus légère");
            }
        }
        else{
            $untest = $supprimer = preg_replace('/\?.*/', '', $_SERVER['HTTP_REFERER']);
            header("Location:".$untest."?test=image de format jpg et png seulement");
        }      
    }

    switch ($method) {
        case 'POST':
            

            break;

        case 'PUT':
            
            break;

        case 'DELETE':
            
            $suppr = $input['suppr']['supprime'];

            $sql = $bdd->prepare("DELETE FROM projets WHERE id = ?");
            $sql->execute(array($suppr));
            break;
    }

    
?>