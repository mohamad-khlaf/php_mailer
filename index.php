<?php
	ob_start();
	session_start();
	// ==================================================================================== Start PHP_MAILER Include
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require './LIB/mailer/Exception.php';
	require  "./LIB/mailer/PHPMailer.php";
	require  "./LIB/mailer/SMTP.php";
// 	date_default_timezone_set('Etc/UTC');
	// ==================================================================================== Start mPDF


	// require_once __DIR__ . "./LIB/mPDF/vendor/autoload.php";


	// $mpdf = new \Mpdf\Mpdf();
	// $mpdf->autoScriptToLang = true;
	// $mpdf->autoLangToFont = true;
	// $mpdf->SetDirectionality('rtl');


	// ==================================================================================== Start Variable Show in Page
	$results = false;
	$is_submiting = false;
	$sms_message = '';
	// ==================================================================================== Start Variable Show in Page



	// ==================================================================================== Start submit form dada
	if ($_SERVER['REQUEST_METHOD'] == 'POST') :
		


		// -------------------------------------------------------------------------------- Start Get Data From Inputs 
		$educational_path = $_POST['educational_path']; //  بداية قسم البيانات الدراسية 
		switch ($educational_path) :
			case 'path_0': $educational_path = ''; 	  break;
			case 'path_1': $educational_path = 'مسار التعليم العام'; 	  break;
			case 'path_2': $educational_path = 'مسار تحفيظ القرآن الكريم';       break;
			case 'path_3': $educational_path = 'مسار الدبلوما الأمريكية';  break;
			case 'path_4': $educational_path = 'مسار التعليم العام'; 	  break;
		endswitch;
		  

		$complex_name = $_POST['complex_name'];
		switch ($complex_name) :
			case 'complex_1': $complex_name = 'مجمع البنات الجديد';		  break;
			case 'complex_2': $complex_name = 'مجمع البديعة بنين'; 			  break;
			case 'complex_3': $complex_name = 'مجمع العريجاء بنين';		  break;
			case 'complex_4': $complex_name = 'مجمع نمار بنين'; 			  break;
		endswitch;


		$educational_level = $_POST['educational_level'];
		switch ($educational_level) :
			case 'level_1': $educational_level = 'رياض الاطفال';	 	    break;
			case 'level_2': $educational_level = 'المرحلة الابتدائية ';    break;
			case 'level_3': $educational_level = 'المرحلة المتوسطة';       break;
			case 'level_4': $educational_level = 'المرحلة الثانوية';       break;
		endswitch;

		$educational_class 			= $_POST['educational_class'];
		$transport_type 			= $_POST['transport_type'];

		$full_student_name 			= $_POST['full_student_name'];  // بداية قسم معلومات الطالب 
		$student_id_num 			= $_POST['student_id_num'];
		$nationalty_student 		= $_POST['nationalty_student'];
		$birthday 					= $_POST['birthday'];
		$birthday_hijry 			= $_POST['birthday_hijry'];
		$birthday_city 				= $_POST['birthday_city'];
		$study_certificate 			= $_POST['study_certificate'];
		$study_stutas 				= $_POST['study_stutas'];
		$illnesses 					= $_POST['illnesses'];

		$parent_name 				= $_POST['parent_name']; // بداية قسم معلومات ولي الأمر 
		$parent_nationalty 			= $_POST['parent_nationalty'];
		$reserve1_relation_parent 	= $_POST['reserve1_relation_parent'];
		$id_patent_type 			= $_POST['id_patent_type'];
		$id_source_parent 			= $_POST['id_source_parent'];
		$parent_id_num 				= $_POST['parent_id_num'];
		$parent_job 				= $_POST['parent_job'];
		$parent_job_address 		= $_POST['parent_job_address'];
		$parent_email 				= $_POST['parent_email'];
		$neighborhood_address 		= $_POST['neighborhood_address'];
		$main_street 				= $_POST['main_street'];
		$sub_street 				= $_POST['sub_street'];
		$house_num 					= $_POST['house_num'];
		$next_to 					= $_POST['next_to'];
		$house_phone 				= $_POST['house_phone'];
		$reserve_name_1 			= $_POST['reserve_name_1'];
		$reserve_relation_1 		= $_POST['reserve_relation_1'];
		$reserve_relation_phone_1 	= $_POST['reserve_relation_phone_1'];
		$reserve_name_2 			= $_POST['reserve_name_2'];
		$reserve_relation_2 		= $_POST['reserve_relation_2'];
		$reserve_relation_phone_2 	= $_POST['reserve_relation_phone_2'];

		$pre_school = $_POST['pre_school']; // غير موجودة في قاعدة البيانات
		$the_code = rand(100000,999999);
		
		// -------------------------------------------------------------------------------- Start mPdf







		// -------------------------------------------------------------------------------- Start Insert Variable In DB
		include("./includes/mysqli.php");
		$sql = "INSERT INTO `regerster` ( `educational_path`, `complex_name`, `educational_level`, `educational_class`, `transport_type`, `full_student_name`, `student_id_num`, `nationalty_student`, `birthday`, `birthday_hijry`, `birthday_city`, `study_certificate`, `study_stutas`, `pre_school`, `illnesses`, `parent_name`, `parent_nationalty`, `reserve1_relation_parent`, `id_patent_type`, `id_source_parent`, `parent_id_num`, `parent_job`, `parent_job_address`, `parent_email`, `neighborhood_address`, `main_street`, `sub_street`, `house_num`, `next_to`, `house_phone`, `reserve_name_1`, `reserve_relation_1`, `reserve_relation_phone_1`, `reserve_name_2`, `reserve_relation_2`, `reserve_relation_phone_2`, `admissions`, `the_code`)
			VALUES ( '$educational_path', '$complex_name', '$educational_level', '$educational_class', '$transport_type', '$full_student_name', '$student_id_num', '$nationalty_student', '$birthday', '$birthday_hijry', '$birthday_city', '$study_certificate', '$study_stutas', '$pre_school', '$illnesses', '$parent_name', '$parent_nationalty', '$reserve1_relation_parent', '$id_patent_type', '$id_source_parent', '$parent_id_num', '$parent_job', '$parent_job_address', '$parent_email', '$neighborhood_address', '$main_street', '$sub_street', '$house_num', '$next_to', '$house_phone', '$reserve_name_1', '$reserve_relation_1', '$reserve_relation_phone_1', '$reserve_name_2', '$reserve_relation_2', '$reserve_relation_phone_2', '0', '$the_code')";		
		$res = mysqli_query($connect, $sql);
		if (! $res) {
			// print last error message
			echo "Connect failed: %s\n", mysqli_error($connect);
			exit();
		}



		// -------------------------------------------------------------------------------- Start Sending EMAIL '
		// $mpdf->WriteHTML("
		// <main class='contract all-contrac' id='contract' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; text-algin: center; direction:rtl'>
		// 	<section class='main-forms' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;overflow: hidden;'>
		// 		<div class='container' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; width: 100%; padding: 15px; margin: auto;'>
		// 			<header style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; justify-content: space-between; align-items: center;'>
		// 				<div class='col-4' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 					<h1 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 16px;'>شركة دار الشوامخ التعليمية</h1>
		// 					<p class='complex-data-title' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'></p>
		// 					<img src='./imgs/logo.png' alt='' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; width: 40px;' width='70'>
		// 				</div>
		// 				<div class='col-4 text-start' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>شؤون الطلاب (بنين - بنات)</p>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>العام الدراسي : <span style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>1444/8/2</span> </p>
		// 				</div>
		// 			</header>
		// 			<div class='content' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<h3 class='text-center mb-5' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; text-align: center; padding: 5px; background: #0DCAF0; margin-bottom: 5px; margin-top: 5px;'>البيانات الدراسية</h3>
		// 				<div class='three-col' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: grid; grid-template-columns: repeat(3, auto); gap: 15px;'>
		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>القسم :</p>
		// 						<p class='border-dashed complex_name' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'>بنين</p>
		// 					</div>
		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>المرحلة الدراسية :</p>
		// 						<p class='border-dashed educational_level' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>نوع الدراسة :</p>
		// 						<p class='border-dashed  educational_path' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الصف :</p>
		// 						<p class='border-dashed classes' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>النقل :</p>
		// 						<p class='border-dashed transport-data' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
		// 				</div>
		// 				<div class='ddd' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>   حرر هذاالعقد في : <span class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></span> <span id='output' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'> </span> <span style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>ـ بين كل من : </span> </p>
		// 				</div>
		// 				<div class='hhh' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>شركة دار الشوامخ التعليمية وفرعها مدارس المجد الأهلية، ويشار إليه في هذه الاتفاقية بـ (الطرف الأول) </p>
		// 					<div style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 						<span class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>و الطرف الثاني :</span>
		// 						<span class='border-dashed parent-name' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></span>
		// 					</div>
		// 					<p class='mt-2 mb-2' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'><span class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>التمهيد</span>: حيث أن الطرف الأول يمتلك مدارس أهلية لجميع المراحل بنين وبنات، ويرغب الطرف الثاني في تسجيل طالبـ / ـة بالمدارس، وعليه فقد اتفق الطرفان وهما بأهليتهما المعتبرة شرعا على المواد المرفقة ضمن اتفاقية التسجيل.</p>
		// 				</div>
		// 			</div>
		// 			<div class='first mt-3 mb-3' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<h3 class='bg-success text-white text-center p-2 mb-2' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; text-align: center; padding: 5px; background: #0DCAF0; margin-bottom: 5px; margin-top: 5px;'> بيانات الطالبـ/ـة </h3>
		// 				<div class='three-col' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: grid; grid-template-columns: repeat(3, auto); gap: 15px;'>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'> الاسم الطالب الكامل:</p>
		// 							<p class='border-dashed fullname' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>رقم الهويه:</p>
		// 							<p class='border-dashed civil-registry' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>


		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الجنسية :</p>
		// 							<p class='border-dashed nationality' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>ناريخ الميلاد :</p>
		// 							<p class='border-dashed birth-day birthday_hijry' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>تاريخ الميلاد الموافق هجري</p>
		// 							<p class='border-dashed student_birth_h' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'> مدينة الميلاد :</p>
		// 							<p class='border-dashed birth-day-city' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'> أخر شهادة دراسية :</p>
		// 							<p class='border-dashed studycertificate' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'> حالة الدراسة:</p>
		// 							<p class='border-dashed academic-status' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'> السابقة :</p>
		// 							<p class='border-dashed pre-school' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 							<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'> الأمراض المزمنة التي يعاني منها  :</p>
		// 							<p class='border-dashed illnesses' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
		// 				</div>

		// 			</div>
		// 			<div class='second mt-3 mb-3' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<h3 class='bg-success text-white text-center p-2' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; text-align: center; padding: 5px; background: #0DCAF0; margin-bottom: 5px; margin-top: 5px;'>بيانات ولي الأمر</h3>
		// 				<div class='three-col' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: grid; grid-template-columns: repeat(3, auto); gap: 15px;'>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الاسم  ولي الامر :</p>
		// 						<p class='border-dashed parent-name' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الجنسية ولي الأمر :</p>
		// 						<p class='border-dashed parent-nationalty' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>صلة القرابة :</p>
		// 						<p class='border-dashed reserve1_relation_parent' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>نوع الهويه :</p>
		// 						<p class='border-dashed id-type' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>مصدرها :</p>
		// 						<p class='border-dashed id-source' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>رقم الهوية :</p>
		// 						<p class='border-dashed id-number' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>



		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>المهنة :</p>
		// 						<p class='border-dashed job' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
							
		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>عنوان العمل :</p>
		// 						<p class='border-dashed job-address' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<!-- <div class='box'>
		// 						<p class='fw-bold'>هاتف العمل   :</p>
		// 						<p class='border-dashed job-phone'></p>
		// 					</div> -->
							

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>البريد الالكتروني   :</p>
		// 						<p class='border-dashed parent-emai' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>عنوان السكن الحي   :</p>
		// 						<p class='border-dashed neighborhood-address' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الشارع الرئيسي   :</p>
		// 						<p class='border-dashed main-street' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الشارع الفرعي  :</p>
		// 						<p class='border-dashed sub-street' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
							
		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>بجواز   :</p>
		// 						<p class='border-dashed next-to' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>جوال المنزل   :</p>
		// 						<p class='border-dashed home-phone' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'> </p>
		// 					</div>

		// 				</div>
		// 				<h3 class='mt-2 mb-2' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; text-align: center; padding: 5px; background: #0DCAF0; margin-bottom: 5px; margin-top: 5px;'>  بيانات تعذر الاتصال</h3>
		// 				<div class='three-col' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: grid; grid-template-columns: repeat(3, auto); gap: 15px;'>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الاسم الأول:</p>
		// 						<p class='border-dashed reserve1-name' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>صلة القرابة:</p>
		// 						<p class='border-dashed reserve1-relation' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الجوال :</p>
		// 						<p class='border-dashed reserve1-phone' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'> </p>
		// 					</div>

		// 				</div>

		// 				<div class='three-col' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: grid; grid-template-columns: repeat(3, auto); gap: 15px;'>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الاسم الثاني:</p>
		// 						<p class='border-dashed reserve2-name' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>صلة القرابة:</p>
		// 						<p class='border-dashed reserve2-relation' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>

		// 					<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 						<p class='fw-bold' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>الجوال :</p>
		// 						<p class='border-dashed reserve2-phone' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 					</div>
		// 				</div>
		// 			</div> <!--  // end second  -->
		// 		</div>  <!-- end contaienr  -->
		// 	</section>
		// 	<section class='registr-division d-none' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;overflow: hidden;'>
		// 		<div class='container' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; width: 100%; padding: 15px; margin: auto;'>
		// 			<div class='third title mt-3 mb-3' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<h3 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; text-align: center; padding: 5px; background: #0DCAF0; margin-bottom: 5px; margin-top: 5px;'>خاص بقسم التسجيل:</h3>
		// 			</div>
		// 			<div class='tow-col' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: grid; grid-template-columns: repeat(2, auto); gap: 10px;'>

		// 				<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'> رقم سند القبض</p>
		// 					<p class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 				</div>

		// 				<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>تاريخه</p>
		// 					<p class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 				</div>

		// 			</div>

		// 			<div class='tow-col' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: grid; grid-template-columns: repeat(2, auto); gap: 10px;'>
		// 				<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'> مدقق البيانات</p>
		// 					<p class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 				</div>
		// 				<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>توقيعه</p>
		// 					<p class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 				</div>
		// 			</div>			
		// 		</div>
		// 	</section>
		// 	<section class='financial-department' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; overflow: hidden;'>
		// 		<div class='container' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; width: 100%; padding: 15px; margin: auto;'>
		// 			<div class='fourd mt-3 mb-3' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<h3 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; text-align: center; padding: 5px; background: #0DCAF0; margin-bottom: 5px; margin-top: 5px;'>******************    النظام المالي للطلاب والطالبات      ******************</h3>
		// 			</div>
		// 			<h4 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #198754; color: white; width: fit-content; padding: 5px; font-size: 12px;'>المادة الاولى</h4>
		// 			<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>إن هذا النظام يمثل الحقوق والواجبات المترتبة على الطرفين ( ولي الأمر والمدرسة ) ويمثل صفة تعاقد بينهما ويلتزمان بتنفيذه ومدته سنة دراسية واحدة تجدد بموافقة الطرفين ويعد بقاء ملف الطالب / الطالبة  موافقة من ولي الأمر على استمراره للسنة الجديدة حسب النظام والرسوم التي تقررها المدرسة</p>
		// 			<h4 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #198754; color: white; width: fit-content; padding: 5px; font-size: 12px;'>المادة الثانية:</h4>
		// 			<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'> نظام الرسوم الدراسية</p>
		// 			<h5 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; text-align: center; font-size: 12px;'> 1- مقدار الرسوم الدراسية لعام دراسي كامل ( فصلين دراسيين):</h5>

		// 			<div class='table-responsive mb-3' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<table class='table align-middle table-hover' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin: auto; padding: 10px;'>
		// 					<thead style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 						<tr class='table-secondary' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #FFEEBA;'>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>المجمع</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>القسم</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>روضة / تمهيدي</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>الابتدائي تحفيظ-عام</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>المتوسط تحفيظ-عام</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>الثانوي</td>
		// 						</tr>
		// 					</thead>
		// 					<tbody style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 						<tr class='table-info' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #B8DAFF;'>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>مدارس المجد (فرع البديعة)</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>بنين</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>8500</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>-</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>-</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>-</td>
		// 						</tr>
		// 						<tr class='table-light' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #BEE5EB;'>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>مدارس المجد (فرع العريجاء)</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>بنات</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>-</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>11500</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>13500</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>16000</td>
		// 						</tr>
		// 						<tr class='table-info' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #B8DAFF;'>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>مدارس المجد (فرع نمار)</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>بنين فقط</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>-</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>12000</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>14000</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>17000</td>
		// 						</tr>
		// 						<tr class='table-light' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #BEE5EB;'>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>دبلوما أمريكية</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>بنين و بنات</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>12800</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>17000</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>19000</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>-</td>
		// 						</tr>
		// 					</tbody>
		// 				</table>
		// 			</div>

		// 			<h5 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; text-align: center; font-size: 12px;'>2- نظام تخفيض الرسوم:</h5>

		// 			<ol class='p-5' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding-right: 10px;'>
		// 				<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>	يمنح ولي الأمر تخفيضاً إذا كان له أكثر من طالب علي النحو التالي (الابن الأكبر لا يمنح) (الابن الثاني5%) و(الابن الثالث فما فوق10%) ولا تشمل هذه التخفيضات مسار الدبلوما الأمريكية والتمهيدي والموهوبين.</p>
		// 				</li>
		// 				<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>	تلغى نسبة الحسم من ولي الأمر آليا في حالة عدم التزامه بسداد الرسوم الدراسية قبل نهاية الفصل الدراسي أو التاريخ أو الفترة التي تحددها المدارس.</p>
		// 				</li>
		// 				<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>في حالة منح الطلاب والطالبات خصومات عامة تلغى الخصومات الواردة في هذا العقد. </p>
		// 				</li>
		// 				<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>	إذا التحق الطالب / الطالبة في المدارس بعد مضي فترة من الفصل الدراسي الأول أو الثاني يتوجب عليه دفع الرسوم الدراسية كاملة.</p>
		// 				</li>
		// 			</ol>

		// 			<h5 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; text-align: center; font-size: 12px;'>3- آلية تسديد الرسوم الدراسية: </h5>
		// 			<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>تدفع الرسوم الدراسية على قسطين القسط الأول عند التسجيل للمستجدين والاسبوع الأول للمستمرين للفصل الدراسي الأول والثاني. </p>

		// 			<h4 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #198754; color: white; width: fit-content; padding: 5px; font-size: 12px;'>المادة الثالثة : </h4>
		// 			<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>: نظام الحركة والنقل لعام دراسي كامل ( فصلين دراسيين):</p>

		// 			<div class='table-responsive mb-3' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<table class='table align-middle table-hover' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin: auto; padding: 10px;'>
		// 					<thead style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 						<tr class='table-secondary' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #FFEEBA;'>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>المسار</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>الفصل الأول </td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>الفصل الثاني</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>إجمالي العام</td>
		// 						</tr>
		// 					</thead>
		// 					<tbody style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 						<tr class='table-light' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #BEE5EB;'>
		// 							<td class='table-secondary' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>ذهاب وعودة (اتجاهين)</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>2000</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>2000</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>4000</td>
		// 						</tr>
		// 						<tr class='table-info' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #B8DAFF;'>
		// 							<td class='table-secondary' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>ذهاب وعودة (اتجاه واحد)</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>1750</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>1750</td>
		// 							<td style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding: 4px; font-size: 8px;'>3500</td>
		// 						</tr>
		// 					</tbody>
		// 				</table>
		// 			</div>

		// 			<ol class='p-5 pt-0' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding-right: 10px;'>
		// 				<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	يتحمل ولي الأمر ضريبة القيمة المضافة للنقل</li>
		// 				<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	خط سير الحافلات تحدده إدارة النقل بالمدارس، وعلى ولي الأمر الالتزام به. </li>
		// 				<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>يلتزم الطالب/الطالبة بانتظار الحافلة في الوقت الذي تحدده إدارة المدارس ولا تلتزم الحافلة بالعودة مرة أخري. </li>
		// 				<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	في حالة وجود ملحوظة على النقل يتم التواصل مع إدارة المدرسة فقط. </li>
		// 			</ol>
		// 		</div>
		// 	</section>
		// 	<section style='print-color-adjust: exact; -webkit-print-color-adjust: exact; overflow: hidden;'>
		// 		<div class='container' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; width: 100%; padding: 15px; margin: auto;'>
		// 			<div class='wrapper' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<h4 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #198754; color: white; width: fit-content; padding: 5px; font-size: 12px;'>المادة الرابعة نظام الانسحاب (سحب الملف):</h4>
		// 				<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>حيث يعتبر بقاء ملف الطالب / الطالبة في المدرسة الأسبوع الأول من بدء الدراسة موافقة على استمراره للسنة الجديدة ولو لم يقدم ولي الأمر طلباً رسمياً بذلك وحيث إن انسحاب الطالب / الطالبة بعد قبوله في المدرسة يحرم طالباً آخر من القبول بالمدارس فإن إدارة المدارس تأمل أن يتم سحب ملف الطالب قبل بدء اليوم الأول من الدراسة أما إذا تأخر ولي الأمر في نقل ابنه / ابنته من المدرسة فإنه يترتب عليه الآتي:</p>
		// 				<div class='p-2 pt-0' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 					<ol style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding-right: 10px;'>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>لحين بدء الأسبوع الثاني من الدراسة فإنه يتوجب عليه دفع 50 % من رسوم الفصل الدراسي.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>لحين بدء الأسبوع الثالث من الدراسة فإنه يتوجب عليه دفع رسوم الفصل الدراسي كاملة.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>يسري هذا النظام علي الرسوم الدراسية والنقل كما يسري على من يسجل في الفصل الدراسي الثاني. </li>
		// 					</ol>
		// 				</div>
		// 			</div>
		// 			<div class='wrapper' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 				<h4 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; background: #198754; color: white; width: fit-content; padding: 5px; font-size: 12px;'>المادة الخامسة أحكام عامة:</h4>
		// 				<div class='p-2 pt-0' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 					<ol style='print-color-adjust: exact; -webkit-print-color-adjust: exact; padding-right: 10px;'>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	تعتذر المدارس عن استقبال الأطفال بمرحلة رياض الأطفال مالم يتم سداد الرسوم الفصلية مع بداية كل فصل دراسي.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	في حالة سحب الطالب من المدارس ترد الرسوم لولي الأمر على حسب مواعيد السحب المبينة في المادة الرابعة بشيك باسم ولي الأمر الذي سدد الرسوم.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	يتحمل الطرف الثاني أي التزامات مالية إضافية تقر من الجهات الرسمية كضريبة القيمة المضافة وغيرها.  </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	أرقام هواتف ولي الأمر والبيانات المدونة في هذه الاستمارة هي التي يتم من خلالها التواصل معه ولا تتحمل المدارس أي مسؤولية إذا كانت البيانات غير صحيحة، وفي حال تغيير أي من الأرقام أو البيانات المدونة في هذه الاستمارة (خلف هذا العقد) يلتزم ولي الأمر بإشعار المدارس خطياً بالتغيير. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	
		// 							<p class='m-0' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px;'>يلتزم ولي الأمر بسداد الرسوم الدراسية ورسوم النقل للمشترك في خدمة النقل قبل بدء كل فصل دراسي وفي حالة تأخر ولي الأمر عن سداد الرسوم الدراسية ورسوم النقل لمدة شهر من بداية الفصل الدراسي يحق للمدارس اتخاذ الإجراءات التالية بدون معارضة ولي الأمر أو الطالب/الطالبة مع حفظ حقوق المدارس المالية: </p>	
		// 							<div class='p-4 pt-0' style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>
		// 								<ol class='list-style-square' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; list-style-type: square;padding-right: 10px;'>
		// 									<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>إيقاف الحافلة عن الطالب او الطالبة لحين سداد الرسوم </li>
		// 									<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	المنع من استلام أصول الشهادات والملف الرسمي وكذلك جميع إخوته وأخواته في المدارس لحين سداد كافة الرسوم. </li>
		// 									<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	المنع من سحب الملف أو نقله أو إدخال درجاته على برنامج نور إلا بعد إنهاء المستحقات المالية. </li>
		// 									<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	حجب التقارير الشهرية والفصلية. </li>
		// 									<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	يحق للمدارس اتخاذ الإجراء القانوني الذي يكفل حقها في الرسوم الدراسية في موعد أقصاه منتصف كل فصل دراسي مثال: سند لأمر، وغيرها من الإجراءات.</li>
		// 								</ol>
		// 							</div>
		// 						</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	 يتعهد الطالب/الطالبة وولي الأمر بالمحافظة على ممتلكات المدرسة، وإذا حصل خلاف ذلك يلتزم الطالب / الطالبة وولي الأمر بدفع قيمة ما تم إتلافه أو استبداله على حسابه الخاص سواء بقصد أو بغير قصد منفرداً أو مع غيره من الطلاب وفي حالة تأخره يحق للمدارس إيقافه عن الدراسة ومطالبته من خلال الجهات المختصة بالوفاء بالالتزام. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	يحق للمدارس استبعاد الطالب/الطالبة عن حافلات المدرسة في حال سوء سلوكه مع زملاءه أو الأخرين من أول مرة أو تسببه في التأخر في ركوب الحافلة مع احتفاظ المدارس بجميع حقوقها المالية وعدم المطالبة باسترداد رسومها أو المتبقي منها. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	على الطالب / الطالبة التقيد بالزي المدرسي المعتمد والعباءة الساترة للطالبات وبالآداب الإسلامية والتمسك بها داخل المدرسة وحولها، والتقيد بالنظام والتعليمات الخاصة بالمدارس وجميع تعليمات الوزارة، أما بالنسبة للزي المدرسي يوفره ولي الأمر من الأسواق أو تقوم المدارس بتوفيره على حساب ولي الأمر. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	في حال ارتكاب الطالب / الطالبة أياً من المخالفات الرسمية أو الإخلال بالنظام العام للمدارس فمن حق المدارس اتخاذ ما تراه مناسباً بما فيها استبعاد الطالب/الطالبة من المدرسة بدون اعتراض منه أو من ولي الأمر حسب ما تقتضيه مصلحة المدارس، مع احتفاظ المدارس بحقوقها المالية.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	لا يجوز استمرار الطالب/الطالبة القديم أو دخوله إلى الصف في بداية السنة الدراسية الجديدة إلا بعد سداد الرسوم الدراسية المستحقة عليه من السنوات السابقة ويحق للمدارس إيقاف الطالب/الطالبة عن الدراسة مع بداية الفصل الدراسي الثاني إذا كان عليه رسوم دراسية متأخرة عن الفصل الدراسي الأول ويتحمل ولي الأمر كامل المسؤولية عن ذلك. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	تعتمد إدارة المدارس لوائح الحسم كل نهاية عام للعام القادم ان وجدت وتعديل الرسوم الدراسية أو رسوم النقل ويكون بتسليم ولي الأمر أو الطالب خطاب أو إبلاغه بوسائل التواصل المعتمدة وذلك قبل بداية العام الدراسي الذي يشمله التعديل او الأسبوع الأول من بداية العام الجديد، وعدم سحب ملف الطالب نهاية العام يعنى موافقته على الرسوم الجديدة ولا يحق له الاعتراض على ذلك. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	الطالب/ـة من خارج المملكة العربية السعودية أو من مدارس أجنبية داخل المملكة يشترط تقديم (أمر قبول من إدارة التعليم – معادلة الشهادات).</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	الطالب/ـة ومن هم أعمارهم أقل من سن القبول عليهم تقديم ما يفيد موافقة إدارة التعليم بقبولهم.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	أسلوب التواصل المعتمد مع أولياء الأمور فيما يخص الرسوم الدراسية وغيرها يكون بخطاب يستلمه الطالب / الطالبة لإيصاله لولي أمره أو برسالة جوال نصية أو واتس آب على أرقام الجوالات المسجلة بطلب الالتحاق أو بالبريد الالكتروني وإذا حدث أي تعديل بالبيانات فيكون الاشعار على مسؤولية ولي الأمر بإبلاغ الإدارة المالية وإدارة القسم كلا على حدة. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	يحق للمدارس تصوير الفعاليات والبرامج والأنشطة والقائمين عليها والمشاركين فيها، واستثمار المتفوقين والحاصلين على جوائز محلية وعالمية في الدعاية، ونشرها بوسائل التواصل الاجتماعي ووسائل الإعلام المختلفة وبدون الرجوع لولي الأمر. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	أقر بأنني اطلعت على نظام الحضور والغياب وأن غياب 25% يحرمني من الدراسة. وأتحمل الرسوم الدراسية كاملة للفصل الدراسي.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	في حال تبين لإدارة المدرسة وجود حالة من حالات التربية الخاصة أو فرط الحركة أو صعوبات التعلم فيحق لإدارة المدرسة الاعتذار من استمرار الطالب بالمدارس ضمن طلبة التعليم العام مع احتفاظ المدارس بحقوقها المالية. </li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	في حالة انقطاع الطالب /الطالبة عن الدراسة أو بالاعتذار عن عام أو فصل دراسي يلزمه تقديم اعتذار رسمي للإدارة التنفيذية في المدارس ويعامل في ضوء ما ورد في المادة الرابعة.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	المواد الإضافية وكراسات الأنشطة التي تقررها المدارس يلزم بها الطالب / الطالبة.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	التقيد بالنظام الداخلي للمدارس والتعليمات الخاصة بها.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	عند تأخر ولي الأمر عن سداد الرسوم الدراسية فيحق للمدارس المطالبة بها لدي المحاكم ويتحمل ولي الأمر أتعاب المحاماة والرسوم الإدارية الأخرى.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	يتحمل ولي الأمر قيمة الكتب الدراسية، والزي المدرسي لمسار الدبلوما الأمريكية والتمهيدي (للبنين والبنات).</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	تستحق المدارس كامل الرسوم المحددة في العقد وكافة الرسوم الأخرى حتى وإن تم إيقاف أو إنهاء العام الدراسي أو جزء منه من جانب الجهات الرسمية بالدولة لأي سبب كان.</li>
		// 						<li style='print-color-adjust: exact; -webkit-print-color-adjust: exact; margin-bottom: 6px; font-size: 12px;'>	في حال حدوث ظروف غير متوقعة وخارجة عن الإرادة، سواء كانت ظروفا طارئة، أو قوة قاهرة مثل الحروب أو الأوبئة أو الزلازل أو غيرها في أي وقت من العام الدراسي، وتسببت في تأجيل أو إلغاء الدراسة أو تحويل الدراسة من حضورية إلى دراسة عن بعد، تكون الرسوم الدراسية ورسوم النقل مستحقة للمدارس كاملة، ولا يحق لولي الأمر مطالبة المدارس بإعفائه منها أو تخفيضها.</li>
		// 					</ol>
		// 				</div>
		// 			</div>
		// 		</div>
		// 	</section>
		// 	<section class=' pledge pb-3' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; overflow: hidden;'>
		// 		<div class='container  border-top border-3 border-primary' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; width: 100%; padding: 15px; margin: auto;'>
		// 			<h3 style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; text-align: center; padding: 5px; background: #0DCAF0; margin-bottom: 5px; margin-top: 5px;'>إقرار وتعهد</h3>
		// 			<quotemeta style='print-color-adjust: exact; -webkit-print-color-adjust: exact;'>'أقر أن المعلومات الشخصية المدونة بعقد الاتفاق ودليل القبول والتسجيل صحيحة وعلى مسؤوليتي، وقد اطلعت على النظام المالي وأتعهد بالالتزام بمضمونه '</quotemeta>

		// 			<div class='tow-col' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: grid; grid-template-columns: repeat(2, auto); gap: 10px;'>

		// 				<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>اسم ولي الأمر</p>
		// 					<p class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 				</div>

		// 				<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>رقم السجل المدني</p>
		// 					<p class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 				</div>

		// 				<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>التوقيع</p>
		// 					<p class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 				</div>
						
		// 				<div class='box' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; display: flex; gap: 10px;'>
		// 					<p style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; width: 100px;'>رقم الجوال</p>
		// 					<p class='border-dashed' style='print-color-adjust: exact; -webkit-print-color-adjust: exact; font-size: 12px; border-bottom: dashed 2px #ddd; padding: 0px 22px;'></p>
		// 				</div>
					
		// 			</div>
		// 		</div>
		// 	</section>
		// </main>
		// ");

		// $mpdf->Output();
		
		// $name_file = 'contract.pdf';
		// $pdf_file = $mpdf->Output('ddd.pdf', 'S');
		// file_put_contents($name_file, $pdf_file);



		// -------------------------------------------------------------------------------- Start Sending EMAIL 
		$mail = new PHPMailer(true);
		$mail->isSMTP();   
		$mail->Host       	= 'smtp.gmail.com';
		$mail->SMTPAuth   	= true;
		$mail->CharSet   	= "UTF-8";
		$mail->SMTPSecure 	= 'tls';
		$mail->Port       	= '587';
		$mail->Username   	= 'mohamadalkhlaf1@gmail.com';
		$mail->Password   	= 'mbjtisiragfjgzao'; 










		$mail->Subject 		= '  التسجيل الالكتروني مدارس المجد  ';
    	$mail->Body 		=  "عزيزي ولي الأمر تم تسجيل الطالبـ/ـة ( $full_student_name ) في مدارس المجد الأهلية بنجاح ،، رقم مرجعي ( $the_code ) نسعد بخدمتكم 920008733)";
		$mail->setFrom('mohamadalkhlaf1@gmail.com', 'مدارس المجد الأهلية- info@almajd.edu.sa');
		$mail->addAddress($parent_email, 'مدارس المجد'); 

		// add pdf attachment to php mailer
		// $mail->addAttachment($name_file);


