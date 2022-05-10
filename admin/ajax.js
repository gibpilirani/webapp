'use strict'

// $(window).on('load', function() {
$(document).ready(function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut();
	$("#preloder").delay(400).fadeOut("slow");
    
    	$('.ddx > a').hover( function(e) {
		$(this).addClass('active');
		e.preventDefault();
	});
	$('.ddx > a').mouseleave( function(e) {
		$('.ddx a').removeClass('active');
		e.preventDefault();
	});

});

var allowed_file_size 	= "1048576"; //1 MB allowed file size

var allowed_file_types 	= [ 'image/png', 'image/jpeg', 'image/jpg']; //Allowed file types
var allowed_file_attachment_types = [
                                    'application/pdf'                                    
                                    ]; //Allowed file types
var border_color 		= "#C2C2C2"; //initial input border color
var maximum_files 		= 1; //Maximum number of files allowed
var proceed 		= true; //Maximum number of files allowed


function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }




//OPEN ICT PAGE
function loadICT(){  
    $("#load").html('<div id="preloder"><div class="loader"></div></div>');
        $("#responseDiv").load( "pages/ict.php " );
}

//OPEN NURSE PAGE
function loadNurse(){  
    $("#load").html('<div id="preloder"><div class="loader"></div></div>');
        $("#responseDiv").load( "pages/nurse.php " );
}

//OPEN MBBS PAGE
function loadMed(){  
    $("#load").html('<div id="preloder"><div class="loader"></div></div>');
        $("#responseDiv").load( "pages/mbbs.php " );
}


//REGISTER APPLICANT ACCOUNT
function registerAccount(){
     $('#user_form').one('submit', function(event){  
        event.preventDefault();  

        proceed = true;
	
	//simple input validation
	$($(this).find("input[data-required=true], textarea[data-required=true]")).each(function(){
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
       
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag              
            } 
           
	}).on("input", function(){ //change border color to original
		 $(this).css('border-color', border_color);
	});
	
	//check file size and type before upload, works in all modern browsers
	if(window.File && window.FileReader && window.FileList && window.Blob){
		var total_files_size = 0;
		if(this.elements['file_attach'].files.length > maximum_files){
            $('#respond').html( "<small style='color:red;'>Can not select more than "+maximum_files+" file(s)</small>");
            $('#respond2').html( "<small style='color:red;'>Can not select more than "+maximum_files+" file(s)</small>");
            proceed = false;			
		}
		$(this.elements['file_attach'].files).each(function(i, ifile){
			if(ifile.value !== ""){ //continue only if file(s) are selected
                if(allowed_file_types.indexOf(ifile.type) === -1){ //check unsupported file
                    $('#respond').html(ifile.name + " is not allowed!");
                    $('#respond2').html(ifile.name + " is not allowed!");
                    proceed = false;
                }
             total_files_size = total_files_size + ifile.size; //add file size to total size
			}
		}); 
       if(total_files_size > allowed_file_size){ 
            $('#respond').html("<small style='color:red;'>Make sure total file size is less than 1 MB!</small>");
            $('#respond2').html("<small style='color:red;'>Make sure total file size is less than 1 MB!</small>");
            proceed = false;
        }
	}
	
	var post_url = "operations/handler.php"; //get form action url
	var request_method = "POST"; //get form GET/POST method
	var form_data = new FormData(this); //Creates new FormData object
	
	//if everything's ok, continue with Ajax form submit
	if(proceed){ 
		$.ajax({ //ajax form submit
			url : post_url,
			type: request_method,
			data : form_data,
			
			contentType: false,
			cache: false,
			processData:false
		}).done(function(data){ //fetch server "json" messages when done
           
            var dataResult = JSON.parse(data);

             $('#respond').show(500);
             $('#respond2').show(500);
            
            if(dataResult.code == 1){
                    
                $('#respond').html('<p class="alert alert-success text-center">'+dataResult.msg+'</p>');
                $('#respond2').html('<p class="alert alert-success text-center">'+dataResult.msg+'</p>');
                
                setTimeout(function(){
                    $('#respond').hide(1500);
                    $('#respond2').hide(1500);
                    window.location = "home.php";
                },2000);
            }else if(dataResult.code == 2){
                 $('#respond').html('<p class="alert alert-danger text-center">'+dataResult.msg+'</p>');
                $('#respond2').html('<p class="alert alert-danger text-center">'+dataResult.msg+'</p>');
                           
                setTimeout(function(){
                    $('#respond').hide(1000);
                    $('#respond2').hide(1000);
                },2000);
            }else{
                 $('#respond').html('<p class="alert alert-danger text-center">'+dataResult.msg+'</p>');
                $('#respond2').html('<p class="alert alert-danger text-center">'+dataResult.msg+'</p>');
                
               setTimeout(function(){
                    $('#respond').hide(1000);
                    $('#respond2').hide(1000);
                },2000);
            }
		
		});
	}

        
  });
}

