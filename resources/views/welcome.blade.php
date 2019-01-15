@extends('layouts.baseIndex')

@section('content')
<!-- main -->
<section class="bg-inverse p-y-0">
  <div class="owl-carousel owl-slide full-height">
    <div class="carousel-item" style="background-image: url('img/carousel/wall-car-market.jpg');">
      <div class="carousel-overlay"></div>
      <div class="carousel-caption">
        <div>
          <b class="text-center">@include('incluir/mensajes')</b>
          <h3 class="carousel-title">Provimarket Casablanca</h3>
          <p>Propineros de Valparaiso - Chile</p>
          @guest
          <a class="btn btn-primary btn-rounded btn-shadow btn-lg" href="{{ url('login') }}"  role="button">Iniciar Sesión</a>
          @endguest
        </div>
      </div>
    </div>
      <!--
    <div class="carousel-item" style="background-image: url('img/carousel/carousel-2.jpg');">
      <div class="carousel-overlay"></div>
      <div class="carousel-caption">
        <div>
          <h3 class="carousel-title">The Last of Us: Remastered</h3>
          <p>Survive an apocalypse on Earth in The Last of Us, a PlayStation 4-exclusive title.</p>
          <a class="btn btn-primary btn-rounded btn-shadow btn-lg" href="https://www.youtube.com/watch?v=W2Wnvvj33Wo" data-lightbox role="button">Watch Gameplay</a>
        </div>
      </div>
    </div>
    <div class="carousel-item" style="background-image: url('https://img.youtube.com/vi/BhTkoDVgF6s/maxresdefault.jpg');">
      <div class="carousel-overlay"></div>
      <div class="carousel-caption">
        <div>
          <h3 class="carousel-title">For Honor: The Berserker</h3>
          <p>Enter the chaos of a raging war as a bold knight, brutal viking, or mysterious samurai.</p>
          <a class="btn btn-primary btn-rounded btn-shadow btn-lg" href="https://www.youtube.com/watch?v=zFUymXnQ5z8" data-lightbox role="button">Watch Gameplay</a>
        </div>
      </div>
     </div>
      -->

  </div>
</section>
<!--
<section class="p-y-80">
  <div class="container">
    <div class="heading">
      <i class="fa fa-steam"></i>
      <h2>Recent Games</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div class="row">
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-lg">
          <div class="card-img">
            <a href="game-post.html"><img src="img/game/game-1.jpg" class="card-img-top" alt="Assassin's Creed Syndicate"></a>
            <div class="badge badge-warning">pc</div>
            <div class="card-likes">
              <a href="#">15</a>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title"><a href="game-post.html">Assassin's Creed Syndicate</a></h4>
            <div class="card-meta"><span>June 13, 2017</span></div>
            <p class="card-text">Defeating the corrupt tyrants entrenched there will require not only strength, but leadership.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-lg">
          <div class="card-img">
            <a href="game-post.html"><img src="img/game/game-2.jpg" class="card-img-top" alt="Rise of the Tomb Raider"></a>
            <div class="badge badge-xbox-one">Xbox One</div>
            <div class="card-likes">
              <a href="#">87</a>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title"><a href="game-post.html">Rise of the Tomb Raider</a></h4>
            <div class="card-meta"><span>November 10, 2015</span></div>
            <p class="card-text">Tomb Raider, Lara becomes more than a survivor as she embarks on her first great.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-lg">
          <div class="card-img">
            <a href="game-post.html"><img src="img/game/game-3.jpg" class="card-img-top" alt="The Witcher 3: Wild Hunt"></a>
            <div class="badge badge-ps4">ps4</div>
            <div class="card-likes">
              <a href="#">23</a>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title"><a href="game-post.html">The Witcher 3: Wild Hunt</a></h4>
            <div class="card-meta"><span>March 15, 2017</span></div>
            <p class="card-text">The world is in chaos. The air is thick with tension and the smoke of burnt villages.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-lg">
          <div class="card-img">
            <a href="game-post.html"><img src="img/game/game-4.jpg" class="card-img-top" alt="Grand Theft Auto V"></a>
            <div class="badge badge-steam">Steam</div>
            <div class="card-likes">
              <a href="#">19</a>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title"><a href="game-post.html">Grand Theft Auto V</a></h4>
            <div class="card-meta"><span>February 2, 2017</span></div>
            <p class="card-text">Trouble taps on your window again with this next chapter in the Grand Theft Auto universe.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-lg">
          <div class="card-img">
            <a href="game-post.html"><img src="img/game/game-5.jpg" class="card-img-top" alt="Deadpool The Game"></a>
            <div class="badge badge-ps4">Ps4</div>
            <div class="card-likes">
              <a href="#">36</a>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title"><a href="game-post.html">Deadpool The Game</a></h4>
            <div class="card-meta"><span>Unknown Release Date</span></div>
            <p class="card-text">There are a few important things I need to say before you crack into my insanely sweet game.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card card-lg">
          <div class="card-img">
            <a href="game-post.html"><img src="img/game/game-6.jpg" class="card-img-top" alt="Grand Theft Auto Online"></a>
            <div class="badge badge-xbox-one">Xbox One</div>
            <div class="card-likes">
              <a href="#">73</a>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title"><a href="game-post.html">Grand Theft Auto Online</a></h4>
            <div class="card-meta"><span>January 16, 2017</span></div>
            <p class="card-text">Grand Theft Auto Online is designed to continually expand and evolve over time.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center"><a class="btn btn-primary btn-shadow btn-rounded btn-effect btn-lg m-t-10" href="games.html">Show More</a></div>
  </div>
