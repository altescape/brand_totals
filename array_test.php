<?php
/**
 * Created: michaelwatts
 * Date: 02/04/2014
 * Time: 23:22
 */


$a = [
    [
        "name" => "arse face",
        [
            "colour" => "black",
            "number" => 3
        ],
        [
            "colour" => "white",
            "number" => 6
        ],
        [
            "colour" => "blue",
            "number" => 2
        ]
    ],
    [
        "name" => "Shitville tenessee",
        [
            "colour" => "pink",
            "number" => 8
        ],
        [
            "colour" => "yella",
            "number" => 5
        ],
        [
            "colour" => "purple",
            "number" => 1
        ]
    ]
];

echo "<pre>";
print_r($a);
echo "</pre>";

for ($i = 0; $i < count($a); ++$i) {

//    print_r($a[$i]);
    echo "<h3>" . $a[$i]["name"] . "</h3>";

    $tot = 0;
    for ($j = 0; $j < count($a[$i]) - 1; ++$j) {
        echo "<li>" . $a[$i][$j]["number"] . "</li>";
        $tot += $a[$i][$j]["number"];
    }
    echo "<li><b>" . $tot . "</b></tot>";
}


//
//foreach($a as $key){
//    foreach($key as $inner_key){
//        echo "<br><br>" . $inner_key . "<br>";
//        foreach($inner_key as $sharted){
//            print_r($sharted);
//        }
//    }
//}
