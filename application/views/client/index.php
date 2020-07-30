<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="360">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/css/style.css">
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
            background-color: #03045e;
            min-width: 100vw;
        }

        .datetime {
            font-size:20px;
            color: white;
            font-weight: 700;
        }

        .content-wrap {
            padding-bottom: 1.5rem; 
            height : 75vh;
        }

        .schedule {
            height : 75vh;
            
        }

        #caousel {
            max-height : 75vh;
            max-width: 100%; 
        }

        .carousel-empty {
            background: linear-gradient(#343a40, #212529);
            min-height : 75vh;
            min-width: 100%;
            justify-content: center;
            align-items: center;
            color: #adb5bd; 
            display: flex;
            font-weight: 700;
        }

        .v-carousel {
            max-height : 700px;
            min-height : 80vh;
            max-width: 100%;
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

        .news {
            color: #48cae4;
            font-weight: 800;
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

        table thead {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="page-container">
        <nav class="navbar navbar-light justify-content-between">
            <?php
                if ($content_group['navigation_bar']['active'] == 'true') {
                    $this->load->view('client/navbar_view');
                }
            ?>
        </nav>   
        <div class="container-fluid mt-4">
            <div class="row content">
                <?php
                    if ($content_group['carousel']['active'] == 'true') {
                        $this->load->view('client/carousel_view');
                    }
                    if ($content_group['schedule']['active'] == 'true') {
                        $this->load->view('client/schedule_view');
                    }
                    if ($content_group['schedule']['active'] == 'false' && $content_group['carousel']['active'] == 'false') {
                        $this->load->view('client/logo_view');
                    }
                ?>
            </div>
            <!-- footer -->
        </div>
        <?php 
            if ($content_group['footer']['active'] == 'true') {
                $this->load->view('client/footer_view');
            }
        ?>
    </div>
    <script src="<?= base_url() ?>assets/client/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/client/vendor/popper.js/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/client/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/client/js/date.js"></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        $(document).ready(function(){ 
            show_carousel()
            show_event()
            show_info()
            datetime()

            var pusher = new Pusher('7ba272c3a6631b4ffaf9', {
                cluster: 'ap1'
            })

            var channel = pusher.subscribe('my-channel')
            channel.bind('my-event', function(data) {
                if(data.message === 'carousel_success'){
                    show_carousel()
                } else if (data.message === 'event_success') {
                    show_event()
                } else {
                    show_info()
                }
            })
            function show_event(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?= base_url()?>Home/get_all_active_event',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html, time, date = '', i
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

            function show_info(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?= base_url()?>Home/get_all_active_information',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html = ''
                        var i
                        console.log(data.length)
                        if (data.length == 0) {
                            html += '<li>no information available</li><li>no information available</li>'
                        } else {
                            for(i=0; i<data.length; i++){
                                if (data[i].info_type == 'news') {
                                    html += '<li class="news">'+data[i].description+'</li>'
                                } else {
                                    html += '<li>'+data[i].description+'</li>'
                                }
                            }
                        }
                        $('.marquee-content').html(html)
                    }

                }).done((data) => {
                    set_marquee(data)
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
                        if (data.length == 0) {
                            html_carousel_indicator += '<li data-target="#carouselExampleIndicators" data-slide-to="0"></li>'
                            html_carousel_data += '<div class="col-md-12 carousel-item">' +
                                                        '<div class="carousel-empty">' +
                                                            '<h2>No Data Available</h2>'
                                                        '</div>' +
                                                    '</div>'
                        } else {
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
                                                                    '<video class="video-fluid v-data" onplay="pauseCarousel()" onended="resumeCarousel()" muted>' +
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

            function set_marquee(data) {
                const root = document.documentElement
    
                const marqueeElementDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed")
                const marqueeContent = document.querySelector(".marquee-content")
    
                root.style.setProperty('--marquee-elements', marqueeContent.children.length)
                if (data.length == 1) {
                    $('.marquee-content li').clone(true).appendTo('.marquee-content')
                } else {
                    $('.marquee-content li').siblings(':first-child').clone(true).appendTo('.marquee-content')
                }
            }
            setInterval(datetime, 1000*60)
        })
        function pauseCarousel() {
            $("#carousel").carousel('pause');
        }
        function resumeCarousel() {
            $("#carousel").carousel('next');
            $("#carousel").carousel({ interval : 4000});
        }
        $('#carousel').on('slid.bs.carousel', function () {
            if ($('.v-carousel').hasClass('active')) {
                $('.v-data').get(0).play()
            }
        })

    </script>
</body>

</html>