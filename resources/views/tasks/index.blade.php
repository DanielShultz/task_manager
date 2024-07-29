<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Задачи') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('tasks.create') }}">
                        {{ __('Создать задачу') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="max-w-7xl mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Название
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Описание
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Статус
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Исполнитель
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Автор
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Изменить</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ $task->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $task->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $task->status->name }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($task->assignedTo === null)
                                Нет исполнителя
                            @else
                                {{ $task->assignedTo->name }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $task->createdBy->name }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Изменить</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
