<?php

// =================================== Customer ===================================

/*
    function: totalMoney
    Ý nghĩa : Tổng tiền
    Đầu vào: price, totalDay
    File sử dụng: Reservation.php
*/
function totalMoney($price, $totalDay){

    $totalMoney = $price * $totalDay;

    return $totalMoney;
}

/*
    function: thongtinKhachSanDatPhong
    Ý nghĩa : lấy ra Thông để khách xem lại
    Đầu vào: con, proID
    File sử dụng: Reservation.php
*/
function thongtinKhachSanDatPhong($con, $proID){

    $sql = "SELECT PropertyName, Address_Property, AVG(E.Point), P.CheckInTime, P.CheckOutTime, P.Image_Property, P.PropertyID

            FROM PROPERTY P JOIN evaluate_property E ON P.PropertyID = E.PropertyID
            
                            JOIN customer C ON E.CustomerID = C.CustomerID
            
            WHERE P.PropertyID = '".$proID."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: totalDay
    Ý nghĩa : Số ngày ở
    Đầu vào: checkin, checkout
    File sử dụng: Reservation.php
*/
function totalDay($checkin, $checkout){
    // Lấy ra ngày checkIn
    $checkInDay = strtotime($checkin);  
    $dateI = date("d", $checkInDay); 

    // Lấy ra ngày CheckOut
    $checkOutDay = strtotime($checkout);     
    $dateO = date("d", $checkOutDay); 

    return $dateO - $dateI;
}


/*
    function: topDestination
    Ý nghĩa : Tìm các top destination
    Đầu vào: con
    File sử dụng: Homepage.php
*/
function topDestination($con){

    $sql = "SELECT P.PlaceName, P.ImageOfPlace, COUNT(RE.ReservationID)
            FROM PLACE P JOIN PROPERTY PRO ON P.PlaceID = PRO.PlaceID
                         JOIN ROOM R ON R.PropertyID = PRO.PropertyID
                         JOIN RESERVATION RE ON RE.RoomID = R.RoomID
            GROUP BY P.PlaceName
            ORDER BY COUNT(RE.ReservationID) DESC
            LIMIT 4;";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: timPhongTheoTopDestination
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property dựa vào topDestination
    Đầu vào: con, topDestination
    File sử dụng: Search.php
*/
function timPhongTheoTopDestination($con, $topDestination){
    $sql = "SELECT Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
            FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                                JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                                JOIN ROOM R ON R.PropertyID = Pro.PropertyID
            WHERE P.PlaceName = '".$topDestination."' and R.Price IN (SELECT MIN(PRICE)
                                                            FROM room
                                                            WHERE PROPERTYID = PRO.PropertyID)
            GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: topTypeProperty
    Ý nghĩa : Tìm các top propertyType
    Đầu vào: con
    File sử dụng: Homepage.php
*/
function topTypeProperty($con){

    $sql = "SELECT PRO.TypeProperty, P.ImageOfPlace,COUNT(RE.ReservationID)
            FROM PROPERTY PRO JOIN PLACE P ON PRO.PlaceID = P.PlaceID
                            JOIN ROOM R ON R.PropertyID = PRO.PropertyID
                            JOIN RESERVATION RE ON RE.RoomID = R.RoomID
            GROUP BY PRO.TypeProperty
            ORDER BY COUNT(RE.ReservationID) DESC;";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: timPhongTheoTopType
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property dựa vào topDestination
    Đầu vào: con, topType
    File sử dụng: Search.php
*/
function timPhongTheoTopType($con, $topType){
    $sql = "SELECT Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
            FROM PROPERTY Pro JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                                JOIN ROOM R ON R.PropertyID = Pro.PropertyID
            WHERE TypeProperty = '".$topType."' and R.Price IN (SELECT MIN(PRICE)
                                                            FROM room
                                                            WHERE PROPERTYID = PRO.PropertyID)
            GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: topCategory
    Ý nghĩa : Tìm các property bằng typeProperty
    Đầu vào: con, Type
    File sử dụng: Homepage.php
*/
function topCategory($con, $type){

    $sql = "SELECT p.ImageOfPlace, p.PlaceName, COUNT(RE.ReservationID),Pro.TypeProperty, COUNT(Pro.TypeProperty), Pro.TypeOfCategory
            FROM PROPERTY PRO JOIN PLACE P ON PRO.PlaceID = P.PlaceID
                            JOIN ROOM R ON R.PropertyID = PRO.PropertyID
                            JOIN RESERVATION RE ON RE.RoomID = R.RoomID
            WHERE PRO.TypeOfCategory = '".$type."'
            GROUP BY p.PlaceName
            ORDER BY COUNT(RE.ReservationID) DESC;";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: timPhongTheoTopDestination
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property dựa vào topDestination
    Đầu vào: con, topCategory, place
    File sử dụng: Search.php
*/
function timPhongTheoTopCate($con, $topCategory, $place){
    $sql = "SELECT Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
            FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                                JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                                JOIN ROOM R ON R.PropertyID = Pro.PropertyID
            WHERE TypeOfCategory = '".$topCategory."' and P.Placename = '".$place."' and R.Price IN (SELECT MIN(PRICE)
                                                            FROM room
                                                            WHERE PROPERTYID = PRO.PropertyID)
            GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";

    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: findUsername
    Ý nghĩa : lấy ra username
    Đầu vào: con, accid
    File sử dụng: HandleInsertCus.php
*/
function findUsernameCus($con, $accID){

    $sql = "SELECT username FROM account WHERE accountID = '".$accID."' and roles = 3";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: findStatusAccount
    Ý nghĩa : lấy ra StatusAccount
    Đầu vào: con, cusAcc
    File sử dụng: HandleInsertCus.php
*/
function findStatusAccount($con, $cusAcc){

    $sql = "SELECT Status_Account FROM Customer WHERE AccountID = '".$cusAcc."'";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}
/*
    function: roomID
    Ý nghĩa : Tìm RoomID
    Đầu vào: con, RoomName, proID
    File sử dụng: HandleInsertCus.php
*/
function roomID($con, $roomName, $proID){

    $sql = "select r.roomID
            from room r join PROPERTY P on r.PropertyID = P.PropertyID
            where r.roomName = '$roomName' and P.PropertyID = '$proID'";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: cusID
    Ý nghĩa : Tìm cusID
    Đầu vào: con, username
    File sử dụng: HandleInsertCus.php
*/
function findcusID($con, $userName){
    $sql = "select c.customerID
            from account a join customer c on a.accountID = c.accountID
            where a.userName = '".$userName."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}
/*
    function: timPhong
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property hiển thị ra
    Đầu vào: Con,PlaceName ,checkin, checkout, bednum
    File sử dụng: Search.php
*/
function timPhong($con, $PlaceName ,$checkin, $checkout, $bednum){

    $sql = "SELECT  Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
    FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                      JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                      JOIN ROOM R ON R.PropertyID = Pro.PropertyID
    WHERE p.PlaceName = '".$PlaceName."' AND R.RoomID IN (SELECT RoomID
                                                    FROM ROOM 
                                                    WHERE RoomID IN (SELECT ROOMID
                                                                     FROM ROOM
                                                                     WHERE PropertyID = Pro.PropertyID and BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                           FROM reservation)
                                                                    UNION
                                                                    SELECT R.ROOMID
                                                                    FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                    WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                                FROM reservation RE2
                                                                                                                                                WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."'))))
                                                    and price = (SELECT min(Price)
                                                                FROM ROOM 
                                                                WHERE RoomID IN (SELECT ROOMID
                                                                                FROM ROOM
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                                       FROM reservation)
                                                                                UNION
                                                                                SELECT R.ROOMID
                                                                                FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                               FROM reservation RE2
                                                                                                                                               WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."')))
                                                    )
    GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";
    
    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: timPhongtheoProperty
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property theo Property Type
    Đầu vào: Con, Protype,PlaceName ,checkin, checkout, bednum
    File sử dụng: Search.php
*/
function timPhongTheoProperty($con, $Protype, $PlaceName ,$checkin, $checkout, $bednum){

    $sql = "SELECT  Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
    FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                      JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                      JOIN ROOM R ON R.PropertyID = Pro.PropertyID
    WHERE p.PlaceName = '".$PlaceName."' AND TypeProperty = '".$Protype."' AND R.RoomID IN (SELECT RoomID
                                                    FROM ROOM 
                                                    WHERE RoomID IN (SELECT ROOMID
                                                                     FROM ROOM
                                                                     WHERE PropertyID = Pro.PropertyID and BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                           FROM reservation)
                                                                    UNION
                                                                    SELECT R.ROOMID
                                                                    FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                    WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                                FROM reservation RE2
                                                                                                                                                WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."'))))
                                                    and price = (SELECT min(Price)
                                                                FROM ROOM 
                                                                WHERE RoomID IN (SELECT ROOMID
                                                                                FROM ROOM
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                                       FROM reservation)
                                                                                UNION
                                                                                SELECT R.ROOMID
                                                                                FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                               FROM reservation RE2
                                                                                                                                               WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."')))
                                                    )
    GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";
    
    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: timTheoProperty2
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property theo Property Type
    Đầu vào: Con, Protypex2,PlaceName ,checkin, checkout, bednum
    File sử dụng: Search.php
*/
function timTheoProperty2($con, $Type1, $Type2, $PlaceName ,$checkin, $checkout, $bednum){
    $sql = "SELECT Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
    FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                      JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                      JOIN ROOM R ON R.PropertyID = Pro.PropertyID
    WHERE p.PlaceName = '".$PlaceName."' AND TypeProperty IN ('".$Type1."', '".$Type2."') AND R.RoomID IN (SELECT RoomID
                                                    FROM ROOM 
                                                    WHERE RoomID IN (SELECT ROOMID
                                                                     FROM ROOM
                                                                     WHERE PropertyID = Pro.PropertyID and BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                           FROM reservation)
                                                                    UNION
                                                                    SELECT R.ROOMID
                                                                    FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                    WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                                FROM reservation RE2
                                                                                                                                                WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."'))))
                                                    and price = (SELECT min(Price)
                                                                FROM ROOM 
                                                                WHERE RoomID IN (SELECT ROOMID
                                                                                FROM ROOM
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                                       FROM reservation)
                                                                                UNION
                                                                                SELECT R.ROOMID
                                                                                FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                               FROM reservation RE2
                                                                                                                                               WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."')))
                                                    )
    GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";
    
    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: timTheoProperty2
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property theo Property Type
    Đầu vào: Con, Protypex3,PlaceName ,checkin, checkout, bednum
    File sử dụng: Search.php
*/
function timTheoProperty3($con, $Type1, $Type2, $Type3, $PlaceName ,$checkin, $checkout, $bednum){
    $sql = "SELECT Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
    FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                      JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                      JOIN ROOM R ON R.PropertyID = Pro.PropertyID
    WHERE p.PlaceName = '".$PlaceName."' AND TypeProperty IN ('".$Type1."', '".$Type2."', '".$Type3."') AND R.RoomID IN (SELECT RoomID
                                                    FROM ROOM 
                                                    WHERE RoomID IN (SELECT ROOMID
                                                                     FROM ROOM
                                                                     WHERE PropertyID = Pro.PropertyID and BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                           FROM reservation)
                                                                    UNION
                                                                    SELECT R.ROOMID
                                                                    FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                    WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                                FROM reservation RE2
                                                                                                                                                WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."'))))
                                                    and price = (SELECT min(Price)
                                                                FROM ROOM 
                                                                WHERE RoomID IN (SELECT ROOMID
                                                                                FROM ROOM
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                                       FROM reservation)
                                                                                UNION
                                                                                SELECT R.ROOMID
                                                                                FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                               FROM reservation RE2
                                                                                                                                               WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."')))
                                                    )
    GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";
    
    $result = mysqli_query($con, $sql);
    
    return $result;
}

/*
    function: timPhongtheoTypeRoom
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property theo TypeRoom
    Đầu vào: Con, TypeRoom,PlaceName ,checkin, checkout, bednum
    File sử dụng: Search.php
*/
function timPhongtheoTypeRoom($con, $TypeRoom, $PlaceName ,$checkin, $checkout, $bednum){

    $sql = "SELECT Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
    FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                      JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                      JOIN ROOM R ON R.PropertyID = Pro.PropertyID
    WHERE p.PlaceName = '".$PlaceName."' AND R.TypeOfRoom = '".$TypeRoom."' AND R.RoomID IN (SELECT RoomID
                                                    FROM ROOM 
                                                    WHERE RoomID IN (SELECT ROOMID
                                                                     FROM ROOM
                                                                     WHERE PropertyID = Pro.PropertyID and BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                           FROM reservation)
                                                                    UNION
                                                                    SELECT R.ROOMID
                                                                    FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                    WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                                FROM reservation RE2
                                                                                                                                                WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."'))))
                                                    and price = (SELECT min(Price)
                                                                FROM ROOM 
                                                                WHERE RoomID IN (SELECT ROOMID
                                                                                FROM ROOM
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                                       FROM reservation)
                                                                                UNION
                                                                                SELECT R.ROOMID
                                                                                FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                               FROM reservation RE2
                                                                                                                                               WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."')))
                                                    )
    GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";
    
    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: timPhongtheoTypeRoomV2
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property theo TypeRoom
    Đầu vào: Con, TypeRoomx2, ,PlaceName ,checkin, checkout, bednum
    File sử dụng: Search.php
*/
function timPhongtheoTypeRoomV2($con, $TypeRoom1, $TypeRoom2, $PlaceName ,$checkin, $checkout, $bednum){

    $sql = "SELECT Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
    FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                      JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                      JOIN ROOM R ON R.PropertyID = Pro.PropertyID
    WHERE p.PlaceName = '".$PlaceName."' AND R.TypeOfRoom IN( '".$TypeRoom1."', '".$TypeRoom2."') AND R.RoomID IN (SELECT RoomID
                                                    FROM ROOM 
                                                    WHERE RoomID IN (SELECT ROOMID
                                                                     FROM ROOM
                                                                     WHERE PropertyID = Pro.PropertyID and BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                           FROM reservation)
                                                                    UNION
                                                                    SELECT R.ROOMID
                                                                    FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                    WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                                FROM reservation RE2
                                                                                                                                                WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."'))))
                                                    and price = (SELECT min(Price)
                                                                FROM ROOM 
                                                                WHERE RoomID IN (SELECT ROOMID
                                                                                FROM ROOM
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                                       FROM reservation)
                                                                                UNION
                                                                                SELECT R.ROOMID
                                                                                FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                               FROM reservation RE2
                                                                                                                                               WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."')))
                                                    )
    GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";
    
    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: timPhongtheoTypeRoom
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property theo Giá max
    Đầu vào: Con, TypeRoom,PriceRoom ,checkin, checkout, bednum
    File sử dụng: Search.php
*/
function timPhongTheoGia($con, $PriceRoom, $PlaceName ,$checkin, $checkout, $bednum){
    $sql = "SELECT Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, AVG(E.Point), R.Price, R.TypeOfRoom
    FROM PROPERTY Pro JOIN PLACE P ON Pro.PlaceID = P.PlaceID 
                      JOIN EVALUATE_PROPERTY E ON Pro.PROPERTYID = E.PROPERTYID
                      JOIN ROOM R ON R.PropertyID = Pro.PropertyID
    WHERE p.PlaceName = '".$PlaceName."' AND R.Price <= '".$PriceRoom."' AND R.RoomID IN (SELECT RoomID
                                                    FROM ROOM 
                                                    WHERE RoomID IN (SELECT ROOMID
                                                                     FROM ROOM
                                                                     WHERE PropertyID = Pro.PropertyID and BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                           FROM reservation)
                                                                    UNION
                                                                    SELECT R.ROOMID
                                                                    FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                    WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                                FROM reservation RE2
                                                                                                                                                WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."'))))
                                                    and price = (SELECT min(Price)
                                                                FROM ROOM 
                                                                WHERE RoomID IN (SELECT ROOMID
                                                                                FROM ROOM
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID
                                                                                                                                                       FROM reservation)
                                                                                UNION
                                                                                SELECT R.ROOMID
                                                                                FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                                                                WHERE PropertyID = Pro.PropertyID AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID
                                                                                                                                               FROM reservation RE2
                                                                                                                                               WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                                                                                        OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."')))
                                                    )
    GROUP BY Pro.PropertyID, Pro.PropertyName,Pro.Image_Property, Pro.Address_Property, R.Price, R.TypeOfRoom;";
    
    $result = mysqli_query($con, $sql);

    return $result;
}
/*
    function: sortAsc
    Ý nghĩa : lấy ra danh sách các phòng đại diện của Property hiển thị ra tăng dần
    Đầu vào: Con,PlaceName ,checkin, checkout, bednum
*/
// function sortAsc($con, $PlaceName ,$checkin, $checkout, $bednum){

//     $sql = "SELECT H.HotelID, H.HotelName, H.Image_Hotel, H.Address_Hotel, AVG(E.Point), R.Price, R.TypeOfRoom
//     FROM PROPERTY P JOIN PLACE P ON H.PlaceID = P.PlaceID JOIN EVALUATE_HOTEL E ON H.HotelID = E.HotelID
//         JOIN ROOM R ON R.HotelID = H.HotelID
//     WHERE p.PlaceName= '".$PlaceName."' AND R.RoomID IN (SELECT R2.RoomID
//                                                     FROM ROOM R2
//                                                     WHERE R2.BedNum = '".$bednum."' AND R2.HotelID = H.HotelID
//                                                     AND NOT EXISTS (SELECT *
//                                                                     FROM RESERVATION RE
//                                                                     WHERE RE.RoomID = R2.RoomID
//                                                                     AND RE.Status_Reservation in (1,3)
//                                                                     AND (DATEDIFF(RE.CheckIn, '".$checkin."') <= 0 OR DATEDIFF(RE.CheckOut,  '".$checkout."') <= 0))									
//                                                     AND R2.Price = (SELECT min(R3.Price)
//                                                                 FROM ROOM R3
//                                                                 WHERE R3.BedNum = 2 AND R3.HotelID = H.HotelID
//                                                                 AND NOT EXISTS (SELECT *
//                                                                                 FROM RESERVATION RE2
//                                                                                 WHERE RE2.RoomID = R3.RoomID
//                                                                                 AND RE2.Status_Reservation in (1,3)
//                                                                                 AND (DATEDIFF(RE2.CheckIn, '".$checkin."') <= 0 OR DATEDIFF(RE2.CheckOut,  '".$checkout."') <= 0))
//                                                                 GROUP BY R3.HotelID)
//                                                     )
//     GROUP BY H.HotelID, H.HotelName, H.Image_Hotel, H.Address_Hotel, R.Price, R.TypeOfRoom
//     ORDER BY R.PRICE ASC;";
    
//     $result = mysqli_query($con, $sql);

//     return $result;
// }

// /*
//     function: sortDesc
//     Ý nghĩa : lấy ra danh sách các phòng đại diện của Property hiển thị ra giảm dần
//     Đầu vào: Con,PlaceName ,checkin, checkout, bednum
// */
// function sortDesc($con, $PlaceName ,$checkin, $checkout, $bednum){

//     $sql = "SELECT H.HotelID, H.HotelName, H.Image_Hotel, H.Address_Hotel, AVG(E.Point), R.Price, R.TypeOfRoom
//     FROM PROPERTY P JOIN PLACE P ON H.PlaceID = P.PlaceID JOIN EVALUATE_HOTEL E ON H.HotelID = E.HotelID
//         JOIN ROOM R ON R.HotelID = H.HotelID
//     WHERE p.PlaceName= '".$PlaceName."' AND R.RoomID IN (SELECT R2.RoomID
//                                                     FROM ROOM R2
//                                                     WHERE R2.BedNum = '".$bednum."' AND R2.HotelID = H.HotelID
//                                                     AND NOT EXISTS (SELECT *
//                                                                     FROM RESERVATION RE
//                                                                     WHERE RE.RoomID = R2.RoomID
//                                                                     AND RE.Status_Reservation in (1,3)
//                                                                     AND (DATEDIFF(RE.CheckIn, '".$checkin."') <= 0 OR DATEDIFF(RE.CheckOut,  '".$checkout."') <= 0))									
//                                                     AND R2.Price = (SELECT min(R3.Price)
//                                                                 FROM ROOM R3
//                                                                 WHERE R3.BedNum = 2 AND R3.HotelID = H.HotelID
//                                                                 AND NOT EXISTS (SELECT *
//                                                                                 FROM RESERVATION RE2
//                                                                                 WHERE RE2.RoomID = R3.RoomID
//                                                                                 AND RE2.Status_Reservation in (1,3)
//                                                                                 AND (DATEDIFF(RE2.CheckIn, '".$checkin."') <= 0 OR DATEDIFF(RE2.CheckOut,  '".$checkout."') <= 0))
//                                                                 GROUP BY R3.HotelID)
//                                                     )
//     GROUP BY H.HotelID, H.HotelName, H.Image_Hotel, H.Address_Hotel, R.Price, R.TypeOfRoom
//     ORDER BY R.PRICE DESC;";
    
//     $result = mysqli_query($con, $sql);

//     return $result;
// }

/*
    function: thongTinPhong
    Ý nghĩa : lấy ra danh sách các phòng của khách sạn được chọn để khách hàng lựa
    Đầu vào: con, hotelName ,checkin, bednum
    File sử dụng: Search_Property.php
*/
function thongTinPhong($con, $proID ,$checkin, $checkout, $bednum){

    $sql = "SELECT *\n"

        . "FROM ROOM \n"

        . "WHERE RoomID IN (SELECT R.ROOMID\n"

        . "                FROM ROOM R JOIN PROPERTY P ON R.PropertyID = P.PropertyID\n"

        . "                WHERE P.PropertyID = '".$proID."' AND BedNum = '".$bednum."' AND RoomID NOT IN(SELECT ROOMID\n"

        . "                                    							                                   FROM reservation)\n"

        . "                      UNION\n"

        . "                SELECT R.ROOMID\n"

        . "                FROM room R JOIN reservation RE ON R.RoomID = RE.RoomID
                                       JOIN PROPERTY P ON R.PropertyID = P.PropertyID\n"

        . "                WHERE P.PropertyID = '".$proID."' AND BedNum = '".$bednum."' AND  RE.RoomID NOT IN(SELECT ROOMID\n"

        . "                                                                       FROM reservation RE2\n"

        . "                                                                       WHERE (RE2.CheckIn = '".$checkin."' AND RE2.CheckOut = '".$checkout."')
                                                                                    OR (RE2.CHECKIN BETWEEN '".$checkin."' and '".$checkout."')
                                                                                    OR (RE2.CHECKOUT BETWEEN '".$checkin."' and '".$checkout."')));";
    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: thongtinKhachSan
    Ý nghĩa : Thông tin khách sạn được người dùng tra cứu
    Tham số đầu vào: con,hotelName
    File sử dụng: Search_Property.php
*/
function thongtinKhachSan($con ,$proID){

    $sql = "SELECT PropertyName, Detail_Property, CheckInTime, CheckOutTime, Address_Property, E.Point, C.CustomerName, C.Country, E.Comment, E.timeComment, P.PropertyID, RE.CheckIn, RE.CheckOut

            FROM PROPERTY P JOIN evaluate_Property E ON P.PropertyID = E.PropertyID
            
                                JOIN customer C ON E.CustomerID = C.CustomerID
                                JOIN ROOM R ON R.PropertyID = P.PropertyID
                                JOIN reservation RE ON RE.RoomID = R.RoomID
            
                WHERE P.PropertyID = '".$proID."'
            
                ORDER BY E.Point DESC
            
                LIMIT 1;";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: dichvuKhachSan
    Ý nghĩa : Thông tin về các dịch vụ khách sạn
    Tham số đầu vào: con, proID
    File sử dụng: Search_Property.php
*/
function dichvuKhachSan($con ,$proID){
    $sql = "SELECT SE.ServiceName
            FROM PROPERTY PRO JOIN service_supplied SS ON SS.PropertyID = PRO.PropertyID
                                JOIN service SE ON SE.ServiceID = SS.ServiceID
            WHERE PRO.PropertyID = '".$proID."';";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: imageRoom
    Ý nghĩa : Hình ảnh các phòng
    Tham số đầu vào: con,hotelName
    File sử dụng: Search_Property.php
*/
function imageRoom($con ,$proID){

    $sql = "select image_room
            from room
            where propertyID = '".$proID."'
            order by roomID
            limit 5;";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: reservationInthepast
    Ý nghĩa : Thông tin booking đã booking và đã ở
    Tham số đầu vào: con, accID
    File sử dụng: Customer_viewBooking.php
*/
function reservationInthepast($con, $accID){

    $sql = "SELECT R.Image_Room, P.PropertyName, R.RoomName, RE.Status_Reservation, re.Total, R.TypeOfRoom, RE.ReservationID\n"

        . "FROM room R JOIN PROPERTY P ON R.PropertyID = P.PropertyID\n"

        . "			   JOIN reservation RE ON R.RoomID = RE.RoomID\n"

        . "WHERE R.RoomID IN (SELECT re.RoomID\n"

        . "                   FROM reservation re)\n"

        . "AND CustomerID IN (SELECT CustomerID\n"

        . "				      FROM account A JOIN customer C ON A.AccountID = C.AccountID\n"

        . "                   WHERE A.AccountID = '".$accID."')\n"

        . "AND RE.CheckIn <= CURDATE()"
        . "AND Status_Reservation IN(2, 4, 5)";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: reservationUpcoming
    Ý nghĩa : Thông tin booking đã booking nhưng chơi tới ngày ở
    Tham số đầu vào: con, accID
    File sử dụng: Customer_viewBooking.php
*/
function reservationUpcoming($con, $accID){

    $sql = "SELECT R.Image_Room, P.PropertyName, R.RoomName, P.CheckInTime, RE.CheckIn, re.Total,  R.TypeOfRoom, RE.ReservationID\n"

            . "FROM room R JOIN PROPERTY P ON R.PropertyID = P.PropertyID\n"

            . "			   JOIN reservation RE ON R.RoomID = RE.RoomID\n"

            . "WHERE CustomerID IN (SELECT CustomerID\n"

            . "				        FROM account A JOIN customer C ON A.AccountID = C.AccountID\n"

            . "                     WHERE A.AccountID = '".$accID."')\n"

            . "AND RE.CheckIn >= CURDATE()"
            . "AND Status_Reservation = 1";

        $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: manageBooking
    Ý nghĩa : Thông tin booking đầy đủ
    Tham số đầu vào: con, ProName, accID, roomName
    File sử dụng: Manage_Booking.php
*/
function manageBooking($con, $ProName, $accID, $roomName){

    $sql = "SELECT R.Image_Room, P.PropertyName, RE.ReservationID,  P.Phone_Property, P.Address_Property, RE.CheckIn, RE.CheckOut, P.CheckInTime, P.CheckOutTime, RE.Status_Reservation
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
                                JOIN PROPERTY P ON R.PropertyID = P.PropertyID
                                JOIN customer C ON C.CustomerID = RE.CustomerID
                                JOIN account A ON C.AccountID = A.AccountID
            WHERE P.PropertyName = '".$ProName."' AND A.ACCOUNTID = '".$accID."' AND r.RoomName = '".$roomName."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: pointPropertyInMangeBooking
    Ý nghĩa : Thông tin điểm khách sạn đã book
    Tham số đầu vào: con, ProName
    File sử dụng: Manage_Booking.php
*/
function pointPropertyInMangeBooking($con, $ProID){

    $sql = "SELECT AVG(E.Point)
            FROM PROPERTY PRO JOIN evaluate_property E ON PRO.PropertyID = E.PropertyID
            WHERE PRO.PropertyID = '".$ProID."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: CustomerReview
    Ý nghĩa : Những bài đáh giá của customer
    Tham số đầu vào: con, accID
    File sử dụng: Customer's_Review.php
*/
function CustomerReview($con, $accID){

    $sql = "select P.Image_Property,P.PropertyName, e.timeComment, e.Point, e.Comment, e.evaHotelID
            from ACCOUNT a join CUSTOMER c on a.AccountID = c.AccountID
                           join EVALUATE_PROPERTY e on e.CustomerID = c.CustomerID
                           join PROPERTY P on P.PropertyID = e.PropertyID
            where a.AccountID = '".$accID."'
            ORDER BY e.timeComment DESC";

    $result = mysqli_query($con, $sql);

    return $result;
}

/*
    function: CustomerReviewDetail
    Ý nghĩa : Thông tin do Property kiểm tra và chỉnh sửa
    Tham số đầu vào: con, evaID
    File sử dụng: Detail_Review.php
*/
function CustomerReviewDetail($con, $evaID){

    $sql = "select P.Image_Property,P.PropertyName, re.checkin, re.CheckOut, e.Point, e.Comment, e.timeComment
    from ACCOUNT a join CUSTOMER c on a.AccountID = c.AccountID
                   join EVALUATE_Property e on e.CustomerID = c.CustomerID
                   join PROPERTY P on P.PropertyID = e.PropertyID
                   join room r on r.PropertyID = p.PropertyID
                   join reservation re on re.RoomID = r.RoomID
    where  evaHotelID = '".$evaID."' ";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}

/*
    function: hotelInformationForReview
    Ý nghĩa : Thông tin do Property kiểm tra và chỉnh sửa
    Tham số đầu vào: con, reserID
    File sử dụng: Customer_Review.php
*/
function hotelInformationForReview($con, $reserID){

    $sql = "SELECT PRO.Image_Property, PRO.PropertyName, PRO.Address_Property, RE.CheckIn, RE.CheckOut, RE.Status_Reservation
            FROM RESERVATION RE JOIN ROOM R ON RE.RoomID = R.RoomID
                                JOIN PROPERTY PRO ON R.PropertyID = PRO.PropertyID
            WHERE RE.ReservationID = '".$reserID."';";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;
}


?>