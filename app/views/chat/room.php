<div class="flex-1 flex flex-col h-full bg-white">
    <div class="h-16 border-b flex items-center justify-between px-6 bg-white shadow-sm z-10">
        <div>
            <h2 class="font-bold text-gray-800 text-lg"><?= $data['aspiration']['title'] ?></h2>
            <div class="flex items-center gap-2 text-xs">
                <span class="text-gray-500">Status:</span>
                <span class="font-semibold text-primary uppercase tracking-wide"><?= $data['aspiration']['status'] ?></span>
            </div>
        </div>
        <a href="<?= BASEURL ?>/<?= $_SESSION['role'] ?>" class="text-gray-400 hover:text-gray-600">✕ Tutup</a>
    </div>

    <div id="chatBox" class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50">
        </div>

    <div class="p-4 bg-white border-t">
        <form id="chatForm" class="flex gap-4 items-end" enctype="multipart/form-data">
            <input type="hidden" name="aspiration_id" value="<?= $data['aspiration']['id'] ?>">
            
            <label class="cursor-pointer text-gray-400 hover:text-primary p-2">
                <input type="file" name="image" class="hidden" accept="image/*">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            </label>

            <textarea name="message" class="w-full border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary resize-none" rows="1" placeholder="Ketik pesan..."></textarea>
            
            <button type="submit" class="bg-primary text-white p-3 rounded-xl hover:bg-indigo-700 shadow-lg transition-transform transform active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
            </button>
        </form>
    </div>
</div>

<script>
const chatBox = document.getElementById('chatBox');
const aspirationId = <?= $data['aspiration']['id'] ?>;
const myId = <?= $_SESSION['user_id'] ?>;

// Fungsi Render Pesan
function renderChat(messages) {
    chatBox.innerHTML = messages.map(msg => {
        const isMe = msg.sender_id == myId;
        return `
            <div class="flex ${isMe ? 'justify-end' : 'justify-start'}">
                <div class="max-w-[70%] ${isMe ? 'bg-primary text-white rounded-br-none' : 'bg-white text-gray-800 border rounded-bl-none'} rounded-2xl p-4 shadow-sm">
                    ${!isMe ? `<div class="text-xs font-bold mb-1 opacity-70">${msg.full_name}</div>` : ''}
                    ${msg.image_path ? `<img src="<?= BASEURL ?>/${msg.image_path}" class="rounded-lg mb-2 max-w-full">` : ''}
                    <p class="text-sm">${msg.message}</p>
                    <div class="text-[10px] mt-1 ${isMe ? 'text-indigo-200' : 'text-gray-400'} text-right">
                        ${msg.created_at}
                    </div>
                </div>
            </div>
        `;
    }).join('');
    // Auto scroll ke bawah
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Fetch Data (Polling setiap 2 detik)
async function fetchMessages() {
    const res = await fetch(`<?= BASEURL ?>/chat/getMessages/${aspirationId}`);
    const data = await res.json();
    renderChat(data);
}

// Kirim Pesan AJAX
document.getElementById('chatForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    await fetch('<?= BASEURL ?>/chat/send', { method: 'POST', body: formData });
    e.target.reset();
    fetchMessages();
});

setInterval(fetchMessages, 2000); // Polling start
fetchMessages(); // First load
</script>