<?php
require "partials/head.php";
?>
    <body>
        <div class="w-screen h-dvh bg-gradient-to-br from-blue-700 via-violet-600 to-green-600 flex justify-center items-center flex-col ">
            <div class="flex flex-1 justify-center items-center container mx-auto    lg:flex-row flex-col" >
                <div class="flex flex-1 flex-col  items-center">
                    <div class="w-full p-4">
                        <h1 class="text-white/75 font-bold text-8xl">Smart Parking</h1>
                        <h1 
                        class=" font-bold 
                        text-8xl
                        bg-gradient-to-r from-blue-400 via-green-500 to-indigo-400
                        inline-block
                        text-transparent
                        bg-clip-text">Iot Revolution</h1>
                        
                    </div>                
                    <div class="w-full p-4">
                        <p class="text-gray-100  text-xl">
                        Transform your parking experience with intelligent IoT sensors, real-time availability tracking, and seamless mobile integration.
                        </h1>             
                    </div>
                      <div class="w-full py-4 flex gap-8 p-4">
                        <a href="/dashboard">
                            <button class="
                            text-white bg-gradient-to-r from-blue-600 to-blue-300
                            font-bold text-sm p-2 rounded-lg hover:scale-[1.1]
                            duration-300 
                            ">Go to Dashboard</button>
                        </a>
                        <a href="setup">
                        <button class="
                        text-white bg-gradient-to-r from-green-600 to-green-300
                        font-bold text-sm p-2 rounded-lg hover:scale-[1.1]
                        duration-300 
                        ">Setup</button>
                        </a>
                    </div>
                    <div class="w-full px-4 py-8 flex flex-row gap-8 h-auto justify-between">
                        <div class=" h-full w-full flex flex-1 flex-col justify-center items-center">
                            <p class="text-3xl font-bold
                            bg-blue-400 
                            inline-block
                            text-transparent
                            bg-clip-text
                            ">99.9% </p>
                            <p class="text-gray-300 text-sm">Uptime</p>

                        </div>
                        <div class=" h-full w-full flex flex-1 flex-col justify-center items-center">
                            <p class="text-3xl font-bold
                            bg-green-500 
                            inline-block
                            text-transparent
                            bg-clip-text
                            " >50% </p>
                            <p class="text-gray-300 text-sm">Time Saved</p>                            
                        </div>
                        <div class=" h-full w-full flex flex-1 flex-col justify-center items-center">
                            <p class="text-3xl font-bold
                            bg-indigo-400 
                            inline-block
                            text-transparent
                            bg-clip-text
                            ">1000+</p>
                            <p class="text-gray-300 text-sm">Locations</p>                            
                        </div>
                        <div class=" h-full w-full flex flex-1 flex-col justify-center items-center">
                            <p class="text-3xl font-bold
                            bg-blue-400 
                            inline-block
                            text-transparent
                            bg-clip-text
                            ">24/7</p>
                            <p class="text-gray-300 text-sm">Support</p>                            
                        </div>

                    </div>
                </div>
                <div class="flex flex-1 h-full w-full justify-center items-center p-4"> 
                <div class="relative w-[600px] h-[400px] flex justify-center items-center">
                    <!-- Background image -->
                    <img src="/src/assets/hero-parking.jpg" 
                        alt="Smart Parking Image" 
                        class="rounded-xl shadow-lg w-full h-full object-cover
                        custom-bounce">

                    <!-- Car positioned at bottom center -->
                    <img src="/src/assets/car.svg" 
                        alt="car" 
                        class="absolute top-0 left-0 -translate-x-1/2
                          -translate-y-1/2 size-16 rounded-xl
                           shadow-lg custom-bounce-icon
                            bg-black p-4" />
                    <img src="/src/assets/people.svg" 
                        alt="car" 
                        class="absolute bottom-0 right-0 translate-x-1/2
                          translate-y-1/2 size-16 rounded-xl
                           shadow-lg custom-bounce-icon
                            bg-black p-4" />
                </div>
                </div>

                
                
            </div>
            <div class="overflow-hidden relative fade-mask container px-16 ">
                <div class="flex w-[200%] animate-scroll">
                <!-- First set of logos -->
                <div class="flex justify-around items-center w-1/2 space-x-10">
                    
                  <?php require "partials/imagecarousel.php" ?>
                  <?php require "partials/imagecarousel.php" ?>
                </div>
                <!-- Duplicate logos for infinite loop -->
                <div class="flex justify-around items-center w-1/2 space-x-10">
                    <?php require "partials/imagecarousel.php" ?>
                    <?php require "partials/imagecarousel.php" ?>
            
                </div>
                </div>
            </div>
        </div>
 
                          
    </body>
</html>