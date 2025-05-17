@extends('layouts.guest')

@section('title', 'Forgot Password - Concrete Plant Management System')

@section('content')
    <div class="sm:mx-auto sm:w-full">
        <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 dark:text-white">
            Forgot your password?
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
            Enter your email address and we'll send you a link to reset your password.
        </p>
    </div>

    @if (session('status'))
        <div class="mb-4 p-4 rounded-md bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700">
            <p class="font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </p>
        </div>
    @endif

    <div class="mt-6">
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">
                    Email address
                </label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" required
                        value="{{ old('email') }}"
                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:focus:ring-blue-500 sm:text-sm sm:leading-6">
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 dark:bg-blue-700 dark:hover:bg-blue-600">
                    Send Password Reset Link
                </button>
            </div>

            <div class="flex items-center justify-center">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                    Back to login
                </a>
            </div>
        </form>
    </div>
@endsection
