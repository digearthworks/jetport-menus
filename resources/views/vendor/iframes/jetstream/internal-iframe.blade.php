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
                src="{{ url($iframeSource . '?' . http_build_query($_GET)) }}"
                class="mainFrame">
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
                src="{{ url($iframeSource) }}"
                class="mainFrame">
            </iframe>
        </div>

    @endif
</x-app-layout>
