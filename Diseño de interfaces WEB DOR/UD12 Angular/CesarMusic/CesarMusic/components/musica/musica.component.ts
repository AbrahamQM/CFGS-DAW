import { Component, afterNextRender } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-musica',
  imports: [],
  templateUrl: './musica.component.html',
  styleUrl: './musica.component.css'
})

//Esto es activateroute para poder movernos por la página
export class MusicaComponent {
  public genero:string= "";

  constructor(
    private route: ActivatedRoute
  ){
      afterNextRender(()=>{
        this.route.params.subscribe((params: Params) => {
          this.genero = params["genero"];
          console.log("genero: ", this.genero);
        })
      })
  }
}
