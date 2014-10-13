<?php

// $data = array(
//     'choc_chip' => array('Chocolate Chip Cookies', 1.25, 10.00),
//     'oatmeal' 	=> array('Oatmeal Cookies', .99, 8.25),
//     'brownies'	=> array('Fudge Brownies', 1.35, 12.00)
// );

// echo '<pre>' . print_r($_GET, 1) . '</pre>';
// echo '<pre>' . print_r($_POST, 1) . '</pre>';
// exit;
/* $items = array( 
		
		array("thumbnail"=>"img/product1.jpg", "company"=>"Vector Ltd" , "desc"=>"Lorem Ipsum dorolo imit" , "profit" => "12120.00$ ", "status" => "Due"),
		array("thumbnail"=>"img/product2.png", "company"=>"Adimin co" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "56456.00$", "status" => "Due"),
		array("thumbnail"=>"img/product3.png", "company"=>"boka soka" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "14400.00$", "status" => "Paid"),
		
		array("thumbnail"=>"img/product1.jpg", "company"=>"salbal llb" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "2323.50$", "status" => "Paid"),
		array("thumbnail"=>"img/product2.png", "company"=>"Vector Ltd" , "desc"=>"Lorem Ipsum dorolo imit" , "profit" => "12120.00$", "status" => "Due"),
		array("thumbnail"=>"img/product3.png", "company"=>"Adimin co" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "56456.00$", "status" => "Due"),
		
		array("thumbnail"=>"img/product1.jpg", "company"=>"Vector Ltd" , "desc"=>"Lorem Ipsum dorolo imit" , "profit" => "12120.00$", "status" => "Due"),
		array("thumbnail"=>"img/product2.png", "company"=>"Adimin co" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "56456.00$", "status" => "Due"),
		array("thumbnail"=>"img/product3.png", "company"=>"Vector Ltd" , "desc"=>"Lorem Ipsum dorolo imit" , "profit" => "12120.00$", "status" => "Due"),
		
		array("thumbnail"=>"img/product1.jpg", "company"=>"Vector Ltd" , "desc"=>"Lorem Ipsum dorolo imit" , "profit" => "12120.00$ ", "status" => "Due"),
		array("thumbnail"=>"img/product2.png", "company"=>"Adimin co" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "56456.00$", "status" => "Due"),
		array("thumbnail"=>"img/product3.png", "company"=>"boka soka" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "14400.00$", "status" => "Paid"),
		
		array("thumbnail"=>"img/product1.jpg", "company"=>"salbal llb" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "2323.50$", "status" => "Paid"),
		array("thumbnail"=>"img/product2.png", "company"=>"Vector Ltd" , "desc"=>"Lorem Ipsum dorolo imit" , "profit" => "12120.00$", "status" => "Due"),
		array("thumbnail"=>"img/product3.png", "company"=>"Adimin co" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "56456.00$", "status" => "Due"),
		
		array("thumbnail"=>"img/product1.jpg", "company"=>"Vector Ltd" , "desc"=>"Lorem Ipsum dorolo imit" , "profit" => "12120.00$", "status" => "Due"),
		array("thumbnail"=>"img/product2.png", "company"=>"Adimin co" , "desc"=>"Lorem Ipsum dorolo" , "profit" => "56456.00$", "status" => "Due"),
		array("thumbnail"=>"img/product3.png", "company"=>"Vector Ltd" , "desc"=>"Lorem Ipsum dorolo imit" , "profit" => "12120.00$", "status" => "Due"),

); */

