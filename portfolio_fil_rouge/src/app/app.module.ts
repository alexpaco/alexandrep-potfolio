import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';
import { HomePage } from '../pages/home/home';
import { PresentationPage } from '../pages/presentation/presentation';
import { ProjetsPage } from '../pages/projets/projets';
import { ContactPage } from '../pages/contact/contact';
import { ProjetSeulPage } from '../pages/projetseul/projetseul';


@NgModule({
  declarations: [
    MyApp,
    HomePage,
    PresentationPage,
    ProjetsPage,
    ContactPage,
    ProjetSeulPage,
  ],
  imports: [
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [
    IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    PresentationPage,
    ProjetsPage,
    ContactPage,
    ProjetSeulPage,
  ],
  providers: [
    {provide: ErrorHandler, useClass: IonicErrorHandler}
  ]
})
export class AppModule {
}
