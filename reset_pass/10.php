<?php require '../vendor/autoload.php'; ?>

<?php 



class easysecure {
   
    var $curr_user;
    var $curr_permission;
    var $curr_task;
    var $validpermission;
    var $error;
   
   
    function &setVar( $name, $value=null ) {
        if (!is_null( $value )) {
            $this->$name = $value;
        }
        return $this->$name;
    }

    function maketoken($formname, $id){
       
        $token = md5(uniqid(rand(), true));
       
        $_SESSION[$formname.$id] = $token;
       
        return $token;
    }
   
    function checktoken($token, $formname, $id){
        //print_r($_SESSION);
        //echo ($token);
        //if we dont have a valid token, return invalid;
        if(!$token){
            $this->setVar('validpermission', 0);
            $this->setVar('error', 'no token found, security bridgedetected');
            return false;
        }
       
        //if we have a valid token check that is is valid
        $key = $_SESSION[$formname.$id];
        if($key !== $token ){
            $this->setVar('validpermission', 0);
            $this->setVar('error', 'invalid token');
            return false;
        }
       
        if($this->validpermission !==1){
              echo 'invalid Permissions to run this script';
              return false;   
        }else{
            return true;
        }
    }
   
}

$easysecure  = new easysecure();




   $token = $easysecure->maketoken("Heyder",1);

  $check = $easysecure->checktoken($token,"Heyder",1);

FB::log($token);

FB::log($check);
    ?>