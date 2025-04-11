<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Notion Clone</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-black">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md p-8">
            <div class="text-5xl font-bold text-center mb-10">N</div>
            <h1 class="text-2xl font-semibold text-center mb-6">Log in</h1>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:border-black transition-colors"
                        required autofocus>
                    @error('email')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:border-black transition-colors"
                        required>
                    @error('password')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" 
                    class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors">
                    Continue
                </button>
            </form>
            
            <a href="{{ route('register') }}" class="block text-center mt-6 text-sm text-black underline">
                Don't have an account? Sign up
            </a>
        </div>
    </div>
</body>
</html>