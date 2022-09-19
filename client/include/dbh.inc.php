<?php
session_start();
class dbHandler
{

    public $conn;

    function __construct()
    {

        $dbservername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "aevgbuildersdb";
        $this->conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function checkIfEmailExist($email)
    {
        $sql = "SELECT id FROM client WHERE email='$email'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    function checkIfUsernameExist($username)
    {
        $sql = "SELECT id FROM client WHERE username='$username'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    function checkIfAccountExist($key)
    {
        if ($this->checkIfEmailExist($key) || $this->checkIfUsernameExist($key)) {
            return true;
        } else {
            return false;
        }
    }

    function getAttempt($key)
    {
        $query = "SELECT login_attempt FROM client WHERE email = '$key' OR username = '$key'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            return $row['login_attempt'];
        } else {
            return 0;
        }
    }

    function updatePassword($email, $newPass)
    {
        $query = "UPDATE `userdata` SET `password`='$newPass' WHERE `email`='$email'";
        return mysqli_query($this->conn, $query);
    }

    function updateStatusToBlock($key)
    {
        $query = "UPDATE client SET status='block' WHERE email='$key' OR username='$key'";
        return mysqli_query($this->conn, $query);
    }

    function updateAttempt($key, $attempt)
    {
        $query = "UPDATE client SET login_attempt=$attempt WHERE email='$key' OR username='$key'";
        return mysqli_query($this->conn, $query);
    }

    function profileUpdate($value, $id)
    {
        $sql = "UPDATE `client` SET firstName='$value->firstName', middleName='$value->middleName', lastName='$value->lastName', username='$value->username', email='$value->email',
         contact_no='$value->contact_no', house_no='$value->house_no', street='$value->street', barangay='$value->barangay', municipality='$value->municipality', 
         province='$value->province', image='$value->image' WHERE id=$id";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function checkAccount($key, $password)
    {
        $query = "SELECT * FROM client WHERE (email = '$key' OR username = '$key')  AND  password ='$password'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result)) {
            if ($row = mysqli_fetch_assoc($result)) {
                if ($row["status"] == "active") {
                    if ($this->updateAttempt($key, 3)) {
                        $_SESSION['id'] = $row["id"];
                        $_SESSION['email'] = $row["email"];
                        return true;
                    }
                }
            }
        } else {
            $total_count = $this->getAttempt($key) - 1;
            $this->updateAttempt($key, $total_count);
            // echo "Email and Password not match. Remaining attempts: " . $total_count;
            return false;
        }
    }

    function registerAccount($info)
    {
        $query = "INSERT INTO client(firstName, middleName, lastName, username, password, email, contact_no, house_no, street, barangay, municipality, province) 
        VALUES ('$info->firstName' ,'$info->middleName', '$info->lastName', '$info->username',
        '$info->password', '$info->email', '$info->contact', '$info->houseNo', '$info->street', '$info->barangay', '$info->municipality', '$info->province')";
        //$this->addActivities($info->firstName + ' ' + $info->lastName, "Account", "Creat an account with student number $info->username");
        return mysqli_query($this->conn, $query);
    }

    function getFullname($id)
    {
        $sql = "SELECT CONCAT(firstName, ' ', lastName) AS fullName FROM client WHERE id='$id'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            return $row['fullName'];
        } else {
            return '';
        }
    }

    function getValueByID($value, $id, $table = "client")
    {
        $sql = "SELECT `$value` FROM $table WHERE id=$id";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            if ($row = mysqli_fetch_assoc($result)) {
                return $row[$value];
                // return $sql;
            }
        }
    }

    function getSpecificInfo($id, $col)
    {
        $sql = "SELECT $col FROM client WHERE id='$id'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            return $row[$col];
        } else {
            return 0;
        }
    }
    
    function updateSpecificInfo($id, $col, $value)
    {
        $sql = "UPDATE `client` SET $col='$value' WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }

    function __destroy()
    {
        $this->conn->close();
    }
}
