<div class="mt-8">
    <h2>Metrics</h2>
    <div wire:poll>
        <p>Core temperature: {{$metrics['cpuTemp'][0]}}</p>
        <p>Uptime: {{$metrics['uptime'][0]}}</p>
    </div>
</div>