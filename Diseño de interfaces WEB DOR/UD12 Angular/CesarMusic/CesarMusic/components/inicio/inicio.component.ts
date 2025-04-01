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
    this.titulo = "CesarMusic";
    this.pulsaciones = 0;
  }

  pulsar():void{
    this.pulsaciones++;
  }
  reset():void{
    this.pulsaciones=0;
  }
}
