<div class="mt-8">
    <h2>Metrics</h2>
    <div class="font-thin" wire:poll>
        @foreach ($metrics['cpuTemp'] as $cpuTempLine)
        @if (!empty($cpuTempLine))
        <p>
            <svg class="w-8 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{$cpuTempLine}}
        </p>
        @else
        <p>Cannot read CPU TEMP</p>
        @endif
        @endforeach
        @foreach ( $metrics['uptime'] as $uptimeLine)
        @if (!empty($uptimeLine))
        <p>
            <svg class="w-8 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{$uptimeLine}}
        </p>
        @else
        <p>Cannot read UPTIME</p>
        @endif
        @endforeach
    </div>
</div>




