<?php

include 'mockup_data.json.php';

$key 	= $_GET['key'];
$del 	= $_GET['del'];
$menu	= $_GET['menuName'];

// echo '<pre>' . print_r($menu, 1) . '</pre>';

if(!empty($del)) {
	//onclick="$(\'.modal-body > form\').submit();">Confirm</button>
	// Modal delete.
	echo '
			
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header modal-confirm-delete">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title">Delete item</h4>
				</div>
				<div class="modal-body">
				<form action="">
					 <div class="panel-body">
			
							Are you sure delete item key = "<span id="modal-value"> '. $key . '</span>"?
			
					</div>
				</form> 
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" id="btnYes">Confirm</button>
					<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				</div>
			</div>
		</div>
							
		';
	return;


} else {
	
// 	echo '<pre>' . print_r($menu) . '</pre>';exit;
	switch($menu) {
		case 'category' :
			{
				$item = $items[$key];
				unset($item[0]);
				unset($item[6]);
				
				if(empty($item)) {
					$item = array();
				}
				foreach($item as $key => $val) {
					$result[] = $val;
				}
				
				categoryModal($result);
				
				break;	
			}
		case 'group' :
			{
				$item = $items[$key];
				
				unset($item[0]);
				unset($item[6]);
				if(empty($item)) {
					$item = array();
				}
				foreach($item as $key => $val) {
					$result[] = $val;
				}
				
				$params['result'] 	= $result;
				$params['regions'] 	= $regionArr;
				groupModal($params);
				
				break;
			}
			
		case 'geography' :
			{
				
				$item = $items[$key];
				unset($item[0]);
				unset($item[6]);
				
				if(empty($item)) {
					$item = array();
				}
				foreach($item as $key => $val) {
					$result[] = $val;
				}
				
				geographyModal($result);
				
				break;
			}
		case 'province' :
			{
				$item = $items[$key];
				unset($item[0]);
				unset($item[6]);
				
				if(empty($item)) {
					$item = array();
				}
				
				foreach($item as $key => $val) {
					$result[] = $val;
				}
				
				provinceModal($result);
				
				break;
			}
		default:
			{
				if(!empty($key)) {
					$item = $items[$key];
				} else {
					$item = array();
				}
				
				
				
// 				echo '<pre>' . print_r($key, 1) . '</pre>';exit;
				unset($item[0]);
				unset($item[6]);
				
				foreach($item as $key => $val) {
					$result[] = $val;
				}
				$params['result'] 		= $result;
				$params['province'] 	= $provinceArr;
				$params['newsCateArr'] 	= $newsCateArr;
				$params['regionArr'] 	= $regionArr;
				userModal($params);
				break;
			}
	}
	
	return;
	
	// Modal add edit
	
	$item = $items[$key];
	unset($item[0]);
	unset($item[6]);
	
	foreach($item as $key => $val) {
		$result[] = $val;
	}
	
	
	
	return; 
	
// 	echo json_encode($result);return;
	echo $result; return;
	echo '
	              <div class="modal-dialog">
	                  <div class="modal-content">
	                      <div class="modal-header">
	                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                          <h4 class="modal-title">Modal Tittle</h4>
	                      </div>
	                      <div class="modal-body"> ';
	echo '<pre>' . print_r($result, 1) . '</pre>';
	echo '                           call on labs_serverside_form.php
	
	                     </div>
	                      <div class="modal-footer">
	                          <button class="btn btn-success" type="submit" href="#">Save changes</button>
			 			 	  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	                      </div>
	                  </div>
	          </div>'
	          ;
	          return;
	          
}




function categoryModal($result){
	echo
	'
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add new category</h4>
				</div>
				<div class="modal-body">
				<form action="">
					<div class="panel-body">
	                          		<div class="form-group">
                                      	<label for="inputUsername">Title</label>
                                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="" value="'.$result[3].'">
                                 	</div>
									<div class="form-group">
                                      	<label for="inputUsername">Title English</label>
                                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="" value="'.$result[4].'">
                                 	</div>
					</div>
				</form>
				</div>
			
				<div class="modal-footer">
					<button type="submit" class="btn btn-info" id="btnSave">Add Category</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default" >Cancel</button>
				</div>

			</div>
		</div>
		
	';
}

