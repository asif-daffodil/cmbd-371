<?php  
    class user {
        public string $fName = "Asif";
        public string $lName = "Abir";
        const int myBirthYear = 1987;
        public static string $gender = "Male";

        public string $city = "Dhaka";

        public function fullName (): string {
            return "User's full name is ".$this->fName." ".$this->lName." and he lives in ".$this->city."\n";
        }

        public function __construct()
        {
            echo "This is a construnct function \n";
        }

        public function __destruct()
        {
            echo "This is a destructor function.\n";
        }
    }

    $obj1 = new user;
    echo $obj1->city."\n";
    $obj1->fName = "Mr. Asif";
    echo $obj1->fullName();
    echo $obj1::myBirthYear."\n";
    echo user::$gender."\n";

    class childUser extends user {
        public float $age = 2.5;
        public function fatherName (): string {
            return "The child's father name is ".$this->fName." and he lives in ".$this->city.".\n";
        } 
    }

    $childObj = new childUser;
    echo $childObj->fatherName();
?>