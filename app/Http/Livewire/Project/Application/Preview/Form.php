<?php

namespace App\Http\Livewire\Project\Application\Preview;

use App\Models\Application;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Url\Url;

class Form extends Component
{
    public Application $application;
    public string $preview_url_template;
    protected $rules = [
        'application.preview_url_template' => 'required',
    ];
    protected $validationAttributes = [
        'application.preview_url_template' => 'preview url template',
    ];

    public function resetToDefault()
    {
        $this->application->preview_url_template = '{{pr_id}}.{{domain}}';
        $this->preview_url_template = $this->application->preview_url_template;
        $this->application->save();
        $this->generate_real_url();
    }

    public function generate_real_url()
    {
        if (data_get($this->application, 'fqdn')) {
            $url = Url::fromString($this->application->fqdn);
            $host = $url->getHost();
            $this->preview_url_template = Str::of($this->application->preview_url_template)->replace('{{domain}}', $host);
        }
    }

    public function mount()
    {
        $this->generate_real_url();
    }

    public function submit()
    {
        $this->validate();
        $this->application->preview_url_template = str_replace(' ', '', $this->application->preview_url_template);
        $this->application->save();
        $this->emit('success', 'Preview url template updated successfully.');
        $this->generate_real_url();
    }
}
