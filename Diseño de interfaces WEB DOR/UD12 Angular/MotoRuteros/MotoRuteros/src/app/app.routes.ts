import { Routes } from '@angular/router';
import { InicioComponent } from './components/inicio/inicio.component';
import { RutasComponent } from './components/rutas/rutas.component';
import { TiendaComponent } from './components/tienda/tienda.component';
import { GaleriaComponent } from './components/galeria/galeria.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { ErrorComponent } from './components/error/error.component';
import { CamisetasComponent } from './components/tienda/camisetas/camisetas.component';
import { GorrasComponent } from './components/tienda/gorras/gorras.component';

//Rellenamos las rutas, lo llevamos al navegador para comprobar el funcionamiento
export const routes: Routes = [
  {path: '', component: InicioComponent},
    {path: 'inicio', component: InicioComponent},
    {path: 'rutas', component: RutasComponent},
    {path: 'rutas/:destino', component: RutasComponent},
    {path: 'tienda', component: TiendaComponent},
    {path: 'tienda/camisetas', component: CamisetasComponent},
    {path: 'tienda/gorras', component: GorrasComponent},
    {path: 'galeria', component: GaleriaComponent},
    {path: 'contacto', component: ContactoComponent},
    {path: '**', component: ErrorComponent}
];
