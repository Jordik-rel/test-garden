<nav class="w-full h-[100px] flex flex-col justify-between mb-8 z-50">
    <div class="flex justify-between items-center w-full bg-[#27963C] h-fit text-white font-medium p-4 px-10 max-md:justify-between">
        <div class="flex items-center space-x-4 px-2 text-sm">
            <p class="flex items-center space-x-2"><i class="fa-solid fa-phone rotate-70"></i><span>+229 01 XX XX XX XX</span> </p>
            <p class="flex items-center space-x-2"><i class="fa-solid fa-envelope"></i><span>contact@gardenaconnect.com</span></p>
        </div>
        <div>
           <ul class="flex items-center px-2 space-x-2 text-sm font-semibold border-white">
                <li class="border-r-2 px-2">
                    <a href="#">Blog</a>
                </li>

                <li class="px-2 border-r-2">
                    <a href="#">FAQs</a>
                </li>

                <li >
                    <a href="#">Fr</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="flex justify-between items-center p-2 h-fit">
        <div class="h-[70px]">
            <!-- <h1 class="font-extralight text-3xl text-green-800">Green Connect</h1> -->
             <a href="/"><img src="{{asset('logo.png')}}" alt="Logo Green Connect" class="w-full h-full object-contain"></a>
        </div>
        <ul class="flex justify-between items-center text-slate-700 font-medium max-md:hidden">
            <li class="mr-4"><a href="/">Accueil</a></li>
            <li class="mr-4 "><a href="/#fonctionnement">Fonctionnement</a></li>
            <li class="mr-4 "><a href="#">Communauté</a></li>
            <li class="mr-4 "><a href="#">Plantes</a></li>
            <li class="mr-4 "><a href="#">Contact</a></li>
        </ul>
        <ul class="flex justify-between items-center max-md:hidden">
            <li class="mr-3"><a href="{{ route('register') }}" class="inline-block px-5 py-1.5 bg-green-700 font-semibold text-white text-base dark:text-[#fdfdfb] border-[#19140035] hover:border-[#1915014a] border  dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm leading-normal">Créer mon compte</a></li>
            <li class="mr-3"><a href="{{ route('login') }}"  class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-base leading-normal">Me Connecter</a></li>
        </ul>
    </div>
</nav>
