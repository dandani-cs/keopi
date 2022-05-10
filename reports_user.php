<?php
session_start();
if ($_SESSION['email']) { // will check if the user is logged-in

} else { // will return to login page if user is not logged in
    header("location:login.html");
}
$userRole = $_SESSION['is_admin']; //gets user role

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

    if ($exists != 0) {
        while ($row = mysqli_fetch_assoc($results)) {
            $filtered_data[] = $row;
        }
    }
    return $filtered_data;
}

// Default values
$date_filter  = new DateTime();
$date_filter  = $date_filter->format('Y-m-d');
$range_filter = "daily";

$query = 'SELECT products.*, IFNULL(qty, 0) AS qty FROM products '.
'LEFT JOIN (%s) t_list on products.product_num = t_list.product_num GROUP BY products.product_num;';

$transact_query = 'SELECT transactions.* FROM transactions INNER JOIN orders on transactions.order_num = orders.order_num WHERE orders.cancelled = 0 AND';
$date_clause    = 'transaction_date = DATE("' . $date_filter . '")';

if (isset($_GET['date_filter']) && isset($_GET['range_filter'])) {
    if ($_GET['range_filter'] == 'daily') {
        $date_param  = new DateTime($_GET['date_filter']);
        $date_clause = 'CAST(transaction_date AS DATE) = DATE("' . $date_param->format('Y-m-d') . '")';
    } else if ($_GET['range_filter'] == 'monthly') {
        $date_param  = new DateTime($_GET['date_filter']);
        $date_start  = clone $date_param;
        $date_end    = clone $date_param;

        $date_start->modify('first day of this month');
        $date_end->modify('last day of this month');

        $date_clause = 'CAST(transaction_date AS DATE) >= DATE("' . $date_start->format("Y-m-d") . '") ' .
            'AND CAST(transaction_date AS DATE) <= DATE("' . $date_end->format("Y-m-d") . '")';
    }
}
$transact_query   = $transact_query . " " . $date_clause;
$bestseller_query = 'SELECT products.*, qty FROM products ' .
    'INNER JOIN (SELECT transactions.* FROM transactions INNER JOIN orders on transactions.order_num = orders.order_num ) tr ' .
    'on (products.product_num = tr.product_num) WHERE tr.cancelled = 0 ' .
    'GROUP BY products.product_num ORDER BY qty DESC LIMIT 3;';  // can be changed to top 5 or whatever

$query = sprintf($query, $transact_query);
//print $query;
$filtered_data = get_filtered_data($query);
$bestsellers   = get_filtered_data($bestseller_query);
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
    <title>Reports &#8211; User</title>

    <link rel="stylesheet" href="css/reports_styles.css" />
</head>

<body>
    <div class="container-fluid" style="height:100%;">
        <div class="row 5">
            <div class="d-flex flex-row min-vh-100 px-0" id="">
                <div class="side-nav d-none d-md-block">
                    <div class="text-center pt-3 mb-3">
                        <img src="img/keopi-logo-transparent-black.png" style="width: 100%;" />
                        <div class="d-flex flex-column">
                            <?php
                            if ($userRole == 1) {
                                print
                                    '
                <a class="side-nav-item" href="user_management.php">
                    <div class="px-3 py-3">
                        <p class="my-0">User Management</p>
                    </div>
                </a>
                 <a class="side-nav-item" href="orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Orders</p>
                    </div>
                </a>
                <a class="side-nav-item side-nav-selected" href="add-orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Add Order</p>
                    </div>
                </a>
                <a class="side-nav-item" href="products.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Products</p>
                    </div>
                </a>
                <a class="side-nav-item " href="reports_admin.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Reports</p>
                    </div>
                </a>
                <a class="side-nav-item" href="logout.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Logout</p>
                    </div>
                </a>';
                            } else {
                                print '
                   <a class="side-nav-item" href="orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Orders</p>
                    </div>
                </a>
                <a class="side-nav-item" href="add-orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Add Order</p>
                    </div>
                </a>
                <a class="side-nav-item side-nav-selected" href="reports_user.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Reports</p>
                    </div>
                </a>
                <a class="side-nav-item" href="logout.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Logout</p>
                    </div>
                </a>
                ';
                            }
                            ?>



                        </div>
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

                                            <form action="reports_user.php" id="filter_form" class="mb-0" method="GET">
                                                <input type="hidden" name="range_filter" id="range_filter" value="daily" onchange="this.form.submit();" />
                                                <input class="fw-light" name="date_filter" id="date_filter" type="date" style="border-radius: 4px; border: 1px solid #6c757d" onchange="this.form.submit();" />
                                            </form>
                                        </div>

                                    </div>
                                </div>

                                <div class="round-bg">
                                    <p class="h4 fw-regular text-color-brown mb-3">Product Sales</p>
                                    <div class="mb-4">
                                        <?php
                                        if (!empty($filtered_data)) {
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

                                            foreach ($filtered_data as $product) {
                                                $row_fmt = '<tr style="cursor: pointer;" onclick="select_row(\'%s\')">
                                                        <th scope="row">%s</th>
                                                        <td>%s</td>
                                                        <td>PHP %s</td>
                                                        <td align="left">%s</td>
                                                        <td>%s</td>
                                                    </tr>';


                                                if (!isset($product_stats[$product['name']])) {
                                                    $product_stats[$product['name']]['qty']    = $product['qty'];
                                                    $product_stats[$product['name']]['price']  = $product['price'];
                                                }

                                                print sprintf(
                                                    $row_fmt,
                                                    $product['name'],
                                                    $product['product_num'],
                                                    $product['name'],
                                                    number_format($product['price'], 2),
                                                    $product['qty'],
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
                                    if (!empty($filtered_data)) {
                                        print ' <p class="h4 fw-regular text-color-brown mb-3">Top 5 Products Based on Sales</p>
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
                                    <h2 class="fw-bold text-color-brown">Bestsellers</h2>
                                    <hr />
                                    <?php
                                    $idx = 1;
                                    foreach ($bestsellers as $product) {
                                        $fmt = '<div class="summary-stat mt-3 text">
                                        <h1 class="fw-bold font-round" style="font-size: 1.75em;">%s</h1>
                                        <h3 class="lead" style="font-size: 1em;">Bestseller #%s &#8211; %s sold</h3>
                                    </div>';
                                        print sprintf($fmt, $product['name'], $idx, $product['qty']);
                                        $idx++;
                                    }
                                    ?>
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
                const url_params = new URLSearchParams(query_string);

                if (url_params.has("date_filter")) {
                    datepicker.valueAsDate = new Date(url_params.get("date_filter"));
                } else {
                    datepicker.valueAsDate = new Date();
                    console.log(datepicker.valueAsDate, new Date());
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

                function select_row(product_name) {
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
                            window.location.assign("reports.php");
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