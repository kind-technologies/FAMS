 <?php  
   App::import('Model','Branch'); 

   
   class BranchTestCase extends CakeTestCase { 

		var $fixtures = array( 'app.branch' );
          
		function testPublished() {
			$this->Branch =& ClassRegistry::init('Branch');

			$result = $this->Branch->get_branches_for_json();

			$this->assertNotNull($result);
		}

   } 
 ?> 
