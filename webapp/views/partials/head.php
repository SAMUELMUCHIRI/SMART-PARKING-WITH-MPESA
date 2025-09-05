<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
          <style>
                @keyframes scroll {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
                }
                .animate-scroll {
                animation: scroll 20s linear infinite;
                }
                .animate-scroll:hover {
                animation-play-state: paused;
                }
                /* Fade mask using CSS gradients */
                .fade-mask {
                -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
                -webkit-mask-repeat: no-repeat;
                -webkit-mask-size: 100% 100%;
                mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
                mask-repeat: no-repeat;
                mask-size: 100% 100%;
                }
            </style>
        
        <link rel="stylesheet" href="/src/input.css">
  
    </head>