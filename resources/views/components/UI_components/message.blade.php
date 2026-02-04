@if(session('success') || session('error'))
    <div id="flash-message" 
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 px-8 py-6 rounded-lg shadow-2xl text-white font-semibold min-w-96 max-w-md
                {{ session('success') ? 'bg-green-500' : 'bg-red-500' }}">
        <div class="flex items-center justify-between gap-4">
            <span>{{ session('success') ?? session('error') }}</span>
            <button onclick="closeFlashMessage()" class="text-white hover:text-gray-200 font-bold text-xl">
                ×
            </button>
        </div>
    </div>

    <script>
        function closeFlashMessage() {
            const message = document.getElementById('flash-message');
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.3s ease-out';
            
            setTimeout(() => {
                message.remove();
            }, 300);
        }
        setTimeout(closeFlashMessage, 5000);
    </script>
@endif