function geographyModal($result){
	echo
	'
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add new geography</h4>
				</div>
				<div class="modal-body">
				<form action="">
					<div class="panel-body">
	                          		<div class="form-group">
                                      	<label for="inputUsername">Name</label>
                                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Input text" value="'.$result[3].'">
                                 	</div>
									<div class="form-group">
                                      	<label for="inputUsername">English Name</label>
                                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="" value="'.$result[4].'">
                                 	</div>
					</div>
				</form>
				</div>
		
				<div class="modal-footer">
					<button type="submit" class="btn btn-info" id="btnSave">Add Geography</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default" >Cancel</button>
				</div>

			</div>
		</div>

	';
}


function provinceModal($result){
	echo
	'
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add new province</h4>
				</div>
				<div class="modal-body">
				<form action="">
					<div class="panel-body">
	                          		<div class="form-group">
                                      	<label for="inputUsername">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Input text" value="'.$result[0].'" required>
                                 	</div>
									<div class="form-group">
                                      	<label for="inputUsername">English Name</label>
                                        <input type="text" name="name_en" class="form-control" placeholder="english name" value="'.$result[3].'">
                                 	</div>
					</div>
				</form>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-info" id="btnSave">Add Province</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default" >Cancel</button>
				</div>

			</div>
		</div>

	';
}

function groupModal($params){
	
	$result = $params['result'];
	$regionArr = $params['regions'];
	
	echo
	'
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add new group</h4>
				</div>
				<div class="modal-body">
			
						
							<div class="panel-body">
								<form action="">
	                          		<div class="form-group">
                                      	<label for="inputUsername">Group Name</label>
                                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Input text" value="'.$result[3].'">
                                 	</div>
                                        		
                                        		
		                                <div class="form-group">
		                                      <label for="inputPermission">Permission</label>
		                                      	<div>
		                                          <label class="checkbox">
		                                              <input type="checkbox" id="inputPermission1" value="upload"> Upload
		                                          </label>
		                                          <label class="checkbox">
		                                              <input type="checkbox" id="inputPermission2" value="download"> Download
		                                          </label>
		                                          <label class="checkbox">
		                                              <input type="checkbox" id="inputPermission3" value="aspera"> Download pass by aspera.
		                                          </label>
		                                          </div>
		                                  </div>
                                        		
								<div class="form-group">
                                      <label for="inputSuccess">Role</label>
                                      <div>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id="inlineCheckbox1" value="option1"> Administrator
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id="inlineCheckbox2" value="option2"> Superuser
                                          </label>
                                      </div>
                                  </div>
                                        		
									<div class="form-group">
			                           	<label for="">Regional</label>
	                                     	<select multiple class="form-control">';
										foreach($regionArr as $item) {
											echo '<option>' . $item . '</option>';
										}
							echo 	'</select>
                                      </div>
									
									</form>
									
									
									
							</div>
						
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" id="btnSave">Add Group</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default" >Cancel</button>
				</div>

			</div>
		</div>

	';
} 


