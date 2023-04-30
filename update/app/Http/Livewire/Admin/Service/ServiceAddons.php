<?php
namespace App\Http\Livewire\Admin\Service;
use App\Models\Addon;
use App\Models\OrderAddonDetail;
use App\Models\Translation;
use Livewire\Component;
class ServiceAddons extends Component
{
    public $name,$price,$addon,$addons,$is_active=1,$search_query,$lang;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.service.service-addons');
    }
    /* process before render */
    public function mount()
    {
        $this->addons = Addon::latest()->get();
        if(session()->has('selected_language'))
        {   /* if session has selected language */
            $this->lang = Translation::where('id',session()->get('selected_language'))->first();
        }
        else{
            /* if session has no selected language */
            $this->lang = Translation::where('default',1)->first();
        }
    }
    /* create service addon */
    public function create()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);
        Addon::create([
            'addon_name'  => $this->name,
            'addon_price' => $this->price,
            'is_active' => 1
        ]);
        $this->name = '';
        $this->price= '';
        $this->is_active = 1;
        $this->addons = Addon::latest()->get();
        $this->emit('closemodal');
    }
    /* set content to edit */
    public function edit($id)
    {
        $this->addon = Addon::where('id',$id)->first();
        $this->name = $this->addon->addon_name;
        $this->price = $this->addon->addon_price;

    }
    /* update addon */
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);
        /* if any addon is exist */
        if($this->addon)
        {
            $this->addon->addon_name = $this->name;
            $this->addon->addon_price = $this->price;
            $this->addon->is_active = $this->is_active ?? 0;
            $this->addon->save();
        }
        $this->name = '';
        $this->price= '';
        $this->addons = Addon::latest()->get();
        $this->emit('closemodal');
    }
    /* process while change the element */
    public function updated($name,$value)
    {
        /* if the updated value is search_query */
        if($name == 'search_query' && $value != '')
        {
            $this->addons = Addon::where('addon_name', 'like' , '%'.$value.'%')->get();
        }
        elseif($name == 'search_query' && $value == ''){
            $this->addons = Addon::latest()->get();

        }
    }
    /* delete addon */
    public function delete($id)
    {
        if (\App\Models\OrderAddonDetail::where('addon_id', $id)->doesntExist()) {
            /* if addon has any childen */
            $addon = Addon::where('id',$id)->delete();
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'success',  'message' => 'AddOn deleted Successfully!']);
        } else {
            /* if addon has no children */
                $this->dispatchBrowserEvent(
                'alert', ['type' => 'error',  'message' => 'Addon deletion restricted!']);
        }
        $this->addons = Addon::latest()->get();
    }
    //Reset Fields
    public function resetFields()
    {
        $this->name = '';
        $this->price = '';
        $this->is_active = 1;
        $this->addon = null;
    }
}