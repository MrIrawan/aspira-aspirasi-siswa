<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login | SchoolVoice</title>
</head>
<body class="bg-indigo-600 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Welcome Back</h2>
        <p class="text-center text-gray-500 mb-8">Silakan masuk ke akun SchoolVoice</p>
        
        <form action="<?= BASEURL ?>/auth/login" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="admin / siswa" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="123" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">Login</button>
        </form>
    </div>
</body>
</html>