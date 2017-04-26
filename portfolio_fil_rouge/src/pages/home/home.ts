import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { PresentationPage } from '../presentation/presentation.ts';
import { ProjetsPage } from '../projets/projets';
import { ContactPage } from '../contact/contact';


@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})

export class HomePage {

  constructor(public navCtrl: NavController, public navParams: NavParams) {
    
  }

  presentation = PresentationPage;
  projets = ProjetsPage;
  contact = ContactPage;
    	
}
