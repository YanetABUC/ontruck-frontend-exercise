<html class="ie ie9 lte9" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="robots" content="all">
    <title>OnTruck Test</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/icons.css" type="text/css">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
<body>
<div class="container gap-top-m" id="vcontainer">
    <h1>Vehicles</h1>

    <div class="search-box gap-top-m">
        <input id="searcher" type="text" placeholder="Search..." v-on:keyup="query">
        <span class="icon-search addon"></span>
    </div>

    <div class="row  gap-top-m toolbars">
        <div class="col-sm-8">
            <nav aria-label="Filter">
                <ul>
                    <li class="nav-item">
                        <a class="item-link" v-bind:class="{ active: activeFilter == 'all'}"
                           v-on:click.prevent="filterBy('all')">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="item-link icon-van" v-bind:class="{ active: activeFilter == 'van'}"
                           v-on:click.prevent="filterBy('van')"></a>
                    </li>
                    <li class="nav-item">
                        <a class="item-link icon-box-van" v-bind:class="{ active: activeFilter == 'box_van'}"
                           v-on:click.prevent="filterBy('box_van')"><span class="path1"></span><span class="path2"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="item-link icon-rigid-truck" v-bind:class="{ active: activeFilter == 'rigid_truck'}"
                           v-on:click.prevent="filterBy('rigid_truck')"></a>
                    </li>
                    <li class="nav-item">
                        <a class="item-link icon-full-trailer" v-bind:class="{ active: activeFilter == 'full_trailer'}"
                           v-on:click.prevent="filterBy('full_trailer')"></a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-sm-4">
            <span>Sort by:</span>
            <nav aria-label="Sort">
                <ul>
                    <li class="nav-item">
                        <a class="item-link" v-bind:class="{ active: descMode}" v-on:click.prevent="order(true)">More drivers</a>
                    </li>
                    <li class="nav-item">
                        <a class="item-link" v-bind:class="{ active: !descMode}" v-on:click.prevent="order(false)">Less drivers</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="list-container">
        <div class="row">
            <div class="col-sm-4" v-for="item in items">
                <div class="card-truck">
                    <div class="card-truck-header">
                        <span v-bind:class="item.icon">
                            <span class="path1"></span><span class="path2"></span>
                        </span>
                    </div>
                    <div class="card-truck-content" v-if="item.driversTotal > 0">
                        <h5>{{item.driversTotal}} Drivers</h5>

                        <div class="driver-box" v-for="driver in item.drivers">
                            <label class="driver-name">{{driver.name}}</label>
                            <label class="driver-email">{{driver.email}}</label>
                        </div>
                    </div>
                    <div class="card-truck-content no-drivers" v-else>
                        <h5>No Drivers</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="js/vue.min.js"></script></head>
<script src="js/main.js"></script></head>
</body>
</html>