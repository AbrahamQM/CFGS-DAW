import { Component } from '@angular/core';

@Component({
  selector: 'app-inicio',
  imports: [],
  templateUrl: './inicio.component.html',
  styleUrl: './inicio.component.css'
})
export class InicioComponent {
  public titulo:string;
  public pulsaciones:number;
  
  constructor(){
    this.titulo = "Bienvenido éste es el título en una variable";
    this.pulsaciones = 0;
  }

  pulsado():void{
    this.pulsaciones++;
  }
}
