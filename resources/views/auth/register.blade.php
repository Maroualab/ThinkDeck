<!-- filepath: c:\laragon\www\notion_clone\resources\views\auth\register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Notion Clone</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-black">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md p-8">
            <div class="text-5xl font-bold text-center mb-10">N</div>
            <h1 class="text-2xl font-semibold text-center mb-6">Sign up</h1>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-2">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:border-black transition-colors"
                        required autofocus>
                    @error('name')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:border-black transition-colors"
                        required>
                    @error('email')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:border-black transition-colors"
                        required>
                    @error('password')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:border-black transition-colors"
                        required>
                </div>
                
                <button type="submit" 
                    class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors">
                    Continue
                </button>
            </form>
            
            <a href="{{ route('login') }}" class="block text-center mt-6 text-sm text-black underline">
                Already have an account? Log in
            </a>
        </div>
    </div>
</body>
</html>