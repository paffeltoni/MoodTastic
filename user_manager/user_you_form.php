<link rel="stylesheet" href="../styles/you_page.css"/>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>

<?php include'../view/header.php'; ?>
<div class="background_floating_orbs">    
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>   
<body>
    <main class="mood-grid">

        <!--Box1-->
        <article class="mood_info_box grid-col-span-2 flow bg-secondary-500 text-neutral-100">
            <h2 class="name"><?php
                $current_date = date('l, \t\h\e jS \o\f F');
                ?>
                <p>It's <?php echo $current_date; ?></p>
            </h2>
            <?php if (isset($_SESSION['data_has_been_logged_error'])): ?>
                <div class="alert__message error">
                    <p> <?= $_SESSION['data_has_been_logged_error'];
            unset($_SESSION['data_has_been_logged_error']);
                ?>
                    </p>     
                </div>
<?php endif ?>
            <form action="user_manager/index.php" method="POST">
                <input type="hidden" name="controllerRequest" value="user_mood_levels" id="mood-form">
                <h2>What's your mood?</h2>
                <label for="moodLevelInput">How are you feeling?</label>
                <input type="range" name="moodLevelInput" id="moodLevelInput" min="1" max="100" >
                <br>
                <label for="stressLevelInput">How is your stress level?</label>
                <input type="range" name="stressLevelInput" id="stressLevelInput" min="1" max="100" >
                <br>
                <label for="abuseLevelInput">How would you rate your abuse level?</label>
                <input type="range" name="abuseLevelInput" id="abuseLevelInput" min="1" max="100" >
                <br>
                <button type="submit" name="submit" class="btn">Save</button>
            </form>
              <p class="position"><h4>Enter your mood with the slider bars according to how you feel, you can slide the bar left for your worst, and right for your best!</h4></p>           
        </article>

        <!--Box2-->
        <article class="mood_info_box flow bg-neutral-100 text-secondary-400">
            <p class="position">This chart is a guide to show you how your mood fluctuates throughout the month. Use this to help you change or create
                habits depending on your goals!</p>                                                
            <div class="mood_chart">
                <canvas id="my_chart"></canvas>           
            </div>             
             <p class="position">You can click on the boxes above to take away a category, click it again to put it back on the graph.</p>    
        </article>

        <!--Box4-->
        <article class="mood_info_box flow bg-neutral-100 text-secondary-400">
            <div class="card-container">
                <button class="neon-button">Posts</button>
                <button class="neon-button">Community</button>
                <button class="neon-button">Games</button>
                <button class="neon-button">Pick Me Up</button>
                <button class="neon-button">Tarot</button>
            </div>
        </article>



        <!--Box5-->
        <article class="mood_info_box grid-col-span-2 flow bg-secondary-500 text-neutral-100">
            <div class="flex">
                <div>
                    <img class="border-primary-400" src="images_thumbnail/SunMoon2.png">
                </div>
                <div>
                    <h2 class="name">Weather & Moon API</h2>
              
                </div>
            </div>
            <form action="user_manager/index.php" method="post">
                <input type="hidden" name="controllerRequest" value="weather">
                <h1>Weather Search:</h1>
                <label for="city">Enter a city name</label>
                <p><input type="text" name="city" id="city"></p>
                <button type="submit" name="submit" class="btn btn-success">Submit Now</button>
                <div class="output">

<?php if (isset($_SESSION['city_error'])): ?>
                        <div class="alert alert-warning" role="alert">
                            <p>
                                <?=
                                $_SESSION['city_error'];
                                unset($_SESSION['city_error']);
                                ?> 
                            </p>    
                        </div>
<?php elseif (isset($_SESSION['weather'])): ?>
                        <div class="alert alert-info" role="alert">
                            <p>
                                <?=
                                $_SESSION['weather'];
                                unset($_SESSION['weather']);
                                ?> 
                            </p>    
                        </div>
<?php endif ?>

                </div>
            </form>
        </article>

        <!--Box3-->
        <article class="mood_info_box flow bg-neutral-100 text-secondary-400">
            <p>
                The Power of Positivity: Embracing a Joyful Life
            </p>
            <p>
            <p><strong>Choose Positivity:</strong> Living a positive life not only brings joy and happiness to yourself, but it also spreads to those around you. 
                Make a conscious effort to focus on the good things in life, practice gratitude, and surround yourself with positivity. 
                Remember that your attitude can shape your reality, so choose to see the world in a positive light and watch the goodness flow.</p>
            </p>
        </article>
    </main>



    <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="" class="category__button">Positive Thinking</a></a>
            <a href="" class="category__button">Perspective</a>
            <a href="" class="category__button">Inspiration</a>
            <a href="" class="category__button">Reflection</a>
            <a href="" class="category__button">Health</a>
            <a href="" class="category__button">Changing Habits</a>     
        </div>
    </section>


    <script src="/MoodTastic/js/mood.js" defer></script>

</body>





<?php include'../view/footer.php'; ?>
