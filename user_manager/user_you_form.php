<link rel="stylesheet" href="../styles/you_page.css"/>

<?php include'../view/header.php'; ?>
<div class="background">    
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
        <article class="mood_info_box grid-col-span-2 flow bg-primary-400 quote text-neutral-100">
            <div class="flex">
                <div>
                    <img  src="" alt="">
                </div>
                <div>
                    <h2 class="name">Title/name</h2>
                    <p class="position">detail if needed</p>
                </div>
            </div>
            <form action="user_manager/index.php" method="POST">
                <input type="hidden" name="controllerRequest" value="user_mood_levels">
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
        </article>

        <!--Box2-->
        <article class="mood_info_box flow bg-secondary-400 text-neutral-100">
            <div class="flex">
                <div>
                    <img src="">
                </div>
                <div>
                    <h2 class="name">Grid Area</h2>
                    <p class="position">detail if needed</p>       
                </div>                                      
            </div>
            <div>
                <canvas id="my_chart"></canvas>  
            </div>        
        </article>

        <!--Box4-->
        <article class="mood_info_box flow bg-neutral-100 text-secondary-400">
            <div class="flex">
                <div>
                    <img src="">
                </div>
                <div>
                    <h2 class="name">The Power of Positivity: Embracing a Joyful Life</h2>
                    <p class="position">detail if needed</p>
                </div>
            </div>
            <p>
                hello
            </p>
            <p>
                Add something in here
            </p>
        </article>

        <!--Box5-->
        <article class="mood_info_box grid-col-span-2 flow bg-secondary-500 text-neutral-100">
            <div class="flex">
                <div>
                    <img class="border-primary-400" src="images_thumbnail/SunMoon2.png">
                </div>
                <div>
                    <h2 class="name">Weather & Moon API</h2>
                    <p class="position">detail if needed</p>
                </div>
            </div>
            <form action="user_manager/index.php" method="post">
                <input type="hidden" name="controllerRequest" value="weather">
                <h1>Search Global Weather</h1>
                <label for="city">Enter your city name</label>
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
            <div class="flex">
                <div>
                    <img src="">
                </div>
                <div>
                    <h2 class="name">Title/name</h2>
                    <p class="position">detail if needed</p>
                </div>
            </div>
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
    
    

    

</body>





<?php include'../view/footer.php'; ?>
