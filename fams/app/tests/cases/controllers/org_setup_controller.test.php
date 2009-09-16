<?php 
class OrgSetupControllerTest extends CakeTestCase { 

	function startCase() { 
		echo '<h1>Starting Test Case</h1>'; 
	} 

	function endCase() { 
		echo '<h1>Ending Test Case</h1>'; 
	} 

	function startTest($method) { 
		echo '<h3>Starting method ' . $method . '</h3>'; 
	} 

	function endTest($method) { 
		echo '<hr />'; 
	} 

	function testBranchView() { 
		$result = $this->testAction('/org_setup/branch_view'); 
		debug($result); 
	}

/*
	function testIndexShort() { 
		$result = $this->testAction('/articles/index/short'); 
		debug($result); 
	} 
*/

	function testBranchViewGetRenderedHtml() { 
		$result = $this->testAction('/org_setup/branch_view/', 
		array('return' => 'render')); 
		debug(htmlentities($result)); 
	} 


	function testBranchViewGetViewVars() { 
		$result = $this->testAction('/org_setup/branch_view/', 
		array('return' => 'vars')); 
		debug($result); 
	} 

/*
	function testIndexShortGetViewVars() { 
		$result = $this->testAction('/articles/index/short', 
		array('return' => 'vars')); 
		debug($result); 
	} 

	function testIndexFixturized() { 
		$result = $this->testAction('/articles/index/short', 
		array('fixturize' => true)); 
		debug($result); 
	} 
*/
	function testBranchViewGetFixturized() { 
	/*	$data = array('Article' => array('user_id' => 1, 
											'published' => 1, 
											'slug'=>'new-article', 
											'title' => 'New Article', 
											'body' => 'New Body')
											);

		$result = $this->testAction('/articles/index', 
										array('fixturize' => true, 
												'data' => $data, 
												'method' => 'post')); 
*/

		$result = $this->testAction('/org_setup/branch_view/', 
										array('fixturize' => true, 
												'data' => null, 
												'method' => 'get')); 

		debug($result); 
	}

} 
?> 
