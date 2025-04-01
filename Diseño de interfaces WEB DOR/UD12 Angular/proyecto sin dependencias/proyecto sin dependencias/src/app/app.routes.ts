import { Routes } from '@angular/router';
import { InicioComponent } from './components/inicio/inicio.component';
import path from 'path';
import { MusicaComponent } from './components/musica/musica.component';
import { CineComponent } from './components/cine/cine.component';
import { ErrorComponent } from './components/error/error.component';
import { ContactoComponent } from './components/contacto/contacto.component';

export const routes: Routes = [
    {path: '', component: InicioComponent},
    {path: 'inicio', component: InicioComponent},
    {path: 'musica', component: MusicaComponent},
    {path: 'cine', component: CineComponent},
    {path: 'contacto', component: ContactoComponent},
    {path: '**', component: ErrorComponent}, //Ojo esta debe ir al final o oculta todas las demás rutas
];
