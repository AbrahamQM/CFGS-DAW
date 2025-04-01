import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { InicioComponent } from './components/inicio/inicio.component';
import { FooterComponent } from './components/footer/footer.component';
import { CabeceraComponent } from './components/cabecera/cabecera.component';
import { NavComponent } from './components/nav/nav.component';
import { MusicaComponent } from './components/musica/musica.component';
import { CineComponent } from './components/cine/cine.component';

@Component({
  selector: 'app-root',
  imports: [
    RouterOutlet, 
    InicioComponent, 
    FooterComponent, 
    CabeceraComponent, 
    NavComponent, 
    MusicaComponent, 
    CineComponent
  ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'Music';
}
