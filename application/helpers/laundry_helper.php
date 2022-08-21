<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * This function used to get the CI instance
 */
if (!function_exists('get_instance')) {
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if (!function_exists('getHashedPassword')) {
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if (!function_exists('verifyHashedPassword')) {
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if (!function_exists('getBrowserAgent')) {
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser()) {
            $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
        } else if ($CI->agent->is_robot()) {
            $agent = $CI->agent->robot();
        } else if ($CI->agent->is_mobile()) {
            $agent = $CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if (!function_exists('setFlashData')) {
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

function renderPdf($nama_dokumen, $html)
{

    // ini_set("memory_limit", "-1");
    $style = '<style>
    hidden {
        display: none;
    }</style>';

    $html .= $style;
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetVisibility('screenonly');
    $mpdf->WriteHTML($html);
    $mpdf->Output($nama_dokumen . ".pdf", 'D');
}

function FormatPeriod_($cKey)
{
    return Left($cKey, 2) . "/" . Right($cKey, 4);
}

function Left($Str, $Len)
{
    return substr($Str, 0, $Len);
}

function Right($Str, $Len)
{
    return substr($Str, -$Len);
}

function Mid($Str, $Start, $Len)
{
    return substr($Str, $Start, $Len);
}

function SetPeriod_($cKey)
{
    return Left($cKey, 2) . Right($cKey, 4);
}

function SetAcc_($cKey)
{
    return Left($cKey, 4) . Right($cKey, 4);
}

function FormatAcc_($cKey)
{
    return Left($cKey, 4) . "." . Right($cKey, 4);
}

function FormatDate_($cDate, $cFormat)
{
    return date($cFormat, strtotime($cDate));
}

function FormatNo_($cKey)
{
    return Left($cKey, 2) . "-" . Mid($cKey, 2, 4) . "/" . Mid($cKey, 6, 2) . "-" . Right($cKey, 4);
}

function SetNo_($cKey)
{
    return Left($cKey, 2) . Mid($cKey, 3, 4) . Mid($cKey, 8, 2) . Right($cKey, 4);
}

// function FormatCurrency_($cKey)
// {
//     return number_format($cKey, DEC_PRC);
// }

// function FormatMoney_($cKey)
// {
//     if ($cKey >= 0)
//         return number_format($cKey, DEC_PRC);
//     else
//         return '(' . number_format(abs($cKey), DEC_PRC) . ')';
// }

function Space_($nLen)
{
    return str_repeat("&nbsp;", $nLen);
}

function CekDatabase_($dbName)
{
    $CI = get_instance();
    $row =  $CI->db->query("SHOW DATABASES LIKE '%$dbName%'")->num_rows();
    if ($row > 0)
        return true;
    else
        return false;
}

function Sort_($array, $on, $order = SORT_ASC)
{

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function Find_($arrData, $colName, $strToFind)
{

    $result = in_array($strToFind, array_column($arrData, $colName));

    return $result;
}

function replace_mychar($str)
{
    $string = str_replace(['\'', '"'], '`', $str);
    return $string;
}

function blank_to_zero($str)
{
    $zero = $str && $str != 'NaN' && $str != 'null' && $str != 'NULL' && $str != 'undefined' && $str != 'Undefined' ? $str : 0;
    return $zero;
}

function getWhOption($aksesGd, $dataGudang, $dataWh)
{
    $j = 0;
    for ($i = 0; $i < count($dataWh); $i++) {
        if (in_array($dataGudang[$i]['KODE'], $aksesGd)) {
            $j += 1;
        } else {
            unset($dataGudang[$i]);
        }
    }

    if ($j > 0) {
        // print_r($dataGudang);
        return $dataGudang;
    }
    // print_r($dataWh);
    return $dataWh;
}

function cekStokExcel($barang, $group, $gd, $tanggal)
{
    $CI = &get_instance();
    $CI->load->model('Persediaan_model');

    $queryStokMasuk = $CI->Persediaan_model->getStokMasuk($barang, $group, $gd, $tanggal);

    $stokmasuk = $queryStokMasuk['stokmasuk'];

    $queryStokKeluar = $CI->Persediaan_model->getStokKeluar($barang, $group, $gd, $tanggal);

    $stokkeluar = $queryStokKeluar['stokkeluar'];

    $hasilpengecekan = ($stokmasuk - $stokkeluar);

    return $hasilpengecekan;
}

function dateToWeek($qDate)
{
    $dt = strtotime($qDate);
    $day  = date('j', $dt);
    $month = date('m', $dt);
    $year = date('Y', $dt);
    $totalDays = date('t', $dt);
    $weekCnt = 1;
    $retWeek = 0;
    for ($i = 1; $i <= $totalDays; $i++) {
        $curDay = date("N", mktime(0, 0, 0, $month, $i, $year));
        if ($curDay == 7) {
            if ($i == $day) {
                $retWeek = $weekCnt + 1;
            }
            $weekCnt++;
        } else {
            if ($i == $day) {
                $retWeek = $weekCnt;
            }
        }
    }
    return $retWeek;
}
