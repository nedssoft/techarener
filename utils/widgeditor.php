
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="widgEditor/css/widgEditor.css">
 	<link rel="stylesheet" type="text/css" href="widgEditor/css/widgContent.css">
 	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 	 <script type="text/javascript" src="widgEditor/scripts/widgEditor.js"></script>
</head>
<body>
   
 
<div class="row">
 	<div class="col-md-4 col-lg-3"></div>
 	<div class="col-md-4 col-lg-6">
           <div style="border: 2px solid gray; height: 100%; box-shadow: 0px 0px 4px; margin: 20px; background: #fff;">
 	<form action="submit.php" onsubmit="alert('Your submitted HTML was:\n\n' + document.getElementById('text-edit-area').value); return false;">

 	       <fieldset>
 	       	<input type="text" name="text-title" placeholder="Enter title" style="width: 100%;padding: 10px; font-size: 18px;">
 	       </fieldset>
 			<fieldset>
				<label for="text-edit-area">
					Type Your lesson To Upload:
				</label>
				<textarea id="text-edit-area" name="text-edit-area" class="widgEditor nothing">&lt;p&gt;widgEditor &lt;strong&gt;automatically&lt;/strong&gt; integrates the content that was in the textarea!&lt;/p&gt;</textarea>
			</fieldset>
			<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-2">
			<fieldset class="submit">
				<button name="submit-lesson" class="btn btn-secondary btn-lg" type="submit" style="margin: 10px;margin-left: 0px;">Submit Lesson</button>
			</fieldset>
			</div>
			<div class="col-md-5"></div>
			</div>
		</form>
		</div>
		</div>
		<div class="col-md-4 col-lg-3"></div>
		</div>
</body>
</html>



		