//LOGIN CREDENTIALS SEND AND FEEDBACK
function logApplicant(){
    $('#applicant_login').submit(function(e){
        e.preventDefault();
//        var email = $('#logEmail').val();
//        var password = $('#logPassword').val();
        var proceed= true;

            //simple input validation
            $($(this).find("input[data-required=true]")).each(function(){
                    if(!$.trim($(this).val())){ //if this field is empty 
                        $(this).css('border-color','red'); //change border color to red   
                        proceed = false; //set do not proceed flag
                    }
                    //check invalid email
                    var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
                    if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                        $(this).css('border-color','red'); //change border color to red   
                        proceed = false; //set do not proceed flag              
                    } 

            }).on("input", function(){ //change border color to original
                 $(this).css('border-color', border_color);
            });
            
        	var post_url = "operations/handler.php"; //get form action url
            var request_method = "POST"; //get form GET/POST method
            var form_data = new FormData(this); //Creates new FormData object

            //if everything's ok, continue with Ajax form submit
            if(proceed){ 
              $("#btn_check").val('Checking...');
             
                $.ajax({ //ajax form submit
                    url : post_url,
                    type: request_method,
                    data : form_data,

                    contentType: false,
                    cache: false,
                    processData:false
                }).done(function(data){ //fetch server messages when done
                     $('#loginResponse').html('');
                     $('#loginResponse').fadeIn();
                    $("#btn_check").val('Login');
                    if(data == 1){
                       $('#loginResponse').html("<span class='alert alert-success text-center'>Success!</span>");
                       setTimeout(function(){
                          window.location = "home.php";
                       },1000);
                        
                    }else if(data == 2){
                        $('#loginResponse').html("<span style='color:red; width:100%;' class='alert alert-danger text-center'>Login failed, passwords do not match</span>");
                        setTimeout(function(){
                            $('#loginResponse').fadeOut(1000);
                        },1500);
                        
                        
                         setTimeout(function(){
                           
                            $('#loginResponse').html(' ');
                        },2500);
                    }else{
                        $('#loginResponse').html("<span class='alert alert-danger text-center' style='color:red; width:100%;'>Login failed</span>");
                        setTimeout(function(){
                            $('#loginResponse').fadeOut(1000);
                            
                        },1500);
                        
                         setTimeout(function(){
                           
                            $('#loginResponse').html(' ');
                        },2500);
                    }
                    
                    
                });
            }

       
    });
}




//ADD APPLICANT OTHER QUALIFICATIONS (UPGRADING PERSON)
function submitOtherQuali(){
    
    $('#other_qualifications').one('submit', function(event){  
        event.preventDefault();  

        proceed = true;
	
	//simple input validation
	$($(this).find("input[data-required=true]")).each(function(){
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
           
           
	}).on("input", function(){ //change border color to original
		 $(this).css('border-color', border_color);
	});
	
	var post_url = "operations/handler.php"; //get form action url
	var request_method = "POST"; //get form GET/POST method
	var form_data = new FormData(this); //Creates new FormData object
	
	//if everything's ok, continue with Ajax form submit
	if(proceed){ 
		$.ajax({ //ajax form submit
			url : post_url,
			type: request_method,
			data : form_data,
			
			contentType: false,
			cache: false,
			processData:false
		}).done(function(data){ //fetch server "json" messages when done

            var dataResult = JSON.parse(data);
                if(dataResult.success==1){
                    $('#other_response').html('<small style=color:green;>Academic details added successfully</small>');
                    loadAcademic();
                    
                }else if(dataResult.success==2){
                    $('#other_response').html('<small style=color:red;>An error occurred, Academic details not added</small>');
                }else if(dataResult.success==3){
                    $('#other_response').html('<small style=color:red;>You already added Academic details earlier...</small>');
                }else if(dataResult.success==4){
                    $('#other_response').html('<small style=color:red;>Add Academic details obtained earlier before other qualifications...</small>'); 
                }
            
            
		});
	}

        
  });
}

