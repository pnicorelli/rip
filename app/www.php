<?php

class www{

		public function post( $req ){
			return array("pippo"=>"pluto", "cavolo"=>array("0"=>1, "1"=>2));
		}

		public function delete( $req ){
			return array("pippo"=>"pluto", "cavolo"=>array("0"=>1, "1"=>2));
		}

}
