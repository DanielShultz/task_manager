<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Изменить задачу') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')

            <div class="mt-4">
                <x-input-label for="name" :value="__('Название')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus
                    autocomplete="name" value="{{ $task->name }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Описание')" />
                <x-textarea id="description" class="block mt-1 w-full" name="description" autocomplete="description">
                    {{ $task->description }}
                </x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="assigned" :value="__('Исполнитель')" />
                <x-select id="assigned" class="block mt-1 w-full" name="assigned" autocomplete="assigned">
                    <option value="">Нет исполнителя</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $task->assignedTo == $user ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('assigned')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="status" :value="__('Статус')" />
                <x-select id="status" class="block mt-1 w-full" name="status" autocomplete="status">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ $task->status == $status ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>


            <div class="flex flex-wrap py-4">
                @foreach ($labels as $label)
                    <div class="flex items-center me-4">
                        <input id="label_{{ $label->id }}" type="checkbox" value="{{ $label->id }}"
                            name="labels[]"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            {{ $task->labels->contains($label) ? 'checked' : '' }}>
                        <label for="label_{{ $label->id }}"
                            class="ms-2 me-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            #{{ $label->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <x-primary-button style="width: 100%">
                    {{ __('Изменить') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</x-app-layout>