//PROGRAMME OF STUDY
function addSelection(){
        $('#course_choices').one('submit', function(event){  
        event.preventDefault();  

        proceed = true;
	
        //simple input validation
        $($(this).find("select[data-required=true]")).each(function(){
                if(!$.trim($(this).val())){ //if this field is empty 
                    $(this).css('border-color','red'); //change border color to red   
                    proceed = false; //set do not proceed flag
                }


        }).on("input", function(){ //change border color to original
             $(this).css('border-color', border_color);
        });

        var post_url = "operations/handler.php"; //get form action url
        var request_method = "POST"; //get form GET/POST method
        var form_data = new FormData(this); //Creates new FormData object

        //if everything's ok, continue with Ajax form submit
        if(proceed){ 
            $.ajax({ //ajax form submit
                url : post_url,
                type: request_method,
                data : form_data,

                contentType: false,
                cache: false,
                processData:false
            }).done(function(data){ //fetch server "json" messages when done

                
                var dataResult = JSON.parse(data);
                if(dataResult.success==1){
                    $('#choice_response').html('<small style=color:green;>Course selection added successfully</small>');
                    drawszlider(100, dataResult.value); 
                    loadProgramme();
                }else if(dataResult.success==2){
                    $('#choice_response').html('<small style=color:red;>An error occurred</small>');     
                }else if(dataResult.success==3){
                    $('#choice_response').html('<small style=color:red;>Course selection details already added</small>');    
                }else if(dataResult.success==10){
                    $('#choice_response').html('<small style="color:red;">Fill </small> <a href="#" onclick="loadAcademic()" ><span aria-hidden="true" ></span> Academic Details <span class="badge"></span></a> <small style="color:red;">before this step</small>');
                }

            });
        }


      });
}

//add financial details
function addFinancialDetails(){
        $('#financial_details').one('submit', function(event){  
        event.preventDefault();  

        proceed = true;
	
        //simple input validation
        $($(this).find("input[data-required=true], textarea[data-required=true]")).each(function(){
                if(!$.trim($(this).val())){ //if this field is empty 
                    $(this).css('border-color','red'); //change border color to red   
                    proceed = false; //set do not proceed flag
                }


        }).on("input", function(){ //change border color to original
             $(this).css('border-color', border_color);
        });

        var post_url = "operations/handler.php"; //get form action url
        var request_method = "POST"; //get form GET/POST method
        var form_data = new FormData(this); //Creates new FormData object

        if(proceed){ 
            $.ajax({ //ajax form submit
                url : post_url,
                type: request_method,
                data : form_data,

                contentType: false,
                cache: false,
                processData:false
            }).done(function(data){ //fetch server "json" messages when done
                
                
                var dataResult = JSON.parse(data);
                if(dataResult.success==1){
                    $('#financial_response').html('<small style=color:green;>Person responsible for fees added  </small>');
                    drawszlider(100, dataResult.value); 
                    loadFinancial();
                }else if(dataResult.success==2){
                    $('#financial_response').html('<small style=color:red;>Person responsible for fees already exists</small>');
                }else if(dataResult.success==3){
                     $('#financial_response').html('<small style=color:red;>An error occurred</small>');
                }else if(dataResult.success==10){
                     $('#financial_response').html('<small style=color:red;>Fill </small><a href="#" onclick="loadProgramme()"><span aria-hidden="true"></span> Programme of Study <span class="badge"></span></a> <small style=color:red;>before this step</small>');             
                }
                

            });
        }


      });
}

