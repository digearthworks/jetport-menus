<x-app-layout>
    @if(!empty($_GET))

        <div class="w-full h-screen frameHolder">
            <iframe
                name='mainFrame'
                id="mainFrame"
                class="w-full h-full mainFrame"
                frameborder="0"
                noresize='noresize'
                scrolling='auto'
                src="{{ url($frame . '?' . http_build_query($_GET)) }}"
                class="maniFrame">
            </iframe>
        </div>
    @else

        <div class="w-full h-screen frameHolder">
            <iframe
                name='mainFrame'
                id="mainFrame"
                class="w-full h-full mainFrame"
                frameborder="0"
                noresize='noresize'
                scrolling='auto'
                src="{{ url($frame) }}"
                class="mainFrame">
            </iframe>
        </div>

    @endif
</x-app-layout>
