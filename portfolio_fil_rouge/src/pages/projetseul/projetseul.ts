import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';



@Component({
  selector: 'page-projetseul',
  templateUrl: 'projetseul.html'
})
export class ProjetSeulPage {

	selectionProjet: any;

	constructor(public navCtrl: NavController, public navParams: NavParams) {

    	this.selectionProjet = navParams.get('projet');
  }
}