//file attachments
function addAttachment(){
    $('#attachments_form').one('submit', function(event){  
        event.preventDefault();  

        proceed = true;
	
	//simple input validation
	$($(this).find("input[data-required=true]")).each(function(){
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
            
	}).on("input", function(){ //change border color to original
		 $(this).css('border-color', border_color);
	});
	
	//check file size and type before upload, works in all modern browsers
	if(window.File && window.FileReader && window.FileList && window.Blob){
		var total_files_size = 0;
		if(this.elements['results'].files.length > maximum_files){
            $('#attachment_result').html( "<small style='color:red;'>Can not select more than "+maximum_files+" file(s)</small>");
            proceed = false;			
		}
		$(this.elements['results'].files).each(function(i, ifile){
			if(ifile.value !== ""){ //continue only if file(s) are selected
                if(allowed_file_attachment_types.indexOf(ifile.type) === -1){ //check unsupported file
                    $('#attachment_result').html("<small style='color:red;'>" + ifile.name + " is not allowed!</small>");
                    proceed = false;
                }
             total_files_size = total_files_size + ifile.size; //add file size to total size
			}
		}); 
       if(total_files_size > allowed_file_size){ 
            $('#attachment_result').html("<small style='color:red;'>Make sure total file size is less than 1 MB!</small>");
            proceed = false;
        }
        
        
        
        	//check file size and type before upload, works in all modern browsers
	if(window.File && window.FileReader && window.FileList && window.Blob){
		var total_files_size = 0;
		if(this.elements['deposit'].files.length > maximum_files){
            $('#attachment_deposit').html( "<small style='color:red;'>Can not select more than "+maximum_files+" file(s)</small>");
            proceed = false;			
		}
		$(this.elements['deposit'].files).each(function(i, ifile){
			if(ifile.value !== ""){ //continue only if file(s) are selected
                if(allowed_file_attachment_types.indexOf(ifile.type) === -1){ //check unsupported file
                    $('#attachment_deposit').html("<small style='color:red;'>" + ifile.name + " is not allowed!</small>");
                    proceed = false;
                }
             total_files_size = total_files_size + ifile.size; //add file size to total size
			}
		}); 
       if(total_files_size > allowed_file_size){ 
            $('#attachment_deposit').html("<small style='color:red;'>Make sure total file size is less than 1 MB!</small>");
            proceed = false;
        }
	}
        
            	//check file size and type before upload, works in all modern browsers
	if(window.File && window.FileReader && window.FileList && window.Blob){
		var total_files_size = 0;
		if(this.elements['letter'].files.length > maximum_files){
            $('#attachment_letter').html( "<small style='color:red;'>Can not select more than "+maximum_files+" file(s)</small>");
            proceed = false;			
		}
		$(this.elements['letter'].files).each(function(i, ifile){
			if(ifile.value !== ""){ //continue only if file(s) are selected
                if(allowed_file_attachment_types.indexOf(ifile.type) === -1){ //check unsupported file
                    $('#attachment_letter').html("<small style='color:red;'>" + ifile.name + " is not allowed!</small>");
                    proceed = false;
                }
             total_files_size = total_files_size + ifile.size; //add file size to total size
			}
		}); 
       if(total_files_size > allowed_file_size){ 
            $('#attachment_letter').html("<small style='color:red;'>Make sure total file size is less than 1 MB!</small>");
            proceed = false;
        }
	}
        
        
	}
	
	var post_url = "operations/handler.php"; //get form action url
	var request_method = "POST"; //get form GET/POST method
	var form_data = new FormData(this); //Creates new FormData object
	
	//if everything's ok, continue with Ajax form submit
	if(proceed){ 
        $.ajax({
          url: post_url,
          type: request_method,
         
          data: form_data,
           contentType: false,
            cache: false,
			processData:false,
          success: function(dataResponse){
              
//              alert(dataResponse + " ha");
            var dataResult = JSON.parse(dataResponse);
            if((dataResult.success)==1){
                $('#attachment_response').html('<small style="color:green;">files added successfully</small>');
                drawszlider(100, dataResult.value);
                loadAttachments();
//                $("#mm").load( "user-side-menu.php #mm" );
                location.reload();
            }else if((dataResult.success)==2){
                $('#attachment_response').html('<small style="color:red;">Database error occured</small>');
            }else if((dataResult.success)==3){
                $('#attachment_response').html('<small style="color:red;">Error occured while uploading files</small>');
            }else if((dataResult.success)==4){
                $('#attachment_response').html('<small style="color:red;">Files exists in database, update the existing one</small>');
            }else if((dataResult.success)==5){
                $('#attachment_response').html('<small style=color:red;>Fill </small><a href="#" onclick="loadFinancial()"><span aria-hidden="true"></span> Person Responsible for Fees <span class="badge"></span></a> <small style=color:red;>before this step</small>');
            }else if((dataResult.success)==6 || (dataResult.success)==7){
                $('#attachment_response').html('<small style="color:red;">Unknown Request!!</small>');
            }else{
                $('#attachment_response').html('<small style="color:red;">Unknown error occurred</small>');
            }
            
          }
        });
        
 
	}

        
  });
}

