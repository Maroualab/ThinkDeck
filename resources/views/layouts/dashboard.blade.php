<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Notion Clone</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-black dark:bg-[#191919] dark:text-white" x-data="{ sidebarOpen: true }">
    <div class="h-screen flex overflow-hidden">
        <!-- Sidebar -->
        <div 
            x-show="sidebarOpen" 
            class="w-64 h-screen bg-[#F7F7F7] dark:bg-[#202020] border-r border-gray-200 dark:border-gray-800 flex-shrink-0 overflow-y-auto transition-all duration-200"
        >
            <div class="p-4">
                <!-- User Profile Section -->
                <div class="flex items-center mb-6">
                    <div class="w-6 h-6 rounded-md bg-gray-300 dark:bg-gray-700 flex items-center justify-center text-sm font-medium">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="ml-2 text-sm font-medium truncate">
                        {{ auth()->user()->name ?? 'User' }}'s Notion
                    </div>
                </div>
                
                <!-- Search -->
                <div class="mb-6">
                    <div class="flex items-center px-3 py-1.5 rounded-md bg-white dark:bg-[#2F2F2F] border border-gray-200 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Search" class="ml-2 bg-transparent w-full focus:outline-none text-sm py-1">
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="mb-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-2 py-1.5 rounded-md hover:bg-gray-200 dark:hover:bg-gray-800 mb-1 {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-800' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>
                    <button 
                        onclick="openModal('createPageModal')" 
                        class="w-full flex items-center px-2 py-1.5 rounded-md hover:bg-gray-200 dark:hover:bg-gray-800 mb-1 text-left"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Page
                    </button>
                </div>
                
                <!-- Workspaces -->
                <div>
                    <div class="flex items-center justify-between px-2 py-1 text-xs text-gray-500 dark:text-gray-400 font-medium uppercase mb-1">
                        <span>Workspaces</span>
                        <button 
                            onclick="openModal('createWorkspaceModal')" 
                            class="hover:bg-gray-200 dark:hover:bg-gray-800 p-1 rounded"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="space-y-1">
                        @forelse(auth()->user()->workspaces ?? [] as $workspace)
                            <a href="{{ route('workspaces.show', $workspace->id) }}" class="flex items-center px-2 py-1.5 rounded-md hover:bg-gray-200 dark:hover:bg-gray-800"></a>
                                <div class="w-4 h-4 flex items-center justify-center mr-2 bg-blue-500 rounded">
                                    <span class="text-xs text-white">{{ substr($workspace->name ?? 'W', 0, 1) }}</span>
                                </div>
                                <span class="truncate">{{ $workspace->name }}</span>
                            </a>
                        @empty
                            <div class="px-2 py-1.5 text-sm text-gray-500 dark:text-gray-400">
                                No workspaces yet
                            </div>
                        @endforelse
                            <button 
                                onclick="openModal('createWorkspaceModal')" 
                                class="flex items-center px-2 py-1.5 text-sm text-blue-600 dark:text-blue-400 hover:underline"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create workspace
                            </button>
                    </div>

                    <!-- Recent Pages -->
                    <div class="mt-6">
                        <div class="px-2 py-1 text-xs text-gray-500 dark:text-gray-400 font-medium uppercase mb-1">
                            Recently Viewed
                        </div>
                        <div class="space-y-1">
                            @forelse(auth()->user()->recentPages ?? [] as $page)
                                <a href="#" class="flex items-center px-2 py-1.5 rounded-md hover:bg-gray-200 dark:hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="truncate">{{ $page->title ?? 'Untitled' }}</span>
                                </a>
                            @empty
                                <div class="px-2 py-1.5 text-sm text-gray-500 dark:text-gray-400">
                                    No recent pages
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Trash -->
                    <div class="mt-6">
                        <a href="#" class="flex items-center px-2 py-1.5 rounded-md hover:bg-gray-200 dark:hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Trash
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 h-screen overflow-hidden">
            <!-- Top Bar -->
            <div class="h-12 border-b border-gray-200 dark:border-gray-800 flex items-center px-4">
                <div class="flex items-center">
                    <button 
                        @click="sidebarOpen = !sidebarOpen" 
                        class="mr-4 p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-800"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="text-sm font-medium">
                        @yield('breadcrumbs', 'Dashboard')
                    </div>
                </div>
                <div class="ml-auto flex items-center space-x-3">
                    <button class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    <button class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <div class="relative" x-data="{ open: false }">
                        <button 
                            @click="open = !open" 
                            class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700 overflow-hidden flex items-center justify-center"
                        >
                            <span>{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                        </button>
                        
                        <div 
                            x-show="open" 
                            @click.away="open = false" 
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-900 rounded-md shadow-lg py-1 border border-gray-200 dark:border-gray-800 z-10"
                        >
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">
                                Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">
                                Settings
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-800 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800 text-red-600 dark:text-red-400">
                                    Log out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto overflow-x-hidden p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Create Page Modal -->
    <div id="createPageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50" onclick="closeModal('createPageModal')"></div>
        <div class="relative bg-white dark:bg-gray-900 rounded-lg w-full max-w-md p-6">
            <h2 class="text-xl font-bold mb-4">Create a page</h2>
            <form action="{{ route('pages.store') ?? '#' }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-800" placeholder="Untitled" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Workspace</label>
                    <select name="workspace_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-800" required>
                        @forelse(auth()->user()->workspaces ?? [] as $workspace)
                            <option value="{{ $workspace->id }}">{{ $workspace->name }}</option>
                        @empty
                            <option disabled>No workspaces available</option>
                        @endforelse
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md" onclick="closeModal('createPageModal')">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-black text-white dark:bg-white dark:text-black rounded-md hover:bg-gray-800 dark:hover:bg-gray-200">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Workspace Modal -->
    <div id="createWorkspaceModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50" onclick="closeModal('createWorkspaceModal')"></div>
        <div class="relative bg-white dark:bg-gray-900 rounded-lg w-full max-w-md p-6">
            <h2 class="text-xl font-bold mb-4">Create a workspace</h2>
            <form action="{{ route('workspaces.store') ?? '#' }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-800" placeholder="Workspace name" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md" onclick="closeModal('createWorkspaceModal')">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-black text-white dark:bg-white dark:text-black rounded-md hover:bg-gray-800 dark:hover:bg-gray-200">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</body>
</html>