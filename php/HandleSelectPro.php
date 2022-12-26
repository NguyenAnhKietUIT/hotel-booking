<?php

// =================================== Property ===================================

/*
    function: totalReservation
    Ý nghĩa : Thống kê tổng các reservation
    Tham số đầu vào: con, proID
    File sử dụng: Home_Property.php
*/
function totalReservation($con, $proID){

    $sql = "SELECT RE.ReservationID
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
                                    
            WHERE R.PropertyID = '".$proID."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_num_rows($result);

    return $row;
}

/*
    function: totalArrival
    Ý nghĩa : Thống kê tổng khách Arrival(Đã đặt và đang ở)
    Tham số đầu vào: con, proID
    File sử dụng: Home_Property.php
*/
function totalArrival($con, $proID){

    $sql = "SELECT RE.ReservationID
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
            WHERE R.PropertyID = '".$proID."' and RE.Status_Reservation = 3;";

    $result = mysqli_query($con, $sql);

    $row = mysqli_num_rows($result);

    return $row;
}

/*
    function: totalDeparture
    Ý nghĩa : Thống kê tổng khách Departure(Đã trả phòng)
    Tham số đầu vào: con, proID
    File sử dụng: Home_Property.php
*/
function totalDeparture($con, $proID){

    $sql = "SELECT RE.ReservationID
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
            WHERE R.PropertyID = '".$proID."' and RE.Status_Reservation = 2;";

    $result = mysqli_query($con, $sql);

    $row = mysqli_num_rows($result);

    return $row;
}
/*
    function: totalReview
    Ý nghĩa : Thống kê tổng review
    Tham số đầu vào: con, proID
    File sử dụng: Home_Property.php
*/
function totalReview($con, $proID){

    $sql = "SELECT e.evaHotelID
            FROM PROPERTY P JOIN EVALUATE_PROPERTY E ON E.PropertyID = P.PropertyID
            WHERE P.PropertyID = '".$proID."'
            GROUP BY P.PropertyID;";

    $result = mysqli_query($con, $sql);

    $row = mysqli_num_rows($result);

    return $row;
}

