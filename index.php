<?php

include "Brands.php";

$brands = new \mw\Brands;
$brands->setFile("brands.json");

//echo "<pre>";
//print_r($brands->brands_per_country());
//echo "</pre>";


echo $brands->stores_per_brand_per_country("Miss Selfridge", "KSA");

// Debugging
$brands->to_string();
?>

<html>
<head>
    <title>Check brands</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1-beta1/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <style>
        .m-top-0 {
            margin-top: 0;
        }
        .m-bot-0 {
            margin-bottom: 0;
        }
        .m-top-5 {
            margin-top: 5px;
        }

    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form method="get" class="form-horizontal" role="form">

                <div class="page-header">
                    <h1>STORES</h1>
                </div>

                <div class="form-group well">
                    <label class="control-label col-sm-3">PER BRAND</label>
                    <div class="col-sm-7">
                        <select name="brand" class="form-control">
                            <option value="<?= $brands->count_stores(); ?>">All</option>
                            <?php
                            foreach($brands->brand_names() as $brand){
                                ?>
                                <option value="<?= $brands->count_stores($brand); ?>"><?= $brand; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <h1 class="m-top-0 m-bot-0"><span id="brand_totals" class="label label-warning"></span></h1>
                    </div>
                </div>
                <div class="form-group well">
                    <label class="control-label col-sm-3">PER COUNTRY</label>
                    <div class="col-sm-7">
                        <select name="country" class="form-control">
                            <?php
                            foreach($brands->stores_per_country() as $country){
                                ?>
                                <option value="<?= $country["total_stores"]; ?>"><?= $country["name"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <h1 class="m-top-0 m-bot-0"><span id="country" class="label label-warning"></span></h1>
                    </div>
                </div>
                <div class="form-group well">
                    <label class="control-label col-sm-3">PER BRAND IN COUNTRY</label>
                    <div class="col-sm-3">
                        <select name="bic_brand" class="form-control">
                            <option value="">All</option>
                            <?php
                            foreach($brands->brand_names() as $brand){
                                ?>
                                <option value="<?= $brands->count_stores($brand); ?>"><?= $brand; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-1 text-center">
                        <p class="m-top-5">in</p>
                    </div>
                    <div class="col-sm-3">
                        <select name="bic_country" class="form-control">
                            <option value="<?= $brands->stores_per_brand_per_country(); ?>">All</option>
                            <?php
                            foreach($brands->stores_per_country() as $country){
                                ?>
                                <option value="<?= $country["total_stores"]; ?>"><?= $country["name"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <h1 class="m-top-0 m-bot-0"><span id="country" class="label label-warning"></span></h1>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!--pre>
    <?php //print_r($brands->brand_names()); ?>
    </pre-->

    <?php //print_r($brands->count_brands("Stradivarius")); ?>

    <?php // $brands->to_string(); ?>
    <script>
        $(function() {

            var brand_totals = $('#brand_totals'),
                country = $('#country');

            // BRANDS
            brand_totals.text($('select[name="brand"]').val());

            $('select[name="brand"]').on('change', function(){
                var brand_count = this.value;
                brand_totals.text(brand_count);
            })

            // COUNTRY
            country.text($('select[name="country"]').val());

            $('select[name="country"]').on('change', function(){
                var country_count = this.value;
                country.text(country_count);
            })
        });
    </script>
</body>
</html>



