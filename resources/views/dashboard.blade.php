<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                        Monitoramento
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a href="/telescope" target="_blank"
                           class="flex items-center gap-4 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <div class="p-3 bg-indigo-800 rounded-xl">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M4 17l6-6 4 4 6-6"></path>
                                    <path d="M2 19h20"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Telescope</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Ferramenta de debug e monitoramento.
                                </p>
                            </div>
                            <svg class="text-white w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M10 5H8.2C7.08 5 6.52 5 6.09 5.22 5.72 5.41 5.41 5.72 5.22 6.09 5 6.52 5 7.08 5 8.2v7.6c0 1.12 0 1.68.22 2.1.19.38.5.69.87.88.42.22 1 .22 2.11.22h7.61c1.12 0 1.68 0 2.1-.22.38-.19.69-.5.88-.87.22-.42.22-1 .22-2.12V14M20 9V4M20 4h-5M20 4l-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
