<x-guest-layout>
    <main class="wrapper">
        <section class="grid grid-cols-4 gap-8 mt-8">
            {{-- Sidenavbar --}}
            <x-partials.sidenav />

            <div class="flex flex-col col-span-3 gap-y-4">
                {{-- Alerts --}}
                <x-alerts.main />

                {{-- Categories Filter --}}
                <div class="mb-4">
                    <form action="{{ route('threads.index') }}" method="GET">
                        <label for="category" class="mr-2">Filter by Category:</label>
                        <select name="category" id="category" class="p-2 border-gray-300 rounded">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="p-2 bg-blue-500 text-white rounded">Filter</button>
                    </form>
                </div>                

                {{-- Threads List --}}
                @foreach ($threads as $thread)
                    <x-thread :thread="$thread" />
                @endforeach

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $threads->render() }}
                </div>
            </div>
        </section>
    </main>
</x-guest-layout>
