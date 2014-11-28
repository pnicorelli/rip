<?php

class test{

		public function get( $req ){
			return array( "message" => "you just GET the TEST page!");
		}

		public function post( $req ){
			return array( "message" => "you just POST the TEST page!");
		}

		public function delete( $req ){
			return array( "message" => "you just DELETE the TEST page!");
		}

}
