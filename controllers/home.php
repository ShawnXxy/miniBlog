<?php
	class Home extends Controller{
		protected function Index(){
			//test
			//echo 'HOME/INDEX';

			$viewmodel = new HomeModel(); //HomeModel defined in models/home.php
			$this->returnView($viewmodel->Index(), true); //returnView defined in classes/controller.php
		}
	}
?>
