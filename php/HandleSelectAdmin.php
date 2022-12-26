<?php

// =================================== Admin ===================================


// ============= Dashboard =============

    /*
        function: soLuongProperty
        Ý nghĩa : lấy ra số lượng Property
        File sử dụng: Admin_Dashboard.php
    */
    function soLuongProperty($con){

        $sql_Property = "SELECT * FROM Property;";
        
        $result = mysqli_query($con, $sql_Property);

        $row = mysqli_num_rows($result);

        return $row;
    }

    /*
        function: soLuongCustomer
        Ý nghĩa : lấy ra số lượng Customer
        File sử dụng: Admin_Dashboard.php
    */
    function soLuongCustomer($con){

        $sql_Customer = "SELECT * FROM Customer";

        $result = mysqli_query($con, $sql_Customer);

        $row = mysqli_num_rows($result);

        return $row;
    }

    /*
        function: soLuongReservation
        Ý nghĩa : lấy ra số lượng đặt phòng
        File sử dụng: Admin_Dashboard.php
    */
    function soLuongReservation($con){

        $sql_reservation = "SELECT * FROM RESERVATION";

        $result = mysqli_query($con, $sql_reservation);

        $row = mysqli_num_rows($result);

        return $row;
    }

    /*
        function: danhsachCus
        Ý nghĩa : lấy ra danh sách khách hàng
        File sử dụng: Admin_Dashboard.php
    */
    function danhsachCus($con){
        
        $sql= "SELECT C.CustomerName, Phone, Sex, Status_Account, Image_Customer, CustomerID
               FROM CUSTOMER C";

        $result = mysqli_query($con, $sql);

        return $result;
    }

    /*
        function: danhsachAccount
        Ý nghĩa : lấy ra danh sách các tài khoản
        File sử dụng: Admin_Dashboard.php
    */
    function danhsachAccount($con){

        $sql = "SELECT username, Gmail, ROLES
                FROM Account
                WHERE ROLES IN(2,3);";

        $result = mysqli_query($con, $sql);

        return $result;
    }

    /*
        function: danhsachProperty
        Ý nghĩa : lấy ra danh sách property
        File sử dụng: Admin_Dashboard.php
    */
    function danhsachProperty($con){

        $sql = "SELECT P.PropertyName, P.Address_Property, P.Phone_Property, A.ROLES, P.Image_Property, P.TypeProperty
        FROM Property P, account A
        WHERE P.AccountID = A.AccountID;";

        $result = mysqli_query($con, $sql);

        return $result;
    }


// ============= Analytics =============

    /*
        function: thongkeCategoryBooking
        Ý nghĩa : Thống kê danh sách booking theo từng Category
        File sử dụng: Admin_Analytics.php
    */
    function thongkeCategoryBooking($con){

        $query = $con->query("
        SELECT P.typeOfCategory as Category, count(re.ReservationID) as amount
        FROM property P join room r on p.PropertyID = r.PropertyID 
                        join reservation re on re.RoomID = r.RoomID
        GROUP BY p.typeofCategory");

        return $query;
    }

    /*
        function: thongkeBookingYear
        Ý nghĩa : Thống kê danh sách booking theo năm
        File sử dụng: Admin_Analytics.php
    */
    function thongkeBookingYear($con){

        $query = $con->query("
        SELECT month(re.CheckIn) as month, count(re.ReservationID) as soluong
        FROM property P join room r on p.PropertyID = r.PropertyID
                        join reservation re on re.RoomID = r.RoomID
        where year(re.CheckIn) = YEAR(CURDATE())
        GROUP BY  month(re.CheckIn);");

        return $query;
    }

    /*
        function: favouriteType
        Ý nghĩa : Category được book nhiều nhất
        File sử dụng: Admin_Analytics.php
    */
    function favouriteType($con){

        $sql = "SELECT P.typeOfCategory, count(re.ReservationID)"

            . "FROM property P join room r on p.PropertyID = r.PropertyID 
                            join reservation re on re.RoomID = r.RoomID\n"

            . "GROUP BY p.typeofCategory\n"

            . "ORDER BY count(re.ReservationID) desc\n"

            . "LIMIT 1;";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_row($result);
        
        return $row;

    }

    /*
        function: monthlyBooking
        Ý nghĩa : Month được book nhiều nhất
        File sử dụng: Admin_Analytics.php
    */
    function monthlyBooking($con){

        $sql = "SELECT month(re.CheckIn), count(re.ReservationID) as soluong\n"

            . "        FROM property P join room r on p.PropertyID = r.PropertyID  
                                       join reservation re on re.RoomID = r.RoomID\n"

            . "        GROUP BY  month(re.CheckIn)\n"

            . "        ORDER BY soluong DESC\n"

            . "        limit 1;";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_row($result);

        return $row;
    }

    /*
        function: hotelMostBooking
        Ý nghĩa : Hotel được book nhiều nhất
        File sử dụng: Admin_Analytics.php
    */
    function hotelMostBooking($con){

        $sql = "SELECT p.PropertyID, p.PropertyName, count(re.ReservationID) as soluong\n"

            . "FROM property P join room r on p.PropertyID = r.PropertyID 
                            join reservation re on re.RoomID = r.RoomID\n"

            . "GROUP BY  p.PropertyID\n"

            . "ORDER BY soluong DESC\n"

            . "LIMIT 1;";

        $result = mysqli_query($con, $sql);
        
        $row = mysqli_fetch_row($result);

        return $row;
    }

    /*
        function: hotelHighestPoint
        Ý nghĩa : Hotel được chấm điểm cao nhất(trung bình)
        File sử dụng: Admin_Analytics.php
    */
    function hotelHighestPoint($con){

        $sql = "SELECT p.PropertyID, p.PropertyName, avg(ev.Point) diem\n"

            . "FROM property P join room r on p.PropertyID = r.PropertyID  \n"

            . "	            join reservation re on re.RoomID = r.RoomID\n"

            . "             join evaluate_property ev on p.PropertyID = ev.PropertyID\n"

            . "GROUP BY  p.PropertyID\n"

            . "ORDER BY diem DESC\n"

            . "LIMIT 1;";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_row($result);

        return $row;
    }


// ============= Message =============

/*
    function: showMessage
    Ý nghĩa : Show các message gửi tới admin
    File sử dụng: Admin_Message.php
*/
function showMessage($con){

    $sql = "SELECT * FROM Contact WHERE usernameReceive = 'admin'";

    $result = mysqli_query($con, $sql);

    return $result;

}


?>