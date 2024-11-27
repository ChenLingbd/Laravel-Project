<x-template-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <div class="flex flex-col md:flex-row h-screen bg-gray-100">
        <x-side-bar />

        <!-- 主要內容區 -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- 頂部導航欄 -->
            <x-navbar-admin />

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h3 class="text-gray-700 text-3xl font-medium mb-6">新增角色</h3>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <!-- 表单开始 -->
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf <!-- CSRF 保护 -->
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            選擇 </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            名稱</th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                        @if (!$user->hasRole('admin') && !$user->hasRole('user'))
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <!-- 勾选框，传递每个用户的 ID -->
                                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                                        class="form-checkbox h-4 w-4 text-blue-600">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $user->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $user->email }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- 分页 -->
                            <div>
                                {{ $users->links() }} <!-- 这里会自动生成分页链接 -->
                            </div>

                            <!-- 隐藏字段，用于传递角色类型 -->
                            <input type="hidden" name="role_type" value="{{ $type }}">

                            <!-- 提交按钮 -->
                            <div class="mt-4 flex justify-end space-x-4">
                                <button type="button" id="cancelBtn"
                                    class="bg-blue-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    取消
                                </button>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    確認
                                </button>
                            </div>
                        </form>
                        <!-- 表单结束 -->
                    </div>

                <script>
                    // 取消按钮的行为
                    document.getElementById('cancelBtn').addEventListener('click', function() {
                        window.location.href = '{{ route('admin.roles.index') }}';
                    });
                </script>
            </div>
        </main>
    </div>
</div>
</x-template-layout>