// 		if (isset($_FILES['img_1'])) : // check img is uploaded before sending data to E-mail 

// 			$mail->addAttachment( $_FILES['img_1']['tmp_name'], $_FILES['img_1']['name'] );


// 			else : echo "false upload img imgs_id";
// 		endif;
		
		if ($mail->send()) : $results = "تم التسجيل ";
		else : $results = "فشل التسجيل  " . $mail->ErrorInfo;
		endif;
		
		// ++++++++++++++++

// 			if ($mail->send()) : $results = "تم التسجيل ";
// 			else : $results = "فشل التسجيل  " . $mail->ErrorInfo;
// 			endif;
        // ++++++++++++++++

		$mail->smtpClose();
		// unlink($name_file);		



		// -------------------------------------------------------------------------------- Start Send Massage sms To Phone Num
		include("LIB/sms/OTSMS.php");
		$UserName		= "11194";
		$UserPassword	= "62292301";
		$Originator		= "Almajd";
		$Message		=  "عزيزي ولي الأمر تم تسجيل الطالبـ/ـة ( $full_student_name ) في مدارس المجد الأهلية بنجاح ،، رقم مرجعي ( $the_code ) نسعد بخدمتكم 920008733)";
		$SendingResult = SendSms($UserName,$UserPassword,$house_phone,$Originator,$Message);

		
		switch ($SendingResult) :
			case '1': 	 $sms_message = 'تم إرسال الرسالة بنجاح';														break;
			case '1010': $sms_message = 'معلومات ناقصة.. اسم المستخدم أو كلمة المرور أو في محتوى الرسالة أو الرقم';	break;
			case '1020': $sms_message = 'بيانات الدخول خاطئة';															break;
			case '1030': $sms_message = 'نفس الرسالة مع نفس الاتجاه توجد في الملحق، انتظر عشر ثواني قبل إعادة إرسالها';break;
			case '1040': $sms_message = 'حروف غير معترف بها ';															  break;
			case '1050': $sms_message = 'الرسالة فارغة، السبب:الانتقاء قد سبب حذف محتوى الرسالة';						break;
			case '1060': $sms_message = 'اعتماد غير كافي لعميلة الإرسال';												  break;
			case '1070': $sms_message = 'رصيدك 0 ، غير كافي لعملية الإرسال';											  break;
			case '1080': $sms_message = 'رسالة غير مرسلة ، خطأ في عملية إرسال رسالة';									break;
			case '1090': $sms_message = 'تكرير عملية الانتقاء أنتج الرسالة';											  break;
			case '1100': $sms_message = 'عذرا ، لم يتم إرسال الرسالة. حاول في وقت لاحق';								 break;
			case '1110': $sms_message = 'عذرا، هناك اسم مرسل خاطئ ثم استعماله، حاول من جديد تصحيح الاسم';				break;
			case '1120': $sms_message = 'عذرا ، هذا البلد الذي تحاول الإرسال له لا تشمله شبكتنا';						break;
			case '1130': $sms_message = 'عذرا، راجع المشرف على شبكاتنا باعتبار الشبكة المحددة في حسابكم';			 break;
			case '1140': $sms_message = 'عذرا ، تجاوزت الحد الأقصى لأجزاء الرسائل. حاول إرسال عدد أقل من الأجزاء';		break;
			case '1150': $sms_message = 'هذه الرسالة مكررة بنفس رقم الجوال واسم المرسل ونص الرسالة';				 break;
			case '1160': $sms_message = 'هناك مشكلة في مدخلات تاريخ وتوقيت الإرسال اللاحق';								 break;
			default : $sms_message =  $SendingResult;
		endswitch;
		// -------------------------------------------------------------------------------- The Proccess is done 
		$is_submiting = true;

		$_SESSION['full_student_name'] 	= $full_student_name;
		$_SESSION['sms_message'] 		= $sms_message;
		$_SESSION['transport_type']		= $transport_type;
		$_SESSION['the_code']			= $the_code;
		
		//========================================================================================Start send whatsapp
		
        // تهيئة الاتصال
        $ch = curl_init();
        
        // تعيين الرابط الذي تريد الاتصال به
        curl_setopt($ch, CURLOPT_URL, "https://imapi.bevatel.com/whatsapp/api/message");
        
        
        // تهيئة رأس الطلب
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTk3OCwic3BhY2VJZCI6MTE0MjQ1LCJvcmdJZCI6NjIxMTAsInR5cGUiOiJhcGkiLCJpYXQiOjE2ODM4OTgyMTl9.p256XUsPJL31YNQ2LEVR5nphrILOCOJBjk2kz0bbdjY'
        );
        
        // تعيين رأس الطلب
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // تعيين الخيارات الإضافية
        curl_setopt($ch, CURLOPT_POST, true);

        
        // تحديد البيانات التي ترسلها في الجسم لطلب POST
        $data = '{
             "phone": "966564627895",
            "channelId": 118987,
            "templateName": "majdregis",
            "languageCode": "ar",
            "text": "مرحباً 👋 عزيزي ولي الأمر تم تسجيل الطالبـ/ـة ({{1}}) في مدارس المجد الأهلية بنجاح بالمسار ({{2}}) قسم ({{3}}) المرحلة ({{4}}) صف ({{5}}) رقم المرجعي ({{6}}) يرجى مراجعة قسم القبول والتسجيل لإنهاء إجراءات قبول الطالبـ/ـة في المدارس، نتمنى لكم يوماً سعيداً💐",
        	"parameters": [
        	     "' . $full_student_name . '", "' . $educational_path . '", "' . $complex_name . '", "' . $educational_level . '", "' . $educational_class . '", "' . $the_code . '"
        	],
        
            "tags": [
                "تسجيل جديد",
                "استقطاب"
            ]
        }';
        
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        // تنفيذ الاتصال واسترداد البيانات
        $response = curl_exec($ch);
        
        // التحقق من عملية الاتصال
        if ($response === false) {
            echo 'خطأ في الاتصال بـ cURL: ' . curl_error($ch);
        }
        
        // إغلاق الاتصال
        curl_close($ch);		
		
		
		
		
		header('Location: thank-you.php');
		exit();
	endif;

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>
		<?php include('./layout/head.php'); ?>
		<link rel="stylesheet" href="./assets/css/all.min.css">
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/css/registration.css">
		<!-- <link rel="stylesheet" href="./assets/css/contracts.css" media="print"> -->
		<title>نموذج فتح حساب  </title>
	</head>
	<body>

		<header class="site-header main-header">
			<div class="container">
				<div class="contetn">
					<div class="logo-info">

						<a href="https://almajd.edu.sa/" class="logo">
							<img src="./assets/imgs/logo.png" alt="مدارس  المجد الاهلية">
						</a>
						<ul>
							<li><a href="http://almajd.edu.sa/">الصفحة الرئيسية</a></li>
							<li><a href="https://almajd.edu.sa/contact/">اتصل بنا</a></li>
							
						</ul>
					</div>
					<div class="vision2030">
						<img src="./assets/imgs/vision.svg" alt="">
					</div>
				</div>
			</div>
		</header>

		<main class="forms-container-main">
			<div class="container">
				<h1 class="text-center"> نموذج تسجيل طالب</h1>
				

				<form 	class="text-right" 
						method="POST" 
						action="<?php echo $_SERVER['PHP_SELF'] ?>" 
						enctype="multipart/form-data"
						id="the_form"
						<?php if ($is_submiting) echo 'data-done-form="done"' ?>
				>
				
				<!-- Start Accourion  -->
				<div class="accordion accordion-flush mb-4 " id="accordionFlushExample">
				<div class="form-accordion-item ">
					<div class="accordion-item ">
						<h2 class="accordion-header" id="flush-headingOne">
							<button class="accordion-button fw-bold text-black " 
									type="button" 
									data-bs-toggle="collapse" 
									data-bs-target="#flush-collapseOne" 
									aria-expanded="false" 
									aria-controls="flush-collapseOne">
									البيانات الدراسية 
							</button>
						</h2>

						<div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="">
								<div class="accordion-body">
								
								<div class="three-col home-select">


							<!-- ========================================================================== -->

								<div class="path-container input-group mb-3" >
									<label class=" bg-label" for="path">أختر المسار</label>
									<select require data-type="educational_path" name="educational_path"  class="form-select inputs_js" id="path" data-class="educational_path">
										<option   class="path_0 path_option" value="" selected>اختر</option>
										<option   class="path_1 path_option" value="path_1" >مسار التعليم العام	</option>
										<option   class="path_2 path_option" value="path_2">مسار تحفيظ القرآن الكريم</option>
										<option   class="path_3 path_option" value="path_3">مسار الدبلوما الأمريكية	</option>
										<option   class="path_4 path_option" value="path_4">مسار الطفولة المبكرة   </option>
									</select>
									<i class="fa-solid fa-star required-inputs"></i>	
									<small id="emailHelp" class="form-text text-muted">
										<?php
											// if(isset($phoneErrors)) :
											// 	if ($phoneErrors !== '' ) : echo $phoneErrors;
											// 	else : echo 'valid phone number';
											// 	endif;		
											// else : echo "We'll never share your email with anyone else.";
											// endif; 
										?>
									</small>														
								</div>
									


								<div class="complex-container input-group mb-3 complex " id="complex"></div>
								<div class="input-group  mb-3 " id="level">	</div>
								<div class="input-group mb-3"  id="class"></div>
													

							<!-- ========================================================================== -->

							</div>


								<div class="input-group mb-3">
								<label class=" bg-label" for="class">النقل</label>
								<select  id="joint_contract" name="transport_type" require data-class="transport-data" class="form-select inputs_js" id="class">
									<option value="" selected>أختر</option>
									<!-- عند تغيير القيمة الخاصة ب نوع الحقل اجباري لازم تغيير القيمة في الشرط الخاص بطهور زر طباعة العقد  -->
									<option value="غير مشترك" >غير مشترك</option>
									<option value="مشترك" 		  >مشترك</option>
								</select>
								<i class="fa-solid fa-star required-inputs"></i>							
								</div>


							</div>
						</div>
					</div>
				</div>
					<!-- End Section One  -->



					<div class="accordion-item ">
						<h2 class="accordion-header" id="flush-headingTwo">
						<button class="accordion-button fw-bold text-black  " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
							بيانات الطالبـ/ـة
						</button>
						</h2>
						<div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo" data-bs-parent="">
							<div class="accordion-body">

								<div class="three-col">
															
															<div class="input-group mb-3 gap-1 ">
																<label class="bg-label"> اسم الطالب كامل</label>
																<input require name="full_student_name" type="text" class="form-control inputs_js" id="companyName"  data-class="fullname" value="">
																<i class="fa-solid fa-star required-inputs"></i>							
															</div>
																				
															<div class="input-group mb-3 gap-1">
																<label class="bg-label">رقم هوية الطالب</label>
																<input  require name="student_id_num" type="number" data-notes="small_student_id_num" class="form-control inputs_js" id="ownerName" data-class="civil-registry" value="">
																<i class="fa-solid fa-star required-inputs"></i>			
																<small id="emailHelp" class="form-text text-muted d-none small_student_id_num">يجب ان يكون الحقل 10 أرقام فقط</small>

															</div>

															<div class="input-group mb-3 gap-1">
																<label class="bg-label">الجنسية</label>
																<select  require name="nationalty_student" data-class="nationality" class="form-select inputs_js">
																	<option value="السعودية">السعودية</option>
																	<option value="الكويت">الكويت</option>
																	<option value="الامارات">الامارات</option>
																	<option value="البحرين">البحرين</option>
																	<option value="مصر">مصر</option>
																	<option value="السودان">السودان</option>
																	<option value="سوريا">سوريا</option>
																	<option value="اليمن">اليمن</option>
																	<option value="العراق">العراق</option>
																	<option value="تونس">تونس</option>
																	<option value="الأردن">الأردن</option>
																	<option value="الجزائر">الجزائر</option>

																</select>							
																<i class="fa-solid fa-star required-inputs"></i>							
															</div>

															<div class="input-group mb-3 gap-1">
																<label class=" bg-label" for=""> تاريخ الميلاد</label>
																<input name="birthday"  data-class="student_birth_h" type="text" id="ContentPlaceHolder1_PageData_ucZawga_PersonDataControl1_ucBirthDate_pickCalHj" class="pickCalHj form-control" readonly="readonly" placeholder="هجري">
																<i class="fa-solid fa-star required-inputs"></i>							
															</div>

															<div class="input-group mb-3 gap-1">
																<label class=" bg-label" for=""> تاريخ الميلاد</label>
																<!-- <input    type="date"  class="form-control" placeholder="هجري"     data-class="birth-day" value=""> -->
																<input name="birthday_hijry"  type="text" id="ContentPlaceHolder1_PageData_ucZawga_PersonDataControl1_ucBirthDate_pickCalGer" class="pickCalGer form-control" readonly="readonly" placeholder="ميلادي">							
																<i class="fa-solid fa-star required-inputs"></i>							
															</div>
													
															<div class="input-group mb-3 gap-1">
																<label class=" bg-label" for="">مكان الولادة</label>
																<input require name="birthday_city"  data-class="birth-day-city" type="text" class="form-control inputs_js">
																<i class="fa-solid fa-star required-inputs"></i>							
															</div>
													
															<div class="input-group mb-3 gap-1">
																<label class=" bg-label" for=""> آخر شهادة دراسية</label>

																<select require name="study_certificate" data-class="studycertificate" class="form-select inputs_js">
																	<option value="" selected="">اختار</option>
																	<option value="تمهيدي">تمهيدي</option>
																	<option value="أول ابتدائي">أول ابتدائي</option>
																	<option value="ثاني ابتدائي">ثاني ابتدائي</option>
																	<option value="ثالث ابتدائي">ثالث ابتدائي</option>
																	<option value="رابع ابتدائي">رابع ابتدائي</option>
																	<option value="خامس ابتدائي">خامس ابتدائي</option>
																	<option value="سادس ابتدائي">سادس ابتدائي</option>
																	<option value="أول متوسط">أول متوسط</option>
																	<option value="ثاني متوسط">ثاني متوسط</option>
																	<option value="ثالث متوسط">ثالث متوسط</option>
																	<option value="أول ثانوي">أول ثانوي</option>
																	<option value="ثاني ثانوي">ثاني ثانوي</option>
																	<option value="لايوجد">لايوجد</option>							
																</select>

																<i class="fa-solid fa-star required-inputs"></i>							
															</div>
													
															<div class="input-group mb-3 gap-1">
																<label class=" bg-label" for="">حالة الدراسة</label>
																<select require name="study_stutas"  class="form-select inputs_js" data-class="academic-status">
																	<option value="">اختار</option>
																	<option value="مستجد">مستجد</option>
																	<option value="ناجح">ناجح</option>
																	<option value="منقول من مدرسة أخرى">منقول</option>
																</select>
																<i class="fa-solid fa-star required-inputs"></i>							
															</div>
													
															<div class="input-group mb-3 gap-1">
																<label class=" bg-label" for="">المدرسة السابقة:</label>
																<input  name="pre_school" data-class="pre-school" type="text" class="form-control inputs_js">
															</div>
													
															<div class="input-group mb-3 gap-1">
																<label class=" bg-label" for="">الأمراض المزمنة  :</label>
																<input name="illnesses" data-class="illnesses" type="text" class="form-control inputs_js">
															</div>
															</div>

							</div>
						</div>
					<!-- End Section Tow  -->

					<div class="accordion-item ">
					<h2 class="accordion-header" id="flush-headingThree">
						<button class="accordion-button fw-bold text-black  " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
						بيانات ولي الأمر
						</button>
					</h2>
					<div id="flush-collapseThree" class="accordion-collapse collapse show" aria-labelledby="flush-headingThree" data-bs-parent="">
							<div class="accordion-body">
							<div class="three-col">
									
									<div class="input-group mb-3 gap-1">
											<label class=" bg-label" for="">اسم ولي الأمر</label>
											<input  name="parent_name" require data-class="parent-name" type="text"  class="form-control inputs_js"    >
											<i class="fa-solid fa-star required-inputs"></i>							
									</div>
									
									<div class="input-group mb-3 gap-1">
										<label class="bg-label">الجنسية</label>
										<select require name="parent_nationalty" data-class="parent-nationalty" class="form-select inputs_js">
											<option value="السعودية">السعودية</option>
											<option value="الكويت">الكويت</option>
											<option value="الامارات">الامارات</option>
											<option value="البحرين">البحرين</option>
											<option value="مصر">مصر</option>
											<option value="السودان">السودان</option>
											<option value="سوريا">سوريا</option>
											<option value="اليمن">اليمن</option>
											<option value="العراق">العراق</option>
											<option value="تونس">تونس</option>
											<option value="الأردن">الأردن</option>
											<option value="الجزائر">الجزائر</option>
										</select>							
										<i class="fa-solid fa-star required-inputs"></i>							
									</div>
								
									
									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">صلة القرابة</label>
										<select require name="reserve1_relation_parent" require data-class="reserve1_relation_parent" class="form-select inputs_js" data-class="academic-status" >
											<option value="الوالد" selected>الوالد</option>
											<option value="الوالدة">الوالدة</option>
											<option value="أخ">أخ			</option>
											<option value="أخت">أخت			</option>
											<option value="عمـ/ـة" >عمـ/ـة	</option>
											<option value="خالـ/ـة" >خالـ/ـة</option>
											<option value="جد/ة"> جد/ة		</option>
											<option value="أخرى"> أخرى		</option>
										</select>
										<i class="fa-solid fa-star required-inputs"></i>	
									</div>
							
									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">نوع الهوية</label>
										<select name="id_patent_type" require data-class="id-type" class="form-select inputs_js" data-class="academic-status" >
											<option value="" selected>اختار</option>
											<option value="هويه مواطن" selected>هويه مواطن</option>
											<option value="هويه مقيم ">هويه مقيم </option>
										</select>
										<i class="fa-solid fa-star required-inputs"></i>	
									</div>
							
									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">مصدر الهوية</label>
										<input name="id_source_parent" require data-class="id-source"   type="text"  class="form-control inputs_js"    >
										<i class="fa-solid fa-star required-inputs"></i>	
									</div>
							
									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">رقم الهوية</label>
										<input require name="parent_id_num" data-notes="small_parent_id_num" require data-class="id-number"   type="number"  class="form-control inputs_js"    >
										<i class="fa-solid fa-star required-inputs"></i>	
										<small id="emailHelp" class="form-text text-muted d-none small_parent_id_num">يجب ان يكون الحقل 10 أرقام فقط</small>
									</div>

								
									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">مهنة ولي الأمر</label>
										<input require name="parent_job"  data-class="job"   type="text"  class="form-control inputs_js"    >
										<i class="fa-solid fa-star required-inputs"></i>	
									</div>

									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">عنوان العمل</label>
										<input name="parent_job_address" require data-class="job-address"   type="text"  class="form-control inputs_js"    >
										<i class="fa-solid fa-star required-inputs"></i>	
									</div>

									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">البريد الالكتروني</label>
										<input name="parent_email" require data-class="parent-emai" name="email"  type="text"  class="form-control inputs_js"    >
										<i class="fa-solid fa-star required-inputs"></i>	
									</div>


								</div>

						</div>
					</div>
					</div>
					<!-- End Section Three  -->

					<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingThree">
						<button class="accordion-button fw-bold text-black " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree">
						بيانات العنوان والاتصال
						</button>
					</h2>
					<div id="flush-collapseFour" class="accordion-collapse collapse show" aria-labelledby="flush-headingThree" data-bs-parent="">
							<div class="accordion-body">
						<div class="three-col">

						<div class="input-group mb-3 gap-1">
							<label class=" bg-label" for="">جوال  ولي الأمر</label>
							<input name="house_phone" data-class="home-phone" data-notes="small_house_phone"  type="number" placeholder="966564627895"    class="small_house_phone_input form-control inputs_js"    >
							<small id="emailHelp" class="form-text text-muted d-none small_house_phone">يجب ان يكون الحقل 12 أرقام فقط بهدذا الشكل 966564627895</small>

						</div>

						<div class="input-group mb-3 gap-1">
							<label class=" bg-label" for="">عنوان السكن (الحي)</label>
							<input require name="neighborhood_address" require data-class="neighborhood-address"   type="text"  class="form-control inputs_js"    >
							<i class="fa-solid fa-star required-inputs"></i>	
						</div>

						<div class="input-group mb-3 gap-1">
							<label class=" bg-label" for="">الشارع الرئيسي</label>
							<input require name="main_street" require data-class="main-street"   type="text"  class="form-control inputs_js"    >
							<i class="fa-solid fa-star required-inputs"></i>	
						</div>

						<div class="input-group mb-3 gap-1">
							<label class=" bg-label" for="">الشارع الفرعي</label>
							<input name="sub_street" data-class="sub-street"   type="text"  class="form-control inputs_js"    >
						</div>



						<div class="input-group mb-3 gap-1">
							<label class=" bg-label" for="">بجوار </label>
							<input name="next_to" data-class="next-to"   type="text"  class="form-control inputs_js"    >
						</div>

						<div class="input-group mb-3 gap-1">
							<label class=" bg-label" for="">رقم المنزل </label>
							<input name="house_num" data-class="house_num"   type="text"  class="form-control "    >
						</div>

					</div>



					<!-- Start seondary name reserv  -->
					<div class="accordion" id="accordionExamplereserver">
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingOne">
							<button class="accordion-button fw-bold text-black " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOnereserv" aria-expanded="true" aria-controls="collapseOne">
								وفي حالة تعذر الاتصال بك عند الضرورة نرجو ذكر اسم وعنوان اثنين يمكن الاتصال بهما	
							</button>
							</h2>
							<div id="collapseOnereserv" class="accordion-collapse collapse show " aria-labelledby="headingOne" data-bs-parent="">
								<div class="accordion-body">


								<div class="three-col">
								<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for=""> الاسم الأول</label>
										<input require name="reserve_name_1" require data-class="reserve1-name"   type="text"  class="form-control inputs_js"    >
										<i class="fa-solid fa-star required-inputs"></i>
									</div>

									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">صلة القرابة</label>
										<select name="reserve_relation_1" require data-class="reserve1-relation" class="form-select inputs_js" data-class="academic-status" >
											<option value="" selected>اختار</option>
											<option value="الوالد">الوالد</option>
											<option value="الوالدة">الوالدة</option>
											<option value="أخ">أخ			</option>
											<option value="أخت">أخت			</option>
											<option value="عمـ/ـة" >عمـ/ـة	</option>
											<option value="خالـ/ـة" >خالـ/ـة</option>
											<option value="جد/ة"> جد/ة		</option>
											<option value="أخرى"> أخرى		</option>
										</select>
										<i class="fa-solid fa-star required-inputs"></i>
									</div>

									<div class="input-group mb-3 gap-1">
										<label class=" bg-label" for="">الجوال</label>
										<input name="reserve_relation_phone_1" require data-notes="small_reserve_1" data-class="reserve1-phone"     type="number" placeholder="********05"  class="form-control inputs_js"    >
										<i class="fa-solid fa-star required-inputs"></i>
										<small id="emailHelp" class="form-text text-muted d-none small_reserve_1">يجب ان يكون الحقل 10 أرقام فقط </small>
									</div>									

								<div class="input-group mb-3 gap-1">
									<label class=" bg-label" for="">الاسم الثاني</label>
									<input name="reserve_name_2" data-class="reserve2-name"   type="text"  class="form-control inputs_js"    >
								</div>

								<div class="input-group mb-3 gap-1">
									<label class=" bg-label" for="">صلة القرابة</label>
									<select name="reserve_relation_2" data-class="reserve2-relation" class="form-select inputs_js" data-class="academic-status" >
										<option value="" >اختار</option>
										<option value="الوالد" selected>الوالد</option>
										<option value="الوالدة">الوالدة</option>
										<option value="أخ">أخ			</option>
										<option value="أخت">أخت			</option>
										<option value="عمـ/ـة" >عمـ/ـة	</option>
										<option value="خالـ/ـة" >خالـ/ـة</option>
										<option value="جد/ة"> جد/ة		</option>
										<option value="أخرى"> أخرى		</option>
									</select>
								</div>

								<div class="input-group mb-3 gap-1">
									<label class=" bg-label" for="">الجوال</label>
									<input name="reserve_relation_phone_2" data-class="reserve2-phone"  data-notes="small_reserve_relation_phone_2" type="number" placeholder="********05"  class="form-control inputs_js"    >
									<small id="emailHelp" class="form-text text-muted d-none small_reserve_relation_phone_2">يجب ان يكون الحقل 10 أرقام فقط</small>


								</div>
								</div> 

								</div>
							</div>
						</div>
					</div>

					<!-- End seondary name reserv  -->	








						</div>
					</div>
					</div>
					<!-- End Section Four  -->



				</div>
				<!-- End Accourion  -->



				<div class="contianer">

						<div class="input-group mb-3 gap-1">
							<label class=" bg-label" for="img_4">صورة الهويه</label>
							<input require name="img_1" type="file" class="form-control " id="img_1" >
						</div>

						<div class="form-check input-group  align-items-center">
							<input  class="form-check-input inputs_js checkbox-read" type="checkbox" value="" >
							<div class="form-check-label me-3 " > 
								<!-- Button trigger modal -->
								<button type="button" class="btn text-primary ms-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> أوافق على الشروط و الاحكام </button>
							</div>
							<small id="echeckboxHelp" class="form-text text-muted echeckboxHelp">
								يرجى الأطلاع و الموافقة على الشروط والاحكام
							</small>
						</div>				
							


						</div> <!-- container imgs -->

						<div class="tow-col submit-btns-container mt-5">
							<input class="btn btn-primary submit-btn" type="submit" value="تسجيل ">
						</div>
				</div>

				</form>
			</div>
		</main>

		<!-- ================================================================================= -->


		<!-- Start Modal Police -->
		<div class="modal fade " 
			 id="staticBackdrop" 
			 data-bs-backdrop="static" 
			 data-bs-keyboard="false" 
			 tabindex="-1" 
			 aria-labelledby="staticBackdropLabel" 
			 aria-hidden="true">

			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">الشروط و الأحكام</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body"> <?php include('./layout/pilice.php')?> </div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">قرأت الشروط و الأحكام كاملة </button>
					</div>

				</div>
			</div>
		</div>
		<!-- End Modal Police -->







		<!-- Start Calender  -->
		<link rel="stylesheet" type="text/css" href="./LIB/calender/ummalqura.calendars.picker.css" />
		<script type="text/javascript" src="./LIB/calender/jquery-3.6.1.min.js"></script>
		<script type="text/javascript" src="./LIB/calender/jquery.calendars.js"></script>
		<script type="text/javascript" src="./LIB/calender/jquery.plugin.js"></script>
		<script type="text/javascript" src="./LIB/calender/jquery.calendars.plus.js"></script>
		<script type="text/javascript" src="./LIB/calender/jquery.calendars.picker.js"></script>
		<script type="text/javascript" src="./LIB/calender/jquery.calendars.picker-ar.js"></script>
		<script type="text/javascript" src="./LIB/calender/jquery.calendars.ummalqura.js"></script>
		<script type="text/javascript" src="./LIB/calender/jquery.calendars.ummalqura-ar.js"></script>
		<script type="text/javascript" src="./LIB/calender/calendar-convert.js"></script>
		<script type="text/javascript" src="./LIB/calender/sss.js"></script>
		<!-- End Calender  -->
		<script src="./assets/js/bootstrap.min.js"></script>
		<script src="./assets/js/main.js"></script>
		<script id="growth_tool" src="https://cdn.chatapi.net/widget/widget.js?wId=243aa2af-9af3-4eac-97ed-5e90f2ea05c1"></script>
	</body>
</html>
<?php
	ob_end_flush();
?>