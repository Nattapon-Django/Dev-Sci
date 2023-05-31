<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'fride');

class dbcon
{
    public function __construct()
    {
        $this->dbcon = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($this->dbcon->connect_error) {
            echo "Cannot connect to database: " . $this->dbcon->connect_error;
        }
    }

    function signin($user, $pass)
    {
        $result = $this->dbcon->query("SELECT u_id,u_user,u_pass,u_type FROM tbl_user WHERE u_user='$user' AND u_pass='$pass' ");
        return $result;
    }

    function fetch_user()
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_user WHERE u_type='user' ");
        return $result;
    }
    function fetch_user_id($id)
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_user WHERE u_id='$id' ");
        return $result;
    }

    function add_user($user, $pass, $email, $tel, $pms)
    {
        $result = $this->dbcon->query("INSERT INTO tbl_user (u_user,u_pass,u_email,u_tel,u_permission) VALUES ('$user','$pass','$email','$tel','$pms')");
        return $result;
    }

    function update_profile($id, $pass, $email, $tel)
    {
        $result = $this->dbcon->query("UPDATE tbl_user SET u_pass='$pass',u_email='$email',u_tel='$tel' WHERE u_id='$id' ");
        return $result;
    }
    function update_profile_by_admin($id, $pass, $email, $tel, $pms)
    {
        $result = $this->dbcon->query("UPDATE tbl_user SET u_pass='$pass',u_email='$email',u_tel='$tel', u_permission='$pms' WHERE u_id='$id' ");
        return $result;
    }

    function check_user_already($user)
    {
        $result = $this->dbcon->query("SELECT u_user FROM tbl_user WHERE u_user='$user' ");
        return $result;
    }
    function fetch_device()
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_device");
        return $result;
    }

    function get_user_permission($sess_id)
    {
        $result_check = $this->dbcon->query("SELECT u_id,u_permission FROM tbl_user WHERE u_id='$sess_id' ");
        $fetch_check = $result_check->fetch_array();
        $explode = explode(",", $fetch_check['u_permission']);
        return $explode;
    }

    function fetch_device_user($list_pms)
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_device WHERE dv_id='$list_pms' ");
        return $result;
    }

    function del_user($u_id)
    {
        $result =  $this->dbcon->query("DELETE  FROM  tbl_user WHERE u_id='$u_id'");
        return $result;
    }

    function getID_show_device($dv_id)
    {
        $result =  $this->dbcon->query("SELECT * FROM tbl_data  WHERE dv_id='$dv_id' ORDER BY `data_id` DESC LIMIT 800");
        return $result;
    }
    function getID_show_device_search($dv_id, $start_search, $end_search)
    {
        $result =  $this->dbcon->query("SELECT * FROM tbl_data WHERE dv_id='$dv_id' AND Date BETWEEN '$start_search' AND '$end_search' ORDER BY data_id DESC");
        return $result;
    }
    function listCheckBoxDevice()
    {
        $result =  $this->dbcon->query("SELECT * FROM tbl_device  ORDER BY dv_id ASC");
        return $result;
    }
    function fetch_device_id($id)
    {
        $result =  $this->dbcon->query("SELECT * FROM tbl_device  WHERE dv_id='$id' ");
        return $result;
    }
    function add_device($dv_id, $name, $detail, $t_min, $t_max, $s_min, $s_max, $b_min, $b_max, $lat, $lon, $line_tk)
    {
        $result =  $this->dbcon->query("INSERT INTO tbl_device
        (dv_id,dv_name,dv_detail,dv_t_min,dv_t_max,dv_s_min,dv_s_max,dv_b_min,dv_b_max,dv_lat,dv_lon,dv_line_tk) VALUES ('$dv_id','$name','$detail','$t_min','$t_max','$s_min','$s_max','$b_min','$b_max','$lat','$lon','$line_tk') ");

        return $result;
    }
    function update_device($id, $name, $detail, $t_min, $t_max, $s_min, $s_max, $b_min, $b_max, $lat, $lon, $line_tk)
    {
        $result =  $this->dbcon->query("UPDATE tbl_device SET 
        dv_name='$name', 
        dv_detail='$detail', 
        dv_t_min='$t_min', 
        dv_t_max='$t_max', 
        dv_s_min='$s_min', 
        dv_s_max='$s_max',
        dv_b_min='$b_min', 
        dv_b_max='$b_max',
        dv_lat='$lat', 
        dv_lon='$lon',
        dv_line_tk='$line_tk'
        WHERE dv_id='$id' ");
        return $result;
    }
    function remove_device($dv_id)
    {
        $result = $this->dbcon->query("DELETE FROM tbl_device WHERE dv_id='$dv_id' ");
        return $result;
    }
    function check_status_device($dv_id)
    {
        $result_send = $this->dbcon->query("SELECT *,NOW() as dt_now FROM tbl_data WHERE dv_id='$dv_id' ORDER BY data_id DESC LIMIT 1");
        $fetch_send = $result_send->fetch_array();
        if (!$fetch_send) {
            return "
            <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#myModal$dv_id'>• Offline</button>
            <div id='myModal$dv_id' class='modal fade' role='dialog'>
            <div class='modal-dialog'>

                <!-- Modal content-->
                <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title'>Device $dv_id</h4>
                </div>
                <div class='modal-body'>
                    <img class='img-responsive center-block' src='../img/device_$dv_id.gif'>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                </div>
                </div>

            </div>
            </div>
            ";
        } else {

            $recv = $fetch_send['Date'] . ' ' . $fetch_send['Time']; //วันเวลาที่ Device ส่งมาล่าสุด
            $recv_now = $fetch_send['dt_now']; //วันเวลาล่าสุด

            $date1 = strtotime("$recv"); //ดึงค่าของเวลา 
            $date2 = strtotime("$recv_now");

            $interval = $date2 - $date1;

            // $seconds = $interval % 60;
            $minutes = floor(($interval % 3600) / 60);
            $hours = floor($interval / 3600); // เป็นการคำนวณที่copyมา 


            // $hours . ":" . $minutes . ":" . $seconds;

            if ($hours > 0) {
                return "
            <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#myModal$dv_id'>• Offline</button>
            <div id='myModal$dv_id' class='modal fade' role='dialog'>
            <div class='modal-dialog'>

                <!-- Modal content-->
                <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title'>Device $dv_id</h4>
                </div>
                <div class='modal-body'>
                    <img class='img-responsive center-block' src='../img/device_$dv_id.gif'>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                </div>
                </div>

            </div>
            </div>


            ";
            } else if ($hours >= 0 && $minutes >= 2) {
                return "
            <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#myModal$dv_id'>• Offline</button>
            <div id='myModal$dv_id' class='modal fade' role='dialog'>
            <div class='modal-dialog'>

                <!-- Modal content-->
                <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title'>Device $dv_id</h4>
                </div>
                <div class='modal-body'>
                    <img class='img-responsive center-block' src='../img/device_$dv_id.gif'>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                </div>
                </div>

            </div>
            </div>


            ";
            } else {
                return "<button class='btn btn-success btn-sm'>• Online</button>";
            }
        }
    }
    function get_graph($dv_id, $date, $time_start, $time_end)
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_data WHERE `dv_id`='$dv_id' AND `Date`='$date' AND `Time` BETWEEN '$time_start' AND '$time_end' ");
        return $result;
    }
    function device_get_max()
    {
        $result = $this->dbcon->query("SELECT MAX(dv_id) as max_id FROM tbl_device");
        $fetch = $result->fetch_array();
        $fetch_max = $fetch['max_id'];
        return $fetch_max;
    }
    function countDevice_status_admin()
    {
        $result = new dbcon;
        $result_fetch = $result->fetch_device();

        $count = array();
        $count_online = 0;
        $count_offline = 0;

        while ($row = $result_fetch->fetch_array()) {
            $status = $result->check_status_device($row[0]);
            if ($status == "<button class='btn btn-danger btn-sm'>• Offline</button>") {
                $count_offline += 1;
            } else if ($status == "<button class='btn btn-success btn-sm'>• Online</button>") {
                $count_online += 1;
            }
        }

        $count = [$count_offline, $count_online];
        return  $count;
    }
    function countDevice_user($session)
    {
        $obj = new dbcon;
        $user_permission = $obj->get_user_permission($session);
        $count_total = 0;
        foreach ($user_permission as $list_pms) {
            $get_device = $obj->fetch_device_user($list_pms);
            $num_row = $get_device->num_rows;
            $count_total += $num_row;
        }
        return $count_total;
    }
    function countDevice_status_user($session)
    {
        $obj = new dbcon;
        $user_permission = $obj->get_user_permission($session);
        $count_online = 0;
        $count_offline = 0;
        $count = array();

        foreach ($user_permission as $list_pms) {
            $status = $obj->check_status_device($list_pms);
            if ($status == "<button class='btn btn-danger btn-sm'>• Offline</button>") {
                $count_offline += 1;
            } else if ($status == "<button class='btn btn-success btn-sm'>• Online</button>") {
                $count_online += 1;
            }
        }
        $count = [$count_offline, $count_online];
        return $count;
    }
    function QueryAlertReport($id, $date, $start, $end)
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_alert WHERE alert_dvid = '$id' AND alert_date = '$date' AND alert_time BETWEEN '$start' AND '$end' LIMIT 500");
        return $result;
    }

    function QueryAlertReportAlertPage($id, $year)
    {
        $result = $this->dbcon->query("SELECT *,YEAR(alert_date) as year,MONTH(alert_date) as month ,COUNT(alert_data) as dataTotal ,count(case alert_tempname when 'Shelf Temp' then 1 else null end) as Shelf ,count(case alert_tempname when 'Freezer Temp' then 1 else null end) as Freezer FROM tbl_alert WHERE alert_dvid = '$id' AND YEAR(alert_date) = '$year' GROUP BY MONTH(alert_date)");
        return $result;
    }
    function QueryAlertReportAlertPageDetail($id, $month, $year)
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_alert WHERE MONTH(alert_date) ='$month' AND YEAR(alert_date) = '$year' AND alert_dvid='$id' ");
        return $result;
    }
}
//////////////// End Class DBcon //////////////////////