/*
    function: analyticsByDay
    Ý nghĩa : Thống kê theo ngày
    Tham số đầu vào: con, proID, year
    File sử dụng: Home_Property.php
*/
function analyticsByDay($con, $proID, $date1, $date2){
    
    $query = $con->query("select day(CheckIn) as day, count(*) as amount
                        from RESERVATION re join room r on re.RoomID = r.RoomID
                        where timestampdiff(day,'".$date1."', CheckIn) >= 0 
                            and timestampdiff(day,'".$date2."', CheckIn) <= 0 
                            and r.PropertyID = '".$proID."'
                        group by day(CheckIn)
                        order by day(CheckIn) asc;");

    return $query;
}

/*
    function: analyticsByMonth
    Ý nghĩa : Thống kê theo tháng
    Tham số đầu vào: con, proID, date1, date2
    File sử dụng: Home_Property.php
*/
function analyticsByMonth($con, $proID, $date1, $date2){
    
    $query = $con->query("	select month(CheckIn) as month, count(*) as amount
                            from RESERVATION re join room r on re.RoomID = r.RoomID
                            where timestampdiff(month,'".$date1."',CheckIn) >= 0 
                                    and timestampdiff(year,'".$date1."', CheckIn) >= 0 
                                    and timestampdiff(month,'".$date2."',CheckIn) <= 0 
                                    and timestampdiff(year, '".$date2."', CheckIn) <= 0
                            and r.PropertyID = '".$proID."'
                            group by month(CheckIn)
                            order by month(CheckIn) asc;");

    return $query;
}



/*
    function: analyticsByYear
    Ý nghĩa : Thống kê theo năm
    Tham số đầu vào: con, proID, year
    File sử dụng: Home_Property.php
*/
function analyticsByYear($con, $proID, $date1, $date2){
    
    $query = $con->query("  select year(CheckIn) as year, count(*) as amount
                            from RESERVATION re join room r on re.RoomID = r.RoomID
                            where timestampdiff(year,'".$date1."', CheckIn) >= 0  
                                        and timestampdiff(year,'".$date2."',CheckIn) <=0
                            and r.PropertyID = '".$proID."'
                            group by year(CheckIn)
                            order by year(CheckIn) asc;");

    return $query;
}
/*
    function: thongtinProperty
    Ý nghĩa : Thông tin do Property kiểm tra và chỉnh sửa
    Tham số đầu vào: con,acID
    File sử dụng: Property_Information.php
*/
function thongtinProperty($con, $acID){

    $sql = "SELECT P.PropertyID, PropertyName, Detail_Property, Phone_Property, GMAIL, Address_Property, CheckInTime, CheckOutTime, P.TypeProperty, P.TypeOfCategory, P.Image_Property\n"

        . "FROM PROPERTY P JOIN Account A ON P.AccountID = A.accountID\n"

        . "WHERE A.AccountID = '".$acID."'; ";
    
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: findUsername
    Ý nghĩa : Lấy ra username Property
    Tham số đầu vào: con, accID
    File sử dụng: .php
*/
function findUsername($con, $accID){

    $sql = "SELECT Username
            FROM Account
            WHERE AccountID = '".$accID."'
            and roles = 2;";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}
/*
    function: findProID
    Ý nghĩa : Lấy ra mã Property
    Tham số đầu vào: con, proName
    File sử dụng: HandleInsertCus.php
*/
function findProID($con, $proName){

    $sql = "SELECT PropertyID
            FROM property
            WHERE PropertyName = '".$proName."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}
/*
    function: findProIDByResno
    Ý nghĩa : Lấy ra mã Property
    Tham số đầu vào: con, proName
    File sử dụng: HandleInsertCus.php
*/
function findProIDByResno($con, $resNumber){

    $sql = "SELECT PRO.PropertyID
            FROM reservation RE JOIN ROOM R ON RE.RoomID = R.RoomID
                                JOIN PROPERTY PRO ON R.PropertyID = PRO.PropertyID
            WHERE re.ReservationID = '".$resNumber."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: findProID
    Ý nghĩa : Lấy ra mã Property
    Tham số đầu vào: con, accID
    File sử dụng: HandleInsertCus.php
*/
function findProIDByAccID($con, $accID){

    $sql = "SELECT PropertyID
            FROM property
            WHERE AccountID = '".$accID."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}
/*
    function: checkService
    Ý nghĩa : Kiểm tra dịch vụ đang có
    Đầu vào: con
*/
function checkService($con, $serviceName){
    $sql = "SELECT *
            FROM Service
            WHERE ServiceName = '".$serviceName."'";

    $result = mysqli_query($con, $sql);
    
    return $result;
}
/*
    function: showServiceInDB
    Ý nghĩa : Tìm mã dịch vụ mới nhất
    Đầu vào: con
*/
function newServiceID($con){
    $sql = "SELECT ServiceID
            FROM Service
            ORDER BY ServiceID DESC
            LIMIT 1";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}
/*
    function: findServiceID
    Ý nghĩa : Lấy ra mã dịch vụ
    Đầu vào: con
*/
function findServiceID($con, $serviceName){
    $sql = "SELECT ServiceID
            FROM SERVICE
            WHERE ServiceName = '".$serviceName."'";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: allRoom
    Ý nghĩa : Lấy ra các dịch vụ có trong Pro
    Tham số đầu vào: con, proID
    File sử dụng: Manage_Room.php
*/
function allService($con, $proID){
    $sql = "SELECT S.ServiceName
            FROM SERVICE S JOIN service_supplied SP ON S.ServiceID = SP.ServiceID
            WHERE SP.PropertyID = '".$proID."';";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: allRoom
    Ý nghĩa : Lấy ra các phòng có trong Pro
    Tham số đầu vào: con, proID
    File sử dụng: Manage_Room.php
*/
function allRoom($con, $proID){

    $sql = "SELECT RoomID, RoomName, TypeOfRoom, BedNum, Price, Image_Room
            FROM Room
            WHERE PropertyID = '".$proID."'
            ORDER BY RoomID DESC;";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: allRates
    Ý nghĩa : Lấy ra các rates&availability trong Pro
    Tham số đầu vào: con, proID
    File sử dụng: Property_Rates.php
*/
function allRate($con, $proID){

    $sql = "SELECT COUNT(R.RoomID), R.TypeOfRoom, AVG(R.Price), RE.Status_Reservation
            FROM ROOM R JOIN RESERVATION RE ON R.RoomID = RE.RoomID
            WHERE R.PropertyID = '".$proID."' 
            GROUP BY RE.Status_Reservation, R.TypeOfRoom
            ORDER BY COUNT(R.RoomID);";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: filterRateByTyperoom
    Ý nghĩa : Lấy ra các rates&availability trong Pro
    Tham số đầu vào: con, proID, typeroom
    File sử dụng: Property_Rates.php
*/
function filterRateByTypeRoom($con, $proID, $typeRoom){

    $sql = "SELECT COUNT(R.RoomID), R.TypeOfRoom, AVG(R.Price), RE.Status_Reservation
            FROM ROOM R JOIN RESERVATION RE ON R.RoomID = RE.RoomID
            WHERE R.PropertyID = '".$proID."' and R.TypeOfRoom = '".$typeRoom."' 
            GROUP BY RE.Status_Reservation, R.TypeOfRoom
            ORDER BY COUNT(R.RoomID);";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: filterRateByStatus
    Ý nghĩa : Lấy ra các rates&availability trong Pro
    Tham số đầu vào: con, proID, status
    File sử dụng: Property_Rates.php
*/
function filterRateByStatus($con, $proID, $status){

    $sql = "SELECT COUNT(R.RoomID), R.TypeOfRoom, AVG(R.Price), RE.Status_Reservation
            FROM ROOM R JOIN RESERVATION RE ON R.RoomID = RE.RoomID
            WHERE R.PropertyID = '".$proID."' and RE.Status_Reservation = '".$status."' 
            GROUP BY RE.Status_Reservation, R.TypeOfRoom
            ORDER BY COUNT(R.RoomID);";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: filterRateByAll
    Ý nghĩa : Lấy ra các rates&availability trong Pro
    Tham số đầu vào: con, proID, typeroom, status
    File sử dụng: Property_Rates.php
*/
function filterRateByAll($con, $proID, $typeRoom, $status){

    $sql = "SELECT COUNT(R.RoomID), R.TypeOfRoom, AVG(R.Price), RE.Status_Reservation
            FROM ROOM R JOIN RESERVATION RE ON R.RoomID = RE.RoomID
            WHERE R.PropertyID = '".$proID."' and TypeOfRoom = '".$typeRoom."'
                                              and Status_Reservation = '".$status."' 
            GROUP BY RE.Status_Reservation, R.TypeOfRoom
            ORDER BY COUNT(R.RoomID);";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: allReservation
    Ý nghĩa : Lấy ra các reservation trong Pro
    Tham số đầu vào: con, proID
    File sử dụng: Property_Reservation.php
*/
function allReservation($con, $proID){

    $sql = "SELECT RE.ReservationID, R.BedNum, RE.CheckIn, RE.CheckOut, R.TypeOfRoom, RE.Status_Reservation, RE.Total
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
            WHERE R.PropertyID = '".$proID."';";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: filterReservationByArrival
    Ý nghĩa : Lấy ra các reservation trong Pro
    Tham số đầu vào: con, proID, CheckInFrom, CheckInUntil
    File sử dụng: Property_Reservation.php
*/
function filterReservationByArrival($con, $proID, $checkInFrom, $checkInUntil){

    $sql = "SELECT RE.ReservationID, R.BedNum, RE.CheckIn, RE.CheckOut, R.TypeOfRoom, RE.Status_Reservation, RE.Total
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
                                JOIN PROPERTY P ON R.PropertyID = P.PropertyID
            WHERE P.PropertyID = '".$proID."' AND (RE.CHECKIN BETWEEN '".$checkInFrom."' AND '".$checkInUntil."') ;";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: filterReservationByArrivalInput
    Ý nghĩa : Lấy ra các reservation trong Pro
    Tham số đầu vào: con, proID, CheckInFrom, CheckInUntil, input
    File sử dụng: Property_Reservation.php
*/
function filterReservationByArrivalInput($con, $proID, $checkInFrom, $checkInUntil, $input){

    $sql = "SELECT RE.ReservationID, R.BedNum, RE.CheckIn, RE.CheckOut, R.TypeOfRoom, RE.Status_Reservation, RE.Total
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
                                JOIN PROPERTY P ON R.PropertyID = P.PropertyID
            WHERE P.PropertyID = '".$proID."' AND (RE.CHECKIN BETWEEN '".$checkInFrom."' AND '".$checkInUntil."') 
                                              AND R.TypeOfRoom = '".$input."' ;";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: filterReservationByDeparture
    Ý nghĩa : Lấy ra các reservation trong Pro
    Tham số đầu vào: con, proID, CheckOutFrom, CheckOutUntil
    File sử dụng: Property_Reservation.php
*/
function filterReservationByDeparture($con, $proID, $checkOutFrom, $checkOutUntil){

    $sql = "SELECT RE.ReservationID, R.BedNum, RE.CheckIn, RE.CheckOut, R.TypeOfRoom, RE.Status_Reservation, RE.Total
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
                                JOIN PROPERTY P ON R.PropertyID = P.PropertyID
            WHERE P.PropertyID = '".$proID."' AND RE.CHECKOUT BETWEEN '".$checkOutFrom."' AND '".$checkOutUntil."' ;";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: filterReservationByDepartureInput
    Ý nghĩa : Lấy ra các reservation trong Pro
    Tham số đầu vào: con, proID, CheckOutFrom, CheckOutUntil, input
    File sử dụng: Property_Reservation.php
*/
function filterReservationByDepartureInput($con, $proID, $checkOutFrom, $checkOutUntil, $input){

    $sql = "SELECT RE.ReservationID, R.BedNum, RE.CheckIn, RE.CheckOut, R.TypeOfRoom, RE.Status_Reservation, RE.Total
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
                                JOIN PROPERTY P ON R.PropertyID = P.PropertyID
            WHERE P.PropertyID = '".$proID."'
                  AND RE.CHECKOUT BETWEEN '".$checkOutFrom."' AND '".$checkOutUntil."' 
                  AND R.TypeOfRoom = '".$input."';";

    $result = mysqli_query($con, $sql);

    return $result;
}



/*
    function: allReview
    Ý nghĩa : Lấy ra các reservation trong Pro
    Tham số đầu vào: con, proID
    File sử dụng: Property_Review.php
*/
function allReview($con, $proID){

    $sql = "SELECT C.Image_Customer, C.CustomerName, A.GMAIL, ev.Point, ev.Comment
            FROM evaluate_property EV JOIN customer C ON EV.CustomerID = C.CustomerID
                                    JOIN ACCOUNT A ON A.AccountID = C.AccountID
            WHERE EV.PropertyID = '".$proID."';";

    $result = mysqli_query($con, $sql);

    return $result;
}

?>