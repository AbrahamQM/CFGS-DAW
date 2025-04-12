import { Routes } from '@angular/router';
import { InicioComponent } from './components/inicio/inicio.component';
import { ReservasComponent } from './components/reservas/reservas.component';
import { DetalleComponent } from './components/detalle/detalle.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { ErrorComponent } from './components/error/error.component';

//Rellenamos las rutas, lo llevamos al navegador para comprobar el funcionamiento
export const routes: Routes = [
  {path: '', component: InicioComponent},
    {path: 'inicio', component: InicioComponent},
    {path: 'detalle', component: DetalleComponent},
    {path: 'detalle/:libro', component: DetalleComponent},
    {path: 'reservas', component: ReservasComponent},
    {path: 'contacto', component: ContactoComponent},
    {path: '**', component: ErrorComponent}
];
