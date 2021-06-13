<x-app-layout>
    <div class="w-full h-screen frameHolder">
        <iframe
            name='mainFrame'
            id="mainFrame"
            class="w-full h-full mainFrame"
            frameborder="0"
            noresize='noresize'
            scrolling='auto'
            src="{{ $frame }}"
            class="mainFrame">
        </iframe>
    </div>
</x-app-layout>
