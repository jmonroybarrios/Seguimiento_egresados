<?php

if (isset($_GET['search']))
{

    $search = $_GET['search'];
    
    
    $data = file_get_contents('https://api-manager.universia.net/empleo/offers/v2/boards/82a63648-7e60-46f9-9aed-8c1985ef4c0b/job_postings/public/?jobOrCompany=' . $search . '&page=1&limit=10');

    echo '<pre>';

    $json = json_decode($data, true);

    print_r($json);
    echo '</pre>';

}

function get_fcontent($url, $method = 'GET', $data = null, $headers = null, $javascript_loop = 0, $timeout = 5, $get_widht_header = null)
{
    $url = str_replace("&amp;", "&", urldecode(trim($url))); //$cookie = tempnam ("./tmp", "CURLCOOKIE");
    //$cookie = './tmp / cookies.txt';

    $cookieFile = "./tmp/cookies.txt";
    if (!file_exists($cookieFile))
    {
        $fh = fopen($cookieFile, "w");
        fwrite($fh, "");
        fclose($fh);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); # required for https urls
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_POST, (($method == 'POST') ? 1 : 0));
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    if (!empty($data))
    {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    if (!empty($headers))
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    if (!empty($get_widht_header))
    {
        curl_setopt($ch, CURLOPT_HEADER, 1);
    }

    $content = curl_exec($ch);
    if (curl_error($ch))
    {
        trigger_error('Curl Error:' . curl_error($ch));
        throw new Exception('Error!');
    }

    $response = curl_getinfo($ch);
    curl_close($ch);
    if (!empty($get_widht_header))
    {
        return array($this->reponseHeaderToArray($content), $response);
    }

    return array($content, $response);
}

?>

<form>

<input type="text" name="search" />
<input type="submit" name="envio" value="Buscar" />
</form>