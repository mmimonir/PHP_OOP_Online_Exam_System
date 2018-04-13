<?php 
$filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/Session.php');
    // Session::init();
    include_once($filepath.'/../lib/Database.php');
    include_once($filepath.'/../helpers/Format.php');

class Process
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function processData($data)
    {
        $selectedans    = $this->fm->validation($data['ans']);
        $number    		= $this->fm->validation($data['number']);
        $selectedans    = mysqli_real_escape_string($this->db->link, $selectedans);
        $number    		= mysqli_real_escape_string($this->db->link, $number);
        $next 			= $number +1;
        
        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = '0';
        }

        $total = $this->getTotal();
        $right = $this->rightAns($number);
        if ($right == $selectedans) {
            $_SESSION['score']++;
        }
        if ($number == $total) {
            header("Location:final.php");
            exit();
        } else {
            header("Location:test.php?q=".$next);
        }
    }

    private function getTotal()
    {
        $query = "SELECT * FROM tbl_ques";
        $getResult = $this->db->select($query);
        $total = $getResult->num_rows;
        return $total;
    }

    private function rightAns($number)
    {
        $query = "SELECT * FROM tbl_ans WHERE quesNo = '$number' AND rightAns = '1'";
        $getData = $this->db->select($query)->fetch_assoc();
        $result = $getData['id'];
        return $result;
    }
}
