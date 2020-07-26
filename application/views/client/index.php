<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/vendor/bootstrap/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat');
        * {
            margin: 0;
            padding: 0; 
            box-sizing: border-box;
        }
        body {
            background-image: linear-gradient(to bottom right, #023e8a, #0096c7, #48cae4);
            background-size: cover;
            height: 100vh;
            display: flex;
            font-family: 'Montserrat', 'sans-serif';
            font-weight: 500;
        }
        .navbar {
            background-color: #a8dadc;
        }

        .content-wrap {
            padding-bottom: 1.5rem; 
            height : 70vh;
        }

        :root {
            --marquee-width: 100vw;
            --marquee-height: 10vh;
            --marquee-elements-displayed: 1;
            --marquee-element-width: calc(var(--marquee-width)/var(--marquee-elements-displayed));
            --marquee-animation-duration: calc(var(--marquee-elements)*8s); 

            --footer-color: #03045e;
        }

        .marquee {
            position: absolute;
            bottom: 0;
            width: var(--marquee-width);
            height: var(--marquee-height);  
            background-color: var(--footer-color);
            color : white;
            overflow : hidden;
        }

        .marquee:before, .marquee:after {
            position: absolute;
            top: 0;
            width: 15rem;
            height: 100%;
            content: "";
            z-index: 1;
        }

        .marquee:before {
            left: 0;
            background: linear-gradient(to right, var(--footer-color) 0%, transparent 100%);
        }

        .marquee:after {
            right: 0;
            background: linear-gradient(to left, var(--footer-color) 0%, transparent 100%);
        }

        .marquee-content {
            list-style: none;
            height: 100%;
            display : flex;
            align-items: center;
            animation : scrolling var(--marquee-animation-duration) linear infinite;
        }

        @keyframes scrolling {
            0% { transform : translateX(0); }
            100% { 
                transform : translateX(
                    calc(
                        -1*var(--marquee-element-width)*var(--marquee-elements)
                    )
                ); 
            }
        }

        .marquee-content li {
            flex-shrink: 0;
            width: var(--marquee-element-width);
            text-align: center;
            font-size: 2.5rem;
            white-space: nowrap;
        }

        /* table tbody { height:100px; overflow:auto; } */
        table thead {
            text-align: center;
        }

        /* #wrapper {
            display: flex;
        } */
    </style>
    
</head>

<body>
    <div id="page-container">
        <nav class="navbar navbar-light justify-content-between">
            <a class="navbar-brand" href="<?= base_url() ?>Home">
                <img src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name') ?>/company/<?= $this->session->userdata('company_logo') ?>" alt="not found" class="d-inline-block align-top" alt="">
            </a>
                <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item">
                        <p class="navbar-link" style="font-size:20px;"><span id="datetime"></span></p>
                    </li>
                </ul>
        </nav>
        <br>    
        <div class="container-fluid content-wrap">
            <div class="row content">
                <div id="carousel" class="col-md-8 col-lg-8 carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    </ol>
                    <div class="carousel-inner">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="card" style="height:700px;">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" colspan="3">Schedule</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Description</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Due Date</th>
                                    </tr>
                                </thead>
                                <tbody id="show_event">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
        </div>
        <footer class="marquee">
            <ul class="marquee-content">
                <li>blalala lorem ipsum dolor sit amet</li>
            </ul>
        </footer>
    </div>
    <script src="<?= base_url() ?>assets/client/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/client/vendor/popper.js/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/client/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/client/js/date.js"></script>
    <script>
        $(document).ready(function(){ 
            show_carousel()
            show_event()
            function show_event(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?= base_url()?>Home/get_all_active_event',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html = ''
                        var i
                        var time = ''
                        var date = ''
                        if (data.length == 0) {
                            html += '<tr><td colspan="3" style="text-align:center">no incoming event</td></tr>'
                        } else {
                            for(i=0; i<data.length; i++){
                                date = dateFormat(new Date(data[i].due_date), "d mmmm yyyy")
                                time = dateFormat(new Date(data[i].due_date), "h:MM")
                                html += '<tr>'+
                                        '<td>'+data[i].description+'</td>'+
                                        '<td>'+ data[i].location +'</td>'+
                                        '<td>'+ time + ' WIB, '+ date + '</td>'+
                                        '</tr>'
                            }
                        }
                        $('#show_event').html(html)
                    }

                })
            }

            function show_carousel(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?= base_url()?>Home/get_all_active_carousel',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html_carousel_indicator = ''
                        var html_carousel_data = ''
                        var i
                        for(i=0; i<data.length; i++){
                            html_carousel_indicator += '<li data-target="#carouselExampleIndicators" data-slide-to="'+i+'"></li>'
                            if (data[i].data_type == "image") {
                                html_carousel_data += '<div class="carousel-item">' +
                                                            '<div class="view">' +
                                                                '<img class="d-block w-100 carousel-image" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name') ?>/carousel/image/'+data[i].data_carousel+'">'+
                                                            '</div>' +
                                                            '<div class="carousel-caption">' +
                                                                '<h3 class="h3-responsive">'+data[i].title+'</h3>' +
                                                                '<p>'+data[i].description+'</p>' +
                                                            '</div>' +
                                                        '</div>'
                            } else {
                                html_carousel_data +=   '<div class="carousel-item v-carousel">' +
                                                            '<div class="view">' +
                                                                '<video class="video-fluid v-data" controls muted>' +
                                                                    '<source src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name') ?>/carousel/video/'+data[i].data_carousel+'" type="video/mp4" />'+
                                                                '</video>'+
                                                            '</div>'+
                                                            '<div class="carousel-caption">' +
                                                                '<h3 class="h3-responsive">'+data[i].title+'</h3>' +
                                                                '<p>'+data[i].description+'</p>' +
                                                            '</div>' +
                                                        '</div>'
                            }
                        }
                        $('.carousel-inner').html(html_carousel_data)
                        $('.carousel-indicators').html(html_carousel_indicator)
                        $('#carousel').carousel({ interval : 4000})
                        $('.carousel-indicators > li').first().addClass('active')
                        $('.carousel-item').first().addClass('active')
                    }
                })
            }
            
            function datetime() {
                var dateNow = new Date()
                var time = dateFormat(new Date(), "HH:MM")
                var date = dateFormat(new Date(), "d mmmm yyyy")
                html = date+'<br>'+time+' WIB'
                $('#datetime').html(html)
            }

            // $('v-carousel.active > .view > video').on('play', function (e) {
            //     console.log('mlaku broo')
            //     $("#carousel").carousel('pause')
            // })
            
            // $('#myCarousel').bind('slid', function (e) {
            //     $('.v-carousel.active').find('iframe').contents().find('body').find('video')[0].play()
            //     $("#carousel").carousel('pause')
            // });
            setInterval(datetime, 1000)
            <?php if ($this->db->affected_rows() > 0) :?>
                show_event()
                show_carousel()
            <?php endif; ?>
            // setInterval(show_event, 10000)
            // setInterval(show_carousel, 30000)
        })
        
        // $('v-carousel.active > .view > video').on('ended', function (e) {
        //     $("#carousel").carousel({ interval : 100})
        // })

        
        // $('.v-carousel').hasClass('active', function () {
        //     console.log('video active')
        // })
        // $('.carousel-image').carousel({ interval : 6000})


    </script>
    <script src="<?= base_url() ?>assets/client/js/marquee.js" defer></script>
</body>

</html>