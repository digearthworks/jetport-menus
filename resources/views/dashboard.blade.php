<x-7xl>
    <x-slot name="header">
        <div class="inline-flex items-center">
            @if($logged_in_user->isAdmin())
                {{__('Welcome, Admin.')}}
            @else
                {{__('Welcome, :user!', ['user' => $logged_in_user->name])}}
            @endif
        </div>

    </x-slot>
        <x-app-grid>
            @forelse($logged_in_user->all_menus->where('name', '!=', 'Dashboard') as $item)
                <x-article-stacked href="{{ $item->link }}" :target="($item->type == 'external_link') ? '_blank' : null">

                    <div class="w-24 h-24 ml-auto mr-auto picture-box">
                        {!! $item->icon->art !!}
                    </div>

                    <x-slot name="caption">
                        <p class="ml-auto mr-auto overflow-hidden leading-none tracking-tighter">
                            {{ $item->name ?? $item->link }}
                        </p>
                    </x-slot>
                </x-article-stacked>
            @empty
                <x-article-stacked>

                    <svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

                    <x-slot name="caption">
                        {{__('No Items')}}
                    </x-slot>
                </x-article-stacked>

            @endforelse
        </x-app-grid>
</x-7xl>


