<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
    <head>
        <title>Examples of PHP and MySQL part 1</title>
        <style>
            ul {
                list-style: none;
            }
        </style>
    </head>
    <body>
        <ul>
            <li>Short open tags:</li>
            <ul>
                <li>< ? &emsp; ? ></li>
                <li>< ?= &emsp; ? ></li>
            </ul>
            <li>Examples of variables:</li>
            <ul>
                <li>$item</li>
                <li>$Item</li>
                <li>$myVariable</li>
                <li>$this_variable</li>
                <li>$this-variable</li>
                <li>$product3</li>
                <li>$_book</li>
                <li>$__bookPage</li>
                <a href="http://www.php.net/manual/en/reserved.php">Reserved variables</a>
            </ul>
            <?php
                $greeting = 'Hello';
                $target = 'world';
                $phrase = $greeting.' '.$target;
                echo '<b>String phrase: </b><br>&emsp;'.$phrase;
                echo "<br>&emsp;{$phrase}";
                echo "<br>&emsp;$phrase";
                echo '<br><b>String functions: </b>';
                echo '<br>&emsp;Lowercase: '.strtolower($phrase);
                echo '<br>&emsp;Uppercase: '.strtoupper($phrase);
                echo '<br>&emsp;Uppercase first: '.ucfirst($phrase);
                echo '<br>&emsp;Lowercase words: '.ucwords($phrase);
                echo '<br><b>----------------------------------------</b>';
                echo '<br>&emsp;Length of string: '.strlen($phrase);
                echo '<br>&emsp;Trim: A'.trim(' B  C D  ').'E'; // trims only spaces around
                echo '<br>&emsp;Find: '.strstr($phrase, 'world'); // found = returns found word, not found = returns empty
                echo '<br>&emsp;Replace by string: '.str_replace('world', 'universe', $phrase); // found = returns replaced, not found returns not replaced
                echo '<br><b>----------------------------------------</b>';
                echo '<br>&emsp;Repeat: '.str_repeat($phrase, 2);
                echo '<br>&emsp;Make substring: '.substr($phrase, 5, 10);
                echo '<br>&emsp;Find position: '.strpos($phrase, 'world'); // found = returns string, not found = returns empty
                echo '<br>&emsp;Find character: '.strchr($phrase, 'l'); // returns found character to the end of string
            ?>
            <li><b>Integer functions:</b></li>
            <ul>
                <li>Absolute value: <?php echo abs(0 - 300); ?></li>
                <li>Exponential: <?php echo pow(2, 8); ?></li>
                <li>Square root: <?php echo sqrt(100); ?></li>
                <li>Modulo: <?php echo fmod(20, 7); ?></li>
                <li>Random: <?php echo rand(); ?></li>
                <li>Random (min, max): <?php echo rand(1, 10); ?></li>
                <li>Number plus string: <?php echo 1 + '2 houses'; //error ?></li>
            </ul>
            <li><b>Floating Point functions:</b></li>
            <?php $float = 3.14; ?>
            <ul>
                <li>Round: <?php echo round($float, 1); ?></li>
                <li>Ceiling: <?php echo ceil($float); ?></li>
                <li>Floor: <?php echo floor($float); ?></li>
            </ul>
            <!-- returns 1 or empty -->
            <li>Is integer: <?php echo is_int($float); ?></li>
            <li>Is float: <?php echo is_float($float); ?></li>
            <li>Is numeric: <?php echo is_numeric($float); ?></li>
            <li><b>Array: </b>
            <?php
            // normal array
            $arr = array(1, 'well', 'ok', array(1, 2, 3, 'counting'));
            $arrSame = [1, 'well', 'ok', [1, 2, 3, 'counting']];
            print_r($arrSame);
            ?></li>
            <li><b>Associative array: </b>
            <?php
            // Associative array
            $arrAssoc = [1 => 'well', 'ok' => [1 => 2, 'count' => 'counting']];
            print_r($arrAssoc);
            echo '<br><b>Get single value: </b>';
            echo $arrAssoc['ok'][1];
            ?></li>
            <li><b>Array functions: </b></li>
            <?php $numbers = [8, 23, 15, 42, 16, 4]; ?>
            <ul>
                <li>Count: <?php echo count($numbers); ?></li>
                <li>Max value: <?php echo max($numbers); ?></li>
                <li>Min value: <?php echo min($numbers); ?></li>
            
                <li>Sort: <?php echo sort($numbers).' '; print_r($numbers); ?></li>
                <li>Reverse sort: <?php echo rsort($numbers).' '; print_r($numbers); ?></li>
            
                <li>Implode: <?php echo $num_string = implode(" * ", $numbers); ?></li>
                <li>Explode: <?php print_r(explode(" * ", $num_string)); ?></li>
            
                <li>15 in array: <?php echo in_array(15, $numbers); ?></li>
                <li>19 in array: <?php echo in_array(19, $numbers); ?></li>
            </ul>
            <?php
            $null_var = null;
            $set_var = 'var set';
            $empty_var = '';
            ?>
            <li><b>Is true bool: <b><?php echo is_bool(true); ?></li>
            <li><b>Is null: <b><?php echo is_null($null_var); ?></li>
            <li><b>Is set: <b><?php echo isset($set_var); ?></li>
            <li><b>Is set empty var: <b><?php echo isset($empty_var); ?></li>
            <li><b>Is empty: <b><?php echo empty($empty_var); ?></li>
        </ul>
    </body>
</html>