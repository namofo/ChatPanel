<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Inicio extends Page
{
    protected static ?string $navigationLabel = 'Inicio';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static string $view = 'filament.pages.inicio';

    public $content;

    public function mount(): void
    {
        $this->content = '
        <div>
            <h1>Guía de Uso para crear ChatBots de Whatsapp.</h1>
                </br>
            <p>🔷 En esta plataforma puedes crear tus propios chatbots autorespondedores para WhatsApp.</p>
                </br>
            <p>🤖 Crea tu Chatbot con Inteligencia Artificial.</p>
                </br>
            <p>🫨 Crea tu Chatbot con Flujos definidos.</p>
                </br>
            <p>🔷 Si necesitas funciones adicionales, por favor hágamelo saber para poder implementarlas.</p>
                </br>
            <p>🤖 Para implementa inteligencia artificial en tu chatbot necesitas APIs como ChatGPT para aprovecha sus potentes funciones.</br>
               <br>Recuerda que el uso de estas APIs implica costos asociados al consumo.💵</p>
                </br>
            <p>🎯 Tu chatbot con flujos funciona sin inteligencia artificial, NO necesita API y NO hay costos asociados.🙂</p>
                </br>
            <p>🎦 Tutorial para crear Chatbots de Whatsapp con Inteligencia Artificial.👇</p>
                </br>
            <img src="https://website-assets-fw.freshworks.com/attachments/ck2x4e02u07j627g0qq45uj0o-byob.one-half.png" alt="">
                
        </br>
        <p>🤖</p>
        </div>';
        
    }

    protected function getViewData(): array
    {
        return [
            'content' => $this->content,
        ];
    }
}
