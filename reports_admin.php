<?php
    session_start();

    function get_filtered_data($query, $date)
    {
        $db_name     = "keopidb";
        $db_username = "root";
        $db_pass     = "";
        $db_host     = "localhost";
        $connection  = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");         
        
        $results = mysqli_query($connection, $query);
        $exists  = mysqli_num_rows($results);
        
        $filtered_data = array();
        
        if($exists != 0)
        {
            while($row = mysqli_fetch_assoc($results))
            {
                $filtered_data[] = $row;
                print '<script>console.log("'.$row['name'].'");</script>';
            }   
        }
        return $filtered_data;
    }
    
    // Default values
    $date_filter  = new DateTime();
    $date_filter  = $date_filter->format('Y-m-d');
    $range_filter = "daily";
    $query = 'SELECT * FROM transactions '.
             'INNER JOIN products on transactions.product_num = products.product_num ';

    $date_clause    = 'WHERE transaction_date = DATE("'.$date_filter.'") ';

    if(isset($_GET['date_filter']) && isset($_GET['range_filter']))
    {
        if($_GET['range_filter'] == 'daily')
        {
            $date_param  = new DateTime($_GET['date_filter']);
            $date_clause = 'WHERE transaction_date = DATE("'.$date_param->format('Y-m-d').'")';
        } 
        else if ($_GET['range_filter'] == 'monthly')
        {
            $date_param  = new DateTime($_GET['date_filter']);
            $date_start  = clone $date_param;
            $date_end    = clone $date_param;

            $date_start->modify('first day of this month');
            $date_end->modify('last day of this month');

            $date_clause = 'WHERE transaction_date >= DATE("'.$date_start->format("Y-m-d").'") '.
                           'AND transaction_date <= DATE("'.$date_end->format("Y-m-d").'")';
        }
    }
    $query = $query." ".$date_clause;
    
    $filtered_data = get_filtered_data($query, $date_filter);
    //print $query;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@200;300;400;600;700;800&family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <title>Reports &#8211; Admin</title>

    <link rel="stylesheet" href="css/reports_styles.css" />
</head>

