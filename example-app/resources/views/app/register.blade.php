@extends('layouts.main')

@section('title', 'Sign Up')

@section('content')
@if ($errors->any())
        <h2>Errors</h2>
        @foreach ($errors->all() as $error)
           <p> {{ $error }}</p>
        @endforeach
    @endif
<section class="bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img src="./images/brainster-learn-logo 2.png" alt="logo">  
        </a>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-[#8448e5] md:text-2xl slide-in">
                    Create your account
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('auth.register') }}">
    @csrf
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-[#8448e5]">Your name</label>
        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" placeholder="John Doe" value="{{ old('name') }}" required>
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="company" class="block mb-2 text-sm font-medium text-[#8448e5]">Company Name</label>
        <input type="text" name="company" id="company" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" placeholder="Company Inc." value="{{ old('company') }}" required>
        @error('company')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-[#8448e5]">Your email</label>
        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" placeholder="name@company.com" value="{{ old('email') }}" required>
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-[#8448e5]">Password</label>
        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        <div id="passwordRequirements" class="hidden mt-2 bg-gray-50 border border-gray-300 p-2 rounded-lg">
            <p id="charLength" class="invalid">At least 8 characters</p>
            <p id="number" class="invalid">At least 1 number</p>
            <p id="uppercase" class="invalid">At least 1 uppercase letter</p>
            <p id="specialChar" class="invalid">At least 1 special character</p>
        </div>
    </div>
    <div>
        <label for="confirm_password" class="block mb-2 text-sm font-medium text-[#8448e5]">Confirm Password</label>
        <input type="password" name="password_confirmation" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
        @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex items-center justify-between">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50">
            </div>
            <div class="ml-3 text-sm">
                <label for="remember" class="text-gray-500">Remember me</label>
            </div>
        </div>
    </div>
    <button type="submit" class="w-full p-2 rounded-xl box-border text-white bg-purple-600 hover:bg-[#101010]">Sign up</button>
    <p class="text-sm font-light text-gray-500">
        Already have an account? <a href="{{ route('login') }}" class="font-medium text-[#f54646] hover:underline">Log in</a>
    </p>
</form>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('js/register-validator.js') }}" defer></script>
@endsection