//apply confirm button

$(document).on("click", "#applyBtn", function(e) {
           bootbox.confirm({
            title: "<p style='color:red;'>DECLARATION</p>",
            message: "I declare that all the information is true and correct to the best of my knowledge and belief. I have checked and provided all the information and documents required to process my application.  I am aware that the University reserves the right to reject any application and or withdraw and cancel any offer of admission should all or part of the above information be found to be untrue and or incorrect, or if an offer was erroneously made. I agree that if I am accepted at the University, I shall be under the disciplinary control of the authorities and I undertake to acquaint myself with, and to conform to the rules and regulations of the University. I declare that I will be able to pay the fees provided, and as they may be revised from time to time. ",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Agree & Apply'
                }
            },
            callback: function (result) {
                //console.log('This was logged in the callback: ' + result);

                if(result == true){
                    //alert("confirm button");
                    var dialog = bootbox.dialog({
                        title: '',
                        message: '<p><i class="fa fa-spin fa-spinner"></i> Processing...</p>'
                    });
                    
                    
                    var completeID = $("#completeID").val();
//                    alert(app);
                    
                    
                     $.ajax({
                        url: "operations/handler.php",
                        method: "POST",
                        data: {
                            completeID: completeID

                        },
                        cache: false,
                        success: function(data) {
                            var responseData = JSON.parse(data);
                            if(responseData.value == 100){
                                  dialog.init(function(){
                                    setTimeout(function(){
                                        
                                        dialog.find('.bootbox-body').html(responseData.message+" refreshing, please wait...");
                                    }, 3000);
                                     
                                     drawszlider(100, 100);
                                     setTimeout(function(){
                                         window.location="home.php";
                                     },5000);
                                }); 
//                                location.reload();
                            }else{
                                   dialog.init(function(){
                                    setTimeout(function(){
                                        
                                        dialog.find('.bootbox-body').html(responseData.message);
                                    }, 3000);
                                     
//                                     drawszlider(100, 100);
                                     
                                });
                            }
                            
                              
                            
                        }
                    });
                    
                    
                    
                    
                   
                    
                    
                }else{
                    //alert("cancel button");
                }
            }
        });
    });


/*==============================================
ADD DYNAMIC ROWS 
*/
function submitDynamic(){
    $('#form_dynamic').one('submit', function(event){  
        event.preventDefault();  
        proceed =true;
	   
        //simple input validation
        $($(this).find("input[data-required=true], textarea[data-required=true]")).each(function(){
                if(!$.trim($(this).val())){ //if this field is empty 
                    $(this).css('border-color','red'); //change border color to red   
                    proceed = false; //set do not proceed flag
                }
            

        }).on("input", function(){ //change border color to original
             $(this).css('border-color', border_color);
        });

        var post_url = "operations/handler.php"; //get form action url
        var request_method = "POST"; //get form GET/POST method
        var form_data = new FormData(this); //Creates new FormData object
        if(proceed){
        //if everything's ok, continue with Ajax form submit
            $.ajax({ //ajax form submit
                url : post_url,
                type: request_method,
                data : form_data,

                contentType: false,
                cache: false,
                processData:false
            }).done(function(data){ //fetch server "json" messages when done
//                alert(data);
                var dataResult = JSON.parse(data);
                        if(dataResult.success==1){
                            $('#academic_response').html('<p class="text-center alert alert-success">Academic details added successfully, please wait...</p>');
                            drawszlider(100, dataResult.value);
                            setTimeout(function(){
                                loadAcademic();
                            },2000)
                            
                        }else if(dataResult.success==2){
                            $('#academic_response').html('<p class="text-center alert alert-danger">'+dataResult.msg+'</p>');
                        }else{
                            $('#academic_response').html("unkown response");
                        }

            });
    
        }

      });
    
}

function delete_row(rowno){
 $('#'+rowno).remove();
}



//progress
function drawszlider(ossz, meik){
	var szazalek=Math.round((meik*100)/ossz);
	document.getElementById("szliderbar").style.width=szazalek+'%';
	document.getElementById("szazalek").innerHTML=szazalek+'%';
	
}

//LOADING EFFECT
$(window).load(function() {
   $('.preloader').fadeOut("slow");
});


















