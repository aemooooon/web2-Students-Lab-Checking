<?php
  /*
   * Project name: In612 Web 2 assignment 2
   * Author: Hua WANG
   * Lectuer: Dale
   * CreatedAt: 2018-09-29
   * Description: All entities Operation
   */
class Model
{
    private $db;

    public function __construct()
    {
        $this->db=new Database;
    }

    // Create admin table
    public function createAdmin()
    {
        $this->db->query('
        DROP TABLE IF EXISTS `admin`;
        CREATE TABLE `admin`(
            adminID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            firstName VARCHAR(100) NULL,
            lastName VARCHAR(100) NULL,
            userName VARCHAR(100) NULL,
            password VARCHAR(128) NULL,
            adminPassword VARCHAR(128) NULL,
            courseSub VARCHAR(128) NULL,
            tab VARCHAR(128) NULL
        )');
        $this->db->execute();
    }

    // Initialize admin
    public function initializeAdmin($file)
    {
        $admins=$this->parse_csv($file);
        $cost=10;
        $salt=strtr(base64_encode(random_bytes(16)), '+', '.');
        $salt=sprintf("$2a$%02d$", $cost).$salt;
        for ($i=0; $i < count($admins); $i++) {
            $firstName=$admins[$i][1];
            $lastName=$admins[$i][2];
            $userName=$admins[$i][3];
            $password=crypt($admins[$i][4], $salt);
            $adminPassword=crypt($admins[$i][5], $salt);
            $courseSub=$admins[$i][6];
            $tab=$admins[$i][7];
        
            $query="INSERT INTO `admin` (`firstName`, `lastName`, `userName`, `password`, `adminPassword`, `courseSub`, `tab`) VALUES (:firstName,:lastName,:userName,:password,:adminPassword,:courseSub,:tab)";
            $this->db->query($query);

            $this->db->bind(':firstName', $firstName);
            $this->db->bind(':lastName', $lastName);
            $this->db->bind(':userName', $userName);
            $this->db->bind(':password', $password);
            $this->db->bind(':adminPassword', $adminPassword);
            $this->db->bind(':courseSub', $courseSub);
            $this->db->bind(':tab', $tab);

            $this->db->execute();
        }
    }

    // Create students table
    public function createStudents()
    {
        $this->db->query('
        DROP TABLE IF EXISTS students;
        CREATE TABLE students(
            studentID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            studentNumber INT(100) NULL,
            firstName VARCHAR(100) NULL,
            lastName VARCHAR(100) NULL,
            userName VARCHAR(100) NULL,
            password VARCHAR(255) NULL
        )');
        $this->db->execute();
    }

    // Initialize students
    public function initializeStudents($file)
    {
        $students=$this->parse_csv($file);
        $cost=10;
        $salt=strtr(base64_encode(random_bytes(16)), '+', '.');
        $salt=sprintf("$2a$%02d$", $cost).$salt;
        for ($i=0; $i < count($students); $i++) {
            $studentNumber=$students[$i][1];
            $firstName=$students[$i][2];
            $lastName=$students[$i][3];
            $userName=$students[$i][4];
            $password=crypt($students[$i][1], $salt);

            $query="INSERT INTO `students` (`studentNumber`, `firstName`, `lastName`, `userName`, `password`) VALUES (:studentNumber, :firstName, :lastName, :userName, :password)";
            $this->db->query($query);

            $this->db->bind(':studentNumber', $studentNumber);
            $this->db->bind(':firstName', $firstName);
            $this->db->bind(':lastName', $lastName);
            $this->db->bind(':userName', $userName);
            $this->db->bind(':password', $password);

            $this->db->execute();
        }
    }

    // Create completion table
    public function createCompletion()
    {
        $this->db->query('
        DROP TABLE IF EXISTS completion;
        CREATE TABLE completion(
            completionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            studentID INT(11) NOT NULL,
            labID INT(10) NOT NULL,
            responseTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
        )');
        $this->db->execute();
    }

    // Initialize completion
    public function initializeCompletion($file)
    {
        $completions=$this->parse_csv($file);
        for ($i=0; $i < count($completions); $i++) {
            $studentID=$completions[$i][1];
            $labID=$completions[$i][2];
            $responseTime=$completions[$i][3];

            $query="INSERT INTO `completion` (`studentID`, `labID`, `responseTime`) VALUES (:studentID, :labID, :responseTime)";
            $this->db->query($query);

            $this->db->bind(':studentID', $studentID);
            $this->db->bind(':labID', $labID);
            $this->db->bind(':responseTime', $responseTime);
            
            $this->db->execute();
        }
    }

    // Create data table
    public function createData()
    {
        $this->db->query('
        DROP TABLE IF EXISTS data;
        CREATE TABLE data(
            dataID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            toolID INT(11) NOT NULL,
            studentID INT(11) NOT NULL,
            labID INT(10) NOT NULL,
            xValue VARCHAR(32) NULL,
            yValue VARCHAR(32) NULL
        )');
        $this->db->execute();
    }

    // Initialize data
    public function initializeData($file)
    {
        $datas=$this->parse_csv($file);
        for ($i=0; $i < count($datas); $i++) {
            $toolID=$datas[$i][1];
            $studentID=$datas[$i][2];
            $labID=$datas[$i][3];
            $xValue=$datas[$i][4];
            $yValue=$datas[$i][5];

            $query="INSERT INTO `data` (`toolID`, `studentID`, `labID`, `xValue`, `yValue`) VALUES (:toolID, :studentID, :labID, :xValue, :yValue);";
            $this->db->query($query);
    
            $this->db->bind(':toolID', $toolID);
            $this->db->bind(':studentID', $studentID);
            $this->db->bind(':labID', $labID);
            $this->db->bind(':xValue', $xValue);
            $this->db->bind(':yValue', $yValue);
    
            $this->db->execute();
        }
    }

    // Create lab table
    public function createLab()
    {
        $this->db->query('
            DROP TABLE IF EXISTS lab;
            CREATE TABLE lab(
                labID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                labName VARCHAR(100) NULL,
                isCheckpoint tinyint(1) NOT NULL DEFAULT 0
            )');
        $this->db->execute();
    }

    // Initialize lab
    public function initializeLab($file)
    {
        $labs=$this->parse_csv($file);
        for ($i=0; $i < count($labs); $i++) {
            $labName=$labs[$i][1];
            $isCheckpoint=$labs[$i][2];
    
            $query="INSERT INTO `lab` (`labName`, `isCheckpoint`) VALUES (:labName, :isCheckpoint)";
            $this->db->query($query);
        
            $this->db->bind(':labName', $labName);
            $this->db->bind(':isCheckpoint', $isCheckpoint);
        
            $this->db->execute();
        }
    }

    // Create tool table
    public function createTool()
    {
        $this->db->query('
            DROP TABLE IF EXISTS tool;
            CREATE TABLE tool(
                toolID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                tableNamex VARCHAR(100) NULL,
                tableNameY  VARCHAR(100) NULL,
                northLabel VARCHAR(100) NULL,
                southLabel VARCHAR(100) NULL,
                eastLabel VARCHAR(100) NULL,
                westLabel VARCHAR(100) NULL
            )');
        $this->db->execute();
    }

    // Initialize tool
    public function initializeTool($file)
    {
        $tools=$this->parse_csv($file);
        for ($i=0; $i < count($tools); $i++) {
            $tableNamex=$tools[$i][1];
            $tableNameY=$tools[$i][2];
            $northLabel=$tools[$i][3];
            $southLabel=$tools[$i][4];
            $eastLabel=$tools[$i][5];
            $westLabel=$tools[$i][6];

            $query="INSERT INTO `tool` (`tableNamex`, `tableNameY`, `northLabel`, `southLabel`, `eastLabel`, `westLabel`) VALUES (:tableNamex,:tableNameY,:northLabel,:southLabel,:eastLabel,:westLabel)";
            $this->db->query($query);
    
            $this->db->bind(':tableNamex', $tableNamex);
            $this->db->bind(':tableNameY', $tableNameY);
            $this->db->bind(':northLabel', $northLabel);
            $this->db->bind(':southLabel', $southLabel);
            $this->db->bind(':eastLabel', $eastLabel);
            $this->db->bind(':westLabel', $westLabel);
    
            $this->db->execute();
        }
    }

    // Display all Lab
    public function displayAllLab()
    {
        $this->db->query('SELECT * FROM lab');
        $results=$this->db->resultSet();
        return $results;
    }

    // Display all Checkpoint Lab
    public function displayAllLabBycp()
    {
        $this->db->query('SELECT * FROM lab WHERE isCheckpoint=1');
        $results=$this->db->resultSet();
        return $results;
    }

    // Display all Students
    public function displayAllStudents()
    {
        $this->db->query('SELECT * FROM students');
        $results=$this->db->resultSet();
        return $results;
    }

    // Display all tool
    public function displayAllTool()
    {
        $this->db->query('SELECT * FROM tool');
        $results=$this->db->resultSet();
        return $results;
    }
    // Display all admin
    public function displayAllAdmin()
    {
        $this->db->query('SELECT * FROM `admin`');
        $results=$this->db->resultSet();
        return $results;
    }
    // Display student by studentID
    public function displayStudentByID($studentID)
    {
        $this->db->query('SELECT * FROM students WHERE studentID=:studentID');
        $this->db->bind(':studentID', $studentID);
        $results=$this->db->single();
        return $results;
    }

    // Verify Student login
    public function checkStudentLogin($studentID, $password)
    {
        $this->db->query('SELECT * FROM students WHERE studentID=:studentID');
        // Bind value
        $this->db->bind(':studentID', $studentID);
    
        $row=$this->db->single();
        $hashed_password = $row->password;
            
        //Check hash password
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    // Verify Staff login
    public function checkStaffLogin($userName, $password)
    {
        $this->db->query('SELECT * FROM `admin` WHERE userName=:userName');
        // Bind value
        $this->db->bind(':userName', $userName);
        
        $row=$this->db->single();
        $hashed_password = $row->password;
                
        //Check hash password
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    // Reset Student password
    public function resetStudentPwd($studentNumber)
    {
        $cost=10;
        $salt=strtr(base64_encode(random_bytes(16)), '+', '.');
        $salt=sprintf("$2a$%02d$", $cost).$salt;
        $this->db->query('UPDATE `students` SET `password` = :password WHERE `studentNumber` = :studentNumber');
        // Bind value
        $this->db->bind(':password', crypt($studentNumber, $salt));
        $this->db->bind(':studentNumber', $studentNumber);
        $this->db->execute();
    }

    // Display completion by studentID
    public function displayCompletionByStudentID($studentID)
    {
        $this->db->query('SELECT * FROM completion WHERE studentID=:studentID');
        $this->db->bind(':studentID', $studentID);
        $results=$this->db->resultSet();
        return $results;
    }

    // Check whether complete mark
    public function checkIsMarked($labID, $studentID)
    {
        $this->db->query('SELECT * FROM completion WHERE labID=:labID AND studentID=:studentID');
        $this->db->bind(':labID', $labID);
        $this->db->bind(':studentID', $studentID);
        $count=$this->db->getRowCount();
        return $count;
    }

    // Return the number of Checkpoints
    public function getCheckpointCount()
    {
        $this->db->query('SELECT * FROM lab WHERE isCheckpoint=1');
        $count=$this->db->getRowCount();
        return $count;
    }

    // Return the number of Checkpoints
    public function getCompletedCheckpointCount($studentID)
    {
        $this->db->query('SELECT * FROM completion JOIN lab ON completion.labID=lab.labID WHERE completion.studentID=:studentID AND lab.isCheckpoint=1');
        $this->db->bind(':studentID', $studentID);
        $count=$this->db->getRowCount();
        return $count;
    }

    // Check whether send tool
    public function checkIsSendTool($labID, $studentID, $toolID)
    {
        $this->db->query('SELECT * FROM data WHERE labID=:labID AND studentID=:studentID AND toolID=:toolID');
        $this->db->bind(':labID', $labID);
        $this->db->bind(':studentID', $studentID);
        $this->db->bind(':toolID', $toolID);
        $count=$this->db->getRowCount();
        return $count;
    }

    // Add tool
    public function addToolRecord($labID, $studentID, $toolID, $x, $y)
    {
        $this->db->query('INSERT INTO data(toolID,studentID,labID,xValue,yValue) VALUES(:toolID,:studentID,:labID,:xValue,:yValue)');
        $this->db->bind(':labID', $labID);
        $this->db->bind(':studentID', $studentID);
        $this->db->bind(':toolID', $toolID);
        $this->db->bind(':xValue', $x);
        $this->db->bind(':yValue', $y);
        $this->db->execute();
    }

    // Add completion
    public function addCompletion($studentID, $labID)
    {
        $this->db->query('INSERT INTO completion(studentID,labID) VALUES(:studentID,:labID)');
        $this->db->bind(':labID', $labID);
        $this->db->bind(':studentID', $studentID);
        $this->db->execute();
    }

    // Display all data
    public function displayAllData()
    {
        $this->db->query('SELECT * FROM data');
        $results=$this->db->resultSet();
        return $results;
    }

    // Display all completion
    public function displayAllCompletion()
    {
        $this->db->query('SELECT * FROM completion');
        $results=$this->db->resultSet();
        return $results;
    }

    // Display 7 days completion So far today
    public function displayCompletion7D()
    {
        $this->db->query('select DISTINCT labID from completion where DATE_SUB((SELECT responseTime FROM `completion` ORDER BY responseTime DESC LIMIT 1), INTERVAL 7 DAY) < date(responseTime)');
        $results=$this->db->resultSet();
        return $results;
    }

    // Return student latest labName
    public function displayLatestLabNameByStudent($studentID)
    {
        $this->db->query('SELECT lab.labName FROM `lab` JOIN completion on lab.labID=completion.labID WHERE completion.studentID=:studentID AND lab.isCheckpoint=1 ORDER by completion.responseTime DESC LIMIT 1;');
        $this->db->bind(':studentID', $studentID);
        $results=$this->db->single();
        return $results;
    }

    // Return class latest labName
    public function displayLatestLabNameByClass()
    {
        $this->db->query('SELECT lab.labName FROM `lab` JOIN completion on lab.labID=completion.labID WHERE  lab.isCheckpoint=1 ORDER by completion.responseTime DESC LIMIT 1;');
        $results=$this->db->single();
        return $results;
    }

    // Display data table
    public function displayXYValue($studentID, $toolID)
    {
        $this->db->query('Select labID,xValue,yValue from data where studentID=:studentID AND toolID=:toolID');
        $this->db->bind(':studentID', $studentID);
        $this->db->bind(':toolID', $toolID);
        $results=$this->db->resultSet();
        return $results;
    }

    // Display data table avg individual vs whole class
    public function displayXValueAvg($studentID, $toolID)
    {
        $this->db->query('SELECT lab.labID as lid,lab.labName, AVG(data.xValue) as individualAvg, (SELECT AVG(data.xValue) as wholeAvg FROM data JOIN lab on lab.labID=data.labID WHERE data.labID=lid) as wholeAvg FROM lab JOIN data on lab.labID=data.labID WHERE studentID=:studentID AND toolID=:toolID GROUP BY lab.labName');
        $this->db->bind(':studentID', $studentID);
        $this->db->bind(':toolID', $toolID);
        $results=$this->db->resultSet();
        return $results;
    }

    // Display data table avg individual vs whole class
    public function displayYValueAvg($studentID, $toolID)
    {
        $this->db->query('SELECT lab.labID as lid,lab.labName, AVG(data.yValue) as individualAvg, (SELECT AVG(data.yValue) as wholeAvg FROM data JOIN lab on lab.labID=data.labID WHERE data.labID=lid) as wholeAvg FROM lab JOIN data on lab.labID=data.labID WHERE studentID=:studentID AND toolID=:toolID GROUP BY lab.labName');
        $this->db->bind(':studentID', $studentID);
        $this->db->bind(':toolID', $toolID);
        $results=$this->db->resultSet();
        return $results;
    }

    // Change Student password
    public function changePasswordByStudent($studentID, $password)
    {
        $cost=10;
        $salt=strtr(base64_encode(random_bytes(16)), '+', '.');
        $salt=sprintf("$2a$%02d$", $cost).$salt;
        $this->db->query('UPDATE students SET password=:password WHERE studentID=:studentID');
        $this->db->bind(':studentID', $studentID);
        $this->db->bind(':password', crypt($password, $salt));
        $this->db->execute();
    }

    // Parse CSV file and return array
    public function parse_csv($filePath)
    {
        $handle = fopen($filePath, 'r');
        $out = array();
        $n = 0;
        while ($data = fgetcsv($handle, 10000)) {
            $num = count($data);
            for ($i = 0; $i < $num; $i++) {
                $out[$n][$i] = $data[$i];
            }
            $n++;
        }
        fclose($handle);
        return $out;
    }
}
