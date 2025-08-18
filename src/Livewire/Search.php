<?php
 
namespace Bishopm\Lightworx\Livewire;

use Bishopm\Lightworx\Models\Document;
use Bishopm\Lightworx\Models\Tag;
use Livewire\Component;

class Search extends Component
{
    public $query;
    public $results;

    public function mount(){
        $this->query="";
        $this->results['documents']=Document::orderBy('document')->get();
    }

    public function tagsearch($slug){
        $tag=Tag::with('documents')->whereSlug($slug)->first();
        $this->results['documents']=$tag->documents;
    }

    public function updatedQuery(){
        if (strlen($this->query) > 1){
            $this->results['documents']=Document::with('tags')->where('document','like','%' . $this->query . '%')
                ->orWhereHas('tags', function ($q) { $q->where('name', 'like', '%' . $this->query . '%'); })
                ->get();
        } else {
            $this->results['documents']=Document::orderBy('document')->get();
        }
    }

    public function render()
    {
        return view('lightworx::livewire.search');
    }
}