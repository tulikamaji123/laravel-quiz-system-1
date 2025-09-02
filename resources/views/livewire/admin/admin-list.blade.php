<div>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-purple-600">
            Admins
        </h2>
    </x-slot>

    <x-slot name="title">
        Admins
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gradient-to-br from-indigo-50 via-white to-pink-50 shadow-xl sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    {{-- Create Admin Button --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.create') }}"
                            class="inline-flex items-center rounded-md bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-2 text-sm font-bold uppercase tracking-wide text-black shadow hover:from-blue-700 hover:to-purple-700 transition-all">
                            + Create Admin
                        </a>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gradient-to-r from-indigo-100 to-purple-100">
                                <tr>
                                    <th class="w-16 px-6 py-3 text-left">
                                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-700">ID</span>
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-700">Name</span>
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-700">Email</span>
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-700">Actions</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse($admins as $admin)
                                    <tr class="hover:bg-indigo-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-800">
                                            {{ $admin->id }}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-blue-600">
                                            {{ $admin->name }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-700">
                                            {{ $admin->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button wire:click="delete({{ $admin->id }})"
                                                class="rounded-md bg-red-100 px-4 py-2 text-xs font-semibold uppercase text-red-600 shadow-sm hover:bg-red-200 hover:text-red-800 transition">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-yellow-50">
                                        <td colspan="8"
                                            class="px-6 py-4 text-center font-medium text-yellow-800">
                                            🚫 No admins were found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
