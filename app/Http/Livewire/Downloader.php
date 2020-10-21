<?php

namespace App\Http\Livewire;

include_once __DIR__ . '/youtube-downloader/src/YouTubeDownloader.php';
include_once __DIR__ . '/youtube-downloader/src/Browser.php';
include_once __DIR__ . '/youtube-downloader/src/Utils.php';
include_once __DIR__ . '/youtube-downloader/src/Parser.php';

use Livewire\Component;
use YouTube\YouTubeDownloader;
use Illuminate\Support\Facades\Storage;

class Downloader extends Component
{
    public $videoUrl;
    public $results;
    public $step;
    public $downloadLink;

    public function mount(){
        $this->reset();
        $this->step = 'init';
    }

    public function createLinks(){
        $this->reset('results');
        $streamedObject = new YouTubeDownloader;
        $links = $streamedObject->getDownloadLinks($this->videoUrl);

        //filter down the results with embedded audio
        foreach ($links as $key => $link){
            if (strpos($link['format'], 'audio')){
                $this->results[] = $link;
            }
        }
        $this->step = 'ready';
    }

    public function render()
    {   $results = $this->results;
        return view('livewire.downloader', compact('results'));
    }
}
