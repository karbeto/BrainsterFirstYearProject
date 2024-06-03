@extends('layouts.main')

@section('title', 'Forgot Password')

@section('content')
<section class="bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img src="./images/brainster-learn-logo 2.png" alt="logo">
        </a>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-[#8448e5] md:text-2xl">
                    Reset your password
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-[#8448e5]">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" placeholder="name@company.com" required="">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="w-full p-2 rounded-xl box-border text-white bg-purple-600 hover:bg-[#101010]">Send Password Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