function userModal($params){
	
	$result			= $params['result'];
	$provinceArr	= $params['province'];
	$newsCateArr	= $params['newsCateArr'];
	$regionArr		= $params['regionArr'];
	
	echo '

			<div class="modal-dialog modal-inews-form">
			<div class="modal-content">
				<form role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h4 class="modal-title">User</h4>
					</div>
					<div class="modal-body">
						<div class="row">
		      				<div class="col-lg-6">
								<section class="panel">
			                         <!--  <header class="panel-heading">
			                              Basic Forms
			                          </header> -->
			                          <div class="panel-body">
			                          <!-- <div class="space15"></div> -->
			                          		<div class="form-group">
		                                      	<label for="inputUsername">Username</label>
		                                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Input username" value="'.$result[0].'">
		                                 	</div>
			                                <div class="form-group">
			                                      <label for="inputPassword">Password</label>
			                                      <input type="password" class="form-control" id="inputPassword" placeholder="Password" value="12345">
			                                </div>

			                          		<div class="form-group">
		                                      	<label for="inputName">Name</label>
		                                          <input type="text" name="name" class="form-control" id="inputName" placeholder="Input name" value="'.$result[1].'">
		                                 	</div>

		                                 	<div class="form-group">
		                                      	<label for="inputSurname">Surname</label>
		                                        <input type="text" name="surname" class="form-control" id="inputSurname" placeholder="Input surname" value="'.$result[2].'">
		                                 	</div>
			               
			                                <div class="form-group">
			                                	<label> Expire date</label>
			                                	<div>
			                                	<div class="col-lg-4">
		                                            <label class=radio-inline">
		                                                  <input type="radio" name="rdoLifetime" id="rdoIndefinite" value="option1" checked>
		                                                  Indefinite
		                                            </label>
													<label class=radio-inline">
		                                                  <input type="radio" name="rdoLifetime" id="rdoDefinite" value="option2">
		                                                  Definite
		                                            </label>
		                                        </div>
	                                            <div class="col-lg-7">
	                                              	<div data-date-format="dd-mm-yyyy" data-date="'. date('d-m-Y') .'"  class="input-append date default-date-picker">
	                                                  	<input type="text" readonly="" value="" size="12" class="form-control form-control-inline input-medium ">
	                                                  	<span class="input-group-btn add-on">
	                                                    	<button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
	                                                  	</span>
	                                              	</div>
	                                            <!-- <span class="help-block">Select date</span> -->
	                                            </div>
		                                      	</div>
			                                </div>
			               
											<div class="clearfix"></div>
				                                <div class="form-group">
				                                      <label for="inputPermission">Permission</label>
				                                      	<div>
				                                          <label class="checkbox">
				                                              <input type="checkbox" id="inputPermission1" value="upload"> Upload
				                                          </label>
				                                          <label class="checkbox">
				                                              <input type="checkbox" id="inputPermission2" value="download"> Download
				                                          </label>
				                                          <label class="checkbox">
				                                              <input type="checkbox" id="inputPermission3" value="aspera"> Download pass by aspera.
				                                          </label>
				                                          </div>
				                                  </div>
			                
		                                  </div>
									</section>
									</div>
					
									<div class="col-lg-6">
										<section class="panel">
				                          <!-- <header class="panel-heading">
				                              Options
				                          </header> -->
					                          <div class="panel-body">
					           
				                                  <div class="form-group">
				                                      <label for="inputSuccess">Role</label>
				                                      <div>
				                                          <label class="checkbox-inline">
				                                              <input type="checkbox" id="inlineCheckbox1" value="option1"> Administrator
				                                          </label>
				                                          <label class="checkbox-inline">
				                                              <input type="checkbox" id="inlineCheckbox2" value="option2"> Superuser
				                                          </label>
				                                      </div>
				                                  </div>
					                           
		                                      <div class="form-group">
		                                      	<label for="">Region</label>
			                                      <select class="form-control m-bot15">
			                                              <option>Option 1</option>
			                                              <option>Option 2</option>
			                                              <option>Option 3</option>
		                                      	</select>
		                                      </div>

		                                      <div class="form-group">
		                                      	<label for="">Province</label>
			                                      <select class="form-control m-bot15">
		                                        		' ;
	foreach($provinceArr as $item) {
		echo '<option>' . $item .'</option>';
	}
	echo 		                                      	'</select>
		                                      </div>

		                                      <div class="form-group">
		                                      	<label for="">Category</label>
			                                      <select class="form-control m-bot15">';

	foreach($newsCateArr as $item) {
		echo '<option>' . $item . '</option>';
	}
	echo 	                                      	'</select>
		                                      </div>

		                                       <div class="form-group">
		                                      	<label for="">Regional</label>
			                                     	<select multiple class="form-control">';
	foreach($regionArr as $item) {
		echo '<option>' . $item . '</option>';
	}
	// 			                                              <option>1</option>
	// 			                                              <option>2</option>
	// 			                                              <option>3</option>
	// 			                                              <option>4</option>
	// 			                                              <option>5</option>
	echo 		                                         '</select>
		                                      </div>
		
			                          </div>
			                      </section>
			                 </div>
			             </div>
					</div>
						<div class="modal-footer">
		                    <button type="button" data-dismiss="modal" class="btn btn-default" >Cancel</button>
							<button type="button" class="btn btn-success save" id="btnSave">Add User</button>
						</div>
			
					</form>
			</div>
		</div>
		
	';
}




// echo '<pre>' . print_r($result, 1) . '</pre>';
echo $result;
// exit;
// echo '<pre>' . print_r($result, 1) . '</pre>';
// exit;
// $result['sEcho'] 				= intval($_GET['sEcho']);
// $result['iTotalRecords'] 		= $totalItems;
// $result['iTotalDisplayRecords'] = $totalItems;
// $result['aaData']				= $rows;
// // $rs['iDisplayLength']		= 5;
// // $result['aaData']				= $items;

// // echo '<pre>' . print_r($rs, 1) . '</pre>';
// echo json_encode($result);


?>
