<?php
/**
 * Created by michaelwatts
 * Date: 02/04/2014
 * Time: 09:21
 */

namespace mw;


class Brands {

    public $file = "";

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    public function data()
    {
        return json_decode(file_get_contents($this->getFile()), true);
    }

    /**
     * Returns everything and structures it so brands fall
     * under their countries
     * @return array
     */
    public function data_array()
    {

        $brands_array = $this->data();

        $a = [];
        $b = -1;

        foreach($brands_array as $brands) {

            if ($brands[0] == "Country"){
                $a[] = [
                  "Country" => $brands[1]
                ];
                $b++;
            } else {
                $a[$b][] = [
                  "name" => $brands[0],
                  "total_stores" => $brands[1]
                ];
            }
        }
        return $a;
    }

    /**
     * Returns countries and not brands
     * @return array
     */
    public function get_countries()
    {
        $arr = [];
        foreach($this->data_array() as $country){
            $arr[] = $country["Country"];
        }
        return $arr;
    }

    /**
     * Returns total number of countries
     * @return int
     */
    public function total_countries()
    {
        return count($this->data_array());
    }

    /**
     * Returns brands (all) and not countries
     * @return array
     */
    public function get_brands()
    {

        $brands_array = $this->data();

        $a = [];

        foreach($brands_array as $brands) {

            if ($brands[0] != "Country"){
                $a[] = [
                  "name" => $brands[0],
                  "total_stores" => $brands[1]
                ];
            }
        }
        return $a;
    }

    /**
     * @param $brand_name
     * @return int
     */
    public function count_stores($brand_name = "All")
    {
        $cnt = 0;

        if ($brand_name != "All"){
            foreach($this->get_brands() as $brand){
                if($brand["name"] == $brand_name){
                    $cnt += $brand["total_stores"];
                }
            }
        } else {
            // count all
            foreach($this->get_brands() as $brand){
                $cnt += $brand["total_stores"];
            }
        }

        if($cnt == 0){
            echo "brand not found";
        } else {
            return $cnt;
        }
    }

    /**
     * Returns all brand names
     * Set $unique to false to return non-unique brand names
     * @param bool $unique
     * @return array
     */
    public function brand_names($unique = true)
    {
        $a = [];

        foreach($this->get_brands() as $brand){
            $a[] = $brand["name"];
        }

        if ($unique == true) {
            return array_unique($a);
        } else {
            return $a;
        }
    }

    public function stores_per_country()
    {

        $data_array = $this->data();
        $a = [];
        $b = [];
        $i = -1;
        $num = 0;

        foreach($data_array as $brands) {

            if ($brands[0] == "Country"){
                $a[] = [
                    "name" => $brands[1],
                    "total_stores" => $b
                ];
                $i++;
                $num = 0;
            }
            elseif ($brands[0] != "Country"){
                $num += $brands[1];
                $a[$i]["total_stores"] = $num;
            }
        }
        return $a;
    }

    public function stores_per_brand_per_country($brand_name = "All", $country_name = "All")
    {

        $data_array = $this->data();
        $i = -1;
        $num = 0;

        // return all stores total
        if($country_name == "All"){
            return $this->count_stores();
        }

        foreach($data_array as $brands) {
            if ($brands[1] == $country_name) {
                echo $brands[1];
            }
//            if ($brands[0] == "Country") {
//                $i++;
//            }
//            if ($brands[0] == $brand_name) {
//                echo $brands[1];
//            }
        }
//        return $num;

    }


    /**
     * debugging
     */
    public function to_string()
    {
        echo "<pre>";
        print_r($this->data_array());
        echo "</pre>";
    }

    public function to_json()
    {
        echo "<pre>";
        echo json_encode($this->data_array());
        echo "</pre>";
    }
} 