</section>

<section class="bg-secondary no-border-bottom p-y-80">
  <div class="container">
    <div class="heading">
      <i class="fa fa-star"></i>
      <h2>Recent Reviews</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div class="owl-carousel owl-list">
      <div class="card card-review">
        <a class="card-img" href="review-post.html">
          <img src="img/review/review-1.jpg" alt="">
          <div class="badge badge-success">7.2</div>
        </a>
        <div class="card-block">
          <h4 class="card-title"><a href="review-post.html">Uncharted 4</a></h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="card card-review">
        <a class="card-img" href="review-post.html">
          <img src="img/review/review-2.jpg" alt="">
          <div class="badge badge-warning">5.4</div>
        </a>
        <div class="card-block">
          <h4 class="card-title"><a href="review-post.html">Hitman: Absolution</a></h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="card card-review">
        <a class="card-img" href="review-post.html">
          <img src="img/review/review-3.jpg" alt="">
          <div class="badge badge-danger">2.1</div>
        </a>
        <div class="card-block">
          <h4 class="card-title"><a href="review-post.html">Last of us: Remastered</a></h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="card card-review">
        <a class="card-img" href="review-post.html">
          <img src="img/review/review-4.jpg" alt="">
          <div class="badge badge-success">7.8</div>
        </a>
        <div class="card-block">
          <h4 class="card-title"><a href="review-post.html">Bioshock: Infinite</a></h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="card card-review">
        <a class="card-img" href="review-post.html">
          <img src="img/review/review-5.jpg" alt="">
          <div class="badge badge-success">8.9</div>
        </a>
        <div class="card-block">
          <h4 class="card-title"><a href="review-post.html">Grand Theft Auto: 5</a></h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="card card-review">
        <a class="card-img" href="review-post.html">
          <img src="img/review/review-6.jpg" alt="">
          <div class="badge badge-warning">4.7</div>
        </a>
        <div class="card-block">
          <h4 class="card-title"><a href="review-post.html">Dayz</a></h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="card card-review">
        <a class="card-img" href="review-post.html">
          <img src="img/review/review-7.jpg" alt="">
          <div class="badge badge-danger">3.1</div>
        </a>
        <div class="card-block">
          <h4 class="card-title">
            <a href="review-post.html">Liberty City</a>
          </h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-image" style="background-image: url(https://img.youtube.com/vi/IsDX_LiJT7E/maxresdefault.jpg);">
  <div class="overlay"></div>
  <div class="container">
    <div class="video-play" data-src="https://www.youtube.com/embed/IsDX_LiJT7E?rel=0&amp;amp;autoplay=1&amp;amp;showinfo=0">
      <div class="embed-responsive embed-responsive-16by9">
        <img class="embed-responsive-item" src="https://img.youtube.com/vi/IsDX_LiJT7E/maxresdefault.jpg" alt="">
        <div class="video-play-icon">
          <i class="fa fa-play"></i>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-primary promo">
  <div class="container">
    <h2>Create your own epic gaming site with gameforest</h2>
    <a class="btn btn-outline-default" href="https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730" target="_blank" role="button">Purchase Now <i class="fa fa-shopping-cart"></i></a>
  </div>
</section>

-->
<!-- /main -->

@endsection
