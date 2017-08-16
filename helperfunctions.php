<?php

require_once("formvalidator.php");

function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        //if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        //{
        //    //The proper error is not given intentionally
        //   $this->HandleError("Automated submission prevention: case 2 failed");
        //    return false;
        //}
        
        $validator = new FormValidator();
        //$validator->addValidation("name","req","Please fill in Name");
        //$validator->addValidation("email","email","The input for Email should be a valid email value");
        //$validator->addValidation("email","req","Please fill in Email");
        $validator->addValidation("username","req","Please fill in UserName");
        $validator->addValidation("password","req","Please fill in Password");
		//$validator->addValidation("address","req","Please fill in Address");
		//$validator->addValidation("dob","req","Please fill in Date of Birth");
		//$validator->addValidation("phone","req","Please fill in Phone");
		//$validator->addValidation("dlnumber","req","Please fill in Driver License Number");
		//$validator->addValidation("confelon","req","Please fill in Convicted Felon");
		//$validator->addValidation("econtact","req","Please fill in Emergency Contact");
		//$validator->addValidation("econtactphone","req","Please fill in Emergency Contact Phone Number");
		//$validator->addValidation("agency","req","Please fill in Agency");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
	
function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
	
	
	?>