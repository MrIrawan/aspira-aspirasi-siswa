<aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0 flex flex-col justify-between">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-primary mb-8">SchoolVoice</h1>
        <button onclick="document.getElementById('modalCreate').classList.remove('hidden')" class="w-full bg-primary hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition-all mb-6 flex items-center justify-center gap-2">
            <span>+ Buat Aspirasi</span>
        </button>
        
        <nav class="space-y-2">
            <a href="<?= BASEURL ?>/student" class="block p-3 rounded-lg bg-indigo-50 text-primary font-medium">Dashboard</a>
            <a href="<?= BASEURL ?>/student/inbox" class="block p-3 rounded-lg hover:bg-gray-50 text-gray-600">Inbox</a>
        </nav>
    </div>
    <div class="p-4 border-t">
        <a href="<?= BASEURL ?>/auth/logout" class="text-red-500 hover:text-red-700 text-sm font-medium block text-center">Logout</a>
    </div>
</aside>

<main class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b h-16 flex items-center justify-between px-8">
        <h2 class="font-semibold text-lg">Aspirasi Saya</h2>
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-500">Halo, <?= $_SESSION['name'] ?></span>
            <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-xs">U</div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($data['aspirations'] as $asp): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow relative group">
                <div class="flex justify-between items-start mb-3">
                    <span class="px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-600"><?= $asp['category'] ?></span>
                    <span class="text-xs text-gray-400"><?= date('d M', strtotime($asp['created_at'])) ?></span>
                </div>
                <h3 class="font-bold text-lg mb-2 text-gray-800"><?= $asp['title'] ?></h3>
                <p class="text-gray-500 text-sm mb-4 line-clamp-2"><?= $asp['description'] ?></p>
                
                <div class="flex items-center justify-between mt-4">
                    <span class="text-xs font-medium 
                        <?= $asp['status'] == 'Terkirim' ? 'text-blue-500' : ($asp['status'] == 'Diproses' ? 'text-yellow-500' : 'text-green-500') ?>">
                        ● <?= $asp['status'] ?>
                    </span>
                    <a href="<?= BASEURL ?>/chat/room/<?= $asp['id'] ?>" class="text-indigo-600 text-sm font-semibold hover:underline">Buka Chat &rarr;</a>
                </div>
                
                <button class="absolute top-4 right-4 text-gray-300 hover:text-gray-600 hidden group-hover:block">•••</button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<div id="modalCreate" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 animate-fade-in-up">
        <h3 class="text-xl font-bold mb-4">Aspirasi Baru</h3>
        <form action="<?= BASEURL ?>/student/create" method="POST">
            <div class="space-y-4">
                <input type="text" name="title" placeholder="Judul Aspirasi" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary" required>
                <select name="category" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="Lingkungan">Lingkungan</option>
                    <option value="Bullying">Bullying</option>
                    <option value="Sarana-prasarana">Sarana & Prasarana</option>
                    <option value="Kebersihan">Kebersihan</option>
                </select>
                <textarea name="description" placeholder="Jelaskan detail aspirasi..." rows="4" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary" required></textarea>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="button" onclick="document.getElementById('modalCreate').classList.add('hidden')" class="flex-1 py-2 text-gray-500 font-medium hover:bg-gray-100 rounded-lg">Batal</button>
                <button type="submit" class="flex-1 py-2 bg-primary text-white font-bold rounded-lg hover:bg-indigo-700">Kirim</button>
            </div>
        </form>
    </div>
</div>