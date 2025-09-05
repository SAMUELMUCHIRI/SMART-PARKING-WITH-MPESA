<?php


require 'views/partials/head.php';
?>

    <body>
        <div class="w-screen h-dvh bg-gradient-to-br from-blue-700 via-violet-600 to-green-600 flex justify-center items-center flex-col ">
            <div class="flex flex-1 justify-center items-center container mx-auto    lg:flex-row flex-col" >
                <div class="flex flex-1 flex-col  items-center">
                    <div class="w-full p-4">
                        <h1 class="text-white/75 font-bold text-8xl">404</h1>
                        <h1 
                        class=" font-bold 
                        text-8xl                    

                        bg-gradient-to-r from-blue-400 via-green-500 to-indigo-400
                        inline-block
                        text-transparent        

                        bg-clip-text">Page Not Found</h1>               
                    </div>                
                    <div class="w-full p-4">
                        <p class="text-gray-100  text-xl">      
                        The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                        </h1>
                    </div>
                      <div class="w-full py-4 flex gap-8 p-4">
                        <a href="/"><button class="
                        text-white bg-gradient-to-r from-blue-600 to-blue-300
                        font-bold text-sm p-2 rounded-lg hover:scale-[1.1]
                        duration-300 
                         ">Go to Homepage</button></a>
                        <button class=" 
                        text-white bg-gradient-to-r from-green-600 to-green-300
                        font-bold text-sm p-2 rounded-lg hover:scale-[1.1]
                        duration-300 
                        ">Contact Support</button>
                    </div>
                </div>
                <div class="flex flex-1 justify-center items-center">
                    <img src="/src/assets/404.svg" class="w-full h-auto" alt="404 Image">
                </div>
            </div>
            <div class="w-full p-4 flex justify-center items-center">
                <p class="text-gray-300 text-sm">© 2024 Smart Parking. All rights reserved.</p>
            </div>
        </div>      
    </body>
</html>