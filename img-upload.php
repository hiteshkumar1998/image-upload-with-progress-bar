<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Image Upload With Progress Bar</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script src="jquery-form.js"></script>
   </head>
   <body align="center">
   	<h1 align="center">Image Upload With Progress Bar</h1>
      <div class="form-container">
         <form action="uploadFile.php" id="uploadForm" name="frmupload"
            method="post" enctype="multipart/form-data">
            <input type="file" id="uploadImage" name="uploadImage" /> <input
               id="submitButton" type="submit" name='btnSubmit'
               value="Submit Image" />
         </form>
         <div class='progress' id="progressDivId">
            <div class='progress-bar' id='progressBar'></div>
            <div class='percent' id='percent'>0%</div>
         </div>
         <div style="height: 10px;"></div>
         <div id='outputImage'></div>
      </div>
      <script type="text/javascript">
         $(document).ready(function () {
             $('#submitButton').click(function () {
             	    $('#uploadForm').ajaxForm({
             	        target: '#outputImage',
             	        url: 'uploadFile.php',
             	        beforeSubmit: function () {
             	        	  $("#outputImage").hide();
             	        	   if($("#uploadImage").val() == "") {
             	        		   $("#outputImage").show();
             	        		   $("#outputImage").html("<div class='error'>Choose a file to upload.</div>");
                             return false; 
                         }
             	            $("#progressDivId").css("display", "block");
             	            var percentValue = '0%';
         
             	            $('#progressBar').width(percentValue);
             	            $('#percent').html(percentValue);
             	        },
             	        uploadProgress: function (event, position, total, percentComplete) {
             	            var percentValue = percentComplete + '%';
             	            $("#progressBar").animate({
             	                width: '' + percentValue + ''
             	            }, {
             	                duration: 5000,
             	                easing: "linear",
             	                step: function (x) {
                                 percentText = Math.round(x * 100 / percentComplete);
         						
             	                    $("#percent").text(percentText + "%");
                                 if(percentText == "100") {
                                 	   $("#outputImage").show();
                                 }
             	                }
             	            });
             	        },
             	        error: function (response, status, e) {
             	            alert('Oops something went.');
             	        },
             	        
             	        complete: function (xhr) {
         					
             	            if (xhr.responseText && xhr.responseText != "error")
             	            {
             	            	  $("#outputImage").html(xhr.responseText);
             	            }
             	            else{  
             	               	$("#outputImage").show();
                 	            	$("#outputImage").html("<div class='error'>Problem in uploading file.</div>");
                 	            	$("#progressBar").stop();
             	            }
             	        }
             	    });
             });
         });
      </script>
   </body>
</html>