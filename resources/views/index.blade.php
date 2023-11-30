<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Group 3 | Home</title>

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/68704db06c.js" crossorigin="anonymous"></script>

    {{-- --}}
    <link rel="stylesheet" href="{{URL::asset('css/index.css')}}">
    
    @if(session()->has('toNews'))
    <style>html {scroll-behavior: auto !important;}</style>
    @endif
    
</head>
<body>
    @if(session()->has('msg'))
    <script>
        alert({{Js::from(session('msg'))}});
    </script>
    @endif

    
    <nav class="navbar navbar-expand-lg fixed-top w-100">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa-solid fa-bars" style="color:#fff"></span>
            </button>
            @if(auth()->check())
            <div class="collapse navbar-collapse loggedin_nav" id="navbarNavAltMarkup">
                <div class="navbar-nav left_nav">
                    <a class="nav-link text-white" href="#">
                    <i class="fa-solid fa-house"></i>
                    Home
                    </a>
                    <a class="nav-link text-white" href="#images">
                    <i class="fa-solid fa-image"></i>
                    Images 
                    </a>
                    <a class="nav-link text-white" href="#news">
                    <i class="fa-solid fa-newspaper"></i>
                    News
                    </a>
                    <a class="nav-link text-white" href="#members">
                    <i class="fa-solid fa-people-group"></i>
                    Group Members
                    </a>
                </div>
                <div class="navbar-nav left_nav">
                    <a class="nav-link text-white" href="{{route('admin.dashboard')}}">
                        <i class="fa-brands fa-trello"></i>
                        Go to Dashboard
                    </a>
                    <a class="nav-link text-white" id="logout_btn" href="{{route('admin.logout')}}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>
                </div>
            </div>  
            @else
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-link text-white" href="#">Home</a>
                <a class="nav-link text-white" href="#images">Images</a>
                <a class="nav-link text-white" href="#news">News</a>
                <a class="nav-link text-white" href="#members">Group Members</a>
            </div>
            @endif
        </div>
    </nav>  

    <main>
        <section id="hero">
        <video autoplay muted loop class="my-bg">
            <source src="{{URL::asset('props/bg.mp4')}}" type="video/mp4">
            </video>    
            
            <div class="hero-text">
                <div class="w_txt">
                    <h1>Welcome to this site...</h1>
                </div>
                <form class="d-flex" role="search" action="https://www.google.com/search" target="_blank">
                    <input class="form-control me-2" name="q" type="search" placeholder="Search on Google" aria-label="Search" required/>
                    <button class="btn btn-primary btn-custom" type="submit">Search</button>
                </form>
            </div>
        </section>

        <section id="images">
            <h1>Images</h1>
            <div class="imgs">
                <img src="https://asset.kompas.com/crops/xjcNbFyx4Sl51KJ4XHYb-lMUCdM=/20x0:770x500/750x500/data/photo/2023/02/07/63e226d5c74bb.jpg" alt="img"/>
                <img src="https://cdn0-production-images-kly.akamaized.net/uQXnED7MRKPRG9eO3Be-Yk8ct34=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/1232307/original/061802900_1463129616-Perusahaan_IT.jpg"/>
                <img src="https://www.constructionplusasia.com/wp-content/uploads/2020/10/Bannafarsai_Stock-Drone-shutterstock_1184307793-810x540.jpg" alt="img"/>
                <img src="https://asset-a.grid.id/crop/0x0:0x0/x/photo/2020/08/14/4285300588.jpg" alt="img"/>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdcCTc_sMc4bgd0Bj3Y8AeJ6BFhjvKMM3WBw&usqp=CAU" alt="img">
            </div>
        </section>

        <section id="news">  
            <div class="list_news">
                {{-- NEWS --}}
                @if ($news != 0)
                <div class="the_news">
                    <h1></h1>
                    <img src="{{URL::asset('props/nyt_img.png')}}"
                     alt="nyt icon"
                     width="300px"> 
                    {{-- SEARCH NEWS --}}
                    <form class="d-flex m-3 w-25" action="{{route('searchNews')}}" method="post">
                        @csrf
                        @method('post')
                        <input class="form-control me-2" name="searchNews" type="text" placeholder="Search other news on NYT" aria-label="Search" required/>
                        <button class="btn btn-primary btn-custom" type="submit">Search</button>
                    </form>
                    <div class="info-search">
                        <i>Keyword : {{$searchKeyword}}</i>
                    </div>
                </div>
                <div class="the_news">
                    @if(sizeof($news) != 0)
                    <div class="news_card">
                        @foreach($news as $d)
                        <?php
                            if($flag == $setNews){
                                break;
                            }
                            $flag++;
                        ?>
                        <div class="card news-content">
                            <div class="card-body">
                                <div class="news-title">
                                    <h5 class="card-title">{{$d['headline']['main']}}</h5>
                                </div>

                                <div class="news-pubdate">
                                    <h6 class="card-subtitle mb-2 text-muted">{{date('Y-m-d', strtotime($d['pub_date']))}}</h6>
                                </div>

                                <div class="news-abstract overflow-hidden">
                                    <p class="card-text">{{$d['abstract']}}</p>
                                </div>

                                <div class="news-readmore">
                                    <a href="{{$d['web_url']}}" target="_blank" class="card-link">Read More...</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <h4>No Results</h4>
                    @endif
                    <h4 class="gotonyt">
                        <a href="https://www.nytimes.com/international/" target="_blank">
                            Go to The New York Times
                        </a>     
                    </h4>  
                </div>
                @else
                <div class="the_news">
                    <h1>News</h1>
                    <h4>No News Available</h4>
                </div>
                @endif
            </div>
        </section>

        <section id="members">
            <div class="header">
                <h1>Group 3 Members</h1>
            </div>

            @if($data->count() > 0)
            <div class="info-members">
                @foreach($data as $d)
                <div class="card card-gap">
                    <div class="card-body member-card-gap">
                      <h5 class="card-title">{{$d->name}}</h5>
                      <p class="card-text">{{$d->npm}}</p>
                      <p class="card-text">{{$d->class}}</p>
                    </div>
                  </div>
                @endforeach
            </div>
            @else
            <div class="card">
                <h1>No Data Available</h1>
            </div>
            @endif
        </section>
    </main>

    <footer>
        <i class="fa-solid fa-layer-group" style="color:#fff"></i>
        <p>&nbspMade by Group3</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{URL::asset('js/logout.js')}}"></script>
</body>
</html>