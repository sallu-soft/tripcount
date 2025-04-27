<x-guest-layout>
    <!-- Session Status -->
    @if ($errors->any())
                <div class="alert z-50 w-fit mx-auto mb-[500px] alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <style media="screen">
        *,
    *:before,
    *:after{
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }
    body{
      background-color: #F0EFEF;
    }
    .background{
      width: 430px;
      height: 520px;
      position: absolute;
      transform: translate(-50%,-50%);
      left: 50%;
      top: 60%;
    }
    .background .shape{
      height: 120px;
      width: 120px;
      position: absolute;
      border-radius: 50%;
    }
    .shape:first-child{
      background: linear-gradient(
          #1845ad,
          #23a2f6
      );
      left: -50px;
      top: -50px;
    }
    .shape:last-child{
      background: linear-gradient(
          to right,
          #ff512f,
          #f09819
      );
      right: -30px;
      bottom: -70px;
    }
    form{
      height: 520px;
      width: 400px;
      background-color: #00959F;
      position: absolute;
      transform: translate(-50%,-50%);
      top: 60%;
      left: 50%;
      border-radius: 10px;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255,255,255,0.1);
      box-shadow: 0 0 40px rgba(8,7,16,0.6);
      padding: 50px 35px;
    }
    form *{
      font-family: 'Poppins',sans-serif;
      color: #ffffff;
      letter-spacing: 0.5px;
      outline: none;
      border: none;
    }
    form h3{
      font-size: 32px;
      font-weight: 500;
      line-height: 42px;
      text-align: center;
    }
    
    label{
      display: block;
      margin-top: 20px;
      font-size: 18px;
      font-weight: 500;
    }
    input{
      display: block;
      height: 50px;
      width: 100%;
      background-color: rgba(255,255,255,0.07);
      border-radius: 3px;
      padding: 0 10px;
      margin-top: 8px;
      font-size: 14px;
      font-weight: 300;
    }
    ::placeholder{
      color: white;
    }
    button{
      margin-top: 20px;
      width: 100%;
      background-color: #ffffff;
      color: #080710;
      padding: 10px 0;
      font-size: 18px;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
    }
    .social{
    margin-top: 30px;
    display: flex;
    }
    .social a{
    background: red;
    width: 150px;
    border-radius: 3px;
    padding: 5px 10px 10px 5px;
    background-color: rgba(255,255,255,0.27);
    color: #eaf0fb;
    text-align: center;
    }
    .social a:hover{
    background-color: rgba(255,255,255,0.47);
    }
    .social .fb{
    margin-left: 25px;
    color:black;
    background-color: white;
    }
    .social .go{
    margin-left: 25px;
    color:black;
    background-color: white;
    }
    .social i{
    margin-right: 4px;
    }
    @media (max-width: 1000px) {
            .background {
                width: 330px;
                height: 420px;
            }
            .shape:first-child {
                left: -80px;
                top: -80px;
            }
            .shape:last-child {
                right: -80px;
                bottom: -80px;
            }
            form {
                width: 400px;
                height: 520px;
            }
            input{
                display: block;
                height: 30px;
                width: 100%;
                background-color: rgba(255,255,255,0.07);
                border-radius: 3px;
                padding: 0 10px;
                margin-top: 8px;
                font-size: 11px;
                font-weight: 300;
                
            }
            .background .shape{
            height: 120px;
            width: 120px;
            position: absolute;
            border-radius: 50%;
            }
        }

        @media (max-width: 767px) {
            .background {
                flex-direction: column;
                height: 100%;
                padding: 20px;
            }
            .shape:first-child,
            .shape:last-child {
                display: none;
            }
            form {
                padding: 30px 20px;
            }
        }
    
    </style>
    
    {{-- <main class="flex flex-col md:flex-row mx-auto w-full md:w-[80%] lg:w-[70%] xl:w-[60%] shadow-2xl bg-white rounded-lg border border-gray-300">
        
        <div class="w-full md:w-[60%] ">

            <div id="default-carousel" class="relative " data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="overflow-hidden relative min-h-[485px] rounded-r-lg ">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <span
                            class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First
                            Slide</span>
                        <img src={{url('/image/ban4.jpeg')}} title="source: imgur.com"
                            class="block absolute top-1/2 left-1/2 w-full h-full -translate-x-1/2 -translate-y-1/2"
                            alt="Banner">
                    </div>

                    <!-- <a href="https://imgur.com/02qczMI"><img src="https://i.imgur.com/02qczMI.jpg" title="source: imgur.com" /></a> -->
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src={{url('/image/ban1.jpeg')}}
                            class="block absolute top-1/2 left-1/2 w-full h-full -translate-x-1/2 -translate-y-1/2"
                            alt="Banner">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src={{url('/image/ban2.jpeg')}}
                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                            alt="Banner">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src={{url('/image/ban3.jpeg')}}
                            class="block absolute top-1/2 left-1/2 w-full h-full -translate-x-1/2 -translate-y-1/2"
                            alt="Banner">
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1"
                        data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                        data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                        data-carousel-slide-to="2"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                        data-carousel-slide-to="3"></button>
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>


        </div>
        <div class="w-full md:w-[40%] flex flex-col bg-white md:rounded-l-lg">
            <div class="flex justify-end mb-3" >
                <a href="{{ route('login') }}" class=" text-gray-600 hover:text-gray-100 dark:text-gray-400 hover:no-underline hover:bg-[#00959F] dark:hover:text-white border-2 border-[#00959F] duration-300 font-semibold py-2 px-5">Log in</a>

                @if (Route::has('emp_login'))
                    <a href="{{ route('emp_login') }}" class="font-semibold py-2 px-5 hover:text-gray-900 dark:text-gray-400 hover:no-underline dark:hover:text-white bg-[#00959F] text-white border-2 hover:bg-white hover:border-2 border-[#00959F] duration-300">Employer Login</a>
                @endif
            </div>
            <div class="flex justify-center flex-col items-center px-5">
               
                <h3 class=" text-gray-900 font-bold text-2xl my-4">Login</h3>
            </div>

            <form method="POST" class="px-5" action="{{ route('login') }}">
                @csrf
                <div class="flex items-cener flex-col gap-2 mb-4 ">
                    <label for="email" class="text-gray-800 font-semibold w-[40%]">Email</label>
                    <input type="text" id="email" placeholder="example@mail.com" name="email" required
                        class="border rounded-md p-2 h-10 text-black bg-white" />
                </div>
                <div class="flex items-cener flex-col gap-2 mb-4 ">
                    <label for="paymentMethod" class="text-gray-800 font-semibold w-[40%]">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password"
                        class=" border rounded-md p-2 h-10 text-black bg-white" />
                </div>
                <div class="flex flex-col gap-3">
                    <button class="bg-cyan-700 px-7 py-2 rounded-lg text-lg font-medium text-white"
                        type="submit">Submit</button>
                    @if (Route::has('password.request'))
                        <a class="font-medium text-md text-blue-800" href="{{ route('password.request') }}">forgot password?</a>
                    @endif
                </div>
            </form>
        </div>

    </main> --}}
    
    <main class="!bg-gray-200">
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" class="px-5 py-4 " action="{{ route('login') }}">
        @csrf
        <h3 class="">Login Here</h3>

        <label for="email">Email</label>
        <input type="text" placeholder="Email" id="email" name="email" >

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">

        <button type="submit">Log In</button>
        @if (Route::has('password.request'))
        <a class="font-medium text-md pt-3 text-white" href="{{ route('password.request') }}">forgot password?</a>
        @endif
        <div class="social">
          <a class="go" href="{{ route('login') }}">Login</a>
          <a class="fb" href="{{ route('emp_login') }}">  Employer Login</a>
        </div>
    </form>
</main>
</x-guest-layout>
