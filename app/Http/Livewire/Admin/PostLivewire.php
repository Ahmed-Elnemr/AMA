<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;

class PostLivewire extends Component
{
    public $search='';


    public $postId;

    public function deletePost(int $post_id){
        $this->postId=$post_id;
        // $this->destroyPost();
    }


   public function destroyPost(){
    // dd('nemr');
   $post=Post::find($this->postId);
   $post->delete();
    session()->flash('message', 'Post Deleted Successfully');

    $this->dispatchBrowserEvent('close-modal');
    $this->resetInput();
   }

   public function closeModal()
   {
       $this->resetInput();
   }

   public function resetInput()
   {
       $this->postId = '';
   }

    public function render()
    {



        $posts = Post::where('post_playload', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        // $posts = Post::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.admin.post-livewire',[

            'posts'=>$posts,
        ]);
    }
}
