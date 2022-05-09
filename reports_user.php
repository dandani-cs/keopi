<?php
    session_start();

    function get_filtered_data($query)
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

    $query = 'SELECT products.*, COUNT(transaction_num) AS num_sold FROM products LEFT JOIN '.
             '(%s) t_list on (products.product_num = t_list.product_num) GROUP BY products.product_num ORDER BY product_num;';

    $transact_query = 'SELECT transactions.*, orders.is_cancelled FROM transactions INNER JOIN orders WHERE orders.is_cancelled = 0 AND';
    $date_clause    = 'transaction_date = DATE("'.$date_filter.'")';

    if(isset($_GET['date_filter']) && isset($_GET['range_filter']))
    {
        if($_GET['range_filter'] == 'daily')
        {
            $date_param  = new DateTime($_GET['date_filter']);
            $date_clause = 'transaction_date = DATE("'.$date_param->format('Y-m-d').'")';
        } 
        else if ($_GET['range_filter'] == 'monthly')
        {
            $date_param  = new DateTime($_GET['date_filter']);
            $date_start  = clone $date_param;
            $date_end    = clone $date_param;

            $date_start->modify('first day of this month');
            $date_end->modify('last day of this month');

            $date_clause = 'transaction_date >= DATE("'.$date_start->format("Y-m-d").'") '.
                           'AND transaction_date <= DATE("'.$date_end->format("Y-m-d").'")';
        }
    }
    $transact_query   = $transact_query." ".$date_clause;
    $bestseller_query = 'SELECT products.*, COUNT(transaction_num) AS num_sold FROM products '.
                        'INNER JOIN (SELECT transactions.*, is_cancelled FROM transactions INNER JOIN orders on transactions.order_num = orders.order_num ) tr '. 
                        'on (products.product_num = tr.product_num) WHERE tr.is_cancelled = 0 '.
                        'GROUP BY products.product_num ORDER BY num_sold LIMIT 3;';  // can be changed to top 5 or whatever
    
    $query = sprintf($query, $transact_query);
    //print $query."<br/>".$bestseller_query;
    $filtered_data = get_filtered_data($query);
    $bestsellers   = get_filtered_data($bestseller_query);
    
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="master.css">
        <link rel="stylesheet" href="css/reports_styles.css">
        <title>Keopi | Reports - User</title>
    </head>

    <body>


        <?php
        if ($_SESSION['email']) { //will check if the user is logged-in

        } else { // will return to login page if user not logged-in
            header("location:login.html");
        }
        $userRole = $_SESSION['is_admin']; //gets user role
        ?>

        <!-- navbar -->
        <div class="container-fluid" style="height:100%;">
            <div class="row gx-5">
                <div class="col-sm-2 nav-col">
                    <div class="profile-mini text-center">
                        <img src="img/logo.png" class="rounded mx-auto d-block profile-pic title">
                    </div>
                    <ul class="nav flex-column nav-pills nav-justified">
                        <?php
                        if ($userRole == 1) { //page option will only appear if user is admin
                            print  '<li class="nav-item">
                            <a class="nav-link" aria-current="page" href="user_management.php"><i class="bi bi-people-fill"></i>User Management</a>
                        </li>';
                        } else { //will redirect to orders page if staff
                            header("location:add-orders.php");
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="orders.php"><i class="bi bi-basket-fill"></i>Transact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-orders.php"><i class="bi bi-bag-plus-fill"></i>Add transaction</a>
                        </li>
                        <?php
                        if ($userRole == 1) { //page option will only appear if user is admin
                            print  '<li class="nav-item">
                <a class="nav-link active" href="products.php"><i class="bi bi-archive-fill"></i>Products</a>
                </li>
                <li class="nav-item">
                <a class="nav-link"><i class="bi bi-clipboard-data-fill"></i>Reports</a>
                </li>';
                        } else { //will redirect to orders page if staff
                            header("location:add-orders.php");
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link logout" href="logout.php"><i class="bi bi-box-arrow-left"></i>Log Out</a>
                        </li>
                    </ul>
                </div>


                <!-- main page container -->
                <div class="col-sm-6 main-content">
                    <div class="heading">
                        <h1>Reports</h1>
                        <div class="d-flex flex-row justify-content-between">
                            <div class="d-flex flex-row flex-md-row">
                                <span class="mx-2"><a href="#" id="filter-daily" class="filter">Daily</a></span>
                                <span class="mx-2"><a href="#" id="filter-monthly" class="filter">Monthly</a></span>
                            </div>
                            <div class="d-flex flex-column flex-md-row">
                                <span class="mx-2">Date to filter </span>

                                <form action="reports_user.php" id="filter_form" class="mb-0" method="GET">
                                    <input type="hidden" name="range_filter" id="range_filter" value="daily" onchange="this.form.submit();" />
                                    <input class="fw-light" name="date_filter" id="date_filter" type="date" style="border-radius: 4px; border: 1px solid #6c757d" onchange="this.form.submit();" />
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="h4 fw-regular text-color-brown mb-3">Product Sales</p>
                            <div class="mb-4">
                                <?php 
                                if(!empty($filtered_data))
                                {
                                    print ' <table class="table table-responsive table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Total Sold</th>
                                                        <th>Available?</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                    
                                    $qty_products_sold = 0;
                                    $total_sales       = 0;
                                    $product_stats     = array();

                                    foreach ($filtered_data as $product) 
                                    {
                                        $row_fmt = '<tr style="cursor: pointer;" onclick="select_row(\'%s\')">
                                                        <th scope="row">%s</th>
                                                        <td>%s</td>
                                                        <td>PHP %s</td>
                                                        <td align="left">%s</td>
                                                        <td>%s</td>
                                                    </tr>';

                                                    
                                        if (isset($product_stats[$product['name']])) {
                                            $product_stats[$product['name']]['qty']++;
                                            $product_stats[$product['name']]['price'] += $product['price'];
                                        } else {
                                            $product_stats[$product['name']]['qty']    = $product['num_sold'];
                                            $product_stats[$product['name']]['price']  = $product['price'];
                                        }

                                        print sprintf(
                                            $row_fmt,
                                            $product['name'],
                                            $product['product_num'],
                                            $product['name'],
                                            number_format($product['price'], 2),
                                            $product['num_sold'],
                                            $product['is_available'] == 1 ? "Yes" : "No"
                                        );
                                        $qty_products_sold++;

                                        // TODO: Incorporate transaction qty field
                                        $total_sales += (float)($product['price']);
                                    }
                                    print '</tbody></table>';
                                }
                                ?>
                            </div>
                            
                            <?php
                                if(!empty($filtered_data))
                                {
                                    print ' <p class="h5 fw-regular text-color-brown mb-3">Top 5 Products based on Sales</p>
                                                <div class="container">
                                                    <canvas id="myChart" class="mb-1" style="width:100%;max-width:100%"></canvas>
                                                </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 side-content">
                    <div class="order-details-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="fw-bold text-color-brown">Bestsellers</h2>
                            </div>
                            <hr />
                            <?php
                                $idx = 1;
                                foreach($bestsellers as $product)
                                {
                                    $fmt = '<div class="summary-stat mt-3 text">
                                        <h1 class="fw-bold font-round" style="font-size: 1.75em;">%s</h1>
                                        <h3 class="lead" style="font-size: 1em;">Bestseller #%s &#8211; %s sold</h3>
                                    </div>';
                                    print sprintf($fmt, $product['name'], $idx, $product['num_sold']);
                                    $idx++;
                                }
                            ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script>
            datepicker = document.getElementById('date_filter');
            const query_string = window.location.search;
            const url_params = new URLSearchParams(query_string);

            if (url_params.has("date_filter")) {
                datepicker.valueAsDate = new Date(url_params.get("date_filter"));
                console.log(datepicker);
            } else {
                datepicker.valueAsDate = new Date();
            }

            filter_form = document.getElementById("filter_form");
            range_value = document.getElementById("range_filter");
            link_daily = document.getElementById("filter-daily");
            link_monthly = document.getElementById("filter-monthly");

            if (url_params.has("range_filter") && url_params.get("range_filter") == "monthly") {
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
            if (!empty($filtered_data)) {
                print "
                    function sort_product_by_sales(x, y) {
                        x_sales = parseInt(product_stat[x].qty) * parseInt(product_stat[x].price);
                        y_sales = parseInt(product_stat[y].qty) * parseInt(product_stat[y].price);
                        return x_sales < y_sales ? 1 : x_sales > y_sales ? -1 : 0;
                    }

                    chart_labels = Object.keys(product_stat).sort(sort_product_by_sales).slice(0, 5);
                    const data = {
                        labels: chart_labels,
                        datasets: [{
                            label: 'Total sales (PHP)',
                            data: chart_labels.map(product => parseInt(product_stat[product].qty) * parseInt(product_stat[product].price)),
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
                                    title : {
                                        text: 'Total sales (PHP)',
                                        display: true
                                    },
                                    display: true,
                                    beginAtZero: true
                                },
                                x: {
                                    title : {
                                        text: 'Product',
                                        display: true
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    labels: {
                                        color: 'rgb(255, 99, 132)'
                                    }
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

            function select_row(product_name, product_id) {
                select_container = document.getElementById("select-info-container");
                selected_name = document.getElementById("selected-name");
                selected_price = document.getElementById("selected-price");
                selected_qty = document.getElementById("selected-qty");
                edit_btn = document.getElementById("edit-btn");

                if (product_name in product_stat) {
                    select_container.style.display = "flex";
                    selected_name.innerHTML = product_name;
                    selected_qty.innerHTML = product_stat[product_name].qty;
                    selected_price.innerHTML = (Math.round(product_stat[product_name].price * 100) / 100).toFixed(2);
                    edit_btn.onclick = function() {
                        window.location.assign("edit_products.php/?id=" + product_id);
                    }
                    edit_btn.enabled = true;
                    document.getElementById("no-selected-text").style.display = "none";
                } else {
                    select_container.style.display = "none";
                    edit_btn.disabled = true;
                    document.getElementById("no-selected-text").style.display = "block";
                }
            }
        </script>

    </body>
</html>