<?php 
    echo date_default_timezone_get()."\n";
    date_default_timezone_set("Asia/Dhaka");
    echo date("d-m-y D h:i:s a")."\n";
    echo date("d/M/Y l H:i:s A")."\n";
    echo date("F")."\n";

    // mktime
    // hour minute second month day year
    $myTime = mktime(15, 6, 7, 8, 9, 2037);
    echo date("d/F/Y l H:i:s A", $myTime)."\n";

    // strtotime
    $str1 = strtotime("today");
    $str2 = strtotime("next day");
    $str3 = strtotime("previous day");
    $str4 = strtotime("next friday");
    $str5 = strtotime("+5 years +4 months +10 days +20 hours +30 minutes");

    echo date("d/F/Y l H:i:s A", $str1)."\n";
    echo date("d/F/Y l H:i:s A", $str2)."\n";
    echo date("d/F/Y l H:i:s A", $str3)."\n";
    echo date("d/F/Y l H:i:s A", $str4)."\n";
    echo date("d/F/Y l H:i:s A", $str5)."\n";

    // print the dats of next 7 fridays
    $start_date = strtotime("next friday");
    $end_date = strtotime("+6 weeks", $start_date);

    while ($start_date <= $end_date) {
        echo date("d/F/Y l", $start_date)."\n";
        $start_date = strtotime("+1 weeks", $start_date);
    }

    // getdate()
    echo date("U");
    print_r(getdate());

    // difference
    $date1 = date_create("2027-09-10");
    $date2 = date_create(date("Y-m-d"));
    $diff = date_diff($date1, $date2);
    // print_r($diff);
    echo $diff->y." Years ".$diff->m." Months ".$diff->d." Days.\n";
?>