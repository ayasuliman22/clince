<?php


trait validation
{
    function validate_username($username): bool
    {
        $pattern = "/^[a-zA-Z ]{3,20}$/";
        $result = preg_match($pattern, trim($username));
        return  $result;
    }

    function validate_email($email): bool
    {
        $result = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        return $result;
    }

    function validate_password($password, $password_confirmation): int
    {

        /*
        This function return : 
        ->      0 if syntax of password is incorrect                        
        ->      1 if syntax is correct and password = password_confirmation
        ->     -1 if syntax is correct and password != password_confirmation
                              

        (?=.*\d)             يتاكد من وجود رقم واحد على الأقل  
        (?=.*\[a-z])    يتاكد من وجود حرف صغير واحد على الأقل  
        (?=.*\[A-Z])    يتاكد من وجود حرف كبير واحد على الأقل  

        يجب ان تكون الكلمة مكونة من حروف كبيرة وصغيرة وأرقام 
        ويكون طول الكلمة من 6 الى 15 
        [a-z\dA-Z]{6,15} 

    */
        $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-z\dA-Z]{6,15}$/";

        $password = trim($password);
        $password_confirmation = trim($password_confirmation);

        $result = preg_match($pattern, $password);
        $identical = $password_confirmation === $password;

        if (!$result) : return 0;
        elseif ($result && $identical) : return 1;
        elseif ($result && !$identical) : return -1;
        endif;
    }

    function validate_date($date): bool
    {
        $pattern = "/^\d{4}-\d{2}-\d{2}$/";
        $result = preg_match($pattern, trim($date));
        return  $result;
    }

    function validate_time($time): bool
    {
        $pattern = "/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/";
        $result = preg_match($pattern, trim($time));
        return  $result;
    }


    function all_true($array): bool
    {

        foreach ($array as $k => $v)
            if (!$v) return false;
        return true;
    }

    function validate($data): bool
    {
        $username = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $password_configuration  = $data['password_configuration'];

        $_username = $this->validate_username($username);
        $_email = $this->validate_email($email);
        $_password = $this->validate_password($password, $password_configuration);
        $flag = $this->all_true([$_username, $_email, $_password == 1]);

        if ($flag) return true;
        else return false;
    }
    function validate_date_table($data): bool
    {
        $date = $data['date'];
        $time = $data['time'];
        $state = $data['state'];

        $_date = $this->validate_date($date);
        $_time = $this->validate_time($time);
        $flag = $this->all_true([$_date, $_time, in_array($state, ["0", "1"])]);

        if ($flag) return true;
        else return false;
    }


    function isDoctorHaveTime($time, $array)
    {
        // echo "<pre>" ;
        // print_r($array) ;
        $time = explode(":" , $time) ;
        foreach ($array as $k => $v) {
            $_time = explode(':', $v["time"]);
            // echo "dwdfsdfsdfd";
            if ($time[0] == $_time[0]) {
                if ($time[1] < $_time[1] + 30) {
                    return False ;
                }
            }

        }

        return true;
    }
}
