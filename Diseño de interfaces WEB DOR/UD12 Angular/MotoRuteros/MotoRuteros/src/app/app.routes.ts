import { Routes } from '@angular/router';
import { InicioComponent } from './components/inicio/inicio.component';
import { MusicaComponent } from './components/musica/musica.component';
import { CineComponent } from './components/cine/cine.component';
import { LibrosComponent } from './components/libros/libros.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { ErrorComponent } from './components/error/error.component';

//Rellenamos las rutas, lo llevamos al navegador para comprobar el funcionamiento
export const routes: Routes = [
  {path: '', component: InicioComponent},
    {path: 'inicio', component: InicioComponent},
    {path: 'musica', component: MusicaComponent},
    {path: 'musica/:genero', component: MusicaComponent},
    {path: 'cine', component: CineComponent},
    {path: 'libros', component: LibrosComponent},
    {path: 'contacto', component: ContactoComponent},
    {path: '**', component: ErrorComponent}
];
