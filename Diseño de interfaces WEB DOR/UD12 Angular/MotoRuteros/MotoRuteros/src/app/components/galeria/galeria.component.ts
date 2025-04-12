import { Component , AfterViewInit} from '@angular/core';

@Component({
  selector: 'app-galeria',
  imports: [],
  templateUrl: './galeria.component.html',
  styleUrl: './galeria.component.css'
})
export class GaleriaComponent implements AfterViewInit {
  ngAfterViewInit(): void {
    // Cargar la API de YouTube
    const tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode?.insertBefore(tag, firstScriptTag);

    // Esperar a que la API esté lista
    (window as any).onYouTubeIframeAPIReady = () => {
      const iframes = document.querySelectorAll('.video-frame');
      iframes.forEach((iframe: any) => {
        const player = new (window as any).YT.Player(iframe, {
          events: {
            onReady: (event: any) => {
              iframe.parentElement.addEventListener('mouseover', () => event.target.playVideo());
              iframe.parentElement.addEventListener('mouseout', () => event.target.pauseVideo());
            }
          }
        });
      });
    };
  }
}