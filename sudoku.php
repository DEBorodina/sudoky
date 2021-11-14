<?php
$time_start = microtime(true);
require_once 'Sudoky_item.php';

//исходные данные
$input = "067102000
000000007
100030000
000360050
000050892
500008003
046200000
000000200
051093004 
";

//расспечатка
function p($sudoky){
    echo "-------------------------\n";
    for($i=0;$i<81;++$i) {
        echo "| ";
        for($j=1;$j<=9;++$j){
            echo $sudoky[$i]->v.(($j%3)?" ":" | ");
            ++$i;
        }
        --$i;
        echo "\n".((($i+1)%27)?"":"-------------------------\n");
    }
}

//создаем судоку
$rows = explode("\n",$input);
array_pop($rows);
foreach ($rows as &$str){
    $str = str_split(trim($str));
}

//создаем массив объектов-элементов судоку
$sudoky = array();
$k=0;
for($i = 0;$i<9;++$i){
    for($j = 0;$j<9;++$j){
        $sudoky[$k++] = new Sudoky_item($rows[$i][$j],$i,$j);
    }
}

//проверяем, можем ли мы поставить элемент на позицию
function CheckItem($sudoky,$item){
    foreach ($sudoky as $i) {
        if($item->v == $i->v){
            if ($i->r == $item->r){
                if($i->c != $item->c) {
                    return false;
                }
            } else if($i->c == $item->c){
                return false;
            }else if ($i->s == $item->s) {
                return false;
            }
        }
    }
    return true;
}

for($i=0;$i<=80;++$i){
    if($sudoky[$i]->empty){
        if($sudoky[$i]->v==9){
            $sudoky[$i]->v=0;
            $t=1;
            while(!$sudoky[$i-$t]->empty){
                ++$t;
            }
            $i=(--$i)-$t;
            continue;
        }
        for ($j=$sudoky[$i]->v+1;$j<=9;++$j){
            $sudoky[$i]->v=$j;
            if(CheckItem($sudoky,$sudoky[$i])){
                break;
            }else if($j==9){
                $sudoky[$i]->v=0;
                $t=1;
                while(!$sudoky[$i-$t]->empty){
                    ++$t;
                }
                $i=(--$i)-$t;
            }
        }
    }
}

p($sudoky);
echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);

