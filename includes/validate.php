<?php
    class validate{
        public function checkEmpty($data, $fields)
        {
            $msg = null; //message is intially null until problems are identified
            foreach ($fields as $value)
            {
                if(empty($data[$value]))
                {
                    $msg .= "<p>$value field cannot be empty</p>"; //any blank field will get added to the message
                }
            }
            return $msg;
        }

        //potentially check for email already being used here???
        public function validEmail($email, $conn) 
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) //checks if the email follows proper formatting
            {
                $sql = "SELECT email FROM useraccounts WHERE email = '$email'";
                $result = $conn->prepare($sql);
                $result->execute();
                $count = $result -> rowCount();
                if ($count == 0){
                    return true;
                }
                return false;
            }
            return false;
        }

        public function validName($data, $fields) //checks that the name entries only have letters and hyphens since it seems unrealistic for a henry the 5th(if there is, they can enter roman numerals)
        {
            $check = true; //set to true originally as it is easier to assume a valid name by default
            foreach($fields as $value)
            {
                if(preg_match("/^[a-zA-Z-]+$/", $data[$value]))
                {
                    continue; //both values need to be checked so loop just moves onto next value
                }
                else
                {
                    $check = false; //if the first or last name is invalid, the name should be invalid
                    break;
                }
            }
            return $check;
        }

        public function validPassword($password, $confirm = null) //1 uppercase, 1 lowercase, 1 number, and 7 length required
        {   
            if($confirm != null){
                if (empty($password) || $password != $confirm){
                    return false;
                }
            }
            if (strlen($password) < 7 || strlen($password) > 40)
            {
                return false;
            }
            if (!preg_match('/[A-Z]/', $password)) {
                return false;
            }
            if (!preg_match('/[a-z]/', $password)) {
                return false;
            }
            if (!preg_match('/[0-9]/', $password)) {
                return false;
            }
            if(!preg_match("/^[a-zA-Z0-9]+$/", $password))
            {
                return false;
            }
            return true;
        }


        public function validateLogin($email, $password, $conn)
        {   
            if ($this->validPassword($password) != false && filter_var($email, FILTER_VALIDATE_EMAIL) != false)
            {
                $sql = "SELECT accountid FROM useraccounts WHERE email = '$email' AND userpassword = '$password'";
                $result = $conn->prepare($sql);
                $result->execute();
                $count = $result -> rowCount();

                if ($count == 1)
                {
                    foreach($result as $row)
                    {
                        session_start();

                        $_SESSION['accountid'] = $row['accountid'];

                        Header('Location: index.php');
                    }
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
    }
?>