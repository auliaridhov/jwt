<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('debug')) {
    function debug($variable)
    {
        echo '<pre>';
        print_r($variable);
        echo '</pre>';
        die();
    }
}

if (!function_exists('tangggal_jFY')) {
    function tangggal_jFY($date = '')
    {
        $array_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        if ($date == '') {
            $bulan = $array_bulan[date('n')];
            $output = date('j') . ' ' . $bulan . ' ' . date('Y');
        } else {
            $bulan = $array_bulan[date('n', strtotime($date))];
            $output = date('j', strtotime($date)) . ' ' . $bulan . ' ' . date('Y', strtotime($date));
        }

        return $output;
    }
}

if (!function_exists('tangggal_FY')) {
    function tangggal_FY()
    {
        $array_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = $array_bulan[date('n')];
        $output = $bulan . ' ' . date('Y');

        return $output;
    }
}

if (!function_exists('get_the_current_url')) {
    function get_the_current_url()
    {
        $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
        $base_url = $protocol . '://' . $_SERVER['HTTP_HOST'];
        $complete_url = $base_url . $_SERVER['REQUEST_URI'];

        return $complete_url;
    }
}

if (!function_exists('ping')) {
    function ping($host, $port)
    {
        return @fsockopen($host, $port, $iErrno, $sErrStr, 1);
    }
}

// ------------------------------------------------------------------------
if (!function_exists('date_mysql_to_id')) {
    function date_mysql_to_id($date, $format = "d-m-Y")
    {
        $date = date_create($date);
        $array1 = array('January', 'February', 'March', 'May', 'June', 'July', 'August', 'October', 'December', 'Aug', 'Oct', 'Dec', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $array2 = array('Januari', 'Februari', 'Maret', 'Mei', 'Juni', 'Juli', 'Agustus', 'Oktober', 'Desember', 'Agu', 'Okt', 'Dec', 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
        $new_date = date_format($date, $format);
        $hasil = str_replace($array1, $array2, $new_date);
        return $hasil;
    }
}

// ------------------------------------------------------------------------
if (!function_exists('generate_date_by_day')) {
    function generate_date_by_day($awal, $akhir, $days)
    {
        $day_input = ucfirst($days);
        $begin = new DateTime($awal);
        $end = new DateTime($akhir);
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $array_date_by_id = [];
        $array_hari = array(
            "Sunday" => "Minggu",
            "Monday" => "Senin",
            "Tuesday" => "Selasa",
            "Wednesday" => "Rabu",
            "Thursday" => "Kamis",
            "Friday" => "Jumat",
            "Saturday" => "Sabtu"
        );

        foreach ($period as $dt) {
            $day = $dt->format("l");
            $date = $dt->format("Y-m-d");
            $h = (array_key_exists($day, $array_hari)) ? $array_hari[$day] : $day;

            if ($h == $day_input) {
                $array_date_by_id[] = $date;
            }
        }
        return $array_date_by_id;
    }
}

if (!function_exists('generate_day_by_date')) {
    function generate_day_by_date($date)
    {
        $tanggale = new DateTime($date);
        $dino = $tanggale->format("l");

        $array_hari = array(
            "Sunday" => "Minggu",
            "Monday" => "Senin",
            "Tuesday" => "Selasa",
            "Wednesday" => "Rabu",
            "Thursday" => "Kamis",
            "Friday" => "Jumat",
            "Saturday" => "Sabtu"
        );
        $h = (array_key_exists($dino, $array_hari)) ? $array_hari[$dino] : $dino;
        return $h;
    }
}

if (!function_exists('validate_token')) {
    function validate_token($headers)
    {
        $CI = &get_instance();
        $CI->load->helpers('Jwt');
        $CI->load->helpers('Authorization');

        if (is_array($headers)) {
            if (!array_key_exists("authorization", $headers) && !array_key_exists("Authorization", $headers)) {
                return false;
            }
            if (!array_key_exists("Authorization", $headers)) {
                $headers["Authorization"] = $headers["authorization"];
            }
            if (Authorization::tokenIsExist($headers)) {
                try {
                    $token = Authorization::validateToken($headers['Authorization']);
                    if ($token != false) {
                        return true;
                    } else {
                        return false;
                    }
                } catch (Exception $e) {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
