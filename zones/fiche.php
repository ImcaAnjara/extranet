<?php 
session_start ();

// if (!isset($_SESSION['numero'])){
//     header('Location: index.php');
// }
$_SESSION['numero'] = $_GET['numero'];
$_SESSION['numerodossier'] = $_GET['numero'];
$_SESSION['nomStagiaire'] = $_GET['nom'];
$_SESSION['prenomStagiaire'] = $_GET['prenom'];
?>
<section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container">
                        <h1 class="title">EVALUATION LANGUE</h1>
                    </div>
                </header>
                <div class="container">
                    <div class="row">
					<div class="button-group">
					<div class="panel panel-default">
					<div class="panel-heading">
					<p class="lead alert alert-info text-center"><b>Accès stagiaire - EVALUATION LANGUE.</b></p>
					
					<h5>Votre fiche stagiaire doit être complétée pour pouvoir enchaîner avec les tests d’évaluation</h5>
					<form id="insertform" action="update.php" method="GET" enctype="multipart/form-data" >
					
					<br><label for="stagiaire">Stagiaire : <?php 
					if (!isset($_GET['numero'])){
					    header('Location: index.php');
					}else{
					
					echo($_GET['nom'].' '.$_GET['prenom']);}
					?></label><br>
					<input type="hidden" name="numerodossier" id="numerodossier" value="<?php echo($_GET['numero']);?>">
					<br><input class="btn btn-primary  special fit small center-block" id="valider" type="submit" value="Cliquez ici pour compléter votre fiche">
					</form>
					
					 
					
					
					<form id="gotestform" action="updatesuccess.php" method="POST" enctype="multipart/form-data" >
					
					<input type="hidden" name="numerodossiertest" id="numerodossiertest" value="<?php echo($_SESSION['numerodossier']);?>">
					<input type="hidden" name="nomtest" id="nomtest" value="<?php echo($_SESSION['nomStagiaire']);?>">
					<input class="btn btn-primary  special fit small center-block" id="valider" type="submit" style="display:<?php if($_GET['stand'] == 0){
							echo("none");}
						?>" value="Cliquez ici pour réaliser votre test Questionnaire à Choix Multiples (test grammatical de base)">
						
					</form>
					
					
					<?php 
					include('httpful.phar');
					
					$urlcheck = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=checkResultByNumeroIdBase";
					$datacheck = "&numero_idbase=" . urlencode($_SESSION['numero']);
					$urlEncodecheck = $urlcheck.$datacheck;
					
					$responsecheck = \Httpful\Request::get($urlEncodecheck)->send();
					$jsonRespcheck = $responsecheck->body;
					
					if(isset($jsonRespcheck) && '200' == $jsonRespcheck->code && $jsonRespcheck->data!=[]) {
						if($jsonRespcheck->data!=[]){
							include("gowebcal.php");
						}
					}
					 ?>
					<br><br><br><h4>Merci de nous contacter pour connaître nos formules adaptées à vos besoins
					<a href="http://www.forma2plus.com/" target=blank>www.forma2plus.com</a></h4>
				</div>
				</div>
					</div>
                    </div>
                </div>
            </section>
        </div>
    </div>