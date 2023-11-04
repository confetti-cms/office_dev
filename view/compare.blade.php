@php($compare = section('homepage/compare')->label('Compare'))
<div class="bg-gray-50 flex items-center justify-center">
    @php($cases = $compare->list('cases')->columns(['title', 'description'])->min(1)->max(4))
    <div class="relative w-full" x-data="{ tab: '0'}">
        <div class="absolute top-0 right-0 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-20 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob "></div>
        <div class="absolute -bottom-32 left-20 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        <div class="relative">
            <div class="flex mt-8 mb-10 space-x-4 text-xl border-b border-gray-300">
                @foreach($cases as $tapNr => $case)
                    <div class="hover:text-indigo-600 py-2 p-2 cursor-pointer"
                         :class="{'text-indigo-600 border-b border-indigo-600': tab == '{{ $tapNr }}'}"
                         @click="tab = '{{ $tapNr }}'">
                        <span>{{ $case->text('title')->min(1)->max(20) }}</span>
                        <span>{{ $case->text('description')->min(1)->max(20) }}</span>
                    </div>
                @endforeach
            </div>
            @foreach($cases as $tapNr => $case)
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2" x-show="tab == {{ $tapNr }}">
                    @foreach($case->list('columns')->columns(['title'])->min(2)->max(2) as $column)
                        <div class="m-10 mt-0 relative space-y-4">
                            <div class="rounded-lg p-4 bg-blue-300 text-xl flex justify-center m-8">
                                <h3>{{ $column->text('title')->min(1)->max(50) }}</h3>
                            </div>
                            @foreach($column->list('step')->columns(['description'])->min(1)->max(10) as $nr => $step)
                                <div class="bg-white rounded-lg">
                                    <div class="p-4 flex items-center justify-between space-x-8">
                                        <div class="rounded-lg p-2 bg-blue-300 text-white">
                                            Step {{ $nr + 1 }}
                                        </div>
                                        <div class="flex-1 flex justify-between items-center font-body">
                                            {{ $step->text('description')->min(1)->max(100) }}
                                        </div>
                                    </div>
                                    @php($example = $step->text('example')->default(''))
                                    @if($example != '')
                                        <div class="pb-3 text-center text-gray-500 font-body">
                                            {{ $example }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>