<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Nithra School Step - Newsfeed</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link
            href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
            rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <style>
            * {
                box-sizing: border-box;
            }

            /* Style the body */
            body {
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
            }

            /* Header/logo Title */
            .header {
                padding: 30px;
                text-align: center;
                background: #1abc9c;
                color: white;
            }

            /* Increase the font size of the heading */
            .header h1 {
                font-size: 40px;
            }

            /* Column container */
            .row {
                display: -ms-flexbox;
                /* IE10 */
                display: flex;
                -ms-flex-wrap: wrap;
                /* IE10 */
                flex-wrap: wrap;
            }

            /* Create two unequal columns that sits next to each other */
            /* Sidebar/left column */
            .side {
                -ms-flex: 30%;
                /* IE10 */
                flex: 30%;
                background-color: #f1f1f1;
                padding: 20px;
            }

            /* Main column */
            .main {
                -ms-flex: 70%;
                /* IE10 */
                flex: 70%;
                background-color: white;
                padding: 20px;
            }

            /* Fake image, just for this example */
            .fakeimg {
                background-color: #aaa;
                width: 100%;
                padding: 20px;
            }

            /* Footer */
            .footer {
                padding: 20px;
                text-align: center;
                background: #ddd;
            }

            /* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 700px) {
                .row {
                    flex-direction: column;
                }
            }
            .timeline {
                list-style-type: none;
                margin: 0;
                padding: 0;
                position: relative;
            }

            .timeline:before {
                content: '';
                position: absolute;
                top: 5px;
                bottom: 5px;
                width: 5px;
                background: #2d353c;
                left: 20%;
                margin-left: -2.5px;
                display: none;
            }
            .timeline-likes {
                color: #6d767f;
                font-weight: 600;
                font-size: 12px;
            }
            .timeline .timeline-time {
                /* position: absolute; */
                left: 0;
                /* width: 18%; */
                text-align: cenetr;
                top: 30px;
            }

            .timeline .timeline-time .date,
            .timeline .timeline-time .time {
                display: block;
                font-weight: 600;
            }

            .timeline .timeline-time .date {
                line-height: 16px;
                font-size: 12px;
            }

            .timeline .timeline-time .time {
                line-height: 24px;
                font-size: 20px;
                color: #242a30;
            }
            /* The Modal (background) */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: black;
            }

            /* Modal Content */
            .modal-content {
                text-align: center;
                position: relative;
                /* background-color: #fefefe; */
                background-color: transparent;
                margin: auto;
                padding: 0;
                /* width: 90%; */
                max-width: 1200px;
            }

            /* The Close Button */
            .close {
                color: white;
                position: absolute;
                top: 10px;
                right: 25px;
                font-size: 35px;
                font-weight: bold;
            }

            .close:focus,
            .close:hover {
                color: #999;
                text-decoration: none;
                cursor: pointer;
            }

            .mySlides {
                display: none;
            }

            .cursor {
                cursor: pointer;
            }

            /* Next & previous buttons */
            .next,
            .prev {
                cursor: pointer;
                position: absolute;
                top: 50%;
                width: auto;
                padding: 16px;
                margin-top: -50px;
                color: white;
                font-weight: bold;
                font-size: 20px;
                transition: 0.6s ease;
                border-radius: 0 3px 3px 0;
                user-select: none;
                -webkit-user-select: none;
            }

            /* Position the "next button" to the right */
            .next {
                right: 0;
                border-radius: 3px 0 0 3px;
            }

            /* On hover, add a black background color with a little bit see-through */
            .next:hover,
            .prev:hover {
                background-color: rgba(0, 0, 0, 0.8);
            }

            img {
                margin-bottom: -4px;
            }

            .demo {
                opacity: 0.6;
            }

            .active,
            .demo:hover {
                opacity: 1;
            }

            img.hover-shadow {
                transition: 0.3s;
            }

            .hover-shadow:hover {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            .show-read-more .more-text {
                display: none;
            }

            .galleryimg {
                display: inline-flex;
                /* width: 100%; */
            }

            @media (max-width: 640px) {
                .galleryimg {
                    /* width: unset; */
                    display: block;
                }
            }

            .liked {
                color: blue;
            }
            .timeline-footer {
                background: #fff;
                border-top: 1px solid #e2e7ec;
                padding-top: 15px;
            }

            .timeline-footer a:not(.btn) {
                color: #575d63;
            }

            .timeline-footer a:not(.btn):focus,
            .timeline-footer a:not(.btn):hover {
                color: #2d353c;
            }

            .timeline-likes {
                color: #6d767f;
                font-weight: 600;
                font-size: 12px;
            }

            .timeline-likes .stats-right {
                float: right;
            }

            .timeline-likes .stats-total {
                display: inline-block;
                line-height: 20px;
            }

            .timeline-likes .stats-icon {
                float: left;
                margin-right: 5px;
                font-size: 9px;
            }

            .timeline-likes .stats-icon+.stats-icon {
                margin-left: -2px;
            }

            .timeline-likes .stats-text {
                line-height: 20px;
            }

            .timeline-likes .stats-text+.stats-text {
                margin-left: 15px;
            }

            .timeline-comment-box {
                background: #f2f3f4;
                margin-left: -25px;
                margin-right: -25px;
                padding: 20px 25px;
            }

            .timeline-comment-box .user {
                float: left;
                width: auto;
                height: 55px;
                overflow: hidden;
                border-radius: 50%;
                margin-top: 14px;
            }

            .timeline-comment-box .user img {
                max-width: 100%;
                max-height: 100%;
            }

            .timeline-comment-box .user+.input {
                margin-left: 44px;
            }

            .lead {
                margin-bottom: 20px;
                font-size: 21px;
                font-weight: 300;
                line-height: 1.4;
            }
        </style>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="{{ asset('public/src/images-grid.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('public/src/images-grid.css') }}">
    </head>
    <body>

        <div class="header" style="width:-webkit-fill-available;">
            <h1>Nithra School Step - Newsfeed</h1>
        </div>
        <div class="row">
            <div class="main" style="width:-webkit-fill-available;">
                @foreach ($items as $item) @if ($item->title)
                <h2>
                    {{ $item->title }}</h2>
                @endif
                <div class="timeline-time timeline-likes">
                    <h4 class="date" style="margin-left: 1rem;margin-top: -1rem;float: right;">
                        @if (date('d-M-Y', strtotime(Carbon\Carbon::now()->toDateTimeString())) ==
                        date('d-M-Y', strtotime($item->created_at))) today @else
                        {{ date('d-M-Y', strtotime(Carbon\Carbon::now()->toDateTimeString()))}}
                        @endif
                        {{ date('h:i A', strtotime($item->created_at))}}
                    </h4>
                </div>
                <!-- <div class="fakeimg" style="height:200px;">Image</div> -->
                <div>
                    <?php
                $var = Request::url();
$splitName = explode('/', $var);
$first_name = $splitName[3];
$uploed_id = explode('=', $first_name);
$user_id = $uploed_id[1];
$user_type = $uploed_id[0];

$likedornot = DB::table('likes')->select(DB::raw('count(*) as like_count'))
 ->where([
                    ['items_id', '=',  $item->id],
                    ['user_id', '=', $user_id]
                ])
    ->get();
$exployedlike = explode(':', $likedornot);
$likedornot = $exployedlike[1];
$likedornot = explode('}', $likedornot);
$wordlistww = DB::table('likes')->select(DB::raw('count(*) as like_count'))->where('items_id', '=', $item->id)
    ->get()
    ->groupBy("items_id");
$comment_tot = DB::table('comments')->select(DB::raw('count(*) as comment_count'))->where('item_id', '=', $item->id)
    ->get()
    ->groupBy("item_id");
?>
                    @if ($item->imageurl != "")
                    <div>
                        <div class="galleryimg">
                            @foreach (explode(',', $item->imageurl) as $key => $imageurlimg)
                            <div class="col-md-6" style="padding:5px;display:inherit;">
                                @if($key <='2')
                                <?php $os = array("jpeg", "jpg", "png", "webp");?>
                                @if (in_array(pathinfo($item->imageurl, PATHINFO_EXTENSION ), $os))
                                <img
                                    data-imgurl="{{ $item->imageurl}}"
                                    src="{{ asset('public/images/' . $imageurlimg) }}"
                                    class="imageview img-thumbnail galleryimg"
                                    style="height:200px;">
                                @endif @if(pathinfo($item->imageurl, PATHINFO_EXTENSION) == 'mp4')
                                <video width="350" height="150" controls="controls">
                                    <source src="{{ asset('public/images/' . $imageurlimg) }}" type="video/mp4">
                                </video>
                                @endif @endif
                            </div>
                            @endforeach @if($key >'2')
                            <span style="font-size: 25px;width: inherit;font-weight: 700;margin-top: 15%;">
                                +
                                {{ count(explode(",",$item->imageurl)) - 3 }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-- </p> -->
                    @endif
                    <div id="myModal" class="modal">
                        <span class="close cursor" onclick="closeModal()">&times;</span>
                        <div class="modal-content">
                            <div class="mySlides">
                                <img
                                    src="{{ asset('public/images/' . $imageurlimg) }}"
                                    onclick="openModal();currentSlide(1)"
                                    class="hover-shadow cursor imageview"
                                    style="width:90%;">
                                <video controls="controls" style="width:100%;height:auto;">
                                    <source src="{{ asset('public/images/' . $imageurlimg) }}" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($item->description)
                <p
                    class="show-read-more"
                    style="white-space: break-spaces;text-align: justify;font-size:15px;">
                    {{ $item->description }}
                </p>
                @endif
                <br>
                @foreach(explode('=', Request::path()) as $key => $info) @if($key =='0')
                <p id="user_type" style="display:none;">{{$info}}</p>
                @endif @if($key =='1')
                <p id="user_id" style="display:none;">{{$info}}</p>
                @endif @endforeach
                <?php 
                $like_count = $wordlistww;
$splitName = explode(':', $like_count);
$like_count = $splitName[2];
$like_count = explode('}', $like_count);
                $comment_count = $comment_tot;
$count_cmt= explode(':', $comment_count);
$comment_count = $count_cmt[2];
$comment_count = explode('}', $comment_count);
?>
                <div class="timeline-footer">
                    <a
                        class="m-r-15 text-inverse-lighter like"
                        onclick="dosomething(<?php echo $item->id; ?>)">
                        @if($likedornot[0] > '0')
                        <i class="fa fa-thumbs-up fa-fw fa-lg m-r-3 like1" style="color:blue;"></i>
                        @else
                        <i class="fa fa-thumbs-up fa-fw fa-lg m-r-3 like1"></i>
                        @endif @if($like_count[0] > '0')
                        {{$like_count[0]}}
                        @endif Like
                    </a>
                    <a
                        class="m-r-15 text-inverse-lighter"
                        id="clickpanel"
                        onclick="clickpanel(<?php echo $item->id; ?>)">
                        <i class="fa fa-comments fa-fw fa-lg m-r-3"></i>
                        @if($comment_count[0] > '0')
                        {{$comment_count[0]}}
                        @endif Comment</a>
                </div>
                <br>
                <div class="timeline-footer" style="padding: 25px;margin: auto;">
                    <div id="panel<?php echo $item->id;?>" style="display:none;">
                        @foreach($item->comments as $comment)
                        <?php 
$cmt_profile = DB::table($user_type)->select('name','profile')->where('id', '=', $comment->user_id)
    ->get();   
$cmt_profile4 = explode(',', $cmt_profile);
$cmt_profile_name=$cmt_profile4[0];
$cmt_profile_name = explode(':', $cmt_profile_name);
// $cmt_profile_name = explode('{', $cmt_profile_name);
// $cmt_profile_name = $cmt_profile_name[1];
    // print_r($cmt_profile_name);
                            ?>
                        <p style="display:inline;">
                            {{$comment->comment}}
                            <div class="timeline-time timeline-likes">
                                <span class="date">
                                    {{$comment->created_at->diffForHumans()}}
                                </span>
                            </div>
                        </p>
                        @endforeach
                        <div class="timeline-comment-box" style="margin:auto;">
                            <div class="user"><img src="{{$users->profile}}"></div>
                            <div class="input">
                                <form method="GET" action="/{{$user_type}}={{$user_id}}/{{$item->id}}">
                                    {{csrf_field()}}
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control rounded-corner"
                                            name="item_id"
                                            value='{{$item->id}}'
                                            style="display:none;">
                                        <input
                                            type="text"
                                            class="form-control rounded-corner"
                                            name="comment"
                                            placeholder="Write a comment..."
                                            style="height: 78px;width: 60%;margin-left: 10px;margin-right: 10px;">
                                        <span class="input-group-btn p-l-10">
                                            <button class="btn btn-primary f-s-12 rounded-corner" type="submit">
                                                <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </body>
        <script>
            function clickpanel(val) {
                var item_id = val;
                var x = $("#panel" + item_id);
                // console.log(x[0].style); alert(x);
                if (x[0].style.display === "none") {
                    x[0].style.display = "block";
                } else {
                    x[0].style.display = "none";
                }
            }
            function dosomething(val) {
                var user_id = val;
            }
            $('.like1').on("click", function () {
                $(this).toggleClass('liked');
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function dosomething(val) {
                var post_id = val;
                var user_type = $("#user_type").text();
                var user_id = $("#user_id").text();
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: user_type + "=" + user_id,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id: user_id,
                        user_type: user_type,
                        post_id: post_id
                    },
                    success: function (data) {
                        // alert(data.success);
                        $(".like1").css('color', '#FF6600');
                        location.href = user_type + "=" + user_id
                    }
                });
            };

            $(document).ready(function () {
                $(".imageview").click(function () {
                    var a = $(this).data("imgurl");
                    var items = a.split(',');

                    console.log(items);
                    var mySlides = column = "";
                    jQuery.each(items, function (i, imgval) {
                        var extension = imgval.substr((imgval.lastIndexOf('.') + 1));
                        console.log(extension);
                        var base_path = "{{url('/')}}/public/images/" + imgval;
                        mySlides += '<img style="margin:auto;" src="' + base_path + '" class="hover-shadow cursor">' +
                                '<br>';
                        column += ' <img class="demo cursor"src="' + base_path + '"  onclick="currentSlide(1)" al' +
                                't="No image">';
                    });
                    console.log(mySlides);
                    console.log(column);

                    $(".mySlides").html(mySlides);
                    $(".column").html(column);

                    $("#myModal").show();
                });
            });

            function openModal() {
                var a = $('.imageview').data("imgurl");
                var items = a.split(',');
                console.log(items)
                document
                    .getElementById("myModal")
                    .style
                    .display = "block";
            }

            function closeModal() {
                document
                    .getElementById("myModal")
                    .style
                    .display = "none";
            }

            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("demo");
                if (n > slides.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i]
                        .className
                        .replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                // dots[slideIndex - 1].className += " active";
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function () {
                var maxLength = 300;
                $(".show-read-more").each(function () {
                    var myStr = $(this).text();
                    if ($.trim(myStr).length > maxLength) {
                        var newStr = myStr.substring(0, maxLength);
                        var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                        $(this)
                            .empty()
                            .html(newStr);
                        $(this).append(
                            ' <a href="javascript:void(0);" class="read-more">read more...</a>'
                        );
                        $(this).append('<span class="more-text">' + removedStr + '</span>');
                    }
                });
                $(".read-more").click(function () {
                    $(this)
                        .siblings(".more-text")
                        .contents()
                        .unwrap();
                    $(this).remove();
                });
            });
        </script>
    </html>