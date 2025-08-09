<x-app-layout>


<div class="max-w-4xl mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('orders.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Back') }}
        </a>        
    </div>
    <h2 class="text-gray-500 text-2xl font-semibold mb-4">Información para exportación</h2>

    <textarea id="infoText" rows="20" class="w-full p-3 border rounded text-sm">{{ $text }}</textarea>

    <button onclick="copyText()" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        Copiar al portapapeles
    </button>

    <p id="copiedMsg" class="text-green-600 mt-2 hidden">¡Texto copiado!</p>
</div>

<script>
    function copyText() {
        const textarea = document.getElementById('infoText');
        textarea.select();
        textarea.setSelectionRange(0, 99999); // para dispositivos móviles
        document.execCommand('copy');

        const msg = document.getElementById('copiedMsg');
        msg.classList.remove('hidden');
        setTimeout(() => msg.classList.add('hidden'), 2000);
    }
</script>
</x-app-layout>
