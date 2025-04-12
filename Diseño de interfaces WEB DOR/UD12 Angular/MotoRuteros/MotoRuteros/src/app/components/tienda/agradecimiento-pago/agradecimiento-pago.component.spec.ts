import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AgradecimientoPagoComponent } from './agradecimiento-pago.component';

describe('AgradecimientoPagoComponent', () => {
  let component: AgradecimientoPagoComponent;
  let fixture: ComponentFixture<AgradecimientoPagoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [AgradecimientoPagoComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AgradecimientoPagoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
