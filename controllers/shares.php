<?php
	class Shares extends Controller {
		protected function Index() {
			//test
			//echo 'SHARES/INDEX';

			$viewmodel = new ShareModel(); //ShareModel defined in models/share.php
			$this->returnView($viewmodel->Index(), true);//returnView defined in classes/controller.php
		}

		protected function add() {
			//if not logged in, redirect to loging/register page
			if(!isset($_SESSION['is_logged_in'])) {
				header('Location: '.ROOT_URL.'shares'); //ROOT_URL defined in config.php
			}
			$viewmodel = new ShareModel(); //ShareModel defined in models/share.php
			$this->returnView($viewmodel->add(), true);//returnView defined in classes/controller.php
		}
	}
?>