<body>
    <div class="d-flex flex-row min-vh-100" id="">
        <div class="side-nav d-none d-md-block">
            <div class="text-center pt-3 mb-3">
                <img src="img/keopi-logo-transparent-black.png" style="width: 100%;" />
            </div>
            <div class="d-flex flex-column">
                <a class="side-nav-item" href="#">
                    <div class="px-3 py-3">
                        <p class="my-0">Transact</p>
                    </div>
                </a>
                <a class="side-nav-item" href="#">
                    <div class="px-3 py-3">
                        <p class="my-0">Add Transaction</p>
                    </div>
                </a>
                <a class="side-nav-item" href="#">
                    <div class="px-3 py-3">
                        <p class="my-0">Products</p>
                    </div>
                </a>
                <a class="side-nav-item side-nav-selected" href="#">
                    <div class="px-3 py-3">
                        <p class="my-0">Reports</p>
                    </div>
                </a>
                <a class="side-nav-item" href="#">
                    <div class="px-3 py-3">
                        <p class="my-0">Logout</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="main-content flex-grow-1">
            <div class="container-lg">
                <div class="row row-cols-1 row-cols-lg-2 px-4 py-4">
                    <!-- left side table -->
                    <div class="col-lg-8 mid-bg px-md-3 pb-3">
                        <div class="round-bg mb-3">
                            <h2 class="fw-bold text-color-brown">Reports</h2>
                            <hr />
                            <div class="d-flex flex-row justify-content-between">
                                <div class="d-flex flex-row flex-md-row">
                                    <span class="mx-2"><a href="#" id="filter-daily" class="filter">Daily</a></span>
                                    <span class="mx-2"><a href="#" id="filter-monthly" class="filter">Monthly</a></span>
                                </div>
                                <div class="d-flex flex-column flex-md-row">
                                    <span class="mx-2">Date to filter </span>

                                    <form action="reports_admin.php" id="filter_form" class="mb-0" method="GET">
                                        <input type="hidden" name="range_filter" id="range_filter" value="daily" onchange="this.form.submit();" />
                                        <input class="fw-light" name="date_filter" id="date_filter" type="date" style="border-radius: 4px; border: 1px solid #6c757d" onchange="this.form.submit();" />
                                    </form>                                    
                                </div>

                            </div>
                        </div>

                        <div class="round-bg">
                            <p class="h4 fw-regular text-color-brown mb-3">Daily Transactions</p>
                            <div class="mb-4">
                                <?php 
                                if(!empty($filtered_data))
                                {
                                    print ' <table class="table table-responsive table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Product</th>
                                                        <th>Order #</th>
                                                        <th>Cancelled?</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                    
                                    $qty_products_sold = 0;
                                    $total_sales       = 0;
                                    $product_stats     = array();

                                    foreach ($filtered_data as $transaction) 
                                    {
                                        $row_fmt = '<tr style="cursor: pointer;" onclick="select_row(\'%s\')">
                                                        <th scope="row">%s</th>
                                                        <td>%s</td>
                                                        <td>%s</td>
                                                        <td align="left">%s</td>
                                                        <td>%s</td>
                                                    </tr>';

                                        $product_name  = $transaction['name'];
                                        $cancelled     = $transaction['cancelled'] == 0 ? "No" : "Yes";
                                        $transact_date = new DateTime($transaction['transaction_date']);
                                        

                                        if (isset($product_stats[$product_name])) {
                                            $product_stats[$product_name]['qty']++;
                                            $product_stats[$product_name]['price'] += $transaction['price'];
                                        } else {
                                            $product_stats[$product_name]['qty']   = 1;
                                            $product_stats[$product_name]['price']  = $transaction['price'];
                                        }

                                        print sprintf(
                                            $row_fmt,
                                            $product_name,
                                            $transaction['transaction_num'],
                                            $transact_date->format('M d, Y'),
                                            $transaction['name'],
                                            $transaction['order_num'],
                                            $cancelled
                                        );
                                        $qty_products_sold++;

                                        // TODO: Incorporate transaction qty field
                                        $total_sales += (float)($transaction['price']);
                                    }
                                    print '</tbody></table>';
                                } else
                                {
                                    print '<p id="no-selected-text" class="text-muted text-center">There are no transactions within the selected time frame.</p>';
                                }
                                ?>
                            </div>
                            
                            <?php
                                if(!empty($filtered_data))
                                {
                                    print ' <p class="h4 fw-regular text-color-brown mb-3">Visualizations</p>
                                                <div class="container">
                                                    <canvas id="myChart" class="mb-1" style="width:100%;max-width:100%"></canvas>
                                                </div>';
                                }
                            ?>
                        </div>
                    </div>

                    <!-- Right side summary -->
                    <div class="col-lg-4 px-3">
                        <div class="round-bg">
                            <h2 class="fw-bold text-color-brown">Daily Summary</h2>
                            <hr />
                            <div class="summary-stat mt-3 text">
                                <h1 class="fw-bold mb-0 font-round" style="font-size: 2.25em;"><?php print empty($filtered_data) ? 0 : $qty_products_sold; ?></h1>
                                <h3 class="lead" style="font-size: 1.25em;">Products Sold</h3>
                            </div>
                            <div class="summary-stat mt-4">
                                <h1 class="fw-bold mb-0 font-round" style="font-size: 2.25em;">PHP <?php print empty($filtered_data) ? "0.00" : number_format($total_sales, 2); ?></h1>
                                <h3 class="lead" style="font-size: 1.25em;">Total sales</h3>
                            </div>
                            
                            <hr />
                            <p id="no-selected-text" class="text-muted text-center">There is currently no product selected.</p>
                            <div id="select-info-container" class="flex-column justify-content-center mx-auto" style="display: none;">
                                
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <p>Selected:</p>
                                    </div>
                                    <div><b id="selected-name">Product #1</b></div>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <p>Total Quantity:</p>
                                    </div>
                                    <div>
                                        <p id="selected-qty">100 pcs</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <p>Total Price: </p>
                                    </div>
                                    <div>
                                        <p>PHP <span id="selected-price">PHP 500.00</span> </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row mt-3 justify-content-end">
                                    <div><button id="edit-btn" class="btn btn-secondary button-col-dark">Edit product</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        datepicker = document.getElementById('date_filter');
        const query_string = window.location.search;
        const url_params   = new URLSearchParams(query_string);

        if(url_params.has("date_filter")) {
            datepicker.valueAsDate = new Date(url_params.get("date_filter"));
            console.log(datepicker);
        } else {
            datepicker.valueAsDate = new Date();
        }

        filter_form  = document.getElementById("filter_form");
        range_value  = document.getElementById("range_filter");
        link_daily   = document.getElementById("filter-daily");
        link_monthly = document.getElementById("filter-monthly");

        if(url_params.has("range_filter") && url_params.get("range_filter") == "monthly") {
            link_daily.classList.add("filter-not-selected", "fw-light", "text-muted");
            link_monthly.classList.add("filter-selected", "fw-regular");
        } else {
            link_monthly.classList.add("filter-not-selected", "fw-light", "text-muted");
            link_daily.classList.add("filter-selected", "fw-regular");
        }

        link_daily.onclick = function() {
            range_value.value = "daily";
            filter_form.submit();
        }

        link_monthly.onclick = function() {
            range_value.value = "monthly";
            filter_form.submit();
        }

        product_stat = <?php print !empty($filtered_data) ? json_encode($product_stats) : "{}" ?>;

        <?php 
            if(!empty($filtered_data))
            {
                print "const data = {
                    labels: Object.keys(product_stat),
                    datasets: [{
                        label: Object.keys(product_stat),
                        data: Object.values(product_stat).map(product => product.qty),
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 205, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(201, 203, 207, 1)'
                        ],
                        hoverOffset: 4,
                    }]
                };
        
                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    precision: 0
                                },
                                beginAtZero: true
                            }
                        }
                    }
                };
                
                
                ";
            }
        ?>

        const myChart = new Chart(
            document.getElementById('myChart'),
            config, 

        );

        function select_row(product_name) 
        {
            select_container = document.getElementById("select-info-container");
            selected_name    = document.getElementById("selected-name");
            selected_price   = document.getElementById("selected-price");
            selected_qty     = document.getElementById("selected-qty");
            edit_btn = document.getElementById("edit-btn");

            if(product_name in product_stat)
            {
                select_container.style.display = "flex";
                selected_name.innerHTML  = product_name;
                selected_qty.innerHTML   = product_stat[product_name].qty;
                selected_price.innerHTML = (Math.round(product_stat[product_name].price * 100) / 100).toFixed(2);
                edit_btn.onclick = function() {
                    window.location.assign("reports.php");
                }
                edit_btn.enabled = true;
                document.getElementById("no-selected-text").style.display = "none";
            } else
            {
                select_container.style.display = "none";
                edit_btn.disabled = true;
                document.getElementById("no-selected-text").style.display = "block";
            }
        }
    </script>

</body>

</html>