$items = array(

		array(
			'<a class="pull-left thumb p-thumb"><img src="img/product1.jpg"></a>', 
			'Vector Ltd',
			'Lorem Ipsum dorolo imit',
			'12120.00$',
			'<span class="label label-info label-mini">Due</span>',
			'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product2.png"></a>',
				'Adimin co',
				'Lorem Ipsum dorolo',
				'56456.00$',
				'<span class="label label-info label-mini">Due</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product3.png"></a>',
				'boka soka',
				'Lorem Ipsum dorolo',
				'14400.00$',
				'<span class="label label-success label-mini">Paid</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<img src="img/product1.jpg">',
				'Vector Ltd',
				'Lorem Ipsum dorolo imit',
				'12120.00$',
				'<span class="label label-info label-mini">Due</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<img src="img/product2.png">',
				'Adimin co',
				'Lorem Ipsum dorolo',
				'56456.00$',
				'<span class="label label-info label-mini">Due</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product3.png"></a>',
				'boka soka',
				'Lorem Ipsum dorolo',
				'14400.00$',
				'<span class="label label-success label-mini">Paid</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product1.jpg"></a>',
				'Vector Ltd',
				'Lorem Ipsum dorolo imit',
				'12120.00$',
				'<span class="label label-info label-mini">Due</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product2.png"></a>',
				'Adimin co',
				'Lorem Ipsum dorolo',
				'56456.00$',
				'<span class="label label-info label-mini">Due</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product3.png"></a>',
				'boka soka',
				'Lorem Ipsum dorolo',
				'14400.00$',
				'<span class="label label-success label-mini">Paid</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product1.jpg"></a>',
				'Vector Ltd',
				'Lorem Ipsum dorolo imit',
				'12120.00$',
				'<span class="label label-info label-mini">Due</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product2.png"></a>',
				'Adimin co',
				'Lorem Ipsum dorolo',
				'56456.00$',
				'<span class="label label-info label-mini">Due</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
		array(
				'<a class="pull-left thumb p-thumb"><img src="img/product3.png"></a>',
				'boka soka',
				'Lorem Ipsum dorolo',
				'14400.00$',
				'<span class="label label-success label-mini">Paid</span>',
				'<td><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                 <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                 <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>'
		),
		
            
		/* 
		array('<a class="pull-left thumb p-thumb"><img src="img/product2.png"></a>', "Adimin co" , "Lorem Ipsum dorolo" ,  "56456.00$",  "Due"),
		array('<a class="pull-left thumb p-thumb"><img src="img/product3.png"></a>', "boka soka" , "Lorem Ipsum dorolo" ,  "14400.00$",  "Paid"),

		array('<a class="pull-left thumb p-thumb"><img src="img/product1.jpg"></a>', "salbal llb" , "Lorem Ipsum dorolo" ,  "2323.50$",  "Paid"),
		array('<a class="pull-left thumb p-thumb"><img src="img/product2.png"></a>', "Vector Ltd" , "Lorem Ipsum dorolo imit" ,  "12120.00$",  "Due"),
		array('<a class="pull-left thumb p-thumb"><img src="img/product3.png"></a>', "Adimin co" , "Lorem Ipsum dorolo" ,  "56456.00$",  "Due"),

		array("img/product1.jpg", "Vector Ltd" , "Lorem Ipsum dorolo imit" ,  "12120.00$",  "Due"),
		array("img/product2.png", "Adimin co" , "Lorem Ipsum dorolo" ,  "56456.00$",  "Due"),
		array("img/product3.png", "Vector Ltd" , "Lorem Ipsum dorolo imit" ,  "12120.00$",  "Due"),

		array("img/product1.jpg", "Vector Ltd" , "Lorem Ipsum dorolo imit" ,  "12120.00$ ",  "Due"),
		array("img/product2.png", "Adimin co" , "Lorem Ipsum dorolo" ,  "56456.00$",  "Due"),
		array("img/product3.png", "boka soka" , "Lorem Ipsum dorolo" ,  "14400.00$",  "Paid"),

		array("img/product1.jpg", "salbal llb" , "Lorem Ipsum dorolo" ,  "2323.50$",  "Paid"),
		array("img/product2.png", "Vector Ltd" , "Lorem Ipsum dorolo imit" ,  "12120.00$",  "Due"),
		array("img/product3.png", "Adimin co" , "Lorem Ipsum dorolo" ,  "56456.00$",  "Due"),

		array("img/product1.jpg", "Vector Ltd" , "Lorem Ipsum dorolo imit" ,  "12120.00$",  "Due"),
		array("img/product2.png", "Adimin co" , "Lorem Ipsum dorolo" ,  "56456.00$",  "Due"),
		array("img/product3.png", "Vector Ltd" , "Lorem Ipsum dorolo imit" ,  "12120.00$",  "Due"), */

);

/* 
"draw": 7,
"recordsTotal": 57,
"recordsFiltered": 57,
"data": [

 *"sEcho": 3,
    "iTotalRecords": 57,
    "iTotalDisplayRecords": 57,
    "aaData": [
 */

$items_num 					= count($items);
$rs['sEcho'] 				= 3;
$rs['iTotalRecords'] 		= $items_num;
$rs['iTotalDisplayRecords'] = $items_num;
// $rs['iDisplayLength']		= 5;
$rs['aaData']				= $items;

// echo '<pre>' . print_r($rs, 1) . '</pre>';
echo json_encode($rs);



