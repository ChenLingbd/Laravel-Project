<x-template-layout>
    <script src="{{ asset('js/admin/user.js') }}"></script>

    <div class="flex flex-col md:flex-row h-screen bg-gray-100">
        <x-side-bar />

        <!-- 主要內容區 -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <x-navbar-admin />

            <!-- 主要內容 -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <h3 class="text-gray-700 text-3xl font-medium mb-6">用戶管理</h3>

                    <!-- 用戶搜索部分 -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h2 id="users-title" class="text-xl font-semibold text-gray-900">用戶</h2>
                            <div>
                                <label for="search-users" class="sr-only">搜索用戶</label>
                                <input type="text" id="search-users"
                                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm"
                                    placeholder="Search...">
                            </div>
                        </div>

                        <!-- 搜索結果 -->
                        <div id="search-results" class="bg-white shadow overflow-hidden sm:rounded-lg"
                            style="display: none;">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <x-table-user />
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <!-- Search results will be dynamically inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- All users 部分 -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">所有用戶</h2>
                        <div id="all-users-list" class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                用戶名稱</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                檢舉</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                權限</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                停用</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-full"
                                                                src="{{ asset('images/account.png') }}"
                                                                alt="{{ $user->name }}">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $user->name }}</div>
                                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex items-center space-x-2">
                                                        <span
                                                            >{{ $user->reports_count ?? 0 }}次</span>
                                                        <x-button-red-short>
                                                            檢舉詳情
                                                        </x-button-red-short>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        @if ($user->hasRole('admin'))
                                                            管理者
                                                        @else
                                                            使用者
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <x-button-red-short
                                                        onclick="showSuspendDialog({{ $user->id }}, {{ json_encode($user->name) }})">
                                                        停用
                                                    </x-button-red-short>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-template-layout>
