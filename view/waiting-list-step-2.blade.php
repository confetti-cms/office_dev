@guest()
    @include('auth.redirect_to_login')
@else
    <div class="relative ">
        <div class="flex items-center justify-center w-full h-screen bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center w-full h-full max-w-2xl px-4 mx-auto text-center">
                <div class="absolute -mt-10 right-4 w-32 h-32 md:w-[400px] md:h-[400px] lg:w-[600px] lg:h-[600px] bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                <div class="absolute mt-[200px] -left-4 md:left-64 w-64 h-64 lg:w-[400px] lg:h-[400px] bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob "></div>
                <div class="absolute mt-[400px] left-20 md:left-32 w-64 h-64 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">You are now on the waiting list!</h1>
                <p class="mt-4 text-gray-700 dark:text-gray-400 text-base font-body font-bold">We send you an email when you can start using Confetti
                    CMS.</p>
                <a href="/docs"
                   class="bg-primary border-primary block z-10 w-full lg:w-1/2 rounded-md border mt-8 p-4 text-center text-base font-semibold text-white transition hover:bg-opacity-90">
                    Take a look at the documentation
                </a>
            </div>
        </div>
        <div>hello</div>
    </div>
@endguest