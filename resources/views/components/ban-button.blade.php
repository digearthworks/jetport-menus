<button {{ $attributes->merge(['title' => 'ban', 'type' => 'submit', 'class' => 'inline-flex items-center justify-center w-6 h-6 mr-2 text-red-700 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-gray-200']) }}>
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
    {{ $slot }}
</button>