function check_already_login($sess_type)
{
    if (isset($sess_type)) {
        // echo "<script>alert('แก้ไขสำเร็จ !!')</script>";
        if ($sess_type == 'admin') {
            echo "<script>window.location.href='admin/index.php'</script>";
        } else if ($sess_type == 'user') {
            echo "<script>window.location.href='user/index.php'</script>";
        }
    }
}

function check_session_loginAdmin()
{
    $_SESSION['sess_u_type'] = isset($_SESSION['sess_u_type']) ? $_SESSION['sess_u_type'] : "";
    if (!isset($_SESSION['sess_u_id'])) {
        echo "<script>alert('กรุณา Login ก่อนใช้งาน')</script>";
        echo "<script>window.location.href='../index.php'</script>";
    }
    if (isset($_SESSION['sess_u_id']) && isset($_SESSION['sess_u_type'])) {
        if ($_SESSION['sess_u_type'] != 'admin') {
            header('Location: ../user/index.php');
        }
    }
}

function check_session_loginUser()
{
    if (!isset($_SESSION['sess_u_id'])) {
        echo "<script>alert('กรุณา Login ก่อนใช้งาน')</script>";
        echo "<script>window.location.href='../index.php'</script>";
    }
    if (isset($_SESSION['sess_u_id']) && isset($_SESSION['sess_u_type'])) {
        if ($_SESSION['sess_u_type'] != 'user') {
            header('Location: ../admin/index.php');
        }
    }
}


function convertDateQueryToSQL($date)
{
    $get_date = explode('-', $date);
    $s_year = $get_date[0];
    $s_month = $get_date[1];
    $s_day = $get_date[2];
    return $s_month . '/' . $s_day . '/' . $s_year;
}
