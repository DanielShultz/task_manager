<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Подробно о задаче') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-2xl font-semibold">
                        {{ $task->name }}
                    </div>
                    <br>
                    <x-textarea class="w-full" rows="10" readonly>
                        {{ $task->description }}
                    </x-textarea>
                    <br>
                    <br>
                    <div>
                        Статус: {{ $task->status->name }}
                    </div>
                    <div>
                        Исполнитель: {{ $task->assignedTo->name }}
                    </div>
                    <div>
                        Автор: {{ $task->createdBy->name }}
                    </div>
                    <div>
                        Создано: {{ $task->created_at }}
                    </div>
                    <div>
                        Обновлено: {{ $task->updated_at }}
                    </div>
                    <br>
                    <div>
                        @foreach ($task->labels as $label)
                            #{{ $label->name }}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <x-primary-link href="{{ route('tasks.index') }}">
            {{ __('На главную страницу') }}
        </x-primary-link>
    </div>

</x-app-layout>
