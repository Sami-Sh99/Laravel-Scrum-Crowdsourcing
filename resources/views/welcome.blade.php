@extends('layouts.guest')
@section('content')

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <div class="intro-img">
        <img src="img/Asset 1.svg" alt="" class="img-fluid">
      </div>

      <div class="intro-info">
        <h2>We provide<br><span>ideas</span><br>for your business!</h2>
        <div>
          <a href="/login" class="btn-get-started scrollto">Get Started</a>
          <a href="#services" class="btn-services scrollto">How it works</a>
        </div>
      </div>

    </div>
  </section><!-- #intro -->


  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>About Us</h3>
          <p>The main goal of this project is to transform crowd sourcing from a complex and limited participation, into a simple and scalable participation.
            It proposes a digital solution to enable distributed teams to benefit from the crowd sourcing structure, with unlimited number of participants and from all around the globe.
          </p>
        </header>

     

        <div class="row about-extra">
          <div class="col-lg-6">
            <img src="img/about-extra-1.svg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
            <h4>Facilitators</h4>
            <p>
              A facilitator is the person running the scrum game; he or she proposes the problem to be solved and receives the results of the game.
            </p>
            <p>
              Facilitators will benefit from saving the workshop data in a structured database without the need to store the messy cards physically.
            </p>
          </div>
        </div>

        <div class="row about-extra">
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="img/about-extra-2.svg" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1">
            <h4>Participants</h4>
            <p>
              A participant can participate in workshops created by the facilitators where they can submit digital cards and score other participants’ cards without passing any card by hand.
            </p>
            {{-- <p>
              Voluptas saepe natus quidem blanditiis. Non sunt impedit voluptas mollitia beatae. Qui esse molestias. Laudantium libero nisi vitae debitis. Dolorem cupiditate est perferendis iusto.
            </p>
            <p>
              Eum quia in. Magni quas ipsum a. Quis ex voluptatem inventore sint quia modi. Numquam est aut fuga mollitia exercitationem nam accusantium provident quia.
            </p> --}}
          </div>
          
        </div>


      </div>
    </section><!-- #about -->

      <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>Steps to Crowd Source</h3>
          <p>Scrum encourages teams to learn through experiences, self-organize while working on a problem, and reflect on their wins and losses to continuously improve.</p>
        </header>

        <div class="row">

          <div class="col-md-6 col-lg-5 offset-lg-1" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-analytics-outline" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="">Introduce a question </a></h4>
              <p class="description">that is desired to gather actionable ideas for, e.g. “What is your boldest solution to [X]”. Ask participants to write down their bold idea and the first step on the front of the index card, and hold up their hand (with the card) when they’re done.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 " data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-bookmarks-outline" style="color: #e9bf06;"></i></div>
              <h4 class="title"><a href="">Mill & Pass</a></h4>
              <p class="description">When everyone is done writing their card, ask participants to start walking around and exchanging cards with other people without reading the cards. Let people walk around until a signal is given (after about 20–30 seconds).</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><a href="">Read & Score</a></h4>
              <p class="description">Ask people to stop exchanging cards. Check to make sure that everyone has one card in his or her hand, exchanging cards with a neighbor if he or she received their own. Ask participants to rate the idea on their card on a scale from 1 to 5 (1 meaning “not my cup of tea” and 5 meaning “I’m totally in for this”). The score can be written down on the back of the card (leaving room for 4 more scores).</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-speedometer-outline" style="color:#41cf2e;"></i></div>
              <h4 class="title"><a href="">4 more rounds of ‘Mill & Pass’ and ‘Read & Score’ </a></h4>
              <p class="description">until every index card has five scores on the back. To avoid errors, a generally question is asked to people after every round of ‘Read & Score’ to verify that their card has as many scores as completed rounds on the back, and that individual scores range between 1 and 5. Ask participants to sum the score after the fifth round of ‘Read & Score’, resulting in a minimum of 5 and a maximum of 25.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-world-outline" style="color: #d6ff22;"></i></div>
              <h4 class="title"><a href="">Identify the ideas with the highest scores</a></h4>
              <p class="description">this step can be done by asking participants to step forward with high scores (counting down from 25), or by asking people to self-organize into a line from low (5) to high (25). Let people with the highest scoring cards present the idea and first step written on them.</p>            </div>
          </div>
          <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-clock-outline" style="color: #4680ff;"></i></div>
              <h4 class="title"><a href="">Get Results</a></h4>
              <p class="description">Use the highest scoring ideas as ideas as input for the next step in the workshop or Scrum Event.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Why Us Section
    ============================-->
    <section id="why-us" class="wow fadeIn">
      <div class="container">
        <header class="section-header">
          <h3>Why choose us?</h3>
          <p>Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.</p>
        </header>

        <div class="row row-eq-height justify-content-center">

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-diamond"></i>
              <div class="card-body">
                <h5 class="card-title">Corporis dolorem</h5>
                <p class="card-text">Deleniti optio et nisi dolorem debitis. Aliquam nobis est temporibus sunt ab inventore officiis aut voluptatibus.</p>
                <a href="#" class="readmore">Read more </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-language"></i>
              <div class="card-body">
                <h5 class="card-title">Voluptates dolores</h5>
                <p class="card-text">Voluptates nihil et quis omnis et eaque omnis sint aut. Ducimus dolorum aspernatur.</p>
                <a href="#" class="readmore">Read more </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-object-group"></i>
              <div class="card-body">
                <h5 class="card-title">Eum ut aspernatur</h5>
                <p class="card-text">Autem quod nesciunt eos ea aut amet laboriosam ab. Eos quis porro in non nemo ex. </p>
                <a href="#" class="readmore">Read more </a>
              </div>
            </div>
          </div>

        </div>

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">274</span>
            <p>Clients</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">421</span>
            <p>Projects</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1,364</span>
            <p>Hours Of Support</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">18</span>
            <p>Hard Workers</p>
          </div>
  
        </div>

      </div>
    </section>


</main>



@endsection
